<?php
/**
 * Abstraction of the procedural Drupal world into OOP.
 *
 * @author     Daniel Barsotti <daniel.barsotti@liip.ch>
 * @license    http://www.opensource.org/licenses/mit-license.php The MIT License
 * @copyright  Copyright (c) 2012 liip ag
 *
 * @package    DrupalConnector
 * @subpackage Menu
 */

namespace Liip\Drupal\Modules\DrupalConnector;

class Menu
{
    /**
     * Returns the ancestors (and relevant placeholders) for any given path.
     *
     * For example, the ancestors of node/12345/edit are:
     * - node/12345/edit
     * - node/12345/%
     * - node/%/edit
     * - node/%/%
     * - node/12345
     * - node/%
     * - node
     *
     * To generate these, we will use binary numbers. Each bit represents a
     * part of the path. If the bit is 1, then it represents the original
     * value while 0 means wildcard. If the path is node/12/edit/foo
     * then the 1011 bitstring represents node/%/edit/foo where % means that
     * any argument matches that part. We limit ourselves to using binary
     * numbers that correspond the patterns of wildcards of router items that
     * actually exists. This list of 'masks' is built in menu_rebuild().
     *
     * @param $parts
     *   An array of path parts, for the above example
     *   array('node', '12345', 'edit').
     *
     * @return
     *   An array which contains the ancestors and placeholders. Placeholders
     *   simply contain as many '%s' as the ancestors.
     */
    function menu_get_ancestors($parts) {
        return menu_get_ancestors($parts);
    }

    /**
     * Unserializes menu data, using a map to replace path elements.
     *
     * The menu system stores various path-related information (such as the 'page
     * arguments' and 'access arguments' components of a menu item) in the database
     * using serialized arrays, where integer values in the arrays represent
     * arguments to be replaced by values from the path. This function first
     * unserializes such menu information arrays, and then does the path
     * replacement.
     *
     * The path replacement acts on each integer-valued element of the unserialized
     * menu data array ($data) using a map array ($map, which is typically an array
     * of path arguments) as a list of replacements. For instance, if there is an
     * element of $data whose value is the number 2, then it is replaced in $data
     * with $map[2]; non-integer values in $data are left alone.
     *
     * As an example, an unserialized $data array with elements ('node_load', 1)
     * represents instructions for calling the node_load() function. Specifically,
     * this instruction says to use the path component at index 1 as the input
     * parameter to node_load(). If the path is 'node/123', then $map will be the
     * array ('node', 123), and the returned array from this function will have
     * elements ('node_load', 123), since $map[1] is 123. This return value will
     * indicate specifically that node_load(123) is to be called to load the node
     * whose ID is 123 for this menu item.
     *
     * @param $data
     *   A serialized array of menu data, as read from the database.
     * @param $map
     *   A path argument array, used to replace integer values in $data; an integer
     *   value N in $data will be replaced by value $map[N]. Typically, the $map
     *   array is generated from a call to the arg() function.
     *
     * @return
     *   The unserialized $data array, with path arguments replaced.
     */
    function menu_unserialize($data, $map) {
        return menu_unserialize($data, $map);
    }



    /**
     * Replaces the statically cached item for a given path.
     *
     * @param $path
     *   The path.
     * @param $router_item
     *   The router item. Usually you take a router entry from menu_get_item and
     *   set it back either modified or to a different path. This lets you modify the
     *   navigation block, the page title, the breadcrumb and the page help in one
     *   call.
     */
    function menu_set_item($path, $router_item) {
        return menu_set_item($path, $router_item);
    }

    /**
     * Get a router item.
     *
     * @param $path
     *   The path, for example node/5. The function will find the corresponding
     *   node/% item and return that.
     * @param $router_item
     *   Internal use only.
     *
     * @return
     *   The router item, an associate array corresponding to one row in the
     *   menu_router table. The value of key map holds the loaded objects. The
     *   value of key access is TRUE if the current user can access this page.
     *   The values for key title, page_arguments, access_arguments, and
     *   theme_arguments will be filled in based on the database values and the
     *   objects loaded.
     */
    function menu_get_item($path = NULL, $router_item = NULL) {
        return menu_get_item($path, $router_item);
    }

    /**
     * Execute the page callback associated with the current path.
     *
     * @param $path
     *   The drupal path whose handler is to be be executed. If set to NULL, then
     *   the current path is used.
     * @param $deliver
     *   (optional) A boolean to indicate whether the content should be sent to the
     *   browser using the appropriate delivery callback (TRUE) or whether to return
     *   the result to the caller (FALSE).
     */
    function menu_execute_active_handler($path = NULL, $deliver = TRUE) {
        return menu_execute_active_handler($path, $deliver);
    }

    /**
     * Returns path as one string from the argument we are currently at.
     */
    function menu_tail_to_arg($arg, $map, $index) {
        return menu_tail_to_arg($arg, $map, $index);
    }

    /**
     * Loads path as one string from the argument we are currently at.
     *
     * To use this load function, you must specify the load arguments
     * in the router item as:
     * @code
     * $item['load arguments'] = array('%map', '%index');
     * @endcode
     *
     * @see search_menu().
     */
    function menu_tail_load($arg, &$map, $index) {
        return menu_tail_load($arg, &$map, $index);
    }

    /**
     * Get a loaded object from a router item.
     *
     * menu_get_object() provides access to objects loaded by the current router
     * item. For example, on the page node/%node, the router loads the %node object,
     * and calling menu_get_object() will return that. Normally, it is necessary to
     * specify the type of object referenced, however node is the default.
     * The following example tests to see whether the node being displayed is of the
     * "story" content type:
     * @code
     * $node = menu_get_object();
     * $story = $node->type == 'story';
     * @endcode
     *
     * @param $type
     *   Type of the object. These appear in hook_menu definitions as %type. Core
     *   provides aggregator_feed, aggregator_category, contact, filter_format,
     *   forum_term, menu, menu_link, node, taxonomy_vocabulary, user. See the
     *   relevant {$type}_load function for more on each. Defaults to node.
     * @param $position
     *   The position of the object in the path, where the first path segment is 0.
     *   For node/%node, the position of %node is 1, but for comment/reply/%node,
     *   it's 2. Defaults to 1.
     * @param $path
     *   See menu_get_item() for more on this. Defaults to the current path.
     */
    function menu_get_object($type = 'node', $position = 1, $path = NULL) {
        return menu_get_object($type, $position, $path);
    }

    /**
     * Renders a menu tree based on the current path.
     *
     * The tree is expanded based on the current path and dynamic paths are also
     * changed according to the defined to_arg functions (for example the 'My
     * account' link is changed from user/% to a link with the current user's uid).
     *
     * @param $menu_name
     *   The name of the menu.
     *
     * @return
     *   A structured array representing the specified menu on the current page, to
     *   be rendered by drupal_render().
     */
    function menu_tree($menu_name) {
        return menu_tree($menu_name);
    }

    /**
     * Returns a rendered menu tree.
     *
     * The menu item's LI element is given one of the following classes:
     * - expanded: The menu item is showing its submenu.
     * - collapsed: The menu item has a submenu which is not shown.
     * - leaf: The menu item has no submenu.
     *
     * @param $tree
     *   A data structure representing the tree as returned from menu_tree_data.
     *
     * @return
     *   A structured array to be rendered by drupal_render().
     */
    function menu_tree_output($tree) {
        return menu_tree_output($tree);
    }

    /**
     * Get the data structure representing a named menu tree.
     *
     * Since this can be the full tree including hidden items, the data returned
     * may be used for generating an an admin interface or a select.
     *
     * @param $menu_name
     *   The named menu links to return
     * @param $link
     *   A fully loaded menu link, or NULL. If a link is supplied, only the
     *   path to root will be included in the returned tree - as if this link
     *   represented the current page in a visible menu.
     * @param $max_depth
     *   Optional maximum depth of links to retrieve. Typically useful if only one
     *   or two levels of a sub tree are needed in conjunction with a non-NULL
     *   $link, in which case $max_depth should be greater than $link['depth'].
     *
     * @return
     *   An tree of menu links in an array, in the order they should be rendered.
     */
    function menu_tree_all_data($menu_name, $link = NULL, $max_depth = NULL) {
        return menu_tree_all_data($menu_name, $link, $max_depth);
    }

    /**
     * Set the path for determining the active trail of the specified menu tree.
     *
     * This path will also affect the breadcrumbs under some circumstances.
     * Breadcrumbs are built using the preferred link returned by
     * menu_link_get_preferred(). If the preferred link is inside one of the menus
     * specified in calls to menu_tree_set_path(), the preferred link will be
     * overridden by the corresponding path returned by menu_tree_get_path().
     *
     * Setting this path does not affect the main content; for that use
     * menu_set_active_item() instead.
     *
     * @param $menu_name
     *   The name of the affected menu tree.
     * @param $path
     *   The path to use when finding the active trail.
     */
    function menu_tree_set_path($menu_name, $path = NULL) {
        return menu_tree_set_path($menu_name, $path);
    }

    /**
     * Get the path for determining the active trail of the specified menu tree.
     *
     * @param $menu_name
     *   The menu name of the requested tree.
     *
     * @return
     *   A string containing the path. If no path has been specified with
     *   menu_tree_set_path(), NULL is returned.
     */
    function menu_tree_get_path($menu_name) {
        return menu_tree_get_path($menu_name);
    }

    /**
     * Get the data structure representing a named menu tree, based on the current page.
     *
     * The tree order is maintained by storing each parent in an individual
     * field, see http://drupal.org/node/141866 for more.
     *
     * @param $menu_name
     *   The named menu links to return.
     * @param $max_depth
     *   (optional) The maximum depth of links to retrieve.
     * @param $only_active_trail
     *   (optional) Whether to only return the links in the active trail (TRUE)
     *   instead of all links on every level of the menu link tree (FALSE). Defaults
     *   to FALSE. Internally used for breadcrumbs only.
     *
     * @return
     *   An array of menu links, in the order they should be rendered. The array
     *   is a list of associative arrays -- these have two keys, link and below.
     *   link is a menu item, ready for theming as a link. Below represents the
     *   submenu below the link if there is one, and it is a subtree that has the
     *   same structure described for the top-level array.
     */
    function menu_tree_page_data($menu_name, $max_depth = NULL, $only_active_trail = FALSE) {
        return menu_tree_page_data($menu_name, $max_depth, $only_active_trail);
    }

    /**
     * Build a menu tree, translate links, and check access.
     *
     * @param $menu_name
     *   The name of the menu.
     * @param $parameters
     *   (optional) An associative array of build parameters. Possible keys:
     *   - expanded: An array of parent link ids to return only menu links that are
     *     children of one of the plids in this list. If empty, the whole menu tree
     *     is built, unless 'only_active_trail' is TRUE.
     *   - active_trail: An array of mlids, representing the coordinates of the
     *     currently active menu link.
     *   - only_active_trail: Whether to only return links that are in the active
     *     trail. This option is ignored, if 'expanded' is non-empty. Internally
     *     used for breadcrumbs.
     *   - min_depth: The minimum depth of menu links in the resulting tree.
     *     Defaults to 1, which is the default to build a whole tree for a menu, i.e.
     *     excluding menu container itself.
     *   - max_depth: The maximum depth of menu links in the resulting tree.
     *   - conditions: An associative array of custom database select query
     *     condition key/value pairs; see _menu_build_tree() for the actual query.
     *
     * @return
     *   A fully built menu tree.
     */
    function menu_build_tree($menu_name, array $parameters = array()) {
        return menu_build_tree($menu_name, $parameters);
    }

    /**
     * Recursive helper function - collect node links.
     *
     * @param $tree
     *   The menu tree you wish to collect node links from.
     * @param $node_links
     *   An array in which to store the collected node links.
     */
    function menu_tree_collect_node_links(&$tree, &$node_links) {
        return menu_tree_collect_node_links(&$tree, &$node_links);
    }

    /**
     * Check access and perform other dynamic operations for each link in the tree.
     *
     * @param $tree
     *   The menu tree you wish to operate on.
     * @param $node_links
     *   A collection of node link references generated from $tree by
     *   menu_tree_collect_node_links().
     */
    function menu_tree_check_access(&$tree, $node_links = array()) {
        return menu_tree_check_access(&$tree, $node_links);
    }

    /**
     * Builds the data representing a menu tree.
     *
     * @param $links
     *   A flat array of menu links that are part of the menu. Each array element
     *   is an associative array of information about the menu link, containing the
     *   fields from the {menu_links} table, and optionally additional information
     *   from the {menu_router} table, if the menu item appears in both tables.
     *   This array must be ordered depth-first. See _menu_build_tree() for a sample
     *   query.
     * @param $parents
     *   An array of the menu link ID values that are in the path from the current
     *   page to the root of the menu tree.
     * @param $depth
     *   The minimum depth to include in the returned menu tree.
     *
     * @return
     *   An array of menu links in the form of a tree. Each item in the tree is an
     *   associative array containing:
     *   - link: The menu link item from $links, with additional element
     *     'in_active_trail' (TRUE if the link ID was in $parents).
     *   - below: An array containing the sub-tree of this item, where each element
     *     is a tree item array with 'link' and 'below' elements. This array will be
     *     empty if the menu item has no items in its sub-tree having a depth
     *     greater than or equal to $depth.
     */
    function menu_tree_data(array $links, array $parents = array(), $depth = 1) {
        return menu_tree_data($links, $parents, $depth);
    }

    /**
     * Preprocesses the rendered tree for theme_menu_tree().
     */
    function template_preprocess_menu_tree(&$variables) {
        return template_preprocess(&$variables);
    }

    /**
     * Returns HTML for a wrapper for a menu sub-tree.
     *
     * @param $variables
     *   An associative array containing:
     *   - tree: An HTML string containing the tree's items.
     *
     * @see template_preprocess_menu_tree()
     * @ingroup themeable
     */
    function theme_menu_tree($variables) {
        return theme_menu_tree($variables);
    }

    /**
     * Returns HTML for a menu link and submenu.
     *
     * @param $variables
     *   An associative array containing:
     *   - element: Structured array data for a menu link.
     *
     * @ingroup themeable
     */
    function theme_menu_link(array $variables) {
        return theme_menu_link($variables);
    }

    /**
     * Returns HTML for a single local task link.
     *
     * @param $variables
     *   An associative array containing:
     *   - element: A render element containing:
     *     - #link: A menu link array with 'title', 'href', and 'localized_options'
     *       keys.
     *     - #active: A boolean indicating whether the local task is active.
     *
     * @ingroup themeable
     */
    function theme_menu_local_task($variables) {
        return theme_menu_local_task($variables);
    }

    /**
     * Returns HTML for a single local action link.
     *
     * @param $variables
     *   An associative array containing:
     *   - element: A render element containing:
     *     - #link: A menu link array with 'title', 'href', and 'localized_options'
     *       keys.
     *
     * @ingroup themeable
     */
    function theme_menu_local_action($variables) {
        return theme_menu_local_action($variables);
    }

    /**
     * Generates elements for the $arg array in the help hook.
     */
    function drupal_help_arg($arg = array()) {
        return drupal_help_arg($arg);
    }

    /**
     * Returns the help associated with the active menu item.
     */
    function menu_get_active_help() {
        return menu_get_active_help();
    }

    /**
     * Gets the custom theme for the current page, if there is one.
     *
     * @param $initialize
     *   This parameter should only be used internally; it is set to TRUE in order
     *   to force the custom theme to be initialized for the current page request.
     *
     * @return
     *   The machine-readable name of the custom theme, if there is one.
     *
     * @see menu_set_custom_theme()
     */
    function menu_get_custom_theme($initialize = FALSE) {
        return menu_get_custom_theme($initialize);
    }

    /**
     * Sets a custom theme for the current page, if there is one.
     */
    function menu_set_custom_theme() {
        return menu_set_custom_theme();
    }

    /**
     * Build a list of named menus.
     */
    function menu_get_names() {
        return menu_get_names();
    }

    /**
     * Return an array containing the names of system-defined (default) menus.
     */
    function menu_list_system_menus() {
        return menu_list_system_menus();
    }

    /**
     * Return an array of links to be rendered as the Main menu.
     */
    function menu_main_menu() {
        return menu_main_menu();
    }

    /**
     * Return an array of links to be rendered as the Secondary links.
     */
    function menu_secondary_menu() {
        return menu_secondary_menu();
    }

    /**
     * Return an array of links for a navigation menu.
     *
     * @param $menu_name
     *   The name of the menu.
     * @param $level
     *   Optional, the depth of the menu to be returned.
     *
     * @return
     *   An array of links of the specified menu and level.
     */
    function menu_navigation_links($menu_name, $level = 0) {
        return menu_navigation_links($menu_name, $level);
    }

    /**
     * Collects the local tasks (tabs), action links, and the root path.
     *
     * @param $level
     *   The level of tasks you ask for. Primary tasks are 0, secondary are 1.
     *
     * @return
     *   An array containing
     *   - tabs: Local tasks for the requested level:
     *     - count: The number of local tasks.
     *     - output: The themed output of local tasks.
     *   - actions: Action links for the requested level:
     *     - count: The number of action links.
     *     - output: The themed output of action links.
     *   - root_path: The router path for the current page. If the current page is
     *     a default local task, then this corresponds to the parent tab.
     */
    function menu_local_tasks($level = 0) {
        return menu_local_tasks($level);
    }

    /**
     * Retrieve contextual links for a system object based on registered local tasks.
     *
     * This leverages the menu system to retrieve the first layer of registered
     * local tasks for a given system path. All local tasks of the tab type
     * MENU_CONTEXT_INLINE are taken into account.
     *
     * @see hook_menu()
     *
     * For example, when considering the following registered local tasks:
     * - node/%node/view (default local task) with no 'context' defined
     * - node/%node/edit with context: MENU_CONTEXT_PAGE | MENU_CONTEXT_INLINE
     * - node/%node/revisions with context: MENU_CONTEXT_PAGE
     * - node/%node/report-as-spam with context: MENU_CONTEXT_INLINE
     *
     * If the path "node/123" is passed to this function, then it will return the
     * links for 'edit' and 'report-as-spam'.
     *
     * @param $module
     *   The name of the implementing module. This is used to prefix the key for
     *   each contextual link, which is transformed into a CSS class during
     *   rendering by theme_links(). For example, if $module is 'block' and the
     *   retrieved local task path argument is 'edit', then the resulting CSS class
     *   will be 'block-edit'.
     * @param $parent_path
     *   The static menu router path of the object to retrieve local tasks for, for
     *   example 'node' or 'admin/structure/block/manage'.
     * @param $args
     *   A list of dynamic path arguments to append to $parent_path to form the
     *   fully-qualified menu router path, for example array(123) for a certain
     *   node or array('system', 'navigation') for a certain block.
     *
     * @return
     *   A list of menu router items that are local tasks for the passed-in path.
     *
     * @see contextual_links_preprocess()
     */
    function menu_contextual_links($module, $parent_path, $args) {
        return menu_contextual_links($module, $parent_path, $args);
    }

    /**
     * Returns the rendered local tasks at the top level.
     */
    function menu_primary_local_tasks() {
        return menu_primary_local_tasks();
    }

    /**
     * Returns the rendered local tasks at the second level.
     */
    function menu_secondary_local_tasks() {
        return menu_secondary_local_tasks();
    }

    /**
     * Returns the rendered local actions at the current level.
     */
    function menu_local_actions() {
        return menu_local_actions();
    }

    /**
     * Returns the router path, or the path of the parent tab of a default local task.
     */
    function menu_tab_root_path() {
        return menu_tab_root_path();
    }

    /**
     * Returns a renderable element for the primary and secondary tabs.
     */
    function menu_local_tabs() {
        return menu_local_tabs();
    }

    /**
     * Returns HTML for primary and secondary local tasks.
     *
     * @ingroup themeable
     */
    function theme_menu_local_tasks(&$variables) {
        return theme_menu_local_tasks(&$variables);
    }

    /**
     * Set (or get) the active menu for the current page - determines the active trail.
     *
     * @return
     *   An array of menu machine names, in order of preference. The
     *   'menu_default_active_menus' variable may be used to assert a menu order
     *   different from the order of creation, or to prevent a particular menu from
     *   being used at all in the active trail.
     *   E.g., $conf['menu_default_active_menus'] = array('navigation', 'main-menu')
     */
    function menu_set_active_menu_names($menu_names = NULL) {
        return menu_set_active_menu_names($menu_names);
    }

    /**
     * Get the active menu for the current page - determines the active trail.
     */
    function menu_get_active_menu_names() {
        return menu_get_active_menu_names();
    }

    /**
     * Set the active path, which determines which page is loaded.
     *
     * Note that this may not have the desired effect unless invoked very early
     * in the page load, such as during hook_boot, or unless you call
     * menu_execute_active_handler() to generate your page output.
     *
     * @param $path
     *   A Drupal path - not a path alias.
     */
    function menu_set_active_item($path) {
        return menu_set_active_item($path);
    }

    /**
     * Sets the active trail (path to menu tree root) of the current page.
     *
     * Any trail set by this function will only be used for functionality that calls
     * menu_get_active_trail(). Drupal core only uses trails set here for
     * breadcrumbs and the page title and not for menu trees or page content.
     * Additionally, breadcrumbs set by drupal_set_breadcrumb() will override any
     * trail set here.
     *
     * To affect the trail used by menu trees, use menu_tree_set_path(). To affect
     * the page content, use menu_set_active_item() instead.
     *
     * @param $new_trail
     *   Menu trail to set; the value is saved in a static variable and can be
     *   retrieved by menu_get_active_trail(). The format of this array should be
     *   the same as the return value of menu_get_active_trail().
     *
     * @return
     *   The active trail. See menu_get_active_trail() for details.
     */
    function menu_set_active_trail($new_trail = NULL) {
        return menu_set_active_trail($new_trail);
    }

    /**
     * Lookup the preferred menu link for a given system path.
     *
     * @param $path
     *   The path, for example 'node/5'. The function will find the corresponding
     *   menu link ('node/5' if it exists, or fallback to 'node/%').
     * @param $selected_menu
     *   The name of a menu used to restrict the search for a preferred menu link.
     *   If not specified, all the menus returned by menu_get_active_menu_names()
     *   will be used.
     *
     * @return
     *   A fully translated menu link, or FALSE if no matching menu link was
     *   found. The most specific menu link ('node/5' preferred over 'node/%') in
     *   the most preferred menu (as defined by menu_get_active_menu_names()) is
     *   returned.
     */
    function menu_link_get_preferred($path = NULL, $selected_menu = NULL) {
        return menu_link_get_preferred($path, $selected_menu);
    }

    /**
     * Gets the active trail (path to root menu root) of the current page.
     *
     * If a trail is supplied to menu_set_active_trail(), that value is returned. If
     * a trail is not supplied to menu_set_active_trail(), the path to the current
     * page is calculated and returned. The calculated trail is also saved as a
     * static value for use by subsequent calls to menu_get_active_trail().
     *
     * @return
     *   Path to menu root of the current page, as an array of menu link items,
     *   starting with the site's home page. Each link item is an associative array
     *   with the following components:
     *   - title: Title of the item.
     *   - href: Drupal path of the item.
     *   - localized_options: Options for passing into the l() function.
     *   - type: A menu type constant, such as MENU_DEFAULT_LOCAL_TASK, or 0 to
     *     indicate it's not really in the menu (used for the home page item).
     */
    function menu_get_active_trail() {
        return menu_get_active_trail();
    }

    // TODO: continue here....
    
    /**
     * Get the breadcrumb for the current page, as determined by the active trail.
     *
     * @see menu_set_active_trail()
     */
    function menu_get_active_breadcrumb() {
        $breadcrumb = array();

        // No breadcrumb for the front page.
        if (drupal_is_front_page()) {
            return $breadcrumb;
        }

        $item = menu_get_item();
        if (!empty($item['access'])) {
            $active_trail = menu_get_active_trail();

            // Allow modules to alter the breadcrumb, if possible, as that is much
            // faster than rebuilding an entirely new active trail.
            drupal_alter('menu_breadcrumb', $active_trail, $item);

            // Don't show a link to the current page in the breadcrumb trail.
            $end = end($active_trail);
            if ($item['href'] == $end['href']) {
                array_pop($active_trail);
            }

            // Remove the tab root (parent) if the current path links to its parent.
            // Normally, the tab root link is included in the breadcrumb, as soon as we
            // are on a local task or any other child link. However, if we are on a
            // default local task (e.g., node/%/view), then we do not want the tab root
            // link (e.g., node/%) to appear, as it would be identical to the current
            // page. Since this behavior also needs to work recursively (i.e., on
            // default local tasks of default local tasks), and since the last non-task
            // link in the trail is used as page title (see menu_get_active_title()),
            // this condition cannot be cleanly integrated into menu_get_active_trail().
            // menu_get_active_trail() already skips all links that link to their parent
            // (commonly MENU_DEFAULT_LOCAL_TASK). In order to also hide the parent link
            // itself, we always remove the last link in the trail, if the current
            // router item links to its parent.
            if (($item['type'] & MENU_LINKS_TO_PARENT) == MENU_LINKS_TO_PARENT) {
                array_pop($active_trail);
            }

            foreach ($active_trail as $parent) {
                $breadcrumb[] = l($parent['title'], $parent['href'], $parent['localized_options']);
            }
        }
        return $breadcrumb;
    }

    /**
     * Get the title of the current page, as determined by the active trail.
     */
    function menu_get_active_title() {
        $active_trail = menu_get_active_trail();

        foreach (array_reverse($active_trail) as $item) {
            if (!(bool) ($item['type'] & MENU_IS_LOCAL_TASK)) {
                return $item['title'];
            }
        }
    }

    /**
     * Get a menu link by its mlid, access checked and link translated for rendering.
     *
     * This function should never be called from within node_load() or any other
     * function used as a menu object load function since an infinite recursion may
     * occur.
     *
     * @param $mlid
     *   The mlid of the menu item.
     *
     * @return
     *   A menu link, with $item['access'] filled and link translated for
     *   rendering.
     */
    function menu_link_load($mlid) {
        if (is_numeric($mlid)) {
            $query = db_select('menu_links', 'ml');
            $query->leftJoin('menu_router', 'm', 'm.path = ml.router_path');
            $query->fields('ml');
            // Weight should be taken from {menu_links}, not {menu_router}.
            $query->addField('ml', 'weight', 'link_weight');
            $query->fields('m');
            $query->condition('ml.mlid', $mlid);
            if ($item = $query->execute()->fetchAssoc()) {
                $item['weight'] = $item['link_weight'];
                _menu_link_translate($item);
                return $item;
            }
        }
        return FALSE;
    }

    /**
     * Clears the cached cached data for a single named menu.
     */
    function menu_cache_clear($menu_name = 'navigation') {
        $cache_cleared = &drupal_static(__FUNCTION__, array());

        if (empty($cache_cleared[$menu_name])) {
            cache_clear_all('links:' . $menu_name . ':', 'cache_menu', TRUE);
            $cache_cleared[$menu_name] = 1;
        }
        elseif ($cache_cleared[$menu_name] == 1) {
            drupal_register_shutdown_function('cache_clear_all', 'links:' . $menu_name . ':', 'cache_menu', TRUE);
            $cache_cleared[$menu_name] = 2;
        }

        // Also clear the menu system static caches.
        menu_reset_static_cache();
    }

    /**
     * Clears all cached menu data. This should be called any time broad changes
     * might have been made to the router items or menu links.
     */
    function menu_cache_clear_all() {
        cache_clear_all('*', 'cache_menu', TRUE);
        menu_reset_static_cache();
    }

    /**
     * Resets the menu system static cache.
     */
    function menu_reset_static_cache() {
        drupal_static_reset('_menu_build_tree');
        drupal_static_reset('menu_tree');
        drupal_static_reset('menu_tree_all_data');
        drupal_static_reset('menu_tree_page_data');
        drupal_static_reset('menu_load_all');
        drupal_static_reset('menu_link_get_preferred');
    }

    /**
     * (Re)populate the database tables used by various menu functions.
     *
     * This function will clear and populate the {menu_router} table, add entries
     * to {menu_links} for new router items, then remove stale items from
     * {menu_links}. If called from update.php or install.php, it will also
     * schedule a call to itself on the first real page load from
     * menu_execute_active_handler(), because the maintenance page environment
     * is different and leaves stale data in the menu tables.
     *
     * @return
     *   TRUE if the menu was rebuilt, FALSE if another thread was rebuilding
     *   in parallel and the current thread just waited for completion.
     */
    function menu_rebuild() {
        if (!lock_acquire('menu_rebuild')) {
            // Wait for another request that is already doing this work.
            // We choose to block here since otherwise the router item may not
            // be available in menu_execute_active_handler() resulting in a 404.
            lock_wait('menu_rebuild');
            return FALSE;
        }

        $transaction = db_transaction();

        try {
            list($menu, $masks) = menu_router_build();
            _menu_router_save($menu, $masks);
            _menu_navigation_links_rebuild($menu);
            // Clear the menu, page and block caches.
            menu_cache_clear_all();
            _menu_clear_page_cache();

            if (defined('MAINTENANCE_MODE')) {
                variable_set('menu_rebuild_needed', TRUE);
            }
            else {
                variable_del('menu_rebuild_needed');
            }
        }
        catch (Exception $e) {
            $transaction->rollback();
            watchdog_exception('menu', $e);
        }

        lock_release('menu_rebuild');
        return TRUE;
    }

    /**
     * Collect and alter the menu definitions.
     */
    function menu_router_build() {
        // We need to manually call each module so that we can know which module
        // a given item came from.
        $callbacks = array();
        foreach (module_implements('menu') as $module) {
            $router_items = call_user_func($module . '_menu');
            if (isset($router_items) && is_array($router_items)) {
                foreach (array_keys($router_items) as $path) {
                    $router_items[$path]['module'] = $module;
                }
                $callbacks = array_merge($callbacks, $router_items);
            }
        }
        // Alter the menu as defined in modules, keys are like user/%user.
        drupal_alter('menu', $callbacks);
        list($menu, $masks) = _menu_router_build($callbacks);
        _menu_router_cache($menu);

        return array($menu, $masks);
    }

    /**
     * Helper function to store the menu router if we have it in memory.
     */
    function _menu_router_cache($new_menu = NULL) {
        $menu = &drupal_static(__FUNCTION__);

        if (isset($new_menu)) {
            $menu = $new_menu;
        }
        return $menu;
    }

    /**
     * Get the menu router.
     */
    function menu_get_router() {
        // Check first if we have it in memory already.
        $menu = _menu_router_cache();
        if (empty($menu)) {
            list($menu, $masks) = menu_router_build();
        }
        return $menu;
    }

    /**
     * Builds a link from a router item.
     */
    function _menu_link_build($item) {
        // Suggested items are disabled by default.
        if ($item['type'] == MENU_SUGGESTED_ITEM) {
            $item['hidden'] = 1;
        }
        // Hide all items that are not visible in the tree.
        elseif (!($item['type'] & MENU_VISIBLE_IN_TREE)) {
            $item['hidden'] = -1;
        }
        // Note, we set this as 'system', so that we can be sure to distinguish all
        // the menu links generated automatically from entries in {menu_router}.
        $item['module'] = 'system';
        $item += array(
            'menu_name' => 'navigation',
            'link_title' => $item['title'],
            'link_path' => $item['path'],
            'hidden' => 0,
            'options' => empty($item['description']) ? array() : array('attributes' => array('title' => $item['description'])),
        );
        return $item;
    }

    /**
     * Helper function to build menu links for the items in the menu router.
     */
    function _menu_navigation_links_rebuild($menu) {
        // Add normal and suggested items as links.
        $menu_links = array();
        foreach ($menu as $path => $item) {
            if ($item['_visible']) {
                $menu_links[$path] = $item;
                $sort[$path] = $item['_number_parts'];
            }
        }
        if ($menu_links) {
            // Keep an array of processed menu links, to allow menu_link_save() to
            // check this for parents instead of querying the database.
            $parent_candidates = array();
            // Make sure no child comes before its parent.
            array_multisort($sort, SORT_NUMERIC, $menu_links);

            foreach ($menu_links as $key => $item) {
                $existing_item = db_select('menu_links')
                    ->fields('menu_links')
                    ->condition('link_path', $item['path'])
                    ->condition('module', 'system')
                    ->execute()->fetchAssoc();
                if ($existing_item) {
                    $item['mlid'] = $existing_item['mlid'];
                    // A change in hook_menu may move the link to a different menu
                    if (empty($item['menu_name']) || ($item['menu_name'] == $existing_item['menu_name'])) {
                        $item['menu_name'] = $existing_item['menu_name'];
                        $item['plid'] = $existing_item['plid'];
                    }
                    else {
                        // It moved to a new menu. Let menu_link_save() try to find a new
                        // parent based on the path.
                        unset($item['plid']);
                    }
                    $item['has_children'] = $existing_item['has_children'];
                    $item['updated'] = $existing_item['updated'];
                }
                if ($existing_item && $existing_item['customized']) {
                    $parent_candidates[$existing_item['mlid']] = $existing_item;
                }
                else {
                    $item = _menu_link_build($item);
                    menu_link_save($item, $existing_item, $parent_candidates);
                    $parent_candidates[$item['mlid']] = $item;
                    unset($menu_links[$key]);
                }
            }
        }
        $paths = array_keys($menu);
        // Updated and customized items whose router paths are gone need new ones.
        $result = db_select('menu_links', NULL, array('fetch' => PDO::FETCH_ASSOC))
            ->fields('menu_links', array(
            'link_path',
            'mlid',
            'router_path',
            'updated',
        ))
            ->condition(db_or()
                ->condition('updated', 1)
                ->condition(db_and()
                    ->condition('router_path', $paths, 'NOT IN')
                    ->condition('external', 0)
                    ->condition('customized', 1)
            )
        )
            ->execute();
        foreach ($result as $item) {
            $router_path = _menu_find_router_path($item['link_path']);
            if (!empty($router_path) && ($router_path != $item['router_path'] || $item['updated'])) {
                // If the router path and the link path matches, it's surely a working
                // item, so we clear the updated flag.
                $updated = $item['updated'] && $router_path != $item['link_path'];
                db_update('menu_links')
                    ->fields(array(
                    'router_path' => $router_path,
                    'updated' => (int) $updated,
                ))
                    ->condition('mlid', $item['mlid'])
                    ->execute();
            }
        }
        // Find any item whose router path does not exist any more.
        $result = db_select('menu_links')
            ->fields('menu_links')
            ->condition('router_path', $paths, 'NOT IN')
            ->condition('external', 0)
            ->condition('updated', 0)
            ->condition('customized', 0)
            ->orderBy('depth', 'DESC')
            ->execute();
        // Remove all such items. Starting from those with the greatest depth will
        // minimize the amount of re-parenting done by menu_link_delete().
        foreach ($result as $item) {
            _menu_delete_item($item, TRUE);
        }
    }

    /**
     * Clone an array of menu links.
     *
     * @param $links
     *   An array of menu links to clone.
     * @param $menu_name
     *   (optional) The name of a menu that the links will be cloned for. If not
     *   set, the cloned links will be in the same menu as the original set of
     *   links that were passed in.
     *
     * @return
     *   An array of menu links with the same properties as the passed-in array,
     *   but with the link identifiers removed so that a new link will be created
     *   when any of them is passed in to menu_link_save().
     *
     * @see menu_link_save()
     */
    function menu_links_clone($links, $menu_name = NULL) {
        foreach ($links as &$link) {
            unset($link['mlid']);
            unset($link['plid']);
            if (isset($menu_name)) {
                $link['menu_name'] = $menu_name;
            }
        }
        return $links;
    }

    /**
     * Returns an array containing all links for a menu.
     *
     * @param $menu_name
     *   The name of the menu whose links should be returned.
     *
     * @return
     *   An array of menu links.
     */
    function menu_load_links($menu_name) {
        $links = db_select('menu_links', 'ml', array('fetch' => PDO::FETCH_ASSOC))
            ->fields('ml')
            ->condition('ml.menu_name', $menu_name)
        // Order by weight so as to be helpful for menus that are only one level
        // deep.
            ->orderBy('weight')
            ->execute()
            ->fetchAll();

        foreach ($links as &$link) {
            $link['options'] = unserialize($link['options']);
        }
        return $links;
    }

    /**
     * Deletes all links for a menu.
     *
     * @param $menu_name
     *   The name of the menu whose links will be deleted.
     */
    function menu_delete_links($menu_name) {
        $links = menu_load_links($menu_name);
        foreach ($links as $link) {
            // To speed up the deletion process, we reset some link properties that
            // would trigger re-parenting logic in _menu_delete_item() and
            // _menu_update_parental_status().
            $link['has_children'] = FALSE;
            $link['plid'] = 0;
            _menu_delete_item($link);
        }
    }

    /**
     * Delete one or several menu links.
     *
     * @param $mlid
     *   A valid menu link mlid or NULL. If NULL, $path is used.
     * @param $path
     *   The path to the menu items to be deleted. $mlid must be NULL.
     */
    function menu_link_delete($mlid, $path = NULL) {
        if (isset($mlid)) {
            _menu_delete_item(db_query("SELECT * FROM {menu_links} WHERE mlid = :mlid", array(':mlid' => $mlid))->fetchAssoc());
        }
        else {
            $result = db_query("SELECT * FROM {menu_links} WHERE link_path = :link_path", array(':link_path' => $path));
            foreach ($result as $link) {
                _menu_delete_item($link);
            }
        }
    }

    /**
     * Helper function for menu_link_delete; deletes a single menu link.
     *
     * @param $item
     *   Item to be deleted.
     * @param $force
     *   Forces deletion. Internal use only, setting to TRUE is discouraged.
     */
    function _menu_delete_item($item, $force = FALSE) {
        $item = is_object($item) ? get_object_vars($item) : $item;
        if ($item && ($item['module'] != 'system' || $item['updated'] || $force)) {
            // Children get re-attached to the item's parent.
            if ($item['has_children']) {
                $result = db_query("SELECT mlid FROM {menu_links} WHERE plid = :plid", array(':plid' => $item['mlid']));
                foreach ($result as $m) {
                    $child = menu_link_load($m->mlid);
                    $child['plid'] = $item['plid'];
                    menu_link_save($child);
                }
            }

            // Notify modules we are deleting the item.
            module_invoke_all('menu_link_delete', $item);

            db_delete('menu_links')->condition('mlid', $item['mlid'])->execute();

            // Update the has_children status of the parent.
            _menu_update_parental_status($item);
            menu_cache_clear($item['menu_name']);
            _menu_clear_page_cache();
        }
    }

    /**
     * Saves a menu link.
     *
     * After calling this function, rebuild the menu cache using
     * menu_cache_clear_all().
     *
     * @param $item
     *   An associative array representing a menu link item, with elements:
     *   - link_path: (required) The path of the menu item, which should be
     *     normalized first by calling drupal_get_normal_path() on it.
     *   - link_title: (required) Title to appear in menu for the link.
     *   - menu_name: (optional) The machine name of the menu for the link.
     *     Defaults to 'navigation'.
     *   - weight: (optional) Integer to determine position in menu. Default is 0.
     *   - expanded: (optional) Boolean that determines if the item is expanded.
     *   - options: (optional) An array of options, see l() for more.
     *   - mlid: (optional) Menu link identifier, the primary integer key for each
     *     menu link. Can be set to an existing value, or to 0 or NULL
     *     to insert a new link.
     *   - plid: (optional) The mlid of the parent.
     *   - router_path: (optional) The path of the relevant router item.
     * @param $existing_item
     *   Optional, the current record from the {menu_links} table as an array.
     * @param $parent_candidates
     *   Optional array of menu links keyed by mlid. Used by
     *   _menu_navigation_links_rebuild() only.
     *
     * @return
     *   The mlid of the saved menu link, or FALSE if the menu link could not be
     *   saved.
     */
    function menu_link_save(&$item, $existing_item = array(), $parent_candidates = array()) {
        drupal_alter('menu_link', $item);

        // This is the easiest way to handle the unique internal path '<front>',
        // since a path marked as external does not need to match a router path.
        $item['external'] = (url_is_external($item['link_path'])  || $item['link_path'] == '<front>') ? 1 : 0;
        // Load defaults.
        $item += array(
            'menu_name' => 'navigation',
            'weight' => 0,
            'link_title' => '',
            'hidden' => 0,
            'has_children' => 0,
            'expanded' => 0,
            'options' => array(),
            'module' => 'menu',
            'customized' => 0,
            'updated' => 0,
        );
        if (isset($item['mlid'])) {
            if (!$existing_item) {
                $existing_item = db_query('SELECT * FROM {menu_links} WHERE mlid = :mlid', array('mlid' => $item['mlid']))->fetchAssoc();
            }
            if ($existing_item) {
                $existing_item['options'] = unserialize($existing_item['options']);
            }
        }
        else {
            $existing_item = FALSE;
        }

        // Try to find a parent link. If found, assign it and derive its menu.
        $parent = _menu_link_find_parent($item, $parent_candidates);
        if (!empty($parent['mlid'])) {
            $item['plid'] = $parent['mlid'];
            $item['menu_name'] = $parent['menu_name'];
        }
        // If no corresponding parent link was found, move the link to the top-level.
        else {
            $item['plid'] = 0;
        }
        $menu_name = $item['menu_name'];

        if (!$existing_item) {
            $item['mlid'] = db_insert('menu_links')
                ->fields(array(
                'menu_name' => $item['menu_name'],
                'plid' => $item['plid'],
                'link_path' => $item['link_path'],
                'hidden' => $item['hidden'],
                'external' => $item['external'],
                'has_children' => $item['has_children'],
                'expanded' => $item['expanded'],
                'weight' => $item['weight'],
                'module' => $item['module'],
                'link_title' => $item['link_title'],
                'options' => serialize($item['options']),
                'customized' => $item['customized'],
                'updated' => $item['updated'],
            ))
                ->execute();
        }

        // Directly fill parents for top-level links.
        if ($item['plid'] == 0) {
            $item['p1'] = $item['mlid'];
            for ($i = 2; $i <= MENU_MAX_DEPTH; $i++) {
                $item["p$i"] = 0;
            }
            $item['depth'] = 1;
        }
        // Otherwise, ensure that this link's depth is not beyond the maximum depth
        // and fill parents based on the parent link.
        else {
            if ($item['has_children'] && $existing_item) {
                $limit = MENU_MAX_DEPTH - menu_link_children_relative_depth($existing_item) - 1;
            }
            else {
                $limit = MENU_MAX_DEPTH - 1;
            }
            if ($parent['depth'] > $limit) {
                return FALSE;
            }
            $item['depth'] = $parent['depth'] + 1;
            _menu_link_parents_set($item, $parent);
        }
        // Need to check both plid and menu_name, since plid can be 0 in any menu.
        if ($existing_item && ($item['plid'] != $existing_item['plid'] || $menu_name != $existing_item['menu_name'])) {
            _menu_link_move_children($item, $existing_item);
        }
        // Find the router_path.
        if (empty($item['router_path'])  || !$existing_item || ($existing_item['link_path'] != $item['link_path'])) {
            if ($item['external']) {
                $item['router_path'] = '';
            }
            else {
                // Find the router path which will serve this path.
                $item['parts'] = explode('/', $item['link_path'], MENU_MAX_PARTS);
                $item['router_path'] = _menu_find_router_path($item['link_path']);
            }
        }
        // If every value in $existing_item is the same in the $item, there is no
        // reason to run the update queries or clear the caches. We use
        // array_intersect_key() with the $item as the first parameter because
        // $item may have additional keys left over from building a router entry.
        // The intersect removes the extra keys, allowing a meaningful comparison.
        if (!$existing_item || (array_intersect_key($item, $existing_item) != $existing_item)) {
            db_update('menu_links')
                ->fields(array(
                'menu_name' => $item['menu_name'],
                'plid' => $item['plid'],
                'link_path' => $item['link_path'],
                'router_path' => $item['router_path'],
                'hidden' => $item['hidden'],
                'external' => $item['external'],
                'has_children' => $item['has_children'],
                'expanded' => $item['expanded'],
                'weight' => $item['weight'],
                'depth' => $item['depth'],
                'p1' => $item['p1'],
                'p2' => $item['p2'],
                'p3' => $item['p3'],
                'p4' => $item['p4'],
                'p5' => $item['p5'],
                'p6' => $item['p6'],
                'p7' => $item['p7'],
                'p8' => $item['p8'],
                'p9' => $item['p9'],
                'module' => $item['module'],
                'link_title' => $item['link_title'],
                'options' => serialize($item['options']),
                'customized' => $item['customized'],
            ))
                ->condition('mlid', $item['mlid'])
                ->execute();
            // Check the has_children status of the parent.
            _menu_update_parental_status($item);
            menu_cache_clear($menu_name);
            if ($existing_item && $menu_name != $existing_item['menu_name']) {
                menu_cache_clear($existing_item['menu_name']);
            }
            // Notify modules we have acted on a menu item.
            $hook = 'menu_link_insert';
            if ($existing_item) {
                $hook = 'menu_link_update';
            }
            module_invoke_all($hook, $item);
            // Now clear the cache.
            _menu_clear_page_cache();
        }
        return $item['mlid'];
    }

    /**
     * Find a possible parent for a given menu link.
     *
     * Because the parent of a given link might not exist anymore in the database,
     * we apply a set of heuristics to determine a proper parent:
     *
     *  - use the passed parent link if specified and existing.
     *  - else, use the first existing link down the previous link hierarchy
     *  - else, for system menu links (derived from hook_menu()), reparent
     *    based on the path hierarchy.
     *
     * @param $menu_link
     *   A menu link.
     * @param $parent_candidates
     *   An array of menu links keyed by mlid.
     * @return
     *   A menu link structure of the possible parent or FALSE if no valid parent
     *   has been found.
     */
    function _menu_link_find_parent($menu_link, $parent_candidates = array()) {
        $parent = FALSE;

        // This item is explicitely top-level, skip the rest of the parenting.
        if (isset($menu_link['plid']) && empty($menu_link['plid'])) {
            return $parent;
        }

        // If we have a parent link ID, try to use that.
        $candidates = array();
        if (isset($menu_link['plid'])) {
            $candidates[] = $menu_link['plid'];
        }

        // Else, if we have a link hierarchy try to find a valid parent in there.
        if (!empty($menu_link['depth']) && $menu_link['depth'] > 1) {
            for ($depth = $menu_link['depth'] - 1; $depth >= 1; $depth--) {
                $candidates[] = $menu_link['p' . $depth];
            }
        }

        foreach ($candidates as $mlid) {
            if (isset($parent_candidates[$mlid])) {
                $parent = $parent_candidates[$mlid];
            }
            else {
                $parent = db_query("SELECT * FROM {menu_links} WHERE mlid = :mlid", array(':mlid' => $mlid))->fetchAssoc();
            }
            if ($parent) {
                return $parent;
            }
        }

        // If everything else failed, try to derive the parent from the path
        // hierarchy. This only makes sense for links derived from menu router
        // items (ie. from hook_menu()).
        if ($menu_link['module'] == 'system') {
            $query = db_select('menu_links');
            $query->condition('module', 'system');
            // We always respect the link's 'menu_name'; inheritance for router items is
            // ensured in _menu_router_build().
            $query->condition('menu_name', $menu_link['menu_name']);

            // Find the parent - it must be unique.
            $parent_path = $menu_link['link_path'];
            do {
                $parent = FALSE;
                $parent_path = substr($parent_path, 0, strrpos($parent_path, '/'));
                $new_query = clone $query;
                $new_query->condition('link_path', $parent_path);
                // Only valid if we get a unique result.
                if ($new_query->countQuery()->execute()->fetchField() == 1) {
                    $parent = $new_query->fields('menu_links')->execute()->fetchAssoc();
                }
            } while ($parent === FALSE && $parent_path);
        }

        return $parent;
    }

    /**
     * Helper function to clear the page and block caches at most twice per page load.
     */
    function _menu_clear_page_cache() {
        $cache_cleared = &drupal_static(__FUNCTION__, 0);

        // Clear the page and block caches, but at most twice, including at
        //  the end of the page load when there are multiple links saved or deleted.
        if ($cache_cleared == 0) {
            cache_clear_all();
            // Keep track of which menus have expanded items.
            _menu_set_expanded_menus();
            $cache_cleared = 1;
        }
        elseif ($cache_cleared == 1) {
            drupal_register_shutdown_function('cache_clear_all');
            // Keep track of which menus have expanded items.
            drupal_register_shutdown_function('_menu_set_expanded_menus');
            $cache_cleared = 2;
        }
    }

    /**
     * Helper function to update a list of menus with expanded items
     */
    function _menu_set_expanded_menus() {
        $names = db_query("SELECT menu_name FROM {menu_links} WHERE expanded <> 0 GROUP BY menu_name")->fetchCol();
        variable_set('menu_expanded', $names);
    }

    /**
     * Find the router path which will serve this path.
     *
     * @param $link_path
     *  The path for we are looking up its router path.
     *
     * @return
     *  A path from $menu keys or empty if $link_path points to a nonexisting
     *  place.
     */
    function _menu_find_router_path($link_path) {
        // $menu will only have data during a menu rebuild.
        $menu = _menu_router_cache();

        $router_path = $link_path;
        $parts = explode('/', $link_path, MENU_MAX_PARTS);
        $ancestors = menu_get_ancestors($parts);

        if (empty($menu)) {
            // Not during a menu rebuild, so look up in the database.
            $router_path = (string) db_select('menu_router')
                ->fields('menu_router', array('path'))
                ->condition('path', $ancestors, 'IN')
                ->orderBy('fit', 'DESC')
                ->range(0, 1)
                ->execute()->fetchField();
        }
        elseif (!isset($menu[$router_path])) {
            // Add an empty router path as a fallback.
            $ancestors[] = '';
            foreach ($ancestors as $key => $router_path) {
                if (isset($menu[$router_path])) {
                    // Exit the loop leaving $router_path as the first match.
                    break;
                }
            }
            // If we did not find the path, $router_path will be the empty string
            // at the end of $ancestors.
        }
        return $router_path;
    }

    /**
     * Insert, update or delete an uncustomized menu link related to a module.
     *
     * @param $module
     *   The name of the module.
     * @param $op
     *   Operation to perform: insert, update or delete.
     * @param $link_path
     *   The path this link points to.
     * @param $link_title
     *   Title of the link to insert or new title to update the link to.
     *   Unused for delete.
     *
     * @return
     *   The insert op returns the mlid of the new item. Others op return NULL.
     */
    function menu_link_maintain($module, $op, $link_path, $link_title) {
        switch ($op) {
            case 'insert':
                $menu_link = array(
                    'link_title' => $link_title,
                    'link_path' => $link_path,
                    'module' => $module,
                );
                return menu_link_save($menu_link);
                break;
            case 'update':
                $result = db_query("SELECT * FROM {menu_links} WHERE link_path = :link_path AND module = :module AND customized = 0", array(':link_path' => $link_path, ':module' => $module))->fetchAll(PDO::FETCH_ASSOC);
                foreach ($result as $link) {
                    $link['link_title'] = $link_title;
                    $link['options'] = unserialize($link['options']);
                    menu_link_save($link);
                }
                break;
            case 'delete':
                menu_link_delete(NULL, $link_path);
                break;
        }
    }

    /**
     * Find the depth of an item's children relative to its depth.
     *
     * For example, if the item has a depth of 2, and the maximum of any child in
     * the menu link tree is 5, the relative depth is 3.
     *
     * @param $item
     *   An array representing a menu link item.
     *
     * @return
     *   The relative depth, or zero.
     *
     */
    function menu_link_children_relative_depth($item) {
        $query = db_select('menu_links');
        $query->addField('menu_links', 'depth');
        $query->condition('menu_name', $item['menu_name']);
        $query->orderBy('depth', 'DESC');
        $query->range(0, 1);

        $i = 1;
        $p = 'p1';
        while ($i <= MENU_MAX_DEPTH && $item[$p]) {
            $query->condition($p, $item[$p]);
            $p = 'p' . ++$i;
        }

        $max_depth = $query->execute()->fetchField();

        return ($max_depth > $item['depth']) ? $max_depth - $item['depth'] : 0;
    }

}
