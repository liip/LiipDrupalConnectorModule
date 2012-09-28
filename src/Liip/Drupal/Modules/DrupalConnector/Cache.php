<?php
/**
 * Abstraction of the procedural Drupal world into OOP.
 *
 * @author     Bastian Feder <drupal@bastian-feder.de>
 * @license    http://www.opensource.org/licenses/mit-license.php The MIT License
 * @copyright  Copyright (c) 2012 liip ag
 *
 * @package DrupalConnector
 * @subpackage Cache
 */

namespace Liip\Drupal\Modules\DrupalConnector\Cache;

/**
 * Cumulates the caching functions of Drupal 7 in one class.
 */
class Cache
{
    /**
     * Provides the value of the cache identified by it's key.
     *
     * @param string $key Identifier of the cached data
     * @param string $bin [Optional] Name of the container the data shall be retrieved from.
     *
     * @return mixed
     */
    public function cache_get($key, $bin = 'cache')
    {
        return cache_get($key, $table);
    }

    /**
     * Returns data from the persistent cache when given an array of cache IDs.
     *
     * @param array  &$cids An array of cache IDs for the data to retrieve.
     * @param string $bin   The cache bin where the data is stored.
     *
     * @return An array of the items successfully returned from cache indexed by cid.
     */
     public function cache_get_multiple(array &$cids, $bin = 'cache')
     {
         return cache_get_multiple($cids, $bin);
     }

    /**
     * Persists the given data in to the cache.
     *
     * @param string       $cid    The cache ID of the data to store.
     * @param array|string $data   The data to store in the cache. Complex data types will be automatically
     *                              serialized before insertion.
     * @param string       $bin    [Optional] Name of the container the data shall be stored in.
     * @param integer      $expire [Optional] Defines how long the data shall be stored.
     *
     * @return mixed
     */
    public function cache_set($cid, $data, $bin = 'cache', $expire = CACHE_PERMANENT)
    {
        return cache_set($cid, $data, $bin, $expire);
    }

    /**
     * Expires data from the cache.
     *
     * @param null $cid      [Optional] Identifier of the data to be deleted.
     * @param null $bin      [Optional] Name of the container the data shall be stored in.
     * @param bool $wildcard [Optional] If »true«, every data identified by a key starting with the declared $cid
     *                        will be deleted
     *
     * @return mixed
     */
    public function cache_clear_all($cid = null, $bin = null, $wildcard = false)
    {
        return cache_clear_all($cid, $bin, $wildcard);
    }

    /**
     * Determines, if a cache container is empty.
     *
     * @param string $bin Name of the container check to be empty.
     *
     * @return »true«, if the cache bin specified is empty.
     */
    public function cache_is_empty($bin)
    {
        return cache_is_empty($bin);
    }
}
