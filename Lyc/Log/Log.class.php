<?php
    /*  Copyright (C) 2014 apoyl.com. All Rights Reserved.
    /*  Author:凹凸曼
    /*  Email: jar-c@163.com
    /*  日志类 Lyc\Log\Log.class.php
    */
namespace Lyc\Log;
class Log implements LogInterface{
    
    private $logpath='./';    //log存放位置
    private $filename='';     //文件名
    private $ext='.xml';      //文件类型
    private $allowext=array('.xml','.txt');
    private $pri=0700; 
    private $encoding='utf-8';
    
    public function __construct(){
        
    }
    
    public function init($logpath,$filename='',$ext='.xml',$encoding='',$pri=0700){
        
	$this->logpath=$logpath;
        $this->filename=$filename;
        $this->ext=$ext;
        $this->encoding=$encoding;
        $this->pri=$pri;
        
        if(empty($this->logpath)||empty($this->filename)){
            throw new LogException('LOG ERROR:null params');
        }

        if(empty($this->ext)||!in_array($this->ext,$this->allowext)){
            throw new LogException('LOG ERROR: null params');
        }
        $this->mdir($this->logpath);
       
    }
   private function mdir($path){
	if(!is_dir($path)){
	  if(!$this->mdir(dirname($path))) return false;
	  if(!mkdir($path,$this->pri)) return false; 
	}
	return true;
    }
   private function getClass(){
	 $filepath=$this->logpath.DIRECTORY_SEPARATOR.$this->filename.$this->ext;
        $objname="Lyc\Log\Ext\\".ucfirst(substr($this->ext,1));
	$class=new $objname($filepath); 
	return $class;

   } 
  
   public function  write($data){
          if(!($data&&is_array($data))){
             throw new LogException('LOG ERROR: null param');
        }
        $class=$this->getClass(); 
	$class->addRow($data);

      }
   public function read($start,$limit){
	if($start<0||$limit<0)
	    throw new  LogException('LOG ERROR : incorrect params');
	$class=$this->getClass();
	$data=$class->fetch($start,$limit);
	return $data;
   }
  }    
?>
