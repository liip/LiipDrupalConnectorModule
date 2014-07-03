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
    public function menu_get_ancestors($parts)
    {
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
    public function menu_unserialize($data, $map)
    {
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
    public function menu_set_item($path, $router_item)
    {
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
    public function menu_get_item($path = NULL, $router_item = NULL)
    {
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
    public function menu_execute_active_handler($path = NULL, $deliver = TRUE)
    {
        return menu_execute_active_handler($path, $deliver);
    }

    /**
     * Returns path as one string from the argument we are currently at.
     */
    public function menu_tail_to_arg($arg, $map, $index)
    {
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
    public function menu_tail_load($arg, &$map, $index)
    {
        return menu_tail_load($arg, $map, $index);
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
    public function menu_get_object($type = 'node', $position = 1, $path = NULL)
    {
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
    public function menu_tree($menu_name)
    {
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
    public function menu_tree_output($tree)
    {
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
    public function menu_tree_all_data($menu_name, $link = NULL, $max_depth = NULL)
    {
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
    public function menu_tree_set_path($menu_name, $path = NULL)
    {
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
    public function menu_tree_get_path($menu_name)
    {
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
    public function menu_tree_page_data($menu_name, $max_depth = NULL, $only_active_trail = FALSE)
    {
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
    public function menu_build_tree($menu_name, array $parameters = array())
    {
        return menu_build_tree($menu_name, $parameters);
    }

  /**
   * Build a menu tree without access check
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
    function menu_build_tree_without_access_check($menu_name, array $parameters = array()) {
      // Build the menu tree without access check and ignore disabled nodes
      $data = _menu_build_tree($menu_name, $parameters);
      return $data['tree'];
    }


  /**
     * Recursive helper function - collect node links.
     *
     * @param $tree
     *   The menu tree you wish to collect node links from.
     * @param $node_links
     *   An array in which to store the collected node links.
     */
    public function menu_tree_collect_node_links(&$tree, &$node_links)
    {
        return menu_tree_collect_node_links($tree, $node_links);
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
    public function menu_tree_check_access(&$tree, $node_links = array())
    {
        return menu_tree_check_access($tree, $node_links);
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
    public function menu_tree_data(array $links, array $parents = array(), $depth = 1)
    {
        return menu_tree_data($links, $parents, $depth);
    }

    /**
     * Preprocesses the rendered tree for theme_menu_tree().
     */
    public function template_preprocess_menu_tree(&$variables)
    {
        return template_preprocess_menu_tree($variables);
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
    public function theme_menu_tree($variables)
    {
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
    public function theme_menu_link(array $variables)
    {
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
    public function theme_menu_local_task($variables)
    {
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
    public function theme_menu_local_action($variables)
    {
        return theme_menu_local_action($variables);
    }

    /**
     * Generates elements for the $arg array in the help hook.
     */
    public function drupal_help_arg($arg = array())
    {
        return drupal_help_arg($arg);
    }

    /**
     * Returns the help associated with the active menu item.
     */
    public function menu_get_active_help()
    {
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
    public function menu_get_custom_theme($initialize = FALSE)
    {
        return menu_get_custom_theme($initialize);
    }

    /**
     * Sets a custom theme for the current page, if there is one.
     */
    public function menu_set_custom_theme()
    {
        return menu_set_custom_theme();
    }

    /**
     * Build a list of named menus.
     */
    public function menu_get_names()
    {
        return menu_get_names();
    }

    /**
     * Return an array containing the names of system-defined (default) menus.
     */
    public function menu_list_system_menus()
    {
        return menu_list_system_menus();
    }

    /**
     * Return an array of links to be rendered as the Main menu.
     */
    public function menu_main_menu()
    {
        return menu_main_menu();
    }

    /**
     * Return an array of links to be rendered as the Secondary links.
     */
    public function menu_secondary_menu()
    {
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
    public function menu_navigation_links($menu_name, $level = 0)
    {
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
    public function menu_local_tasks($level = 0)
    {
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
    public function menu_contextual_links($module, $parent_path, $args)
    {
        return menu_contextual_links($module, $parent_path, $args);
    }

    /**
     * Returns the rendered local tasks at the top level.
     */
    public function menu_primary_local_tasks()
    {
        return menu_primary_local_tasks();
    }

    /**
     * Returns the rendered local tasks at the second level.
     */
    public function menu_secondary_local_tasks()
    {
        return menu_secondary_local_tasks();
    }

    /**
     * Returns the rendered local actions at the current level.
     */
    public function menu_local_actions()
    {
        return menu_local_actions();
    }

    /**
     * Returns the router path, or the path of the parent tab of a default local task.
     */
    public function menu_tab_root_path()
    {
        return menu_tab_root_path();
    }

    /**
     * Returns a renderable element for the primary and secondary tabs.
     */
    public function menu_local_tabs()
    {
        return menu_local_tabs();
    }

    /**
     * Returns HTML for primary and secondary local tasks.
     *
     * @ingroup themeable
     */
    public function theme_menu_local_tasks(&$variables)
    {
        return theme_menu_local_tasks($variables);
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
    public function menu_set_active_menu_names($menu_names = NULL)
    {
        return menu_set_active_menu_names($menu_names);
    }

    /**
     * Get the active menu for the current page - determines the active trail.
     */
    public function menu_get_active_menu_names()
    {
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
    public function menu_set_active_item($path)
    {
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
    public function menu_set_active_trail($new_trail = NULL)
    {
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
    public function menu_link_get_preferred($path = NULL, $selected_menu = NULL)
    {
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
    public function menu_get_active_trail()
    {
        return menu_get_active_trail();
    }

    /**
     * Get the breadcrumb for the current page, as determined by the active trail.
     *
     * @see menu_set_active_trail()
     */
    public function menu_get_active_breadcrumb()
    {
        return menu_get_active_breadcrumb();
    }

    /**
     * Get the title of the current page, as determined by the active trail.
     */
    public function menu_get_active_title()
    {
        return menu_get_active_title();
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
    public function menu_link_load($mlid)
    {
        return menu_link_load($mlid);
    }

    /**
     * Clears the cached cached data for a single named menu.
     */
    public function menu_cache_clear($menu_name = 'navigation')
    {
        return menu_cache_clear($menu_name);
    }

    /**
     * Clears all cached menu data. This should be called any time broad changes
     * might have been made to the router items or menu links.
     */
    public function menu_cache_clear_all()
    {
        return menu_cache_clear_all();
    }

    /**
     * Resets the menu system static cache.
     */
    public function menu_reset_static_cache()
    {
        return menu_reset_static_cache();
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
    public function menu_rebuild()
    {
        return menu_rebuild();
    }

    /**
     * Collect and alter the menu definitions.
     */
    public function menu_router_build()
    {
        return menu_router_build();
    }

    /**
     * Get the menu router.
     */
    public function menu_get_router()
    {
        return menu_get_router();
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
    public function menu_links_clone($links, $menu_name = NULL)
    {
        return menu_links_clone($links, $menu_name);
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
    public function menu_load_links($menu_name)
    {
        return menu_load_links($menu_name);
    }

    /**
     * Deletes all links for a menu.
     *
     * @param $menu_name
     *   The name of the menu whose links will be deleted.
     */
    public function menu_delete_links($menu_name)
    {
        return menu_delete_links($menu_name);
    }

    /**
     * Delete one or several menu links.
     *
     * @param $mlid
     *   A valid menu link mlid or NULL. If NULL, $path is used.
     * @param $path
     *   The path to the menu items to be deleted. $mlid must be NULL.
     */
    public function menu_link_delete($mlid, $path = NULL)
    {
        return menu_link_delete($mlid, $path);
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
    public function menu_link_save(&$item, $existing_item = array(), $parent_candidates = array())
    {
        return menu_link_save($item, $existing_item, $parent_candidates);
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
    public function menu_link_maintain($module, $op, $link_path, $link_title)
    {
        return menu_link_maintain($module, $op, $link_path, $link_title);
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
    public function menu_link_children_relative_depth($item)
    {
        return menu_link_children_relative_depth($item);
    }
}
