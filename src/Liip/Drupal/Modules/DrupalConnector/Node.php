<?php

/**
 * Abstraction of the procedural Drupal world into OOP.
 *
 * @author     Bastian Feder <drupal@bastian-feder.de>
 * @license    http://www.opensource.org/licenses/mit-license.php The MIT License
 * @copyright  Copyright (c) 2012 liip ag
 *
 * @package DrupalConnector
 * @subpackage Node
 */

namespace Liip\Drupal\Modules\DrupalConnector;

/**
 * Cumulates the node functions of Drupal 7 in one class.
 */
class Node
{
    /**
     * Determine whether the current user may perform the given operation on the
     * specified node.
     *
     * @param $op
     *   The operation to be performed on the node. Possible values are:
     *   - "view"
     *   - "update"
     *   - "delete"
     *   - "create"
     * @param $node
     *   The node object on which the operation is to be performed, or node type
     *   (e.g. 'forum') for "create" operation.
     * @param $account
     *   Optional, a user object representing the user for whom the operation is to
     *   be performed. Determines access for a user other than the current user.
     * @return
     *   TRUE if the operation may be performed, FALSE otherwise.
     *
     * @link http://api.drupal.org/api/drupal/modules!node!node.module/function/node_access/7
     */
    public function node_access($op, $node, $account = NULL) {
        return node_access($op, $node, $account);
    }

    /**
     * Delete a node.
     *
     * @param $nid
     *   A node ID.
     *
     * @link http://api.drupal.org/api/drupal/modules!node!node.module/function/node_delete/7
     */
    public function node_delete($nid) {
        return node_delete($nid);
    }

    /**
     * Load a node object from the database.
     *
     * @param $nid
     *   The node ID.
     * @param $vid
     *   The revision ID.
     * @param $reset
     *   Whether to reset the node_load_multiple cache.
     *
     * @return
     *   A fully-populated node object, or FALSE if the node is not found.
     *
     * @link http://api.drupal.org/api/drupal/modules!node!node.module/function/node_load/7
     */
    public function node_load($param = array(), $revision = NULL, $reset = NULL) {
        $node = node_load($param, $revision, $reset);
        return $node;
    }

    /**
     * Save changes to a node or add a new node.
     *
     * @param $node
     *   The $node object to be saved. If $node->nid is
     *   omitted (or $node->is_new is TRUE), a new node will be added.
     *
     * @link http://api.drupal.org/api/drupal/modules!node!node.module/function/node_save/7
     */
    public function node_save(&$node) {
        return node_save($node);
    }

    /**
     * Generate an array for rendering the given node.
     *
     * @param $node
     *   A node object.
     * @param $view_mode
     *   View mode, e.g. 'full', 'teaser'...
     * @param $langcode
     *   (optional) A language code to use for rendering. Defaults to the global
     *   content language of the current request.
     *
     * @return
     *   An array as expected by drupal_render().
     *
     * @link http://api.drupal.org/api/drupal/modules!node!node.module/function/node_view/7
     */
    public function node_view($node, $teaser = FALSE, $page = FALSE, $links = TRUE) {
        return node_view($node, $teaser, $page, $links);
    }
}
