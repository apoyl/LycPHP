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
        $path=dirname(__FILE__).DIRECTORY_SEPARATOR.'Log'.DIRECTORY_SEPARATOR.date('Y',$now);

        $filename='mylog_'.date('Ym',$now);
        $data=array(
            'time'=>date('Y-m-d H:i:s',$now),   //日期
            'author'=>'dddsdafas',              //作者
            'ip'=>'127.0.0.1',                  //ip
            'ac'=>'删除',                       //动作
            'content'=>'非法字符',              //内容
            'url'=>'nihao.php'                  //提交前的url
        );
        try{
          $log->init($path,$filename,$ext='.log','utf-8',$pri=0700);
          $log->create($data);           
        }catch(Exception $e){
            echo 'log write failure !';
            exit;
        }

    }
}    
      new LogTest();   
?>
