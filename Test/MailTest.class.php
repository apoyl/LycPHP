<?php
    /*  Copyright (C) 2014 apoyl.com. All Rights Reserved. 
    /*  Author:凹凸曼
    /*  Email: jar-c@163.com  
    /*  邮件测试类 Test\SmtpTest.class.php
    */

  namespace Test;
  use Lyc\Loader\Autoloader;
  use Lyc\Mail\Send;
  require_once __DIR__. '/../Lyc/Loader/Autoloader.class.php';
  Autoloader::getInstance();
  class MailTest extends LycTest{
    public function __construct(){
        parent::__construct($this);
    }
   //发送邮件 
    public  function sendTest(){
       //用qq,163 等发邮寄请先到你的帐号设置里 打开SMTP
       //发送成功后请到你邮寄服务器查看是否成功！
       $arr=array(
            'hostname'=>"smtp.qq.com", //smtp服务器
            'user'=>"test",//帐号 （qq,163等）
            'pwd'=>"test", //密码
            'from'=>"", //发邮件地址
            'to'=>"",      //收邮件地址
            'subject'=>"test",           //主题
            'message'=>"hello Email!"           //内容
        );
        
        $send=new Send();
        try{
        $send->init($arr);
        $send->send();
        }catch(Exception $e){
            echo $e;
            exit;
        }

    }
}   

new MailTest();
?>
