<?php
    /*  Copyright (C) 2014 apoyl.com. All Rights Reserved.
    /*  Author:凹凸曼
    /*  Email: jar-c@163.com  
    /*  发邮件类 Lyc\Mail\Send.class.php
    */
   namespace Lyc\Mail;
   class Send{
    
    var $mailtype='smtp'; //方式方式 目前只支持这个
    
    var $port=25;        //端口
    
    var $hostname='';    //主机
    
    var $user='';        //用户名
    
    var $pwd='';        //密码
    
    
    var $hello='hi';    //招呼
    
    var $from='';       //发信人
    
    var $to='';         //收信人
    
    var $subject='';     //标题
    
    var $message='';     //内容
    
    var $timeout=20;
    
    
    
    
    public function __construct(){
        
    }
    
    private function smtpSend(){
        $smtp=new Smtp();
        try{
            $smtp->open($this->hostname,$this->port,$this->timeout);
            $smtp->hello($this->hello);
            $smtp->auth($this->user,$this->pwd);
            $smtp->from($this->from);
            $smtp->to($this->to);
            $smtp->data($this->subject,$this->message);
            $smtp->quit();
            $smtp->close();
        }catch(Exception $e){
            throw new Exception($e);
        }        
        
    }
    public function init($arr=array()){
        if(!is_array($arr)){
            throw new MailException('errors: init ');
        }
        foreach($arr as $k=>$v){
            $this->$k=$v;
        }
        
    }
    public function send(){
        
        if('smtp'==$this->mailtype){

            $this->smtpSend();
        }
        
    }
}    
?>
