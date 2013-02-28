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

/**
 * Cumulates the module functions of Drupal 7 in one class.
 *
 * Please order the functions alphabetically!
 */
class Module
{
    /**
     * Hands off alterable variables to type-specific *_alter implementations.
     *
     * This dispatch function hands off the passed-in variables to type-specific
     * hook_TYPE_alter() implementations in modules. It ensures a consistent
     * interface for all altering operations.
     *
     * A maximum of 2 alterable arguments is supported. In case more arguments need
     * to be passed and alterable, modules provide additional variables assigned by
     * reference in the last $context argument:
     *
     * <code>
     *   []
     *
     *   $context = array(
     *     'alterable' => &$alterable,
     *     'unalterable' => $unalterable,
     *     'foo' => 'bar',
     *   );
     *   drupal_alter('mymodule_data', $alterable1, $alterable2, $context);
     *
     *   []
     * </code>
     *
     * Note that objects are always passed by reference in PHP5. If it is absolutely
     * required that no implementation alters a passed object in $context, then an
     * object needs to be cloned:
     *
     * <code>
     *  []
     *
     *   $context = array(
     *     'unalterable_object' => clone $object,
     *   );
     *   drupal_alter('mymodule_data', $data, $context);
     *
     *  []
     * </code>
     *
     * @param string $type      A string describing the type of the alterable $data. 'form', 'links',
     *                          'node_content', and so on are several examples. Alternatively can be an
     *                          array, in which case hook_TYPE_alter() is invoked for each value in the
     *                          array, ordered first by module, and then for each module, in the order of
     *                          values in $type. For example, when Form API is using drupal_alter() to
     *                          execute both hook_form_alter() and hook_form_FORM_ID_alter()
     *                          implementations, it passes array('form', 'form_' . $form_id) for $type.
     * @param mixed  &$data     The variable that will be passed to hook_TYPE_alter() implementations to be
     *                          altered. The type of this variable depends on the value of the $type
     *                          argument. For example, when altering a 'form', $data will be a structured
     *                          array. When altering a 'profile', $data will be an object.
     * @param mixed  &$context1 An additional variable that is passed by reference.
     * @param mixed  &$context2 An additional variable that is passed by reference. If more
     *                          context needs to be provided to implementations, then this should be an
     *                          associative array as described above.
     *
     * @link http://api.drupal.org/api/drupal/includes!module.inc/function/drupal_alter/7
     */
    public function drupal_alter($type, &$data, &$context1 = null, &$context2 = null)
    {
        drupal_alter($type, $data, $context1, $context2);
    }

    /**
     * Disable a given set of modules.
     *
     * @param array   $module_list          An array of module names.
     * @param boolean $disable_dependents   If »true«, dependent modules will automatically be added and disabled in
     *                                      the correct order. This incurs a significant performance cost, so use
     *                                      »false« if you know $module_list is already complete and in the correct.
     *                                      order.
     *
     * @link http://api.drupal.org/api/drupal/includes!module.inc/function/module_disable/7
     */
    public function module_disable($module_list, $disable_dependents = true)
    {
        module_disable($module_list, $disable_dependents);
    }

    /**
     * Enables or installs a given list of modules.
     *
     * Definitions:
     * - "Enabling" is the process of activating a module for use by Drupal.
     * - "Disabling" is the process of deactivating a module.
     * - "Installing" is the process of enabling it for the first time or after it
     *   has been uninstalled.
     * - "Uninstalling" is the process of removing all traces of a module.
     *
     * Order of events:
     * - Gather and add module dependencies to $module_list (if applicable).
     * - For each module that is being enabled:
     *   - Install module schema and update system registries and caches.
     *   - If the module is being enabled for the first time or had been
     *     uninstalled, invoke hook_install() and add it to the list of installed
     *     modules.
     *   - Invoke hook_enable().
     * - Invoke hook_modules_installed().
     * - Invoke hook_modules_enabled().
     *
     * @param array   $module_list          An array of module names.
     * @param boolean $enable_dependencies  If »true«, dependencies will automatically be added and enabled in the
     *                                      correct order. This incurs a significant performance cost, so use FALSE
     *                                      if you know $module_list is already complete and in the correct order.
     *
     * @return boolean »false« if one or more dependencies are missing, »true« otherwise.
     *
     * @see  hook_install()
     * @see  hook_enable()
     * @see  hook_modules_installed()
     * @see  hook_modules_enabled()
     *
     * @link http://api.drupal.org/api/drupal/includes!module.inc/function/module_enable/7
     */
    public function module_enable($module_list, $enable_dependencies = true)
    {
        return module_enable($module_list, $enable_dependencies);
    }

    /**
     * Determine whether a given module exists.
     *
     * @param string $module The name of the module (without the .module extension).
     *
     * @return boolean TRUE if the module is both installed and enabled.
     */
    public function module_exists($module)
    {
        return module_exists($module);
    }

    
    /**
     * Determines whether a module implements a hook.
     *
     * @param $module The name of the module (without the .module extension).
     * @param $hook   The name of the hook (e.g. "help" or "menu").
     *
     * @return
     *     TRUE if the module is both installed and enabled, and the hook is
     *     implemented in that module.
     */
    function module_hook($module, $hook) {
        return module_hook($module, $hook);
    }

    /**
     * Invoke a hook in a particular module.
     *
     * This method does as well handle additionally passed arguments.
     * These arguments will be passed to the hook function identified by
     * $module and $hook.
     *
     * Example:
     * <code>
     *  []
     *
     *  $block = module_invoke('views', 'block_view', 'map-block_1');
     *
     *  []
     * </code>
     *
     * @param string $module   The name of the module (without the .module extension).
     * @param string $hook     The name of the hook to invoke.
     *
     * @return mixed The return value of the hook implementation.
     *
     * @link http://api.drupal.org/api/drupal/includes!module.inc/function/module_invoke/7
     */
    public function module_invoke($module, $hook)
    {
        return call_user_func_array('module_invoke', func_get_args());
    }

    /**
     * Invoke a hook in all enabled modules that implement it.
     *
     * This method does as well handle additionally passed arguments.
     * These arguments will be passed to the hook function identified by
     * $module and $hook.
     *
     * Example:
     * <code>
     *  []
     *
     *  $blocks = module_invoke_all('block_view', 'map-block_1');
     *
     *  []
     * </code>
     *
     * @param string $hook The name of the hook to invoke.
     *
     * @return array An array of return values of the hook implementations.
     *                If modules return arrays from their implementations,
     *                those are merged into one array.
     *
     * @link          http://api.drupal.org/api/drupal/includes!module.inc/function/module_invoke_all/7
     */
    public function module_invoke_all($hook)
    {
        return call_user_func_array('module_invoke_all', func_get_args());
    }

    /**
     * Determine which modules are implementing a hook.
     *
     * @param string  $hook  The name of the hook (e.g. "help" or "menu").
     * @param string  $sort  By default, modules are ordered by weight and filename, settings this option
     *                       to TRUE, module list will be ordered by module name.
     * @param boolean $reset For internal use only: Whether to force the stored list of hook
     *                       implementations to be regenerated (such as after enabling a new module,
     *                       before processing hook_enable).
     *
     * @return array An array with the names of the modules which are implementing this hook.
     *
     * @link http://api.drupal.org/api/drupal/includes!module.inc/function/module_implements/7
     */
    public function module_implements($hook, $sort = false, $reset = false)
    {
        return module_implements($hook, $sort, $reset);
    }
}
