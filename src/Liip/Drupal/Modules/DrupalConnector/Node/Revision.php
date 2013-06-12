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

namespace Liip\Drupal\Modules\DrupalConnector\Node;

/**
 * Cumulates the node revison functions of Drupal 7 in one class.
 *
 * Please order the functions alphabetically!
 */
class Revision
{
    /**
     * Delete a node revision.
     *
     * @param $revision_id The revision ID to delete.
     *
     * @return boolean
     */
    public function node_revision_delete($revision_id)
    {
        return node_revision_delete($revision_id);
    }

    /**
     * Return a list of all the existing revision numbers.
     *
     * @param \stdClass $node
     * @return \stdClass[] List of every revision of the given node.
     */
    public function node_revision_list(\stdClass $node)
    {
        return node_revision_list($node);
    }
}
