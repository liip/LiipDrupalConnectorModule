<?php
/**
 * Abstraction of the procedural Drupal world into OOP.
 *
 * @author     Bastian Feder <drupal@bastian-feder.de>
 * @license    http://www.opensource.org/licenses/mit-license.php The MIT License
 * @copyright  Copyright (c) 2012 liip ag
 *
 * @package    DrupalConnector
 * @subpackage Module
 */

namespace Liip\Drupal\Modules\DrupalConnector;

class Common
{
    /**
     * Formats a date, using a date type or a custom date format string.
     *
     * @param $timestamp
     *   A UNIX timestamp to format.
     * @param $type
     *   (optional) The format to use, one of:
     *   - 'short', 'medium', or 'long' (the corresponding built-in date formats).
     *   - The name of a date type defined by a module in hook_date_format_types(),
     *     if it's been assigned a format.
     *   - The machine name of an administrator-defined date format.
     *   - 'custom', to use $format.
     *   Defaults to 'medium'.
     * @param $format
     *   (optional) If $type is 'custom', a PHP date format string suitable for
     *   input to date(). Use a backslash to escape ordinary text, so it does not
     *   get interpreted as date format characters.
     * @param $timezone
     *   (optional) Time zone identifier, as described at
     *   http://php.net/manual/en/timezones.php Defaults to the time zone used to
     *   display the page.
     * @param $langcode
     *   (optional) Language code to translate to. Defaults to the language used to
     *   display the page.
     *
     * @return
     *   A translated date string in the requested format.
     */
    function format_date($timestamp, $type = 'medium', $format = '', $timezone = NULL, $langcode = NULL)
    {
        return format_date($timestamp, $type, $format, $timezone, $langcode);
    }

    /**
     * Formats an internal or external URL link as an HTML anchor tag.
     *
     * This function correctly handles aliased paths, and adds an 'active' class
     * attribute to links that point to the current page (for theming), so all
     * internal links output by modules should be generated by this function if
     * possible.
     *
     * @param string $text       The link text for the anchor tag.
     * @param string $path       The internal path or external URL being linked to, such as "node/34" or
     *                            "http://example.com/foo". After the url() function is called to construct
     *                           the URL from $path and $options, the resulting URL is passed through
     *                           check_plain() before it is inserted into the HTML anchor tag, to ensure
     *                           well-formed HTML. See url() for more information and notes.
     * @param array  $options    An associative array of additional options, with the following elements:
     *                         - 'attributes': An associative array of HTML attributes to apply to the
     *                           anchor tag. If element 'class' is included, it must be an array; 'title'
     *                           must be a string; other elements are more flexible, as they just need
     *                           to work in a call to drupal_attributes($options['attributes']).
     *                         - 'html' (default FALSE): Whether $text is HTML or just plain-text. For
     *                           example, to make an image tag into a link, this must be set to TRUE, or
     *                           you will see the escaped HTML image tag. $text is not sanitized if
     *                           'html' is TRUE. The calling function must ensure that $text is already
     *                           safe.
     *                         - 'language': An optional language object. If the path being linked to is
     *                           internal to the site, $options['language'] is used to determine whether
     *                           the link is "active", or pointing to the current page (the language as
     *                           well as the path must match). This element is also used by url().
     *                         - Additional $options elements used by the url() function.
     *
     * @return string An HTML string containing a link to the given path.
     */
    public function l($text, $path, $options = array())
    {
        return l($text, $path, $options);
    }

    /**
     * Translates a string to the current language or to a given language.
     *
     * The t() function serves two purposes. First, at run-time it translates
     * user-visible text into the appropriate language. Second, various mechanisms
     * that figure out what text needs to be translated work off t() -- the text
     * inside t() calls is added to the database of strings to be translated.
     * These strings are expected to be in English, so the first argument should
     * always be in English. To enable a fully-translatable site, it is important
     * that all human-readable text that will be displayed on the site or sent to
     * a user is passed through the t() function, or a related function. See the
     * @link http://drupal.org/node/322729 Localization API @endlink pages for
     *       more information, including recommendations on how to break up or not
     *       break up strings for translation.
     *
     * You should never use t() to translate variables, such as calling
     * @code t($text); @endcode, unless the text that the variable holds has been
     *       passed through t() elsewhere (e.g., $text is one of several translated
     *       literal strings in an array). It is especially important never to call
     * @code t($user_text); @endcode, where $user_text is some text that a user
     *       entered - doing that can lead to cross-site scripting and other security
     *       problems. However, you can use variable substitution in your string, to put
     *       variable text such as user names or link URLs into translated text. Variable
     *       substitution looks like this:
     *
     * @code
     * $text = t("@name's blog", array('@name' => format_username($account)));
     * @endcode
     *
     *       Basically, you can put variables like @name into your string, and t() will
     *       substitute their sanitized values at translation time. (See the
     *       Localization API pages referenced above and the documentation of
     *       format_string() for details.) Translators can then rearrange the string as
     *       necessary for the language (e.g., in Spanish, it might be "blog de @name").
     *
     * During the Drupal installation phase, some resources used by t() wil not be
     * available to code that needs localization. See st() and get_t() for
     * alternatives.
     *
     * @param string $string     A string containing the English string to translate.
     * @param array  $args       An associative array of replacements to make after translation. Based
     *                           on the first character of the key, the value is escaped and/or themed.
     *                           See format_string() for details.
     * @param array  $options    An associative array of additional options, with the following elements:
     *                         - 'langcode' (defaults to the current language): The language code to
     *                           translate to a language other than what is used to display the page.
     *                         - 'context' (defaults to the empty context): The context the source string
     *                           belongs to.
     *
     * @return string The translated string.
     *
     * @link http://api.drupal.org/api/drupal/includes!bootstrap.inc/function/t/7
     */
    public function t($string, array $args = array(), array $options = array())
    {
        return t($string, $args, $options);
    }

    /**
     * Generates an internal or external URL.
     *
     * When creating links in modules, consider whether l() could be a better
     * alternative than url().
     *
     * @param string $path
     *     The internal path or external URL being linked to, such as "node/34" or
     *   "http://example.com/foo". A few notes:
     *   - If you provide a full URL, it will be considered an external URL.
     *   - If you provide only the path (e.g. "node/34"), it will be
     *     considered an internal link. In this case, it should be a system URL,
     *     and it will be replaced with the alias, if one exists. Additional query
     *     arguments for internal paths must be supplied in $options['query'], not
     *     included in $path.
     *   - If you provide an internal path and $options['alias'] is set to TRUE, the
     *     path is assumed already to be the correct path alias, and the alias is
     *     not looked up.
     *   - The special string '<front>' generates a link to the site's base URL.
     *   - If your external URL contains a query (e.g. http://example.com/foo?a=b),
     *     then you can either URL encode the query keys and values yourself and
     *     include them in $path, or use $options['query'] to let this function
     *     URL encode them.
     * @param array  $options
     *     An associative array of additional options, with the following elements:
     *   - 'query': An array of query key/value-pairs (without any URL-encoding) to
     *     append to the URL.
     *   - 'fragment': A fragment identifier (named anchor) to append to the URL.
     *     Do not include the leading '#' character.
     *   - 'absolute': Defaults to FALSE. Whether to force the output to be an
     *     absolute link (beginning with http:). Useful for links that will be
     *     displayed outside the site, such as in an RSS feed.
     *   - 'alias': Defaults to FALSE. Whether the given path is a URL alias
     *     already.
     *   - 'external': Whether the given path is an external URL.
     *   - 'language': An optional language object. If the path being linked to is
     *     internal to the site, $options['language'] is used to look up the alias
     *     for the URL. If $options['language'] is omitted, the global $language_url
     *     will be used.
     *   - 'https': Whether this URL should point to a secure location. If not
     *     defined, the current scheme is used, so the user stays on http or https
     *     respectively. TRUE enforces HTTPS and FALSE enforces HTTP, but HTTPS can
     *     only be enforced when the variable 'https' is set to TRUE.
     *   - 'base_url': Only used internally, to modify the base URL when a language
     *     dependent URL requires so.
     *   - 'prefix': Only used internally, to modify the path when a language
     *     dependent URL requires so.
     *   - 'script': The script filename in Drupal's root directory to use when
     *     clean URLs are disabled, such as 'index.php'. Defaults to an empty
     *     string, as most modern web servers automatically find 'index.php'. If
     *     clean URLs are disabled, the value of $path is appended as query
     *     parameter 'q' to $options['script'] in the returned URL. When deploying
     *     Drupal on a web server that cannot be configured to automatically find
     *     index.php, then hook_url_outbound_alter() can be implemented to force
     *     this value to 'index.php'.
     *   - 'entity_type': The entity type of the object that called url(). Only
     *     set if url() is invoked by entity_uri().
     *   - 'entity': The entity object (such as a node) for which the URL is being
     *     generated. Only set if url() is invoked by entity_uri().
     *
     * @return string A string containing a URL to the given path.
     *
     * @link http://api.drupal.org/api/drupal/includes!common.inc/function/url/7
     */
    public function url($path = null, $options = array())
    {
        return url($path, $options);
    }

    /**
     * Returns a persistent variable.
     *
     * Case-sensitivity of the variable_* functions depends on the database
     * collation used. To avoid problems, always use lower case for persistent
     * variable names.
     *
     * @param $name
     *   The name of the variable to return.
     * @param $default
     *   The default value to use if this variable has never been set.
     *
     * @return
     *       The value of the variable. Unserialization is taken care of as necessary.
     *
     * @link http://api.drupal.org/api/drupal/includes!bootstrap.inc/function/variable_get/7
     */
    public function variable_get($name, $default)
    {
        return variable_get($name, $default);
    }

    /**
     * Sets a persistent variable.
     *
     * Case-sensitivity of the variable_* functions depends on the database
     * collation used. To avoid problems, always use lower case for persistent
     * variable names.
     *
     * @param $name
     *   The name of the variable to set.
     * @param $value
     *   The value to set. This can be any PHP data type; these functions take care
     *   of serialization as necessary.
     *
     * @link http://api.drupal.org/api/drupal/includes!bootstrap.inc/function/variable_set/7
     */
    public function variable_set($name, $value)
    {
        return variable_set($name, $value);
    }

    /**
     * Logs a system message.
     *
     * @param string  $type       The category to which this message belongs. Can be any string, but the
     *                            general practice is to use the name of the module calling watchdog().
     * @param string  $message    The message to store in the log. Keep $message translatable
     *                            by not concatenating dynamic values into it! Variables in the
     *                            message should be added by using placeholder strings alongside
     *                            the variables argument to declare the value of the placeholders.
     *                            See t() for documentation on how $message and $variables interact.
     * @param array   $variables  Array of variables to replace in the message on display or
     *                            NULL if message is already translated or not possible to translate.
     * @param integer $severity   The severity of the message; one of the following values as defined in
     *
     * @link http://www.faqs.org/rfcs/rfc3164.html RFC 3164: @endlink
     *                            - WATCHDOG_EMERGENCY: Emergency, system is unusable.
     *                            - WATCHDOG_ALERT: Alert, action must be taken immediately.
     *                            - WATCHDOG_CRITICAL: Critical conditions.
     *                            - WATCHDOG_ERROR: Error conditions.
     *                            - WATCHDOG_WARNING: Warning conditions.
     *                            - WATCHDOG_NOTICE: (default) Normal but significant conditions.
     *                            - WATCHDOG_INFO: Informational messages.
     *                            - WATCHDOG_DEBUG: Debug-level messages.
     *
     * @param string  $link       A link to associate with the message.
     *
     * @link http://api.drupal.org/api/drupal/includes!bootstrap.inc/function/watchdog/7
     */
    public function watchdog($type, $message, $variables = array(), $severity = WATCHDOG_NOTICE, $link = null)
    {
        return watchdog($type, $message, $variables, $severity, $link);
    }
}
