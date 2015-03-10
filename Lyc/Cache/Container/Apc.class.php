<?php
    /*  Copyright (C) 2014-2015 apoyl.com. All Rights Reserved.
    /*  Author:凹凸曼
    /*  Email: jar-c@163.com 
    /*  Apc缓存 Lyc\Cache\Container\Apc.class.php
    */
namespace Lyc\Cache\Container;
use Lyc\Cache\CacheInterface;
use Lyc\Cache\CacheException;
class Apc implements CacheInterface{
	protected $ttl=0;
	public function __construct($arr=array()){
		if(!ini_get('apc.enabled'))
			throw new CacheException('CACHE ERROR:ext/Apc is disabled');
		if(version_compare('3.0.0',phpversion('apc'))>0)
			throw new CacheException('CACHE ERROR:ext/Apc version >=3.0.0');
			
		if(isset($arr['ttl']))
			$this->ttl=intval($arr['ttl']);
	}
 	//判断是否存在缓存
	public function hasItem($key){
		if(empty($key))
			throw new CacheException('CACHE ERROR:key is empty');
		if(apc_exists($key))
			return true;
		return false;
	}
  	//设置并覆盖原缓存
	public function setItem($key,$value){
		if(empty($key))
			throw new CacheException('CACHE ERROR:key is empty');
		return apc_store($key,$value,$this->ttl);
	}
	//获取缓存
	public function getItem($key){
		if(empty($key))
			throw new CacheException('CACHE ERROR:key is empty');
		return apc_fetch($key);
		
	}
	//删除缓存
	public function delItem($key){
		if(empty($key))
			throw new CacheException('CACHE ERROR:key is empty');
		return apc_delete($key);
	}
	//清除缓存
	public function clearItems(){
		return apc_clear_cache();
	}
  
} 
?>
