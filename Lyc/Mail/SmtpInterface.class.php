<?php
    /*  Copyright (C) 2014 apoyl.com. All Rights Reserved.
    /*  Author:凹凸曼
    /*  Email: jar-c@163.com  
    /*  SMTP接口 Lyc\Mail\SmtpInterface.class.php
    */  
  namespace Lyc\Mail; 
  Interface SmtpInterface{
   
     //打开连接
    public function open($hostname,$port,$timeout);
    
    //判断socket连接状态
    public function opened();
    
    //建立联系
    public function hello($msg);    
    
    //认证
    public function auth($user,$pwd);    
    
    //设置发信人
    public function from($fromname);    
    
    //设置收信人
    public function to($toname);      
    
    //内容
    public function data($subject,$message);  
       
    
    //退出
    public function quit();    
    
    //获取信息
    public function gets();     
    
    
    
}    
?>
