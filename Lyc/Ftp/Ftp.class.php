<?php
    /*  Copyright (C) 2014 apoyl.com. All Rights Reserved.
    /*  Author:凹凸曼
    /*  Email: jar-c@163.com
    /*  Ftp类 Lyc\Ftp\Ftp.class.php
    */
namespace Lyc\Ftp;  
class Ftp extends FtpAbstract{
    
    public function __construct($host,$user,$pwd,$mode=FTP_BINARY,$port=21,$timeout=30,$pasv=TRUE){
        $this->host=$host;
        $this->user=$user;
        $this->pwd=$pwd;
        $this->mode=$mode;
        $this->port=$port;
        $this->timeout=$timeout;
        $this->pasv=$pasv;
        $this->init();

    }
    protected function init(){

            $this->connect();
            $this->login();

    }
    /**
    * 上传文件
    * 
    */
    public function upload($remotefile,$localfile){
        
       $res=ftp_nb_put($this->ftpobj,$remotefile,$localfile,$this->mode,ftp_size($this->ftpobj,$remotefile));
       while($res==FTP_MOREDATA){
           $res=ftp_nb_continue($this->ftpobj);
       }
       if($res!=FTP_FINISHED){
           return FALSE;
       }
       return TRUE;
    }
    /**
    * 下载文件
    * 
    */ 
    public function download($localfile,$remotefile){
        ftp_set_option($this->ftpobj,FTP_AUTOSEEK,FALSE);
        $res=ftp_nb_get($this->ftpobj,$localfile,$remotefile,$this->mode,ftp_size($this->ftpobj,$localfile));
        while($res==FTP_MOREDATA){
            $res=ftp_nb_continue($this->ftpobj);
        }
        if($res!=FTP_FINISHED){
            return FALSE;
        }
        return TRUE;
    }  
}
?>
