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
 * Factory to get connectors instances. Caches the instances.
 * @author Daniel Barsotti <daniel.barsotti@liip.ch>
 */
class ConnectorFactory
{
    /**
     * @var Cache
     */
    protected static $cacheConnector;

    /**
     * @var Common
     */
    protected static $commonConnector;

    /**
     * @var Database
     */
    protected static $databaseConnector;

    /**
     * @var Module
     */
    protected static $moduleConnector;

    /**
     * @var Node
     */
    protected static $nodeConnector;

    /**
     * @var User
     */
    protected static $userConnector;

    /**
     * @var Bootstrap
     */
    protected static $bootstrapConnector;

    /**
     * @var Filter
     */
    protected static $filterConnector;

    /**
     * @static
     * @return Cache
     */
    public static function getCacheConnector()
    {
        if (is_null(self::$cacheConnector)) {
            self::$cacheConnector = new Cache();
        }

        return self::$cacheConnector;
    }

    /**
     * @static
     * @return Common
     */
    public static function getCommonConnector()
    {
        if (is_null(self::$commonConnector)) {
            self::$commonConnector = new Common();
        }

        return self::$commonConnector;
    }

    /**
     * @static
     * @return Database
     */
    public static function getDatabaseConnector()
    {
        if (is_null(self::$databaseConnector)) {
            self::$databaseConnector = new Database();
        }

        return self::$databaseConnector;
    }

    /**
     * @static
     * @return Module
     */
    public static function getModuleConnector()
    {
        if (is_null(self::$moduleConnector)) {
            self::$moduleConnector = new Module();
        }

        return self::$moduleConnector;
    }

    /**
     * @static
     * @return Node
     */
    public static function getNodeConnector()
    {
        if (is_null(self::$nodeConnector)) {
            self::$nodeConnector = new Node();
        }

        return self::$nodeConnector;
    }

    /**
     * @static
     * @return User
     */
    public static function getUserConnector()
    {
        if (is_null(self::$userConnector)) {
            self::$userConnector = new User();
        }

        return self::$userConnector;
    }

    /**
     * @static
     * @return Bootstrap
     */
    public static function getBootstrapConnector()
    {
        if (is_null(self::$bootstrapConnector)) {
            self::$bootstrapConnector = new Bootstrap();
        }

        return self::$bootstrapConnector;
    }

    /**
     * @static
     * @return Filter
     */
    public static function getFilterConnector()
    {
        if (is_null(self::$filterConnector)) {
            self::$filterConnector = new Filter();
        }

        return self::$filterConnector;
    }
}
