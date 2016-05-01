<?php
/**
 * Created by PhpStorm.
 * User: m.benhenda(benhenda.med@gmail.com)
 * Date: 30/04/2016
 * Time: 14:52
 */

namespace Med\Demo\Test;


use Med\Demo\FakeCacheAdapter;
use Med\Demo\FragmentCache;

class FragmentCacheTest extends \PHPUnit_Framework_TestCase
{
    public function testConstructorWithoutInterface()
    {
        $this->expectException(\PHPUnit_Framework_Error::class);
        new FragmentCache(new \stdClass());
    }

    public function testConstructorWithInterface()
    {
        new FragmentCache(new FakeCacheAdapter());
    }

    public function testCacheWithCache()
    {
        $cacheAdapter = $this->getMockBuilder(FakeCacheAdapter::class)
            ->getMock();

        $cacheAdapter->method('get')->willReturn('en cache');

        $cache = new FragmentCache($cacheAdapter);
        $this->expectOutputString('en cache');
        $cache->cache('test', function(){echo 'salut';});
    }

    public function testCacheWithoutCache()
    {
        $cacheAdapter = $this->instanceMock();

        $cacheAdapter->method('get')->willReturn(false);

        $cache = new FragmentCache($cacheAdapter);
        $this->expectOutputString('salut');
        $cache->cache('test', function(){echo 'salut';});
    }

    public function testCacheWithoutCacheSetCache()
    {
        $cacheAdapter = $this->instanceMock();
        $cacheAdapter->expects(static::once())->method('set')->with('test', 'salut');

        $cache = new FragmentCache($cacheAdapter);
        $this->expectOutputString('salut');
        $cache->cache('test', function(){echo 'salut';});
    }

    public function testHashKey()
    {
        $cacheAdapter = $this->instanceMock();
        $cacheAdapter->expects(static::once())->method('get')->with('test');

        $cache = new FragmentCache($cacheAdapter);
        $cache->cache('test', function(){return false;});
    }
    public function testHashKeyArray()
    {
        $cacheAdapter = $this->instanceMock();
        $cacheAdapter
            ->expects(static::once())
            ->method('get')
            ->with('This_is_the_key');

        $cache = new FragmentCache($cacheAdapter);
        $cache->cache(['This', 'is', 'the', 'key'], function(){return false;});
    }

    public function testHashKeyWithBoolean()
    {
        $cacheAdapter = $this->instanceMock();
        $cache = new FragmentCache($cacheAdapter);
        $this->expectException('Exception');
        $cache->cache(true, function(){return false;});
    }

    public function testHashKeyArrayWithBoolean()
    {
        $cacheAdapter = $this->instanceMock();
        $cacheAdapter
            ->expects(static::once())
            ->method('get')
            ->with('This__the_key');

        $cache = new FragmentCache($cacheAdapter);
        $cache->cache(['This', false, 'the', 'key'], function(){return false;});
    }

    /**
     * Method description
     *
     * @return \PHPUnit_Framework_MockObject_MockObject
     */
    public function instanceMock()
    {
        $cacheAdapter = $this->getMockBuilder(FakeCacheAdapter::class)
            ->getMock();

        $cacheAdapter->method('get')->willReturn(false);

        return $cacheAdapter;
    }
}
