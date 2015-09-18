<?php
    /*  Copyright (C) 2014 apoyl.com. All Rights Reserved.
    /*  Author:凹凸曼
    /*  Email: jar-c@163.com  
    /*  自动加载测试类 Test\LoaderTest.class.php
    */
   namespace Test;
   use Lyc\Db\Connect;
   use Lyc\Loader\Autoloader;
   use App\Ctr\Index;  //引入自定义空间类
   require_once 'LycTest.class.php';
   class LoaderTest extends LycTest {
      public function __construct(){
       parent::__construct($this);

      } 
     public  function loaderTest(){
	//测试是否自动加载Lyc\Db\Connect类
        require_once __DIR__.'/../Lyc/Loader/Autoloader.class.php';
	//新增项目空间
        $auto=Autoloader::getInstance();
	$auto->proDir(__dir__.'/RouteTest/mod/');
	//正确
	$this->assertEqual(new Index(),'App\Ctr\Index');
	//正确
	$this->assertEqual(new Connect(),'Lyc\Db\Connect');
	//错误
	$this->assertEqual(new Connect(),'Lyc\Dbb\Connect');

     }
     
   }
   
   new LoaderTest();    
?>
