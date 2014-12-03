<?php
    /*  Copyright (C) 2014 apoyl.com. All Rights Reversed.
    /*  Author:凹凸曼
    /*  Email: jar-c@163.com  
    /*  Url测试类 Test\UrlTest.class.php
    */ 
namespace Test;
use Lyc\Url\Url;
use Lyc\Loader\Autoloader;
require_once __DIR__.'/../Lyc/Loader/Autoloader.class.php';
Autoloader::getInstance();
class UrlTest extends LycTest{
    public function __construct(){
	parent::__construct($this);
    }
    //测试post请求，抓取页面
    public function postTest(){
        //测试默认、curl、sock类抓取页面
        $url=Url::getInstance();
        //$url=Url::getInstance('curl');  
        //$url=Url::getInstance('sock'); 
	//设置代理
       	//$proxy=array('host'=>'请填写代理服务器');
	//$url->setProxy($proxy);
        $data=$url->post("http://www.apoyl.com",array('paged'=>1));
	$this->assertEqual($url->getCode(),200);
	//echo $data;
	
    }
    //测试get请求，抓取页面
    public function getTest(){ 
        //测试默认、curl、sock类抓取页面
        $url=Url::getInstance();
        //$url=Url::getInstance('curl');  
        // $url=Url::getInstance('sock'); 
	//设置代理
       //$proxy=array('host'=>'请填写代理服务器');
	//$url->setProxy($proxy);
        
	$data=$url->get("http://www.apoyl.com");
	$this->assertEqual($url->getCode(),200);
	//echo $data;
	
    }
}

new UrlTest();
?>
