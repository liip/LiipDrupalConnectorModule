<?php

/**
 * Abstraction of the procedural Drupal world into OOP.
 *
 * @author     Bastian Feder <drupal@bastian-feder.de>
 * @license    http://www.opensource.org/licenses/mit-license.php The MIT License
 * @copyright  Copyright (c) 2012 liip ag
 *
 * @package    DrupalConnector
 * @subpackage Node
 */

namespace Liip\Drupal\Modules\DrupalConnector;

/**
 * Cumulates the node functions of Drupal 7 in one class.
 *
 * Please order the functions alphabetically!
 */
class Node
{
    /**
     * Determine whether the current user may perform the given operation on the
     * specified node.
     *
     * @param string    $op      The operation to be performed on the node. Possible values are:
     *                            - "view"
     *                            - "update"
     *                            - "delete"
     *                            - "create"
     * @param \stdClass $node    The node object on which the operation is to be performed,
     *                            or node type (e.g. 'forum') for "create" operation.
     * @param \stdClass $account Optional, a user object representing the user for whom the operation is to be
     *                            performed. Determines access for a user other than the current user.
     *
     * @return boolean TRUE if the operation may be performed, FALSE otherwise.
     *
     * @link http://api.drupal.org/api/drupal/modules!node!node.module/function/node_access/7
     */
    public function node_access($op, $node, $account = null)
    {
        return node_access($op, $node, $account);
    }

    /**
     * Delete a node.
     *
     * @param integer $nid A node ID.
     *
     * @link http://api.drupal.org/api/drupal/modules!node!node.module/function/node_delete/7
     */
    public function node_delete($nid)
    {
        node_delete($nid);
    }

    /**
     * Retrieves the timestamp at which the current user last viewed the
     * specified node.
     *
     * @param integer $nid The node ID.
     *
     * @return \stdClass
     *
     * @link http://api.drupal.org/api/drupal/modules!node!node.module/function/node_last_viewed/7
     */
    public function node_last_viewed($nid)
    {
        return node_last_viewed($nid);
    }

    /**
     * Load a node object from the database.
     *
     * @param integer $nid   The node ID.
     * @param integer $vid   The revision ID.
     * @param boolean $reset Whether to reset the node_load_multiple cache.
     *
     * @return \stdClass|false A fully-populated node object, or FALSE if the node is not found.
     *
     * @link http://api.drupal.org/api/drupal/modules!node!node.module/function/node_load/7
     */
    public function node_load($nid = null, $vid = null, $reset = false)
    {
        return node_load($nid, $vid, $reset);
    }

    /**
     * Decide on the type of marker to be displayed for a given node.
     *
     * @param integer $nid       Node ID whose history supplies the "last viewed" timestamp.
     * @param integer $timestamp Time which is compared against node's "last viewed" timestamp.
     *
     * @return integer One of the MARK constants.
     *
     * @link http://api.drupal.org/api/drupal/modules!node!node.module/function/node_mark/7
     */
    public function node_mark($nid, $timestamp)
    {
        return node_mark($nid, $timestamp);
    }

    /**
     * Save changes to a node or add a new node.
     *
     * @param \stdClass &$node The $node object to be saved. If $node->nid is omitted (or $node->is_new is TRUE), a new node will be added.
     *
     * @throws \Liip\Drupal\Modules\DrupalConnector\NodeException in case the node could not be persisted.
     *
     * @link http://api.drupal.org/api/drupal/modules!node!node.module/function/node_save/7
     */
    public function node_save(&$node)
    {
        try {
            node_save($node);
        } catch (\Exception $e) {
            throw new NodeException(
                sprintf(NodeException::FailedToSaveNodeText, $node->nid),
                NodeException::FailedToSaveNode
            );
        }
    }

    /**
     * Update the 'last viewed' timestamp of the specified node for current user.
     *
     * @param \stdClass $node A node object.
     *
     * @link http://api.drupal.org/api/drupal/modules!node!node.module/function/node_tag_new/7
     */
    public function node_tag_new($node)
    {
        node_tag_new($node);
    }

    /**
     * Gathers a listing of links to nodes.
     *
     * @param object $result A database result object from a query to fetch node entities. If your query joins the
     *                       {node_comment_statistics} table so that the comment_count field is available,
     *                       a title attribute will be added to show the number of comments.
     * @param string $title  A heading for the resulting list.
     *
     * @return array A renderable array containing a list of linked node titles fetched from $result,
     *                or FALSE if there are no rows in $result.
     *
     * @link          http://api.drupal.org/api/drupal/modules!node!node.module/function/node_title_list/7
     */
    public function node_title_list($result, $title = null)
    {
        return node_title_list($result, $title);
    }

    /**
     * Generate an array for rendering the given node.
     *
     * @param \stdClass $node     A node object.
     * @param string    $viewMode View mode, e.g. 'full', 'teaser'...
     * @param string    $langCode (optional) A language code to use for rendering. Defaults to the global content
     *                            language of the current request.
     *
     * @return array An array as expected by drupal_render().
     *
     * @link http://api.drupal.org/api/drupal/modules!node!node.module/function/node_view/7
     */
    public function node_view($node, $viewMode = 'full', $langCode = null)
    {
        return node_view($node, $viewMode, $langCode);
    }
}
