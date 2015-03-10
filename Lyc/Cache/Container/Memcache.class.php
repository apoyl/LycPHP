<?php
    /*  Copyright (C) 2014-2015 apoyl.com. All Rights Reserved.
    /*  Author:凹凸曼
    /*  Email: jar-c@163.com 
    /*  Memcache缓存 Lyc\Cache\Container\Memcache.class.php
    */
namespace Lyc\Cache\Container;
use Lyc\Cache\CacheInterface;
use Lyc\Cache\CacheException;
class Memcache implements CacheInterface{
	private $ttl=0;
	private $cache=null;
	const COMP=MEMCACHE_COMPRESSED;
	public function __construct($arr){
		if(version_compare('3.0.0',phpversion('memcache'))>0){
			throw new CacheException('CACHE ERROR:ext/memcache version >=3.0.0 ');
		}
		$host='127.0.0.1';
		$port=11211;
		if(isset($arr['ttl']))
			$this->ttl=$arr['ttl'];
		if(isset($arr['host']))
			$host=$arr['host'];
		if(isset($arr['port']))
			$port=$arr['port'];
		
		if(!$this->cache=@memcache_connect($host,$port,$this->ttl))
			throw new CacheException('CACHE ERROR:Server memcached can not connect to '.$host.':'.$port);
		
	}
 	//判断是否存在缓存
	public function hasItem($key){
		if($this->getItem($key)) return true;
		return false;
	}
  	//设置并覆盖原缓存
	public function setItem($key,$value){
		if(empty($key))
			throw new CacheException('CACHE ERROR:key is empty');
		return memcache_set($this->cache,$key,$value,self::COMP,$this->ttl);
	}
	//获取缓存
	public function getItem($key){
		if(empty($key))
			throw new CacheException('CACHE ERROR:key is empty');
		return memcache_get($this->cache,$key,self::COMP);
	}
	//删除缓存
	public function delItem($key){
		if(empty($key))
			throw new CacheException('CACHE ERROR:key is empty');
		return memcache_delete($this->cache,$key);
	}
	//清除缓存
	public function clearItems(){
		return memcache_flush($this->cache);
	}
  
} 
?>
