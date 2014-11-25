<?php
    /*  Copyright (C) 2014 apoyl.com. All Rights Reserved.
    /*  Author:凹凸曼
    /*  Email: jar-c@163.com
    /*  分页测试类 Test\PaginatorTest.class.php
    */
  namespace Test;
  use Lyc\Loader\Autoloader;
  use Lyc\Paginator\Paginator;
  require_once __DIR__.'/../Lyc/Loader/Autoloader.class.php';
  Autoloader::getInstance();
   class PaginatorTest extends LycTest{
      public function __construct(){
         parent::__construct($this);
      }
       
      public function viewTest(){
       /*@param:int 总条条数
       /*@param:int 显示当前页前后的最多页数
       /*@param:int 每页的条数
       /*@param:int 当前的页码
       /*@param:string  链接 
        */
       $pag=new Paginator(200,10,20,4,"http://www.apoyl.com");
        //测试下一页 是否等于6 
        //这个会报错，如果需要测试nextpage方法访问权限protected  更改为public
	//$this->assertEqual(6,$pag->nextpage());

        //测试输出的视图
        //测试结果是不相等，亲，我相信你会修改
       $resulthtml='<span>[<a href="http://www.apoyl.com?paged=1">first</a>][<a href="http://www.apoyl.com?paged=2">pre</a>][<a href="http://www.apoyl.com?paged=1">1</a>][<a href="http://www.apoyl.com?paged=2">2</a>][<a href="http://www.apoyl.com?paged=3"><font color="red">3</font></a>][<a href="http://www.apoyl.com?paged=4">4</a>][<a href="http://www.apoyl.com?paged=5">5</a>][<a href="http://www.apoyl.com?paged=6">6</a>][<a href="http://www.apoyl.com?paged=7">7</a>][<a href="http://www.apoyl.com?paged=8">8</a>][<a href="http://www.apoyl.com?paged=9">9</a>][<a href="http://www.apoyl.com?paged=10">10</a>][<a href="http://www.apoyl.com?paged=4">next</a>][<a href="http://www.apoyl.com?paged=10">last</a>]</span>';
       $pag->setLanuage('en');
       $this->assertEqual($resulthtml,$pag->getPviews());
	
      }
  }  
  
    new PaginatorTest();
?>
