<?php

/**
 * Abstraction of the procedural Drupal world into OOP.
 *
 * @author     Bastian Feder <drupal@bastian-feder.de>
 * @license    http://www.opensource.org/licenses/mit-license.php The MIT License
 * @copyright  Copyright (c) 2012-2013 liip ag
 *
 * @package    DrupalConnector
 * @subpackage Form
 */

namespace Liip\Drupal\Modules\DrupalConnector;


class Form
{
    /**
     * Returns a renderable form array for a given form ID.
     *
     * This function should be used instead of drupal_build_form() when $form_state
     * is not needed (i.e., when initially rendering the form) and is often
     * used as a menu callback.
     *
     * @param $form_id
     *   The unique string identifying the desired form. If a function with that
     *   name exists, it is called to build the form array. Modules that need to
     *   generate the same form (or very similar forms) using different $form_ids
     *   can implement hook_forms(), which maps different $form_id values to the
     *   proper form constructor function. Examples may be found in node_forms(),
     *   and search_forms().
     * @param ...
     *   Any additional arguments are passed on to the functions called by
     *   drupal_get_form(), including the unique form constructor function. For
     *   example, the node_edit form requires that a node object is passed in here
     *   when it is called. These are available to implementations of
     *   hook_form_alter() and hook_form_FORM_ID_alter() as the array
     *   $form_state['build_info']['args'].
     *
     * @return
     *   The form array.
     *
     * @see drupal_build_form()
     */
    public function drupal_get_form($form_id)
    {
        return drupal_get_form($form_id);
    }
}
