<?php
    /*  Copyright (C) 2014 apoyl.com. All Rights Reserved.
    /*  Author:凹凸曼
    /*  Email: jar-c@163.com
    /*  Ftp测试类 框架 Test\FtpTest.class.php
    */
namespace Test;
use Lyc\Loader\Autoloader;
use Lyc\Ftp\Ftp;
require_once __DIR__.'/../Lyc/Loader/Autoloader.class.php';
Autoloader::getInstance();
 class FtpTest extends LycTest{

    public function __construct(){
        parent::__construct($this);

      
    }
    /**
    * 上传文件
    * 
    */
    public  function uploadTest(){
        $host=''; 		//ip
        $user='';		//用户名
        $pwd="";  		//密码
        $ftp=new Ftp($host,$user,$pwd); 
 
        /*@param:string 远程上传文件名
	/*@param:string 本地上传文件
	*/	
        $res=$ftp->upload('',"");
        if(!$res){
            echo " upload failure";
        }
        

    }
    
    public function downloadTest(){
        $host='';
        $user='';
        $pwd="";
        $ftp=new Ftp($host,$user,$pwd);

	/*@param:string 本地保存路径
	/*@param:string 远程下载文件名
	*/
        $res=$ftp->download("c:\\test.rar","test.rar");
        if(!$res){
            echo "download failure";
        }
        
    }
}   

new FtpTest();
?>
