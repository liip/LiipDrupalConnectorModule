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
     * Access callback: Checks a user's permission for performing a node operation.
     *
     * @param $op
     *   The operation to be performed on the node. Possible values are:
     *   - "view"
     *   - "update"
     *   - "delete"
     *   - "create"
     * @param Drupal\Core\Entity\EntityInterface|string|stdClass $node
     *   The node entity on which the operation is to be performed, or the node type
     *   object, or node type string (e.g., 'forum') for the 'create' operation.
     * @param $account
     *   (optional) A user object representing the user for whom the operation is to
     *   be performed. Determines access for a user other than the current user.
     *   Defaults to NULL.
     * @param $langcode
     *   (optional) Language code for the variant of the node. Different language
     *   variants might have different permissions associated. If NULL, the
     *   original langcode of the node is used. Defaults to NULL.
     *
     * @return
     *   TRUE if the operation may be performed, FALSE otherwise.
     *
     * @see node_menu()
     */
    public function node_access($op, $node, $account = NULL, $langcode = NULL)
    {
        return node_access($op, $node, $account);
    }

    /**
     * Loads a node entity from the database.
     *
     * @param int $nid
     *   The node ID.
     * @param bool $reset
     *   (optional) Whether to reset the node_load_multiple() cache. Defaults to
     *   FALSE.
     *
     * @return Drupal\node\Node|false
     *   A fully-populated node entity, or FALSE if the node is not found.
     */
    public function node_load($nid = NULL, $reset = FALSE)
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
     * Generates an array for rendering the given node.
     *
     * @param \Drupal\Core\Entity\EntityInterface $node
     *   A node entity.
     * @param $view_mode
     *   (optional) View mode, e.g., 'full', 'teaser'... Defaults to 'full.'
     * @param $langcode
     *   (optional) A language code to use for rendering. Defaults to NULL which is
     *   the global content language of the current request.
     *
     * @return
     *   An array as expected by drupal_render().
     */
    function node_view(EntityInterface $node, $view_mode = 'full', $langcode = NULL)
    {
        return node_view($node, $view_mode, $langcode);
    }
}
