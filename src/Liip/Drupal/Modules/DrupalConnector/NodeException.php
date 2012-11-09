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
 * Exception class to gather error messages and codes.
 *
 */
class NodeException extends \Exception
{
    const FailedToSaveNode = 1;
    const FailedToSaveNodeText = 'Unable to save node (%s)!';
}
