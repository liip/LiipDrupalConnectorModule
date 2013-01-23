<?php

/**
 * Abstraction of the procedural Drupal world into OOP.
 *
 * @author     Bastian Feder <drupal@bastian-feder.de>
 * @license    http://www.opensource.org/licenses/mit-license.php The MIT License
 * @copyright  Copyright (c) 2012-2013 liip ag
 *
 * @package    DrupalConnector
 * @subpackage Theme
 */

namespace Liip\Drupal\Modules\DrupalConnector;


class Theme
{
    /**
     * Generates themed output.
     *
     * All requests for themed output must go through this function. It examines
     * the request and routes it to the appropriate
     * @link themeable theme function or template @endlink, by checking the theme
     * registry.
     *
     * The first argument to this function is the name of the theme hook. For
     * instance, to theme a table, the theme hook name is 'table'. By default, this
     * theme hook could be implemented by a function called 'theme_table' or a
     * template file called 'table.tpl.php', but hook_theme() can override the
     * default function or template name.
     *
     * If the implementation is a template file, several functions are called
     * before the template file is invoked, to modify the $variables array. These
     * fall into the "preprocessing" phase and the "processing" phase, and are
     * executed (if they exist), in the following order (note that in the following
     * list, HOOK indicates the theme hook name, MODULE indicates a module name,
     * THEME indicates a theme name, and ENGINE indicates a theme engine name):
     * - template_preprocess(&$variables, $hook): Creates a default set of variables
     *   for all theme hooks.
     * - template_preprocess_HOOK(&$variables): Should be implemented by
     *   the module that registers the theme hook, to set up default variables.
     * - MODULE_preprocess(&$variables, $hook): hook_preprocess() is invoked on all
     *   implementing modules.
     * - MODULE_preprocess_HOOK(&$variables): hook_preprocess_HOOK() is invoked on
     *   all implementing modules, so that modules that didn't define the theme hook
     *   can alter the variables.
     * - ENGINE_engine_preprocess(&$variables, $hook): Allows the theme engine to
     *   set necessary variables for all theme hooks.
     * - ENGINE_engine_preprocess_HOOK(&$variables): Allows the theme engine to set
     *   necessary variables for the particular theme hook.
     * - THEME_preprocess(&$variables, $hook): Allows the theme to set necessary
     *   variables for all theme hooks.
     * - THEME_preprocess_HOOK(&$variables): Allows the theme to set necessary
     *   variables specific to the particular theme hook.
     * - template_process(&$variables, $hook): Creates a default set of variables
     *   for all theme hooks.
     * - template_process_HOOK(&$variables): This is the first processor specific
     *   to the theme hook; it should be implemented by the module that registers
     *   it.
     * - MODULE_process(&$variables, $hook): hook_process() is invoked on all
     *   implementing modules.
     * - MODULE_process_HOOK(&$variables): hook_process_HOOK() is invoked on
     *   on all implementing modules, so that modules that didn't define the theme
     *   hook can alter the variables.
     * - ENGINE_engine_process(&$variables, $hook): Allows the theme engine to set
     *   necessary variables for all theme hooks.
     * - ENGINE_engine_process_HOOK(&$variables): Allows the theme engine to set
     *   necessary variables for the particular theme hook.
     * - ENGINE_process(&$variables, $hook): Allows the theme engine to process the
     *   variables.
     * - ENGINE_process_HOOK(&$variables): Allows the theme engine to process the
     *   variables specific to the theme hook.
     * - THEME_process(&$variables, $hook):  Allows the theme to process the
     *   variables.
     * - THEME_process_HOOK(&$variables):  Allows the theme to process the
     *   variables specific to the theme hook.
     *
     * If the implementation is a function, only the theme-hook-specific preprocess
     * and process functions (the ones ending in _HOOK) are called from the
     * list above. This is because theme hooks with function implementations
     * need to be fast, and calling the non-theme-hook-specific preprocess and
     * process functions for them would incur a noticeable performance penalty.
     *
     * There are two special variables that these preprocess and process functions
     * can set: 'theme_hook_suggestion' and 'theme_hook_suggestions'. These will be
     * merged together to form a list of 'suggested' alternate theme hooks to use,
     * in reverse order of priority. theme_hook_suggestion will always be a higher
     * priority than items in theme_hook_suggestions. theme() will use the
     * highest priority implementation that exists. If none exists, theme() will
     * use the implementation for the theme hook it was called with. These
     * suggestions are similar to and are used for similar reasons as calling
     * theme() with an array as the $hook parameter (see below). The difference
     * is whether the suggestions are determined by the code that calls theme() or
     * by a preprocess or process function.
     *
     * @param $hook
     *   The name of the theme hook to call. If the name contains a
     *   double-underscore ('__') and there isn't an implementation for the full
     *   name, the part before the '__' is checked. This allows a fallback to a more
     *   generic implementation. For example, if theme('links__node', ...) is
     *   called, but there is no implementation of that theme hook, then the 'links'
     *   implementation is used. This process is iterative, so if
     *   theme('links__contextual__node', ...) is called, theme() checks for the
     *   following implementations, and uses the first one that exists:
     *   - links__contextual__node
     *   - links__contextual
     *   - links
     *   This allows themes to create specific theme implementations for named
     *   objects and contexts of otherwise generic theme hooks. The $hook parameter
     *   may also be an array, in which case the first theme hook that has an
     *   implementation is used. This allows for the code that calls theme() to
     *   explicitly specify the fallback order in a situation where using the '__'
     *   convention is not desired or is insufficient.
     * @param $variables
     *   An associative array of variables to merge with defaults from the theme
     *   registry, pass to preprocess and process functions for modification, and
     *   finally, pass to the function or template implementing the theme hook.
     *   Alternatively, this can be a renderable array, in which case, its
     *   properties are mapped to variables expected by the theme hook
     *   implementations.
     *
     * @return
     *   An HTML string representing the themed output.
     *
     * @see themeable
     */
    public function theme($hook, $variables = array())
    {
        return theme($hook $variables);
    }

    /**
     * Returns HTML for a query pager.
     *
     * Menu callbacks that display paged query results should call theme('pager') to
     * retrieve a pager control so that users can view other results. Format a list
     * of nearby pages with additional query results.
     *
     * @param $variables
     *   An associative array containing:
     *   - tags: An array of labels for the controls in the pager.
     *   - element: An optional integer to distinguish between multiple pagers on
     *     one page.
     *   - parameters: An associative array of query string parameters to append to
     *     the pager links.
     *   - quantity: The number of pages in the list.
     *
     * @ingroup themeable
     */
    public function theme_pager(array $variables = array())
    {
        return theme_pager($variables);
    }
}
