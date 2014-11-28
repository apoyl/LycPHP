<?php
    /*  Copyright (C) 2014 apoyl.com. All Rights Reserved.
    /*  Author:凹凸曼
    /*  Email: jar-c@163.com  
    /*  MongoDB数据库测试类 Test\MongoTest.class.php
    */
   namespace Test;
   use Lyc\Loader\Autoloader;
   use Lyc\Mongo\Mongo;
   use Lyc\Mongo\Model;
   require_once __DIR__.'/../Lyc/Loader/Autoloader.class.php';
   Autoloader::getInstance();
 
class MongoTest extends LycTest{
    public function __construct(){

       parent::__construct($this);
    }
    
    public function initTest(){
	$dbconfig=array(
       		 'dbuser'  => 'aotudbmongo',   //数据库用户名
       		 'dbpwd'   => 'tiantiankaixinaotu#*#123456abc',   //数据库密码
		 'dbs'     => 'scratcher',     //数据库名

       		// 'dbip'    => 'localhost',     //数据库ip地址
       		// 'dbport'  => '27017',        //数据库开发端口
       	);
        $table   = 'scr_record';    //表名
        $primary = '_id';           //唯一键

	$mongo=new Mongo($dbconfig);
        $m=$mongo->getModel();
	$m->setTable($table)->setPrimary($primary);
	//获取一条记录
        $arr=$m->getOne();
        $this->assertGe(count($arr),1);
        //获取总数
	$c=$m->totalNum();
	$this->assertGe($c,1);
	//其他使用方法，请看接口文件:Lyc\Mongo\MongoInterface.class.php
	//$arrall=$m->getAll();
    }
    
   
}

new MongoTest();
?>
