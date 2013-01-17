<?php
/**
 * Abstraction of the procedural Drupal world into OOP.
 *
 * @author     Daniel Barsotti <daniel.barsotti@liip.ch>
 * @license    http://www.opensource.org/licenses/mit-license.php The MIT License
 * @copyright  Copyright (c) 2012 liip ag
 *
 * @package    DrupalConnector
 * @subpackage Module
 */

namespace Liip\Drupal\Modules\DrupalConnector;

class Bootstrap
{
    /**
     * Generates a default anonymous $user object.
     *
     * @return Object - the user object.
     */
    public function drupal_anonymous_user() {
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
     * @param $phase
     *   A constant. Allowed values are the DRUPAL_BOOTSTRAP_* constants.
     * @param $new_phase
     *   A boolean, set to FALSE if calling drupal_bootstrap from inside a
     *   function called from drupal_bootstrap (recursion).
     *
     * @return
     *   The most recently completed phase.
     */
    public function drupal_bootstrap($phase = NULL, $new_phase = TRUE)
    {
        drupal_bootstrap($phase, $new_phase);
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
     *
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
     *
     * In a few cases, a function can have certainty that there is no legitimate
     * use-case for resetting that function's static variable. This is rare,
     * because when writing a function, it's hard to forecast all the situations in
     * which it will be used. A guideline is that if a function's static variable
     * does not depend on any information outside of the function that might change
     * during a single page request, then it's ok to use the "static" keyword
     * instead of the drupal_static() function.
     *
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
     *
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
     *
     * Example:
     * @code
     * function user_access($string, $account = NULL) {
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
     * @param $name
     *   Globally unique name for the variable. For a function with only one static,
     *   variable, the function name (e.g. via the PHP magic __FUNCTION__ constant)
     *   is recommended. For a function with multiple static variables add a
     *   distinguishing suffix to the function name for each one.
     * @param $default_value
     *   Optional default value.
     * @param $reset
     *   TRUE to reset a specific named variable, or all variables if $name is NULL.
     *   Resetting every variable should only be used, for example, for running
     *   unit tests with a clean environment. Should be used only though via
     *   function drupal_static_reset() and the return value should not be used in
     *   this case.
     *
     * @return
     *   Returns a variable by reference.
     *
     * @see drupal_static_reset()
     */
    function &drupal_static($name, $default_value = NULL, $reset = FALSE) {
        return drupal_static($name, $default_value, $reset);
    }
}
