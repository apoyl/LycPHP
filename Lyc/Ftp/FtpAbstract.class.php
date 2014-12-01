<?php
    /*  Copyright (C) 2014 apoyl.com. All Rights Reserved.
    /*  Author:凹凸曼
    /*  Email: jar-c@163.com
    /*  Ftp抽象类 Lyc\Ftp\FtpAbstract.class.php
    */
namespace Lyc\Ftp; 
abstract class FtpAbstract {
    
    protected $ftpobj=null;
    protected $host='';
    protected $user='anonymous';
    protected $pwd='';
    protected $mode=FTP_BINARY;
    protected $port=21;
    protected $timeout=30;
    
    protected $pasv=TRUE;
    
    protected function init(){
        
    }
    /**
    * 建立ftp连接
    * 
    */
    protected function connect(){        
       $this->ftpobj=@ftp_connect($this->host,$this->port,$this->timeout);
       if(null==$this->ftpobj){ 
       throw new FtpException("FTP ERROR : Couldn't connect to $this->host");
       }
    }
    /**
    * 建立ssl ftp连接
    * 
    */
    protected function connectSsl(){        
       $ftpobj=@ftp_ssl_connect($this->host,$this->port,$this->timeout);
       if(null==$ftpobj){   
       throw new FtpException("FTP ERROR : Couldn't connect to $this->host");
       }
    }
    /**
    * 登录验证ftp 及设置模式
    * 
    */
    protected function login(){
        
        if(@ftp_login($this->ftpobj,$this->user,$this->pwd)){
            ftp_pasv($this->ftpobj,$pasv);
            
        }else{
            throw new FtpException("FTP ERROR : Couldn't login to $this->host");
        }
    }
    /**
    * 上传文件
    * 
    */
    public function upload($remotefile,$localfile){
        
    }
    /**
    * 下载文件
    * 
    */
    public function download($localfile,$remotefile){
        
    }
    /**
    * 关闭连接
    * 
    */
    public function close(){
        if(is_string($this->ftpobj)){
            ftp_close($this->ftpobj);
        }
    }
    
}
?>
