<?php
    /*  Copyright (C) 2014-2015 apoyl.com. All Rights Reserved.
    /*  Author:凹凸曼
    /*  Email: jar-c@163.com 
     /*  上传类 Lyc\Upload\Upload.class.php
     */

namespace Lyc\Upload;

class Upload {
    private $storage='';                        //存放上层目录
    private $storagestruct='Y/m/d';             //时间存放结构
    private $container=array();                 //上传对象容器
    private $err=array();                       //上传错误集合
    private $varname='';                        //上传变量名
    private $filenums=0;                        //上传数量


    public function __construct($varname,$storage){
        if(empty($varname)) throw new UploadException('UPLOAD ERROR : varname is empty');
        if(empty($storage)) throw new UploadException('UPLOAD ERROR : storage is empty');
        $this->varname=$varname;
        $this->storage=$storage;
	if($this->varname)
        $this->req();
       	$this->mkPdir($this->getFullPath());
    }
    public function getNums(){
        return $this->filenums;
    }
    //请求处理
    private function req(){
       $files=array_unique(array_filter($_FILES[$this->varname]['name']));
        $this->filenums=count($files);
       if($files){
           foreach ($files as $k=>$v){
                   $img=new Image();
                   $img->setName($v);
                   $img->setSize($_FILES[$this->varname]['size'][$k]);
                   $img->setTmp_name($_FILES[$this->varname]['tmp_name'][$k]);
                   $img->setType($_FILES[$this->varname]['type'][$k]);
                   $img->setErr($_FILES[$this->varname]['error'][$k]);
                   array_push($this->container, $img);
                   if($_FILES[$this->varname]['error'][$k]!=0)
                        $this->err[$k]=$_FILES[$this->varname]['error'][$k];
                   if(!$img->verifSuffix()) 
                        $this->err[$k]=20001;
           }
       }

    }
    private function  getFullPath(){
        return $path=$this->storage.DIRECTORY_SEPARATOR.date($this->storagestruct,time());
    }
    
    //生成目录结构
    private function mkPdir($path){
        if(!is_dir($path))
            @mkdir(iconv("UTF-8", "GBK", $path),0777,true);
    }
    /*上传 
     * @return errnum :错误集合
     */
    public function move(){
        if($this->filenums<=0) $status=4;
        $status=0;
        if($this->err) return $this->err;
        if($this->container){
            foreach ($this->container as $obj){
                $now=time();
               if(is_uploaded_file($obj->getTmp_name())){
                   $file=DIRECTORY_SEPARATOR.date('YmdHis',$now).rand(10000,99999).$obj->getPostfix();
                   $re=@move_uploaded_file($obj->getTmp_name(),$this->getFullPath().$file);
                   if($re){
                       $ar=explode(DIRECTORY_SEPARATOR,$this->storage);
                       $url=end($ar).DIRECTORY_SEPARATOR.date($this->storagestruct,$now).$file; 
                       $obj->setUrl($url);
                       $obj->setDateline($now);
                   }else 
                       $status=20003;
               }else{
                   $status=20002;
                   break;
                   
               }
            }
           
        }
        return $status;
    }
    public function getContainer(){
        return $this->container;
    }
    public function retoStr($errnum){
        $data=array(
            0=>'亲，文件上传成功',
            1=>'亲，超过了文件大小php.ini中即系统设定的大小',
            2=>'亲，超过了文件大小MAX_FILE_SIZE 选项指定的值',
            3=>'亲，文件只有部分被上传',
            4=>'亲，木有文件可以上传',
            5=>'亲，上传文件大小为0',
            20001=>'亲，不允许上传类型',
            20002=>'亲，文件不能通过HTTP上传',
            20003=>'亲，文件移动失败',
        );
        return $data[$errnum];
    }
   

} 
?>
