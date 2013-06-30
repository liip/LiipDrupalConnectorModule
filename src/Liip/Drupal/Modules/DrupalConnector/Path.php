<?php

/**
 * Abstraction of the procedural Drupal world into OOP.
 *
 * @author     Bastian Feder <bastian.feder@liip.ch>
 * @license    http://www.opensource.org/licenses/mit-license.php The MIT License
 * @copyright  Copyright (c) 2012 Liip Inc.
 *
 * @package    DrupalConnector
 * @subpackage Path
 */

namespace Liip\Drupal\Modules\DrupalConnector;

/**
 * Functions to handle paths in Drupal, including path aliasing.
 *
 * These public functions are not loaded for cached pages, but modules that need
 * to use them in hook_boot() or hook exit() can make them available, by
 * executing "drupal_bootstrap(DRUPAL_BOOTSTRAP_FULL);".
 */

class Path
{
    /**
     * Return the current URL path of the page being viewed.
     *
     * Examples:
     * - http://example.com/node/306 returns "node/306".
     * - http://example.com/drupalfolder/node/306 returns "node/306" while
     *   base_path() returns "/drupalfolder/".
     * - http://example.com/path/alias (which is a path alias for node/306) returns
     *   "node/306" as opposed to the path alias.
     *
     * This public function is not available in hook_boot() so use $_GET['q'] instead.
     * However, be careful when doing that because in the case of Example #3
     * $_GET['q'] will contain "path/alias". If "node/306" is needed, calling
     * drupal_bootstrap(DRUPAL_BOOTSTRAP_FULL) makes this public function available.
     *
     * @return
     *   The current Drupal URL path.
     *
     * @see request_path()
     */
    public function current_path()
    {
        return current_path();
    }

    /**
     * Determines whether a path is in the administrative section of the site.
     *
     * By default, paths are considered to be non-administrative. If a path does
     * not match any of the patterns in path_get_admin_paths(), or if it matches
     * both administrative and non-administrative patterns, it is considered
     * non-administrative.
     *
     * @param string $path
     *   A Drupal path.
     *
     * @return bool TRUE if the path is administrative, false otherwise.@see path_get_admin_paths()
     * @see hook_admin_paths()
     * @see hook_admin_paths_alter()
     */
    public function path_is_admin($path)
    {
        return path_is_admin($path);
    }

    /**
     * Gets a list of administrative and non-administrative paths.
     *
     * @return array
     *   An associative array containing the following keys:
     *   'admin': An array of administrative paths and regular expressions
     *            in a format suitable for drupal_match_path().
     *   'non_admin': An array of non-administrative paths and regular expressions.
     *
     * @see hook_admin_paths()
     * @see hook_admin_paths_alter()
     */
    public function path_get_admin_paths()
    {
        return path_get_admin_paths();
    }

    /**
     * Checks a path exists and the current user has access to it.
     *
     * @param string $path
     *   The path to check.
     * @param bool $dynamic_allowed
     *   Whether paths with menu wildcards (like user/%) should be allowed.
     *
     * @return bool TRUE if it is a valid path AND the current user has access permission,
     */
    public function drupal_valid_path($path, $dynamic_allowed = false)
    {
        return drupal_valid_path($path, $dynamic_allowed);
    }

}
