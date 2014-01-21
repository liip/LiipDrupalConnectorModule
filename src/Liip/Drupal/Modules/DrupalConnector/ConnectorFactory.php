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
     * @var Ajax
     */
    protected static $ajaxConnector;

    /**
     * @var Bootstrap
     */
    protected static $bootstrapConnector;

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
     * @var File
     */
    protected static $fileConnector;

    /**
     * @var Filter
     */
    protected static $filterConnector;

    /**
     * @var Form
     */
    protected static $formConnector;

    /**
     * @var Menu
     */
    protected static $menuConnector;

    /**
     * @var Module
     */
    protected static $moduleConnector;

    /**
     * @var Node
     */
    protected static $nodeConnector;

    /**
     * @var Path
     */
    protected static $pathConnector;

    /**
     * @var Revision
     */
    protected static $nodeRevisionConnector;

    /**
     * @var Theme
     */
    protected static $themeConnector;

    /**
     * @var User
     */
    protected static $userConnector;

    /**
     * Provides an instance of the Ajax object
     *
     * @static
     * @return File
     */
    public static function getAjaxConnector()
    {
        if (is_null(self::$ajaxConnector)) {
            self::$ajaxConnector = new Ajax();
        }

        return self::$ajaxConnector;
    }

    /**
     * Provides an instance of the Cache object
     *
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
     * Provides an instance of the Common object
     *
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
     * Provides an instance of the Database object
     *
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
     * Provides an instance of the Menu object
     *
     * @static
     * @return Menu
     */
    public static function getMenuConnector()
    {
        if (is_null(self::$menuConnector)) {
            self::$menuConnector = new Menu();
        }

        return self::$menuConnector;
    }

    /**
     * Provides an instance of the Module object
     *
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
     * Provides an instance of the Node object
     *
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
     * Provides an instance of the User object
     *
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
     * Provides an instance of the Bootstrap object
     *
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
     * Provides an instance of the Filter object
     *
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
     * Provides an instance of the Theme object
     *
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
     * Provides an instance of the Form object
     *
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
     * Provides an instance of the Revision object
     *
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

    /**
     * Provides an instance of the Path object
     *
     * @static
     * @return Path
     */
    public static function getPathConnector()
    {
        if (is_null(self::$pathConnector)) {
            self::$pathConnector = new Path();
        }

        return self::$pathConnector;
    }

    /**
     * Provides an instance of the File object
     *
     * @static
     * @return File
     */
    public static function getFileConnector()
    {
        if (is_null(self::$fileConnector)) {
            self::$fileConnector = new File();
        }

        return self::$fileConnector;
    }
}
