<?php
    /*  Copyright (C) 2014 apoyl.com. All Rights Reserved.
    /*  Author:凹凸曼
    /*  Email: jar-c@163.com  
    /*  SMTP类 Lyc\Mail\Smtp.class.php
    */
  namespace Lyc\Mail; 
  class Smtp implements SmtpInterface{
    var $crlf="\r\n";
    var $port=25;
    var $socket=null;
    var $charset="utf-8";
    
    var $hostname='';
    var $from='';
    var $to='';

    public function __construct(){
        
    }
     //打开连接
    public function open($hostname,$port,$timeout){
          
        if($this->opened()){
            print_r($this->socket);
            return false;
        }

        if(empty($port)){
            $port=$this->port;
        }
        $this->hostname=$hostname;
        $this->socket=fsockopen($hostname,$port,$errno,$errstr,$timeout);
        if(empty($this->socket)){
            throw new MailException("$hostname:$port CONNECT - Unable to connect to the SMTP server");
            return false;

        }
        stream_set_blocking($this->socket,true);
        //socket_set_timeout($this->socket,1,0); //设置响应时间1s
        $data=$this->gets();

        //socket_set_timeout($this->socket,0,100000); //微秒
        
        if(substr($data,0,3)!='220'){
            throw new MailException("$hostname:$port CONNECT - $data");
            return false;
        }
        return true;
    }
    
    //判断socket连接状态
    public function opened(){
        if(!empty($this->socket)){
            $status=socket_get_status($this->socket);
            
            if($status['eof']){
                $this->close();
                return false;
            }
            return true;
        }
        return false;
    }    
    
    //建立联系
    public function hello($msg){
        if(empty($msg)){
            $msg='hi';
        }        
        fputs($this->socket,'HELO '.$msg.$this->crlf);
        $data=$this->gets();
         
        if(substr($data, 0, 3) != 220 && substr($data, 0, 3) != 250){
            throw new MailException("errors: helo -- $data");
        }
        
    }    
    
    //认证
    public function auth($user,$pwd){

        fputs($this->socket,'auth login'.$this->crlf);
        $data=$this->gets();
        if(substr($data,0,3)!=334){
            throw new MailException("errors: auth login -- $data");
        }

        fputs($this->socket,base64_encode($user).$this->crlf);
        $data=$this->gets();
        if(substr($data,0,3)!=334){
            throw new MailException("errors: user -- $data");
        }
        
        fputs($this->socket,base64_encode($pwd).$this->crlf);
        $data=$this->gets();
        if(substr($data,0,3)!=235){
            throw new MailException("errors: pwd -- $data");
        }
        
        
    }    
    
    //设置发信人
    public function from($fromname){

         $this->from=$fromname ;
         fputs($this->socket,"mail from: $fromname{$this->crlf}");
         $data=$this->gets();
         if(substr($data,0,3)!=250){
             throw new MailException("errors: mail from -- $data");
         }
    
    }  
    
    //设置收信人
    public function to($toname){

        $this->to=$toname;
         fputs($this->socket,"rcpt to: $toname$this->crlf");
         $data=$this->gets();
         if(substr($data,0,3)!=250){
             throw new MailException("errors: rcpt to -- $data");
         }        
    }    
    
    //内容
    public function data($subject,$message){
        fputs($this->socket,"data$this->crlf");
        $data=$this->gets();
        if(substr($data,0,3)!=354){
             throw new MailException("errors: data -- $data");
        }
       // socket_set_timeout($this->socket,2,0); //响应时间2秒
            
            $maildelimiter=$this->crlf;
            $charset=$this->charset;
            $message= chunk_split(base64_encode(str_replace("\n", "\r\n", str_replace("\r", "\n", str_replace("\r\n", "\n", str_replace("\n\r", "\r", $message))))));
            $subject='=?'.$charset.'?B?'.base64_encode(preg_replace("/[\r|\n]/", '', '[LYC] '.$subject)).'?=';
            
           $headers = "From: $this->from{$maildelimiter}X-Priority: 3{$maildelimiter}X-Mailer: APOYL {$maildelimiter}MIME-Version: 1.0{$maildelimiter}Content-type: text/html; charset=$charset{$maildelimiter}Content-Transfer-Encoding: base64{$maildelimiter}";
           $headers .= 'Message-ID: <'.gmdate('YmdHs').'.'.substr(md5($message.microtime()), 0, 6).rand(100000, 999999).'@'.$this->hostname.">{$maildelimiter}";
            fputs($this->socket,"Date: ".gmdate('r')."$this->crlf");
            fputs($this->socket,"To: $this->to$this->crlf");
            fputs($this->socket,"Subject: $subject$this->crlf");
            fputs($this->socket,$headers.$this->crlf);
            fputs($this->socket,"$this->crlf$this->crlf");
            fputs($this->socket,"$message$this->crlf.$this->crlf");
            $data=$this->gets();
            if(substr($data,0,3)!=250){
                throw new MailException("errors: end -- $data");
            }
           
    }  
    
  
        
    //退出,命令
    public function quit(){
        fputs($this->socket,"quit$this->crlf");
        $data=$this->gets();
        if(substr($data,0,3)!=221){
            throw new MailException("errors: quit --$data");
        }
        
    }  
    //关闭socket
    public function close(){
        fclose($this->socket);
    }
    //获取信息
    public function gets(){
        $data='';
       while($str=fgets($this->socket,512)){
            $data.=$str;
             if(substr($str,3,1)==' ') {

                 break;
             }
        } 
    return $data;            
        
    }  
    
    
}
  
?>
