<?php
    /*  Copyright (C) 2014-2015 apoyl.com. All Rights Reserved.
    /*  Author:凹凸曼
    /*  Email: jar-c@163.com 
    /*  缓存工厂 Lyc\Cache\CacheFactory.class.php
    */
namespace Lyc\Cache;
use Lyc\Cache\Container\Apc;
use Lyc\Cache\Container\Memcache;
class CacheFactory{
	static public  function create($op='',$arr=array()){
		$obj=null;
		switch(strtolower($op)){
			case 'apc':$obj=new Apc($arr); break;
			case 'memcache':$obj=new Memcache($arr);break;
			
		}
		return $obj;
	}
} 
?>
