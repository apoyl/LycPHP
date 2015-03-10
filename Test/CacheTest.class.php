<?php
    /*  Copyright (C) 2014 apoyl.com. All Rights Reversed.
    /*  Author:凹凸曼
    /*  Email: jar-c@163.com  
    /*  缓存测试类 Test\CacheTest.class.php
    */ 
namespace Test;
use Lyc\Cache\CacheFactory;
use Lyc\Url\Url;
use Lyc\Loader\Autoloader;
require_once __DIR__.'/../Lyc/Loader/Autoloader.class.php';
Autoloader::getInstance();
class CacheTest extends LycTest{
    public function __construct(){
	parent::__construct($this);
    }
    //测试Apc
    public function apcTest(){
	$cache=CacheFactory::create('apc',array('ttl'=>60));
	$key='gg';
	$value=array('nihao','hao');
	//设置缓存	
	$this->assertEqual(true,$cache->setItem($key,$value));
	//是否存在
	$this->assertEqual(true,$cache->hasItem($key));
	//返回key对应的value
	$this->assertEqual($value,$cache->getItem($key));
	//删除某缓存
	$this->assertEqual(true,$cache->delItem($key));
	//清除所有缓存
	$this->assertEqual(true,$cache->clearItems());
	
    }
    //测试Memcache 
    public function memcacheTest(){
	$cache=CacheFactory::create('memcache',array('host'=>'192.168.0.118','port'=>12000,'ttl'=>160));
	$key='mm';
	$value=array('miss','you');;
	// 注释同上
	$this->assertEqual(true,$cache->setItem($key,$value));
	$this->assertEqual(true,$cache->hasItem($key));
	$this->assertEqual($value,$cache->getItem($key));
	$this->assertEqual(true,$cache->delItem($key));
	$this->assertEqual(true,$cache->clearItems());	

    } 
}

new CacheTest();
?>
