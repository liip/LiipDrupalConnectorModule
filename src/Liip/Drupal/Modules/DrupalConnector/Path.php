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
     * Initialize the $_GET['q'] variable to the proper normal path.
     */
    public function drupal_path_initialize()
    {
        drupal_path_initialize();
    }

    /**
     * Given an alias, return its Drupal system URL if one exists. Given a Drupal
     * system URL return one of its aliases if such a one exists. Otherwise,
     * return false.
     *
     * @param string $action
     *   One of the following values:
     *   - wipe: delete the alias cache.
     *   - alias: return an alias for a given Drupal system path (if one exists).
     *   - source: return the Drupal system URL for a path alias (if one exists).
     * @param string $path
     *   The path to investigate for corresponding aliases or system URLs.
     * @param string $path_language
     *   Optional language code to search the path with. Defaults to the page language.
     *   If there's no path defined for that language it will search paths without
     *   language.
     *
     * @return bool|mixed Either a Drupal system path, an aliased path, or false if no path was
     */
    public function drupal_lookup_path($action, $path = '', $path_language = null)
    {
        return drupal_lookup_path($action, $path, $path_language);
    }

    /**
     * Cache system paths for a page.
     *
     * Cache an array of the system paths available on each page. We assume
     * that aliases will be needed for the majority of these paths during
     * subsequent requests, and load them in a single query during
     * drupal_lookup_path().
     */
    public function drupal_cache_system_paths()
    {
        drupal_cache_system_paths();
    }

    /**
     * Given an internal Drupal path, return the alias set by the administrator.
     *
     * If no path is provided, the public function will return the alias of the current
     * page.
     *
     * @param $path
     *   An internal Drupal path.
     * @param $path_language
     *   An optional language code to look up the path in.
     *
     * @return
     *   An aliased path if one was found, or the original path if no alias was
     *   found.
     */
    public function drupal_get_path_alias($path = null, $path_language = null)
    {
        return drupal_get_path_alias($path, $path_language);
    }

    /**
     * Given a path alias, return the internal path it represents.
     *
     * @param string $path
     *   A Drupal path alias.
     * @param string $path_language
     *   An optional language code to look up the path in.
     *
     * @return bool|mixed The internal path represented by the alias, or the original alias if no
     */
    public function drupal_get_normal_path($path, $path_language = null)
    {
        return drupal_get_normal_path($path, $path_language);
    }

    /**
     * Check if the current page is the front page.
     *
     * @return bool Boolean value: TRUE if the current page is the front page; false if otherwise.
     */
    public function drupal_is_front_page()
    {
        return drupal_is_front_page();
    }

    /**
     * Check if a path matches any pattern in a set of patterns.
     *
     * @param string $path
     *   The path to match.
     * @param string $patterns
     *   String containing a set of patterns separated by \n, \r or \r\n.
     *
     * @return bool Boolean value: TRUE if the path matches a pattern, false otherwise.
     */
    public function drupal_match_path($path, $patterns)
    {
        return drupal_match_path($path, $patterns);
    }

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
     * Rebuild the path alias white list.
     *
     * @param string $source
     *   An optional system path for which an alias is being inserted.
     *
     * @return array|null An array containing a white list of path aliases.
     */
    public function drupal_path_alias_whitelist_rebuild($source = null)
    {
        return drupal_path_alias_whitelist_rebuild($source);
    }

    /**
     * Fetches a specific URL alias from the database.
     *
     * @param string|array|integer $conditions
     *   A string representing the source, a number representing the pid, or an
     *   array of query conditions.
     *
     * @return bool false if no alias was found or an associative array containing the
     */
    public function path_load($conditions)
    {
        return path_load($conditions);
    }

    /**
     * Save a path alias to the database.
     *
     * @param string $path
     *   An associative array containing the following keys:
     *   - source: The internal system path.
     *   - alias: The URL alias.
     *   - pid: (optional) Unique path alias identifier.
     *   - language: (optional) The language of the alias.
     */
    public function path_save(&$path)
    {
        path_save($path);
    }

    /**
     * Delete a URL alias.
     *
     * @param array|integer $criteria
     *   A number representing the pid or an array of criteria.
     */
    public function path_delete($criteria)
    {
        path_delete($criteria);
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

    /**
     * Clear the path cache.
     *
     * @param string $source
     *   An optional system path for which an alias is being changed.
     */
    public function drupal_clear_path_cache($source = null)
    {
        drupal_clear_path_cache($source);
    }
}
