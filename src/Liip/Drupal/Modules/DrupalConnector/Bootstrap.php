<?php
/**
 * Abstraction of the procedural Drupal world into OOP.
 * @author     Daniel Barsotti <daniel.barsotti@liip.ch>
 * @license    http://www.opensource.org/licenses/mit-license.php The MIT License
 * @copyright  Copyright (c) 2012 liip ag
 * @package    DrupalConnector
 * @subpackage Breadcrumb
 */

namespace Liip\Drupal\Modules\DrupalConnector;

class Bootstrap
{
    /**
     * Returns a component of the current Drupal path.
     *
     * When viewing a page at the path "admin/structure/types", for example, arg(0)
     * returns "admin", arg(1) returns "structure", and arg(2) returns "types".
     * Avoid use of this function where possible, as resulting code is hard to
     * read. In menu callback functions, attempt to use named arguments. See the
     * explanation in menu.inc for how to construct callbacks that take arguments.
     * When attempting to use this function to load an element from the current
     * path, e.g. loading the node on a node page, use menu_get_object() instead.
     *
     * @param string|null $index The index of the component, where each component is separated by a '/'
     *                            (forward-slash), and where the first component has an index of 0 (zero).
     * @param string $path  A path to break into components. Defaults to the path of the current page.
     *
     * @return
     *   The component specified by $index, or null if the specified component was
     *   not found. If called without arguments, it returns an array containing all
     *   the components of the current path.
     */
    public function arg($index = null, $path = null)
    {
        return arg($index, $path);
    }

    /**
     * Generates a default anonymous $user object.
     *
     * @return Object - the user object.
     */
    public function drupal_anonymous_user()
    {
        return drupal_anonymous_user();
    }

    /**
     * Ensures Drupal is bootstrapped to the specified phase.
     *
     * The bootstrap phase is an integer constant identifying a phase of Drupal
     * to load. Each phase adds to the previous one, so invoking a later phase
     * automatically runs the earlier phases as well. To access the Drupal
     * database from a script without loading anything else, include bootstrap.inc
     * and call drupal_bootstrap(DRUPAL_BOOTSTRAP_DATABASE).
     *
     * @param string|null $phase
     *   A constant. Allowed values are the DRUPAL_BOOTSTRAP_* constants.
     * @param boolean $new_phase
     *   A boolean, set to false if calling drupal_bootstrap from inside a
     *   function called from drupal_bootstrap (recursion).
     *
     * @return mixed The most recently completed phase.
     */
    public function drupal_bootstrap($phase = null, $new_phase = true)
    {
        return drupal_bootstrap($phase, $new_phase);
    }

    /**
     * Sets a message to display to the user.
     *
     * Messages are stored in a session variable and displayed in page.tpl.php via
     * the $messages theme variable.
     * Example usage:
     * @code
     * drupal_set_message(t('An error occurred and processing did not complete.'), 'error');
     * @endcode
     *
     * @param string $message
     *   (optional) The translated message to be displayed to the user. For
     *   consistency with other messages, it should begin with a capital letter and
     *   end with a period.
     * @param string $type
     *   (optional) The message's type. Defaults to 'status'. These values are
     *   supported:
     *   - 'status'
     *   - 'warning'
     *   - 'error'
     * @param bool $repeat
     *   (optional) If this is FALSE and the message is already set, then the
     *   message won't be repeated. Defaults to TRUE.
     *
     * @return array|null
     *   A multidimensional array with keys corresponding to the set message types.
     *   The indexed array values of each contain the set messages for that type.
     *   Or, if there are no messages set, the function returns NULL.
     * @see drupal_get_messages()
     * @see theme_status_messages()
     */
    public function drupal_set_message($message = null, $type = 'status', $repeat = true)
    {
        return drupal_set_message($message, $type, $repeat);
    }

    /**
     * Provides central static variable storage.
     *
     * All functions requiring a static variable to persist or cache data within
     * a single page request are encouraged to use this function unless it is
     * absolutely certain that the static variable will not need to be reset during
     * the page request. By centralizing static variable storage through this
     * function, other functions can rely on a consistent API for resetting any
     * other function's static variables.
     * Example:
     * @code
     * function language_list($field = 'language') {
     *   $languages = &drupal_static(__FUNCTION__);
     *   if (!isset($languages)) {
     *     // If this function is being called for the first time after a reset,
     *     // query the database and execute any other code needed to retrieve
     *     // information about the supported languages.
     *     ...
     *   }
     *   if (!isset($languages[$field])) {
     *     // If this function is being called for the first time for a particular
     *     // index field, then execute code needed to index the information already
     *     // available in $languages by the desired field.
     *     ...
     *   }
     *   // Subsequent invocations of this function for a particular index field
     *   // skip the above two code blocks and quickly return the already indexed
     *   // information.
     *   return $languages[$field];
     * }
     * function locale_translate_overview_screen() {
     *   // When building the content for the translations overview page, make
     *   // sure to get completely fresh information about the supported languages.
     *   drupal_static_reset('language_list');
     *   ...
     * }
     * @endcode
     * In a few cases, a function can have certainty that there is no legitimate
     * use-case for resetting that function's static variable. This is rare,
     * because when writing a function, it's hard to forecast all the situations in
     * which it will be used. A guideline is that if a function's static variable
     * does not depend on any information outside of the function that might change
     * during a single page request, then it's ok to use the "static" keyword
     * instead of the drupal_static() function.
     * Example:
     * @code
     * function actions_do(...) {
     *   // $stack tracks the number of recursive calls.
     *   static $stack;
     *   $stack++;
     *   if ($stack > variable_get('actions_max_stack', 35)) {
     *     ...
     *     return;
     *   }
     *   ...
     *   $stack--;
     * }
     * @endcode
     * In a few cases, a function needs a resettable static variable, but the
     * function is called many times (100+) during a single page request, so
     * every microsecond of execution time that can be removed from the function
     * counts. These functions can use a more cumbersome, but faster variant of
     * calling drupal_static(). It works by storing the reference returned by
     * drupal_static() in the calling function's own static variable, thereby
     * removing the need to call drupal_static() for each iteration of the function.
     * Conceptually, it replaces:
     * @code
     * $foo = &drupal_static(__FUNCTION__);
     * @endcode
     * with:
     * @code
     * // Unfortunately, this does not work.
     * static $foo = &drupal_static(__FUNCTION__);
     * @endcode
     * However, the above line of code does not work, because PHP only allows static
     * variables to be initializied by literal values, and does not allow static
     * variables to be assigned to references.
     * - http://php.net/manual/en/language.variables.scope.php#language.variables.scope.static
     * - http://php.net/manual/en/language.variables.scope.php#language.variables.scope.references
     * The example below shows the syntax needed to work around both limitations.
     * For benchmarks and more information, see http://drupal.org/node/619666.
     * Example:
     * @code
     * function user_access($string, $account = null) {
     *   // Use the advanced drupal_static() pattern, since this is called very often.
     *   static $drupal_static_fast;
     *   if (!isset($drupal_static_fast)) {
     *     $drupal_static_fast['perm'] = &drupal_static(__FUNCTION__);
     *   }
     *   $perm = &$drupal_static_fast['perm'];
     *   ...
     * }
     * @endcode
     *
     * @param string $name
     *   Globally unique name for the variable. For a function with only one static,
     *   variable, the function name (e.g. via the PHP magic __FUNCTION__ constant)
     *   is recommended. For a function with multiple static variables add a
     *   distinguishing suffix to the function name for each one.
     * @param mixed $default_value
     *   Optional default value.
     * @param boolean $reset
     *   true to reset a specific named variable, or all variables if $name is null.
     *   Resetting every variable should only be used, for example, for running
     *   unit tests with a clean environment. Should be used only though via
     *   function drupal_static_reset() and the return value should not be used in
     *   this case.
     *
     * @return mixed
     *   Returns a variable by reference.
     * @see drupal_static_reset()
     */
    public function &drupal_static($name, $default_value = null, $reset = false)
    {
        return drupal_static($name, $default_value, $reset);
    }

    /**
     * Unserializes and appends elements from a serialized string.
     *
     * @param $obj
     *   The object to which the elements are appended.
     * @param $field
     *   The attribute of $obj whose value should be unserialized.
     *
     * @return \stdClass
     */
    public function drupal_unpack($obj, $field = 'data')
    {
        return drupal_unpack($obj, $field);
    }

    /**
     * Returns the IP address of the client machine.
     *
     * If Drupal is behind a reverse proxy, we use the X-Forwarded-For header
     * instead of $_SERVER['REMOTE_ADDR'], which would be the IP address of
     * the proxy server, and not the client's. The actual header name can be
     * configured by the reverse_proxy_header variable.
     * @return string
     *   IP address of client machine, adjusted for reverse proxy and/or cluster
     *   environments.
     */
    public function ip_address()
    {
        return ip_address();
    }

    /**
     * Returns the requested URL path of the page being viewed.
     *
     * Examples:
     * - http://example.com/node/306 returns "node/306".
     * - http://example.com/drupalfolder/node/306 returns "node/306" while
     *   base_path() returns "/drupalfolder/".
     * - http://example.com/path/alias (which is a path alias for node/306) returns
     *   "path/alias" as opposed to the internal path.
     * - http://example.com/index.php returns an empty string (meaning: front page).
     * - http://example.com/index.php?page=1 returns an empty string.
     *
     * @return string The requested Drupal URL path.
     * @see current_path()
     */
    public function request_path()
    {
        return request_path();
    }

    /**
     * Rescans all enabled modules and rebuilds the registry.
     *
     * Rescans all code in modules or includes directories, storing the location of
     * each interface or class in the database.
     */
    public function registry_rebuild()
    {
        registry_rebuild();
    }

    /**
     * Returns a list of installed languages, indexed by the specified key.
     *
     * @param string $field
     *   The field to index the list with
     * @return array
     *   The associative array with all the languages installed
     */
    public function language_list($field = 'language')
    {
        return language_list($field);
    }
    
    /**
     * Returns the default language used on the site
     *
     * @param $property
     *   Optional property of the language object to return
     */
    public function language_default($property = NULL) {
        return language_default($property);
    }
}
