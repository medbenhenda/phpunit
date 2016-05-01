<?php
/**
 * Created by PhpStorm.
 * User: m.benhenda(benhenda.med@gmail.com)
 * Date: 30/04/2016
 * Time: 15:20
 */

namespace Med\Demo;


Interface CacheAdapterInterface
{
    public function get($key);

    public function set($key, $value);
}