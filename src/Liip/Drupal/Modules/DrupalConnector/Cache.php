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

namespace Liip\Drupal\Modules\DrupalConnector;

/**
 * Cumulates the caching functions of Drupal 7 in one class.
 *
 * Please order the functions alphabetically!
 */
class Cache
{
    /**
     * Instantiates and statically caches the correct class for a cache bin.
     *
     * By default, this returns an instance of the Drupal\Core\Cache\DatabaseBackend
     * class.
     *
     * Classes implementing Drupal\Core\Cache\CacheBackendInterface can register
     * themselves both as a default implementation and for specific bins.
     *
     * @param $bin
     *   The cache bin for which the cache object should be returned, defaults to
     *   'cache'.
     *
     * @return Drupal\Core\Cache\CacheBackendInterface
     *   The cache object associated with the specified bin.
     *
     * @see Drupal\Core\Cache\CacheBackendInterface
     */
    function cache($bin = 'cache') {
        return cache($bin);
    }

    /**
     * Marks cache items from all bins with any of the specified tags as invalid.
     *
     * Many sites have more than one active cache backend, and each backend my use
     * a different strategy for storing tags against cache items, and invalidating
     * cache items associated with a given tag.
     *
     * When invalidating a given list of tags, we iterate over each cache backend,
     * and call invalidateTags() on each.
     *
     * @param array $tags
     *   The list of tags to invalidate cache items for.
     *
     * @deprecated 8.x
     *   Use \Drupal\Core\Cache\Cache::invalidateTags().
     */
    function cache_invalidate_tags(array $tags) {
        cache_invalidate_tags($tags);
    }
    
}
