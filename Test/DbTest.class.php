<?php
    /*  Copyright (C) 2014 apoyl.com. All Rights Reserved.
    /*  Author:凹凸曼
    /*  Email: jar-c@163.com  
    /*  数据库测试类 Test\DbTest.class.php
    */
   namespace Test;
   use Lyc\Loader\Autoloader;
   use Lyc\Db\Manager;
   require_once __DIR__.'/../Lyc/Loader/Autoloader.class.php';
   Autoloader::getInstance();
  
   /* 重要提示：请把文件messages.sql导入你本地mysql.test里,
   /*然后才能进行下面数据库操作测试
   */
   class DbTest extends LycTest{
       //数据库相关配置数组
       protected $data=array(
			'myhost'=>'localhost',
			'dbname'=>'test', //数据库名
			'dbroot'=>'root', //数据库用户名
			'dbpwd'=>'admin', //数据库密码
			'dbport'=>3306,   //数据库端口
		#	'dbcharset'=>'gb2312', //编码
		#	'linkstyle'=>0,     
			'dbstyle'=>'mysql',
			);

      public function __construct(){
          parent::__construct($this);
      }
      //测试获取多行数据 
      public function fetchArrayTest(){
	    	
          $m=new Manager($this->data);
          $arr=$m->fetchArray('SELECT * FROM `messages` LIMIT 0 , 3');
	  //至少1条数据
          //类型不对，这条记录测试是错误的
	  $this->assertGe($arr,1);
	  //测试正确
	  $this->assertGe(count($arr),1);
      }
     //测试添加数据
     public function addTest(){
          
          $m=new Manager($this->data);
          $arr=array(
              
               'nickname'=>'lyctestd',
               'content'=>'neirongsss',
               'dateline'=>'123442333'
         );
         $f=$m->add($arr,'messages');
          $f=$m->getInsertId();
          $data1=$m->fetchRow('select * FROM `messages` where message_id='.$f);
	  $this->assertEqual($arr,$data1);
         
      }
     //测试获取多列数据 
     public function fetchColArrayTest(){
        
          $m=new Manager();
          $arr=$m->fetchColArray('SELECT * FROM `messages` LIMIT 0 , 3');
          $f=$m->getAffectedRows();
          $this->assertGe($f,1);
      }
     //测试获取对象数组
     public function fetchArrayObjectTest(){
         
         $m=new Manager();
         $arr=$m->fetchArrayObject('SELECT * FROM `messages` LIMIT 0,3');
         $this->assertGe(count($arr),1); 
     }
     //测试数据记录数 
     public function getNumRowsTest(){
         
         $m=new Manager();	
         $nums=$m->getNumRows('SELECT * FROM `messages`');
	 $this->assertGe($nums,1);
     }

  }
  new DbTest();
?>
