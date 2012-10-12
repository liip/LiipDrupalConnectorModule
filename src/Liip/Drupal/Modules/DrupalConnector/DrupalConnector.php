<?php
/**
 * Abstraction of the procedural Drupal world into OOP.
 *
 * @author     Bastian Feder <drupal@bastian-feder.de>
 * @author     Daniel Barsotti <daniel.barsotti@liip.ch>
 * @author     The Migipedia Team Members
 * @license    http://www.opensource.org/licenses/mit-license.php The MIT License
 * @copyright  Copyright (c) 2012 liip ag
 *
 * @package DrupalConnector
 */


namespace Liip\Drupal\Modules\DrupalConnector;

/**
 * This class was originally written by the Migipedia team at Liip.
 *
 * It simply wraps the Drupal functions into a class to facilitate the mocking
 * of Drupal during testing.
 *
 * Please order the functions alphabetically!
 */
class DrupalConnector
{

    public function arg($index = NULL, $path = NULL) {
        return arg($index, $path);
    }

    public function base_url() {
        global $base_url;
        return $base_url;
    }

    public function current_user() {
        global $user;
        return $user;
    }

    public function drupal_access_denied() {
        drupal_access_denied();
    }

    public function drupal_add_css($path = NULL, $type = 'module', $media = 'all', $preprocess = TRUE) {
        return drupal_add_css($path, $type, $media, $preprocess);
    }

    public function drupal_add_js($data = NULL, $type = 'module', $scope = 'header', $defer = FALSE, $cache = TRUE, $preprocess = TRUE) {
        return drupal_add_js($data, $type, $scope, $defer, $cache, $preprocess);
    }

    public function drupal_anonymous_user() {
        return drupal_anonymous_user();
    }

    public function drupal_bootstrap($phase = NULL, $new_phase = TRUE) {
        drupal_bootstrap($phase, $new_phase);
    }

    public function drupal_execute($form_id, &$form_state) {
        return drupal_execute($form_id, $form_state);
    }

    public function drupal_get_breadcrumb() {
        return drupal_get_breadcrumb();
    }

    public function drupal_get_form() {
        $args = func_get_args();
        return call_user_func_array('drupal_get_form', $args);
    }

    public function drupal_get_path($type, $name) {
        return drupal_get_path($type, $name);
    }

    public function drupal_get_path_alias($path, $path_language = '') {
        return drupal_get_path_alias($path, $path_language);
    }

    public function drupal_get_private_key() {
        return drupal_get_private_key();
    }

    public function drupal_goto($path = '', $query = NULL, $fragment = NULL, $http_response_code = 302) {
        drupal_goto($path, $query, $fragment, $http_response_code);
    }

    public function drupal_not_found() {
        return drupal_not_found();
    }

    public function drupal_set_breadcrumb($breadcrumb) {
        return drupal_set_breadcrumb($breadcrumb);
    }

    public function drupal_set_message($message = NULL, $type = 'status', $repeat = TRUE) {
        return drupal_set_message($message, $type, $repeat);
    }

    public function &drupal_static($name, $default_value = NULL, $reset = FALSE) {
        $static = &drupal_static($name, $default_value, $reset);
        return $static;
    }

    public function drupal_unpack($obj, $field = 'data') {
        return drupal_unpack($obj, $field);
    }

    public function field_file_load($fid, $reset = NULL) {
        return field_file_load($fid, $reset);
    }

    public function filter_default_format($account = NULL) {
        return filter_default_format($account);
    }

    public function format_date($timestamp, $type = 'medium', $format = '', $timezone = NULL, $langcode = NULL) {
        format_date($timestamp, $type, $format, $timezone, $langcode);
    }

    public function imagecache_create_url($preset_name, $image_path) {
        return imagecache_create_url($preset_name, $image_path);
    }

    public function ip_address() {
        return ip_address();
    }

    public function menu_execute_active_handler($path = NULL) {
        return menu_execute_active_handler($path);
    }

    public function menu_set_active_item($path) {
        return menu_set_active_item($path);
    }

    public function pager_query($query, $limit = 10, $element = 0, $count_query = NULL) {
        $args = func_get_args();
        return call_user_func_array('pager_query', $args);
    }

    public function product_taxonomy_get_term_by_description($desc, $vid = 0) {
        return product_taxonomy_get_term_by_description($desc, $vid);
    }

    public function registry_rebuild() {
        registry_rebuild();
    }

    public function session_id() {
        return session_id();
    }

    public function taxonomy_get_term($tid, $reset = FALSE) {
        return taxonomy_get_term($tid, $reset);
    }

    public function theme() {
        $args = func_get_args();
        return call_user_func_array('theme', $args);
    }

    public function theme_pager($tags = array(), $limit = 10, $element = 0, $parameters = array(), $quantity = 9) {
        return theme_pager($tags, $limit, $element, $parameters, $quantity);
    }
}
