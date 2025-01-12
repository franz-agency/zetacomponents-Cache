<?php
/**
 * File containing the ezcCacheStackReplacementStrategy interface.
 *
 * Licensed to the Apache Software Foundation (ASF) under one
 * or more contributor license agreements.  See the NOTICE file
 * distributed with this work for additional information
 * regarding copyright ownership.  The ASF licenses this file
 * to you under the Apache License, Version 2.0 (the
 * "License"); you may not use this file except in compliance
 * with the License.  You may obtain a copy of the License at
 * 
 *   http://www.apache.org/licenses/LICENSE-2.0
 * 
 * Unless required by applicable law or agreed to in writing,
 * software distributed under the License is distributed on an
 * "AS IS" BASIS, WITHOUT WARRANTIES OR CONDITIONS OF ANY
 * KIND, either express or implied.  See the License for the
 * specific language governing permissions and limitations
 * under the License.
 *
 * @package Cache
 * @version //autogentag//
 * @license http://www.apache.org/licenses/LICENSE-2.0 Apache License, Version 2.0
 * @filesource
 */

/**
 * Interface to be implemented by stack replacement strategies.
 *
 * This interface is to be implemented by replacement strategy classes, which
 * can be configured to be used by an {@link ezcCacheStack}. The defined
 * methods wrap around their counterparts on {@link ezcCacheStackableStorage}.
 *
 * A replacement strategy must take care about the actual
 * storing/restoring/deleting of cache items in the given storage. In addition
 * it must take care about keeping the needed {@link ezcCacheStackMetaData} up
 * to date and about purging data from the cache storage, if it runs full.
 *
 * A replacement strategy must define its own meta data class which implements
 * {@link ezcCacheStackMetaData}. It must check in each method call, that the
 * given $metaData is of correct type. If this is not the case, {@link
 * ezcCacheInvalidMetaDataException} must be throwen.
 * 
 * @package Cache
 * @version //autogentag//
 */
interface ezcCacheStackReplacementStrategy
{
    /**
     * Stores the given $itemData in the storage given in $conf.
     *
     * This method stores the given $itemData assigned to $itemId and
     * optionally $itemAttributes in the {@link ezcCacheStackableStorage} given
     * in $conf. In case the storage has reached the $itemLimit defined in
     * $conf, it must be freed according to $freeRate {@link
     * ezcCacheStackStorageConfiguration}.
     *
     * The freeing of items from the storage must first happen via {@link
     * ezcCacheStackableStorage::purge()}, which removes outdated items from
     * the storage and returns the affected IDs. In case this does not last to
     * free the desired number of items, the replacement strategy specific
     * algorithm for freeing takes effect.
     *
     * After the necessary freeing process has been performed, the item is
     * stored in the storage and the $metaData is updated accordingly.
     *
     * @param string $itemId
     * @param array(string=>string) $itemAttributes
     * @throws ezcCacheInvalidMetaDataException
     *         if the given $metaData is not processable by this replacement
     *         strategy.
     */
    public static function store(
        ezcCacheStackStorageConfiguration $conf,
        ezcCacheStackMetaData $metaData,
        $itemId,
        mixed $itemData,
        $itemAttributes = []
    );

    /**
     * Restores the data with the given $dataId from the storage given in $conf.
     *
     * This method takes care of restoring the item with ID $itemId and
     * optionally $itemAttributes from the {@link ezcCacheStackableStorage}
     * given in $conf. The parameters $itemId, $itemAttributes and $search are
     * forwarded to {@link ezcCacheStackableStorage::restore()}, the returned
     * value (item data on successful restore, otherwise false) are returned by
     * this method.
     *
     * The method must take care that the restore process is reflected in
     * $metaData according to the spcific replacement strategy implementation.
     *
     * @param string $itemId
     * @param array(string=>string) $itemAttributes
     * @param bool $search
     *
     * @return mixed Restored data or false.
     * @throws ezcCacheInvalidMetaDataException
     *         if the given $metaData is not processable by this replacement
     *         strategy.
     */
    public static function restore(
        ezcCacheStackStorageConfiguration $conf,
        ezcCacheStackMetaData $metaData,
        $itemId,
        $itemAttributes = [],
        $search = false
    );

    /**
     * Deletes the data with the given $itemId from the given $storage.
     *
     * This method takes care about deleting the item identified by $itemId and
     * optionally $itemAttributes from the {@link ezcCacheStackableStorage}
     * give in $conf. The parameters $itemId, $itemAttributes and $search are
     * therefore forwarded to {@link ezcCacheStackableStorage::delete()}. This
     * method returns a list of all item IDs that have been deleted by the
     * call. The method reflects these changes in $metaData.
     *
     * @param string $itemId
     * @param array(string=>string) $itemAttributes
     * @param bool $search
     *
     * @return array(string) Deleted item IDs.
     * @throws ezcCacheInvalidMetaDataException
     *         if the given $metaData is not processable by this replacement
     *         strategy.
     */
    public static function delete(
        ezcCacheStackStorageConfiguration $conf,
        ezcCacheStackMetaData $metaData,
        $itemId,
        $itemAttributes = [],
        $search = false
    );

    /**
     * Returns a fresh meta data object.
     *
     * Different replacement strategies will use different meta data classes.
     * This method must return a freshly created instance of the meta data
     * object used by this meta data.
     * 
     * @return ezcCacheStackMetaData
     */
    public static function createMetaData();
}

?>
