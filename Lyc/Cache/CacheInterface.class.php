<?php
    /*  Copyright (C) 2014-2015 apoyl.com. All Rights Reserved.
    /*  Author:凹凸曼
    /*  Email: jar-c@163.com 
    /*  缓存接口 Lyc\Cache\CacheInterface.class.php
    */
namespace Lyc\Cache;

Interface CacheInterface{ 
	//判断是否存在缓存
	public function hasItem($key);
  	//设置并覆盖原缓存
	public function setItem($key,$value);
	//获取缓存
	public function getItem($key);
	//删除缓存
	public function delItem($key);
	//清除缓存
	public function clearItems();
} 
?>
