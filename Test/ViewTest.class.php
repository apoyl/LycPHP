<?php
    /*  Copyright (C) 2014-2015 apoyl.com. All Rights Reserved. 
    /*  Author:凹凸曼
    /*  Email: jar-c@163.com  
    /*  试图测试类 Test\ViewTest.class.php
    */
namespace Test;
use Lyc\View\View;
use Lyc\Loader\Autoloader;
require_once __DIR__.'/../Lyc/Loader/Autoloader.class.php';
Autoloader::getInstance();

class ViewTest extends LycTest{
    public function __construct(){
       parent::__construct($this);
    }
    
    public function tplTest(){
	//TPLDIR 定义存放模板位置
	define('TPLDIR',__dir__.'/view');
	//模板文件名 默认后缀.phtml
	$testtpl='index';
	//此组件可结合Route组件一起使用
	$view=new View(TPLDIR);
	$view->tpl($testtpl);
	$start='hello world';
	$view->setVar('start',$start);	
   }
}    
      new ViewTest();   
?>
