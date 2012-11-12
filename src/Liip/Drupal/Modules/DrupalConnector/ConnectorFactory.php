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

/**
 * Factory to get connectors instances. Caches the instances.
 * @author Daniel Barsotti <daniel.barsotti@liip.ch>
 */
class ConnectorFactory
{
    /**
     * @var \Liip\Drupal\Modules\DrupalConnector\Cache
     */
    protected static $cacheConnector;

    /**
     * @var \Liip\Drupal\Modules\DrupalConnector\Common
     */
    protected static $commonConnector;

    /**
     * @var \Liip\Drupal\Modules\DrupalConnector\Database
     */
    protected static $databaseConnector;

    /**
     * @var \Liip\Drupal\Modules\DrupalConnector\Module
     */
    protected static $moduleConnector;

    /**
     * @var \Liip\Drupal\Modules\DrupalConnector\Node
     */
    protected static $nodeConnector;

    /**
     * @var \Liip\Drupal\Modules\DrupalConnector\User
     */
    protected static $userConnector;

    /**
     * @static
     * @return \Liip\Drupal\Modules\DrupalConnector\Cache
     */
    public static function getCacheConnector()
    {
        if (is_null(self::$cacheConnector)) {
            self::$cacheConnector = new \Liip\Drupal\Modules\DrupalConnector\Cache();
        }

        return self::$cacheConnector;
    }

    /**
     * @static
     * @return \Liip\Drupal\Modules\DrupalConnector\Common
     */
    public static function getCommonConnector()
    {
        if (is_null(self::$commonConnector)) {
            self::$commonConnector = new \Liip\Drupal\Modules\DrupalConnector\Common();
        }

        return self::$commonConnector;
    }

    /**
     * @static
     * @return \Liip\Drupal\Modules\DrupalConnector\Database
     */
    public static function getDatabaseConnector()
    {
        if (is_null(self::$databaseConnector)) {
            self::$databaseConnector = new \Liip\Drupal\Modules\DrupalConnector\Database();
        }

        return self::$databaseConnector;
    }

    /**
     * @static
     * @return \Liip\Drupal\Modules\DrupalConnector\Module
     */
    public static function getModuleConnector()
    {
        if (is_null(self::$moduleConnector)) {
            self::$moduleConnector = new \Liip\Drupal\Modules\DrupalConnector\Module();
        }

        return self::$moduleConnector;
    }

    /**
     * @static
     * @return \Liip\Drupal\Modules\DrupalConnector\Node
     */
    public static function getNodeConnector()
    {
        if (is_null(self::$nodeConnector)) {
            self::$nodeConnector = new \Liip\Drupal\Modules\DrupalConnector\Node();
        }

        return self::$nodeConnector;
    }

    /**
     * @static
     * @return \Liip\Drupal\Modules\DrupalConnector\User
     */
    public static function getUserConnector()
    {
        if (is_null(self::$userConnector)) {
            self::$userConnector = new \Liip\Drupal\Modules\DrupalConnector\User();
        }

        return self::$userConnector;
    }
}
