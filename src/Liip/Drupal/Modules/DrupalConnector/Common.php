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
     * Delivers an "access denied" error to the browser.
     *
     * Page callback functions wanting to report an "access denied" message should
     * return MENU_ACCESS_DENIED instead of calling drupal_access_denied(). However,
     * functions that are invoked in contexts where that return value might not
     * bubble up to menu_execute_active_handler() should call
     * drupal_access_denied().
     */
    public function drupal_access_denied()
    {
        drupal_access_denied();
    }

    /**
     * Adds a cascading stylesheet to the stylesheet queue.
     *
     * Calling drupal_static_reset('drupal_add_css') will clear all cascading
     * stylesheets added so far.
     *
     * If CSS aggregation/compression is enabled, all cascading style sheets added
     * with $options['preprocess'] set to TRUE will be merged into one aggregate
     * file and compressed by removing all extraneous white space.
     * Preprocessed inline stylesheets will not be aggregated into this single file;
     * instead, they are just compressed upon output on the page. Externally hosted
     * stylesheets are never aggregated or compressed.
     *
     * The reason for aggregating the files is outlined quite thoroughly here:
     * http://www.die.net/musings/page_load_time/ "Load fewer external objects. Due
     * to request overhead, one bigger file just loads faster than two smaller ones
     * half its size."
     *
     * $options['preprocess'] should be only set to TRUE when a file is required for
     * all typical visitors and most pages of a site. It is critical that all
     * preprocessed files are added unconditionally on every page, even if the
     * files do not happen to be needed on a page. This is normally done by calling
     * drupal_add_css() in a hook_init() implementation.
     *
     * Non-preprocessed files should only be added to the page when they are
     * actually needed.
     *
     * @param $data
     *   (optional) The stylesheet data to be added, depending on what is passed
     *   through to the $options['type'] parameter:
     *   - 'file': The path to the CSS file relative to the base_path(), or a
     *     stream wrapper URI. For example: "modules/devel/devel.css" or
     *     "public://generated_css/stylesheet_1.css". Note that Modules should
     *     always prefix the names of their CSS files with the module name; for
     *     example, system-menus.css rather than simply menus.css. Themes can
     *     override module-supplied CSS files based on their filenames, and this
     *     prefixing helps prevent confusing name collisions for theme developers.
     *     See drupal_get_css() where the overrides are performed. Also, if the
     *     direction of the current language is right-to-left (Hebrew, Arabic,
     *     etc.), the function will also look for an RTL CSS file and append it to
     *     the list. The name of this file should have an '-rtl.css' suffix. For
     *     example, a CSS file called 'mymodule-name.css' will have a
     *     'mymodule-name-rtl.css' file added to the list, if exists in the same
     *     directory. This CSS file should contain overrides for properties which
     *     should be reversed or otherwise different in a right-to-left display.
     *   - 'inline': A string of CSS that should be placed in the given scope. Note
     *     that it is better practice to use 'file' stylesheets, rather than
     *     'inline', as the CSS would then be aggregated and cached.
     *   - 'external': The absolute path to an external CSS file that is not hosted
     *     on the local server. These files will not be aggregated if CSS
     *     aggregation is enabled.
     * @param $options
     *   (optional) A string defining the 'type' of CSS that is being added in the
     *   $data parameter ('file', 'inline', or 'external'), or an array which can
     *   have any or all of the following keys:
     *   - 'type': The type of stylesheet being added. Available options are 'file',
     *     'inline' or 'external'. Defaults to 'file'.
     *   - 'basename': Force a basename for the file being added. Modules are
     *     expected to use stylesheets with unique filenames, but integration of
     *     external libraries may make this impossible. The basename of
     *     'modules/node/node.css' is 'node.css'. If the external library "node.js"
     *     ships with a 'node.css', then a different, unique basename would be
     *     'node.js.css'.
     *   - 'group': A number identifying the group in which to add the stylesheet.
     *     Available constants are:
     *     - CSS_SYSTEM: Any system-layer CSS.
     *     - CSS_DEFAULT: (default) Any module-layer CSS.
     *     - CSS_THEME: Any theme-layer CSS.
     *     The group number serves as a weight: the markup for loading a stylesheet
     *     within a lower weight group is output to the page before the markup for
     *     loading a stylesheet within a higher weight group, so CSS within higher
     *     weight groups take precendence over CSS within lower weight groups.
     *   - 'every_page': For optimal front-end performance when aggregation is
     *     enabled, this should be set to TRUE if the stylesheet is present on every
     *     page of the website for users for whom it is present at all. This
     *     defaults to false. It is set to TRUE for stylesheets added via module and
     *     theme .info files. Modules that add stylesheets within hook_init()
     *     implementations, or from other code that ensures that the stylesheet is
     *     added to all website pages, should also set this flag to TRUE. All
     *     stylesheets within the same group that have the 'every_page' flag set to
     *     TRUE and do not have 'preprocess' set to false are aggregated together
     *     into a single aggregate file, and that aggregate file can be reused
     *     across a user's entire site visit, leading to faster navigation between
     *     pages. However, stylesheets that are only needed on pages less frequently
     *     visited, can be added by code that only runs for those particular pages,
     *     and that code should not set the 'every_page' flag. This minimizes the
     *     size of the aggregate file that the user needs to download when first
     *     visiting the website. Stylesheets without the 'every_page' flag are
     *     aggregated into a separate aggregate file. This other aggregate file is
     *     likely to change from page to page, and each new aggregate file needs to
     *     be downloaded when first encountered, so it should be kept relatively
     *     small by ensuring that most commonly needed stylesheets are added to
     *     every page.
     *   - 'weight': The weight of the stylesheet specifies the order in which the
     *     CSS will appear relative to other stylesheets with the same group and
     *     'every_page' flag. The exact ordering of stylesheets is as follows:
     *     - First by group.
     *     - Then by the 'every_page' flag, with TRUE coming before false.
     *     - Then by weight.
     *     - Then by the order in which the CSS was added. For example, all else
     *       being the same, a stylesheet added by a call to drupal_add_css() that
     *       happened later in the page request gets added to the page after one for
     *       which drupal_add_css() happened earlier in the page request.
     *   - 'media': The media type for the stylesheet, e.g., all, print, screen.
     *     Defaults to 'all'.
     *   - 'preprocess': If TRUE and CSS aggregation/compression is enabled, the
     *     styles will be aggregated and compressed. Defaults to TRUE.
     *   - 'browsers': An array containing information specifying which browsers
     *     should load the CSS item. See drupal_pre_render_conditional_comments()
     *     for details.
     *
     * @return
     *   An array of queued cascading stylesheets.
     *
     * @see drupal_get_css()
     */
    public function drupal_add_css($data = null, $options = null)
    {
        return drupal_add_css($data, $options);
    }

    /**
     * Adds a JavaScript file, setting, or inline code to the page.
     *
     * The behavior of this function depends on the parameters it is called with.
     * Generally, it handles the addition of JavaScript to the page, either as
     * reference to an existing file or as inline code. The following actions can be
     * performed using this function:
     * - Add a file ('file'): Adds a reference to a JavaScript file to the page.
     * - Add inline JavaScript code ('inline'): Executes a piece of JavaScript code
     *   on the current page by placing the code directly in the page (for example,
     *   to tell the user that a new message arrived, by opening a pop up, alert
     *   box, etc.). This should only be used for JavaScript that cannot be executed
     *   from a file. When adding inline code, make sure that you are not relying on
     *   $() being the jQuery function. Wrap your code in
     * @code (function ($) {... })(jQuery); @endcode
     *   or use jQuery() instead of $().
     * - Add external JavaScript ('external'): Allows the inclusion of external
     *   JavaScript files that are not hosted on the local server. Note that these
     *   external JavaScript references do not get aggregated when preprocessing is
     *   on.
     * - Add settings ('setting'): Adds settings to Drupal's global storage of
     *   JavaScript settings. Per-page settings are required by some modules to
     *   function properly. All settings will be accessible at Drupal.settings.
     *
     * Examples:
     * @code
     *   drupal_add_js('misc/collapse.js');
     *   drupal_add_js('misc/collapse.js', 'file');
     *   drupal_add_js('jQuery(document).ready(function () { alert("Hello!"); });', 'inline');
     *   drupal_add_js('jQuery(document).ready(function () { alert("Hello!"); });',
     *     array('type' => 'inline', 'scope' => 'footer', 'weight' => 5)
     *   );
     *   drupal_add_js('http://example.com/example.js', 'external');
     *   drupal_add_js(array('myModule' => array('key' => 'value')), 'setting');
     * @endcode
     *
     * Calling drupal_static_reset('drupal_add_js') will clear all JavaScript added
     * so far.
     *
     * If JavaScript aggregation is enabled, all JavaScript files added with
     * $options['preprocess'] set to TRUE will be merged into one aggregate file.
     * Preprocessed inline JavaScript will not be aggregated into this single file.
     * Externally hosted JavaScripts are never aggregated.
     *
     * The reason for aggregating the files is outlined quite thoroughly here:
     * http://www.die.net/musings/page_load_time/ "Load fewer external objects. Due
     * to request overhead, one bigger file just loads faster than two smaller ones
     * half its size."
     *
     * $options['preprocess'] should be only set to TRUE when a file is required for
     * all typical visitors and most pages of a site. It is critical that all
     * preprocessed files are added unconditionally on every page, even if the
     * files are not needed on a page. This is normally done by calling
     * drupal_add_js() in a hook_init() implementation.
     *
     * Non-preprocessed files should only be added to the page when they are
     * actually needed.
     *
     * @param $data
     *   (optional) If given, the value depends on the $options parameter:
     *   - 'file': Path to the file relative to base_path().
     *   - 'inline': The JavaScript code that should be placed in the given scope.
     *   - 'external': The absolute path to an external JavaScript file that is not
     *     hosted on the local server. These files will not be aggregated if
     *     JavaScript aggregation is enabled.
     *   - 'setting': An associative array with configuration options. The array is
     *     merged directly into Drupal.settings. All modules should wrap their
     *     actual configuration settings in another variable to prevent conflicts in
     *     the Drupal.settings namespace. Items added with a string key will replace
     *     existing settings with that key; items with numeric array keys will be
     *     added to the existing settings array.
     * @param $options
     *   (optional) A string defining the type of JavaScript that is being added in
     *   the $data parameter ('file'/'setting'/'inline'/'external'), or an
     *   associative array. JavaScript settings should always pass the string
     *   'setting' only. Other types can have the following elements in the array:
     *   - type: The type of JavaScript that is to be added to the page. Allowed
     *     values are 'file', 'inline', 'external' or 'setting'. Defaults
     *     to 'file'.
     *   - scope: The location in which you want to place the script. Possible
     *     values are 'header' or 'footer'. If your theme implements different
     *     regions, you can also use these. Defaults to 'header'.
     *   - group: A number identifying the group in which to add the JavaScript.
     *     Available constants are:
     *     - JS_LIBRARY: Any libraries, settings, or jQuery plugins.
     *     - JS_DEFAULT: Any module-layer JavaScript.
     *     - JS_THEME: Any theme-layer JavaScript.
     *     The group number serves as a weight: JavaScript within a lower weight
     *     group is presented on the page before JavaScript within a higher weight
     *     group.
     *   - every_page: For optimal front-end performance when aggregation is
     *     enabled, this should be set to TRUE if the JavaScript is present on every
     *     page of the website for users for whom it is present at all. This
     *     defaults to false. It is set to TRUE for JavaScript files that are added
     *     via module and theme .info files. Modules that add JavaScript within
     *     hook_init() implementations, or from other code that ensures that the
     *     JavaScript is added to all website pages, should also set this flag to
     *     TRUE. All JavaScript files within the same group and that have the
     *     'every_page' flag set to TRUE and do not have 'preprocess' set to false
     *     are aggregated together into a single aggregate file, and that aggregate
     *     file can be reused across a user's entire site visit, leading to faster
     *     navigation between pages. However, JavaScript that is only needed on
     *     pages less frequently visited, can be added by code that only runs for
     *     those particular pages, and that code should not set the 'every_page'
     *     flag. This minimizes the size of the aggregate file that the user needs
     *     to download when first visiting the website. JavaScript without the
     *     'every_page' flag is aggregated into a separate aggregate file. This
     *     other aggregate file is likely to change from page to page, and each new
     *     aggregate file needs to be downloaded when first encountered, so it
     *     should be kept relatively small by ensuring that most commonly needed
     *     JavaScript is added to every page.
     *   - weight: A number defining the order in which the JavaScript is added to
     *     the page relative to other JavaScript with the same 'scope', 'group',
     *     and 'every_page' value. In some cases, the order in which the JavaScript
     *     is presented on the page is very important. jQuery, for example, must be
     *     added to the page before any jQuery code is run, so jquery.js uses the
     *     JS_LIBRARY group and a weight of -20, jquery.once.js (a library drupal.js
     *     depends on) uses the JS_LIBRARY group and a weight of -19, drupal.js uses
     *     the JS_LIBRARY group and a weight of -1, other libraries use the
     *     JS_LIBRARY group and a weight of 0 or higher, and all other scripts use
     *     one of the other group constants. The exact ordering of JavaScript is as
     *     follows:
     *     - First by scope, with 'header' first, 'footer' last, and any other
     *       scopes provided by a custom theme coming in between, as determined by
     *       the theme.
     *     - Then by group.
     *     - Then by the 'every_page' flag, with TRUE coming before false.
     *     - Then by weight.
     *     - Then by the order in which the JavaScript was added. For example, all
     *       else being the same, JavaScript added by a call to drupal_add_js() that
     *       happened later in the page request gets added to the page after one for
     *       which drupal_add_js() happened earlier in the page request.
     *   - defer: If set to TRUE, the defer attribute is set on the &lt;script&gt;
     *     tag. Defaults to false.
     *   - cache: If set to false, the JavaScript file is loaded anew on every page
     *     call; in other words, it is not cached. Used only when 'type' references
     *     a JavaScript file. Defaults to TRUE.
     *   - preprocess: If TRUE and JavaScript aggregation is enabled, the script
     *     file will be aggregated. Defaults to TRUE.
     *
     * @return
     *   The current array of JavaScript files, settings, and in-line code,
     *   including Drupal defaults, anything previously added with calls to
     *   drupal_add_js(), and this function call's additions.
     *
     * @see drupal_get_js()
     */
    public function drupal_add_js($data = null, $options = null)
    {
        return drupal_add_js($data, $options);
    }

    /**
     * Performs end-of-request tasks.
     *
     * In some cases page requests need to end without calling drupal_page_footer().
     * In these cases, call drupal_exit() instead. There should rarely be a reason
     * to call exit instead of drupal_exit();
     *
     * @param $destination
     *   If this function is called from drupal_goto(), then this argument
     *   will be a fully-qualified URL that is the destination of the redirect.
     *   This should be passed along to hook_exit() implementations.
     */
    public function drupal_exit($destination = NULL)
    {
        drupal_exit($destination);
    }

    /**
     * Returns the path to a system item (module, theme, etc.).
     *
     * @param $type
     *   The type of the item (i.e. theme, theme_engine, module, profile).
     * @param $name
     *   The name of the item for which the path is requested.
     *
     * @return string
     *   The path to the requested item.
     */
    public function drupal_get_path($type, $name)
    {
        return drupal_get_path($type, $name);
    }

    /**
     * Ensures the private key variable used to generate tokens is set.
     *
     * @return string
     *   The private key.
     */
    public function drupal_get_private_key()
    {
        return drupal_get_private_key();
    }

    /**
     * Splits a URL-encoded query string into an array.
     *
     * @param $query
     *   The query string to split.
     *
     * @return
     *   An array of URL decoded couples $param_name => $value.
     */
    public function drupal_get_query_array($query)
    {
        return drupal_get_query_array($query);
    }

    /**
     * Processes a URL query parameter array to remove unwanted elements.
     *
     * @param $query
     *   (optional) An array to be processed. Defaults to $_GET.
     * @param $exclude
     *   (optional) A list of $query array keys to remove. Use "parent[child]" to
     *   exclude nested items. Defaults to array('q').
     * @param $parent
     *   Internal use only. Used to build the $query array key for nested items.
     *
     * @return
     *   An array containing query parameters, which can be used for url().
     */
    public function drupal_get_query_parameters(array $query = NULL, array $exclude = array('q'), $parent = '')
    {
        return drupal_get_query_parameters($query, $exclude, $parent);
    }

    /**
     * Sends the user to a different Drupal page.
     *
     * This issues an on-site HTTP redirect. The function makes sure the redirected
     * URL is formatted correctly.
     *
     * Usually the redirected URL is constructed from this function's input
     * parameters. However you may override that behavior by setting a
     * destination in either the $_REQUEST-array (i.e. by using
     * the query string of an URI) This is used to direct the user back to
     * the proper page after completing a form. For example, after editing
     * a post on the 'admin/content'-page or after having logged on using the
     * 'user login'-block in a sidebar. The function drupal_get_destination()
     * can be used to help set the destination URL.
     *
     * Drupal will ensure that messages set by drupal_set_message() and other
     * session data are written to the database before the user is redirected.
     *
     * This function ends the request; use it instead of a return in your menu
     * callback.
     *
     * @param $path
     *   A Drupal path or a full URL.
     * @param $options
     *   An associative array of additional URL options to pass to url().
     * @param $http_response_code
     *   Valid values for an actual "goto" as per RFC 2616 section 10.3 are:
     *   - 301 Moved Permanently (the recommended value for most redirects)
     *   - 302 Found (default in Drupal and PHP, sometimes used for spamming search
     *         engines)
     *   - 303 See Other
     *   - 304 Not Modified
     *   - 305 Use Proxy
     *   - 307 Temporary Redirect (alternative to "503 Site Down for Maintenance")
     *   Note: Other values are defined by RFC 2616, but are rarely used and poorly
     *   supported.
     *
     * @see drupal_get_destination()
     * @see url()
     */
    public function drupal_goto($path = '', array $options = array(), $http_response_code = 302)
    {
        drupal_goto($path, $options, $http_response_code);
    }

    /**
     * Parses an array into a valid, rawurlencoded query string.
     *
     * This differs from http_build_query() as we need to rawurlencode() (instead of
     * urlencode()) all query parameters.
     *
     * @param $query
     *   The query parameter array to be processed, e.g. $_GET.
     * @param $parent
     *   Internal use only. Used to build the $query array key for nested items.
     *
     * @return
     *   A rawurlencoded string which can be used as or appended to the URL query
     *   string.
     *
     * @see drupal_get_query_parameters()
     * @ingroup php_wrappers
     */
    public function drupal_http_build_query(array $query, $parent = '')
    {
        return drupal_http_build_query($query, $parent);
    }

    /**
     * Performs an HTTP request.
     *
     * This is a flexible and powerful HTTP client implementation. Correctly
     * handles GET, POST, PUT or any other HTTP requests. Handles redirects.
     *
     * @param $url
     *   A string containing a fully qualified URI.
     * @param array $options
     *   (optional) An array that can have one or more of the following elements:
     *   - headers: An array containing request headers to send as name/value pairs.
     *   - method: A string containing the request method. Defaults to 'GET'.
     *   - data: A string containing the request body, formatted as
     *     'param=value&param=value&...'. Defaults to NULL.
     *   - max_redirects: An integer representing how many times a redirect
     *     may be followed. Defaults to 3.
     *   - timeout: A float representing the maximum number of seconds the function
     *     call may take. The default is 30 seconds. If a timeout occurs, the error
     *     code is set to the HTTP_REQUEST_TIMEOUT constant.
     *   - context: A context resource created with stream_context_create().
     *
     * @return object
     *   An object that can have one or more of the following components:
     *   - request: A string containing the request body that was sent.
     *   - code: An integer containing the response status code, or the error code
     *     if an error occurred.
     *   - protocol: The response protocol (e.g. HTTP/1.1 or HTTP/1.0).
     *   - status_message: The status message from the response, if a response was
     *     received.
     *   - redirect_code: If redirected, an integer containing the initial response
     *     status code.
     *   - redirect_url: If redirected, a string containing the URL of the redirect
     *     target.
     *   - error: If an error occurred, the error message. Otherwise not set.
     *   - headers: An array containing the response headers as name/value pairs.
     *     HTTP header names are case-insensitive (RFC 2616, section 4.2), so for
     *     easy access the array keys are returned in lower case.
     *   - data: A string containing the response body that was received.
     */
    public function drupal_http_request($url, array $options = array())
    {
        return drupal_http_request($url, $options);
    }

    /**
     * Converts a PHP variable into its JavaScript equivalent.
     *
     * We use HTML-safe strings, with several characters escaped.
     *
     * @see drupal_json_decode()
     * @see drupal_json_encode_helper()
     * @ingroup php_wrappers
     */
    public function drupal_json_encode($var)
    {
        return drupal_json_encode($var);
    }

    /**
     * Converts an HTML-safe JSON string into its PHP equivalent.
     *
     * @return mixed
     *
     * @see drupal_json_encode()
     * @ingroup php_wrappers
     */
    public function drupal_json_decode($var)
    {
        return drupal_json_decode($var);
    }

    /**
     * Returns data in JSON format.
     *
     * This function should be used for JavaScript callback functions returning
     * data in JSON format. It sets the header for JavaScript output.
     *
     * @param $var
     *   (optional) If set, the variable will be converted to JSON and output.
     */
    public function drupal_json_output($var = NULL)
    {
        return drupal_json_output($var);
    }

    /**
     * Delivers a "page not found" error to the browser.
     *
     * Page callback functions wanting to report a "page not found" message should
     * return MENU_NOT_FOUND instead of calling drupal_not_found(). However,
     * functions that are invoked in contexts where that return value might not
     * bubble up to menu_execute_active_handler() should call drupal_not_found().
     */
    public function drupal_not_found()
    {
        drupal_not_found();
    }

    /**
     * Sets the breadcrumb trail for the current page.
     *
     * @param $breadcrumb
     *   Array of links, starting with "home" and proceeding up to but not including
     *   the current page.
     */
    public function drupal_set_breadcrumb($breadcrumb = null)
    {
        drupal_set_breadcrumb($breadcrumb);
    }

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
     * @return mixed
     *   A translated date string in the requested format.
     */
    public function format_date($timestamp, $type = 'medium', $format = '', $timezone = null, $langcode = null)
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
     *                         - 'html' (default false): Whether $text is HTML or just plain-text. For
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
     *   - 'absolute': Defaults to false. Whether to force the output to be an
     *     absolute link (beginning with http:). Useful for links that will be
     *     displayed outside the site, such as in an RSS feed.
     *   - 'alias': Defaults to false. Whether the given path is a URL alias
     *     already.
     *   - 'external': Whether the given path is an external URL.
     *   - 'language': An optional language object. If the path being linked to is
     *     internal to the site, $options['language'] is used to look up the alias
     *     for the URL. If $options['language'] is omitted, the global $language_url
     *     will be used.
     *   - 'https': Whether this URL should point to a secure location. If not
     *     defined, the current scheme is used, so the user stays on http or https
     *     respectively. TRUE enforces HTTPS and false enforces HTTP, but HTTPS can
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
     * Unsets a persistent variable.
     *
     * Case-sensitivity of the variable_* functions depends on the database
     * collation used. To avoid problems, always use lower case for persistent
     * variable names.
     *
     * @param $name
     *   The name of the variable to undefine.
     *
     * @see variable_get()
     * @see variable_set()
     */
    public function variable_del($name)
    {
        variable_del($name);
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
     *                            null if message is already translated or not possible to translate.
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

    /**
     * Returns the base URL path (i.e., directory) of the Drupal installation.
     *
     * base_path() adds a "/" to the beginning and end of the returned path if the
     * path is not empty. At the very least, this will return "/".
     *
     * Examples:
     * - http://example.com returns "/" because the path is empty.
     * - http://example.com/drupal/folder returns "/drupal/folder/".
     */
    function base_path() {
        return base_path();
    }
}
