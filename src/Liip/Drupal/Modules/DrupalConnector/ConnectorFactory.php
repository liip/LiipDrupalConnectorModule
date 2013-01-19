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

use Liip\Drupal\Modules\DrupalConnector\Node\Revision;

/**
 * Factory to get connectors instances. Caches the instances.
 * @author Daniel Barsotti <daniel.barsotti@liip.ch>
 * @author Bastian Feder <drupal@bastian-feder.de>
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
     * @var Revision
     */
    protected static $nodeRevisionConnector;

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
     * @var Theme
     */
    protected static $themeConnector;

    /**
     * @var Form
     */
    protected static $formConnector;

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

    /**
     * @static
     * @return Theme
     */
    public static function getThemeConnector()
    {
        if (is_null(self::$themeConnector)) {
            self::$themeConnector = new Theme();
        }

        return self::$themeConnector;
    }

    /**
     * @static
     * @return Form
     */
    public static function getFormConnector()
    {
        if (is_null(self::$formConnector)) {
            self::$formConnector = new Form();
        }

        return self::$formConnector;
    }

    /**
     * @static
     * @return Revision
     */
    public static function getNodeRevisionConnector()
    {
        if (is_null(self::$nodeRevisionConnector)) {
            self::$nodeRevisionConnector = new Revision();
        }

        return self::$nodeRevisionConnector;
    }
}
