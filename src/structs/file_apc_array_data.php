<?php
/**
 * File containing the ezcCacheStorageFileApcArrayDataStruct class.
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
 * Defines a file array APC Storage structure.
 *
 * @package Cache
 * @version //autogentag//
 */
class ezcCacheStorageFileApcArrayDataStruct extends ezcBaseStruct
{
    /**
     * Holds the time the data was introduced in the cache.
     *
     * @var int
     */
    public $time;

    /**
     * Constructs a new ezcCacheStorageFileApcArrayDataStruct.
     *
     * @param string $location
     * @param int|bool $mtime
     * @param int|bool $atime
     */
    public function __construct( /**
     * Holds the actual data.
     *
     */
    public mixed $data, /**
     * Holds the location of the cache.
     *
     */
    public $location, /**
     * Holds the modified time of the file.
     *
     */
    public $mtime = false, /**
     * Holds the accessed time of the file.
     *
     */
    public $atime = false )
    {
        $this->time = time();
    }
}
?>
