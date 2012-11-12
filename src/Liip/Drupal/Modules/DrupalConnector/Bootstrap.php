<?php
/**
 * Abstraction of the procedural Drupal world into OOP.
 *
 * @author     Bastian Feder <drupal@bastian-feder.de>
 * @license    http://www.opensource.org/licenses/mit-license.php The MIT License
 * @copyright  Copyright (c) 2012 liip ag
 *
 * @package    DrupalConnector
 * @subpackage Module
 */

namespace Liip\Drupal\Modules\DrupalConnector;

class Bootstrap
{
    /**
     * Generates a default anonymous $user object.
     *
     * @return Object - the user object.
     */
    public function drupal_anonymous_user() {
        return drupal_anonymous_user();
    }

    /**
     * Ensures Drupal is bootstrapped to the specified phase.
     *
     * The bootstrap phase is an integer constant identifying a phase of Drupal
     * to load. Each phase adds to the previous one, so invoking a later phase
     * automatically runs the earlier phases as well. To access the Drupal
     * database from a script without loading anything else, include bootstrap.inc
     * and call drupal_bootstrap(DRUPAL_BOOTSTRAP_DATABASE).
     *
     * @param $phase
     *   A constant. Allowed values are the DRUPAL_BOOTSTRAP_* constants.
     * @param $new_phase
     *   A boolean, set to FALSE if calling drupal_bootstrap from inside a
     *   function called from drupal_bootstrap (recursion).
     *
     * @return
     *   The most recently completed phase.
     */
    public function drupal_bootstrap($phase = NULL, $new_phase = TRUE)
    {
        drupal_bootstrap($phase, $new_phase);
    }

}
