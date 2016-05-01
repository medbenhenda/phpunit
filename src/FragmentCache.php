<?php
/**
 * Created by PhpStorm.
 * User: m.benhenda(benhenda.med@gmail.com)
 * Date: 30/04/2016
 * Time: 14:52
 */

namespace Med\Demo;


class FragmentCache
{
    private $cache;

    public function __construct(CacheAdapterInterface $cache)
    {
        $this->cache = $cache;
    }

    public function cache($key, Callable $callback)
    {
        if (is_bool($key)) {
            throw new \Exception('The param given is a boolean.');
        }
        $key = $this->hashKey($key);
        $value = $this->cache->get($key);
        if (!$value) {
            ob_start();
            $callback ();
            $value = ob_get_clean();
            $this->cache->set($key, $value);
        }
        echo $value;
    }

    private function hashKey($key)
    {
        if (is_array($key)) {
            return implode('_', $key);
        } else {
            return $key;
        }
    }
}