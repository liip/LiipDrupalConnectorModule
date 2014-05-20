<?php

/**
 * Abstraction of the procedural Drupal world into OOP.
 *
 * @author     Matteo De Micheli <matteo.de.micheli@liip.ch>
 * @license    http://www.opensource.org/licenses/mit-license.php The MIT License
 * @copyright  Copyright (c) 2012-2013 Liip ag
 *
 * @package    DrupalConnector
 * @subpackage Session
 */

namespace Liip\Drupal\Modules\DrupalConnector;


class Session
{
  /**
   * Determines whether to save session data of the current request.
   *
   * This function allows the caller to temporarily disable writing of
   * session data, should the request end while performing potentially
   * dangerous operations, such as manipulating the global $user object.
   * See http://drupal.org/node/218104 for usage.
   *
   * @param $status
   *   Disables writing of session data when FALSE, (re-)enables
   *   writing when TRUE.
   *
   * @return
   *   FALSE if writing session data has been disabled. Otherwise, TRUE.
   */
  function drupal_save_session($status = NULL) {
      return drupal_save_session($status);
  }
}
