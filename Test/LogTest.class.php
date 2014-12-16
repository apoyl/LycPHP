<?php
    /*  Copyright (C) 2014 apoyl.com. All Rights Reserved. 
    /*  Author:凹凸曼
    /*  Email: jar-c@163.com  
    /*  日志记录测试类 Test\LogTest.class.php
    */
namespace Test;
use Lyc\Log\Log;
use Lyc\Loader\Autoloader;
require_once __DIR__.'/../Lyc/Loader/Autoloader.class.php';
Autoloader::getInstance();

class LogTest extends LycTest{
    public function __construct(){
       date_default_timezone_set('Asia/Shanghai');
       parent::__construct($this);
    }
    
    public function mdirTest(){
        
        $log=new Log();
        $now=time();
        $path=dirname(__FILE__).DIRECTORY_SEPARATOR.'Log'.DIRECTORY_SEPARATOR.date('Y',$now).DIRECTORY_SEPARATOR.date('m',$now);

        $filename='mylog_'.date('Ym',$now);
        $data=array(
            'time'=>date('Y-m-d',$now),   //日期
            'author'=>'dddsdafas',              //作者
            'ip'=>'127.0.0.1',                  //ip
            'ac'=>'删除',                       //动作
            'content'=>'非法字符',              //内容
            'url'=>'nihao.php'                  //提交前的url
        );
        
	  //初始化
          $log->init($path,$filename,$ext='.xml');
          //写入日志文件
	  $log->write($data);
	  //读取日志文件 开始0 行数1
	  $redata= $log->read(0,1);  
	     
	   $this->assertEqual($data,$redata[0]);   
 		          
    }
}    
      new LogTest();   
?>
