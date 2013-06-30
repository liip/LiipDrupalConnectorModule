<?php

/**
 * Abstraction of the procedural Drupal world into OOP.
 *
 * @author     Daniel Barsotti <daniel.barsotti@liip.ch>
 * @license    http://www.opensource.org/licenses/mit-license.php The MIT License
 * @copyright  Copyright (c) 2012 liip ag
 *
 * @package DrupalConnector
 * @subpackage Filter
 */

namespace Liip\Drupal\Modules\DrupalConnector;

/**
 * Cumulates the filter functions of Drupal 7 in one class.
 *
 * Please order the functions alphabetically!
 */
class Filter
{
    /**
     * Returns the ID of the default text format for a particular user.
     *
     * The default text format is the first available format that the user is
     * allowed to access, when the formats are ordered by weight. It should
     * generally be used as a default choice when presenting the user with a list
     * of possible text formats (for example, in a node creation form).
     *
     * Conversely, when existing content that does not have an assigned text format
     * needs to be filtered for display, the default text format is the wrong
     * choice, because it is not guaranteed to be consistent from user to user, and
     * some trusted users may have an unsafe text format set by default, which
     * should not be used on text of unknown origin. Instead, the fallback format
     * returned by filter_fallback_format() should be used, since that is intended
     * to be a safe, consistent format that is always available to all users.
     *
     * @param $account
     *   (optional) The user account to check. Defaults to the currently logged-in
     *   user.
     * @return
     *   The ID of the user's default text format.
     *
     * @see filter_fallback_format()
     */
    public function filter_default_format($account = null)
    {
        return filter_default_format($account);
    }

    /**
     * Load a text format object from the database.
     *
     * @param $format_id
     *   The format ID.
     *
     * @return
     *   A fully-populated text format object, if the requested format exists and
     *   is enabled. If the format does not exist, or exists in the database but
     *   has been marked as disabled, FALSE is returned.
     *
     * @see filter_format_exists()
     */
    public function filter_format_load($format_id)
    {
        return filter_format_load($format_id);
    }

    /**
     * Disable a text format.
     *
     * There is no core facility to re-enable a disabled format. It is not deleted
     * to keep information for contrib and to make sure the format ID is never
     * reused. As there might be content using the disabled format, this would lead
     * to data corruption.
     *
     * @param $format
     *   The text format object to be disabled.
     */
    public function filter_format_disable($format)
    {
        return filter_format_disable($format);
    }

    /**
     * Determines if a text format exists.
     *
     * @param $format_id
     *   The ID of the text format to check.
     *
     * @return
     *   TRUE if the text format exists, FALSE otherwise. Note that for disabled
     *   formats filter_format_exists() will return TRUE while filter_format_load()
     *   will return FALSE.
     *
     * @see filter_format_load()
     */
    public function filter_format_exists($format_id)
    {
        return filter_format_exists($format_id);
    }

    /**
     * Returns the machine-readable permission name for a provided text format.
     *
     * @param $format
     *   An object representing a text format.
     * @return
     *   The machine-readable permission name, or FALSE if the provided text format
     *   is malformed or is the fallback format (which is available to all users).
     */
    public function filter_permission_name($format)
    {
        return filter_permission_name($format);
    }

    /**
     * Retrieve a list of text formats, ordered by weight.
     *
     * @param $account
     *   (optional) If provided, only those formats that are allowed for this user
     *   account will be returned. All formats will be returned otherwise.
     * @return
     *   An array of text format objects, keyed by the format ID and ordered by
     *   weight.
     *
     * @see filter_formats_reset()
     */
    public function filter_formats($account = null)
    {
        return filter_formats($account);
    }

    /**
     * Resets text format caches.
     *
     * @see filter_formats()
     */
    public function filter_formats_reset()
    {
        return filter_formats_reset();
    }

    /**
     * Retrieves a list of roles that are allowed to use a given text format.
     *
     * @param $format
     *   An object representing the text format.
     * @return
     *   An array of role names, keyed by role ID.
     */
    public function filter_get_roles_by_format($format)
    {
        return filter_get_roles_by_format($format);
    }

    /**
     * Retrieves a list of text formats that are allowed for a given role.
     *
     * @param $rid
     *   The user role ID to retrieve text formats for.
     * @return
     *   An array of text format objects that are allowed for the role, keyed by
     *   the text format ID and ordered by weight.
     */
    public function filter_get_formats_by_role($rid)
    {
        return filter_get_formats_by_role($rid);
    }

    /**
     * Returns the ID of the fallback text format that all users have access to.
     *
     * The fallback text format is a regular text format in every respect, except
     * it does not participate in the filter permission system and cannot be
     * disabled. It needs to exist because any user who has permission to create
     * formatted content must always have at least one text format they can use.
     *
     * Because the fallback format is available to all users, it should always be
     * configured securely. For example, when the Filter module is installed, this
     * format is initialized to output plain text. Installation profiles and site
     * administrators have the freedom to configure it further.
     *
     * Note that the fallback format is completely distinct from the default
     * format, which differs per user and is simply the first format which that
     * user has access to. The default and fallback formats are only guaranteed to
     * be the same for users who do not have access to any other format; otherwise,
     * the fallback format's weight determines its placement with respect to the
     * user's other formats.
     *
     * Any modules implementing a format deletion functionality must not delete
     * this format.
     *
     * @see hook_filter_format_disable()
     * @see filter_default_format()
     */
    public function filter_fallback_format()
    {
        return filter_fallback_format();
    }

    /**
     * Check if text in a certain text format is allowed to be cached.
     *
     * This function can be used to check whether the result of the filtering
     * process can be cached. A text format may allow caching depending on the
     * filters enabled.
     *
     * @param $format_id
     *   The text format ID to check.
     * @return
     *   TRUE if the given text format allows caching, FALSE otherwise.
     */
    public function filter_format_allowcache($format_id)
    {
        return filter_format_allowcache($format_id);
    }

    /**
     * Retrieve a list of filters for a given text format.
     *
     * Note that this function returns all associated filters regardless of whether
     * they are enabled or disabled. All functions working with the filter
     * information outside of filter administration should test for $filter->status
     * before performing actions with the filter.
     *
     * @param $format_id
     *   The format ID to retrieve filters for.
     *
     * @return
     *   An array of filter objects associated to the given text format, keyed by
     *   filter name.
     */
    public function filter_list_format($format_id)
    {
        return filter_list_format($format_id);
    }

    /**
     * Run all the enabled filters on a piece of text.
     *
     * Note: Because filters can inject JavaScript or execute PHP code, security is
     * vital here. When a user supplies a text format, you should validate it using
     * filter_access() before accepting/using it. This is normally done in the
     * validation stage of the Form API. You should for example never make a preview
     * of content in a disallowed format.
     *
     * @param $text
     *   The text to be filtered.
     * @param $format_id
     *   The format id of the text to be filtered. If no format is assigned, the
     *   fallback format will be used.
     * @param $langcode
     *   Optional: the language code of the text to be filtered, e.g. 'en' for
     *   English. This allows filters to be language aware so language specific
     *   text replacement can be implemented.
     * @param $cache
     *   Boolean whether to cache the filtered output in the {cache_filter} table.
     *   The caller may set this to FALSE when the output is already cached
     *   elsewhere to avoid duplicate cache lookups and storage.
     *
     * @ingroup sanitization
     */
    public function check_markup($text, $format_id = null, $langcode = '', $cache = FALSE)
    {
        return check_markup($text, $format_id, $langcode, $cache);
    }

    /**
     * Expands an element into a base element with text format selector attached.
     *
     * The form element will be expanded into two separate form elements, one
     * holding the original element, and the other holding the text format selector:
     * - value: Holds the original element, having its #type changed to the value of
     *   #base_type or 'textarea' by default.
     * - format: Holds the text format fieldset and the text format selection, using
     *   the text format id specified in #format or the user's default format by
     *   default, if null.
     *
     * The resulting value for the element will be an array holding the value and the
     * format.  For example, the value for the body element will be:
     * @code
     *   $form_state['values']['body']['value'] = 'foo';
     *   $form_state['values']['body']['format'] = 'foo';
     * @endcode
     *
     * @param $element
     *   The form element to process. Properties used:
     *   - #base_type: The form element #type to use for the 'value' element.
     *     'textarea' by default.
     *   - #format: (optional) The text format id to preselect. If null or not set,
     *     the default format for the current user will be used.
     *
     * @return
     *   The expanded element.
     */
    public function filter_process_format($element)
    {
        return filter_process_format($element);
    }

    /**
     * #pre_render callback for #type 'text_format' to hide field value from prying eyes.
     *
     * To not break form processing and previews if a user does not have access to a
     * stored text format, the expanded form elements in filter_process_format() are
     * forced to take over the stored #default_values for 'value' and 'format'.
     * However, to prevent the unfiltered, original #value from being displayed to
     * the user, we replace it with a friendly notice here.
     *
     * @see filter_process_format()
     */
    public function filter_form_access_denied($element)
    {
        return filter_form_access_denied($element);
    }

    /**
     * Returns HTML for a text format-enabled form element.
     *
     * @param $variables
     *   An associative array containing:
     *   - element: A render element containing #children and #description.
     *
     * @ingroup themeable
     */
    public function theme_text_format_wrapper($variables)
    {
        return theme_text_format_wrapper($variables);
    }

    /**
     * Checks if a user has access to a particular text format.
     *
     * @param $format
     *   An object representing the text format.
     * @param $account
     *   (optional) The user account to check access for; if omitted, the currently
     *   logged-in user is used.
     *
     * @return
     *   Boolean TRUE if the user is allowed to access the given format.
     */
    public function filter_access($format, $account = null)
    {
        return filter_access($format, $account);
    }

    /**
     * Parses an HTML snippet and returns it as a DOM object.
     *
     * This function loads the body part of a partial (X)HTML document
     * and returns a full DOMDocument object that represents this document.
     * You can use filter_dom_serialize() to serialize this DOMDocument
     * back to a XHTML snippet.
     *
     * @param $text
     *   The partial (X)HTML snippet to load. Invalid mark-up
     *   will be corrected on import.
     * @return
     *   A DOMDocument that represents the loaded (X)HTML snippet.
     */
    public function filter_dom_load($text)
    {
        return filter_dom_load($text);
    }

    /**
     * Converts a DOM object back to an HTML snippet.
     *
     * The function serializes the body part of a DOMDocument
     * back to an XHTML snippet.
     *
     * The resulting XHTML snippet will be properly formatted
     * to be compatible with HTML user agents.
     *
     * @param $dom_document
     *   A DOMDocument object to serialize, only the tags below
     *   the first <body> node will be converted.
     * @return
     *   A valid (X)HTML snippet, as a string.
     */
    public function filter_dom_serialize($dom_document)
    {
        return filter_dom_serialize($dom_document);
    }

    /**
     * Adds comments around the <!CDATA section in a dom element.
     *
     * DOMDocument::loadHTML in filter_dom_load() makes CDATA sections from the
     * contents of inline script and style tags.  This can cause HTML 4 browsers to
     * throw exceptions.
     *
     * This function attempts to solve the problem by creating a DocumentFragment
     * and imitating the behavior in drupal_get_js(), commenting the CDATA tag.
     *
     * @param $dom_document
     *   The DOMDocument containing the $dom_element.
     * @param $dom_element
     *   The element potentially containing a CDATA node.
     * @param $comment_start
     *   String to use as a comment start marker to escape the CDATA declaration.
     * @param $comment_end
     *   String to use as a comment end marker to escape the CDATA declaration.
     */
    public function filter_dom_serialize_escape_cdata_element($dom_document, $dom_element, $comment_start = '//', $comment_end = '')
    {
        return filter_dom_serialize_escape_cdata_element($dom_document, $dom_element, $comment_start, $comment_end);
    }

    /**
     * Returns HTML for guidelines for a text format.
     *
     * @param $variables
     *   An associative array containing:
     *   - format: An object representing a text format.
     *
     * @ingroup themeable
     */
    public function theme_filter_guidelines($variables)
    {
        return theme_filter_guidelines($variables);
    }
}
