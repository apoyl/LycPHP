<?php
    /*  Copyright (C) 2014 apoyl.com. All Rights Reserved.
    /*  Author:凹凸曼
    /*  Email: jar-c@163.com
    /*  配置文件 Lyc\Log\Log.class.php
    */
namespace Lyc\Log;
use Lyc\Xml\Dom;
class Log{
    
    private $logpath='./';    //log存放位置
    private $filename='';   //文件名
    private $ext='.xml';     //文件类型
    private $allowext=array('.xml','.log');
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
            throw new LogException('LOG ERROR:params');
        }

        if(empty($this->ext)||!in_array($this->ext,$this->allowext)){
            throw new LogException('LOG ERROR: params');
        }
        $this->mdir($this->logpath);
       
    }
    
    private function mdir($path){
        if(!file_exists($path)){
            $tem=explode(DIRECTORY_SEPARATOR,strrev($path),2);
            $lastpath=strrev($tem[1]);
            if(!file_exists($lastpath)){
                mkdir($lastpath,$this->pri);
            }  
          mkdir($path,$this->pri);  
        }
    }
   
   /**
   * 初始化xml
   * 
   */
   protected function  initDom($filepath,$model){
       $xml=new Dom("1.0",$this->encoding);
       $xml->formatOutput=true;
     //  header("Content-Type: text/plain");
       $root=$xml->create($xml,'logs');                  //跟节点
       $this->dealEelement($xml,$root,$filepath,$model);
   }

   
   /**
   * 增量数据
   * 
   */
   protected function addDom($filepath,$model){
       $xml=new Dom();
       $xml->formatOutput=true;
       $xml->preserveWhiteSpace=false;
       $xml->load($filepath);
       $root=$xml->getElementsByTagName('logs')->item(0);
       $this->dealEelement($xml,$root,$filepath,$model);        

   }
   
   protected function dealEelement($xml,$root,$filepath,$model){
       $root=$xml->create($root,'log');                   //子节点
       $xml->create($root,'date',$model->time);          //日期
       $xml->create($root,'author',$model->author);       //作者
       $xml->create($root,'ip',$model->ip);               //ip
       $xml->create($root,'action',$model->ac);            //ac
       $xml->create($root,'content',$model->content,1);    //内容
       $xml->create($root,'url',$model->url);               //url
       $xml->save($filepath);         
   }
   /**
   * 创建文件
   * 
   */
   public function  create($data){
          if(!($data&&is_array($data))){
             throw new LogException('MODEL ERROR:param');
        }
        $filepath=$this->logpath.DIRECTORY_SEPARATOR.$this->filename.$this->ext;
         $model=new Model($data);        
         
        switch($this->ext){

            case '.xml':
                         if($this->exists($filepath)){
                            $this->addDom($filepath,$model);
                         }else{
                           $this->initDom($filepath,$model);
                         }
                         break;
            case '.log':
                         if($this->exists($filepath)){
                           $this->inFile($filepath,$model->time."\t\t".$model->ip."\t\t".$model->author."\t\t".$model->ac."\t\t".$model->content."\t\t".$model->url."\n\r",'a+');
                         }else{
                           $this->inFile($filepath,$model->time."\t\t".$model->ip."\t\t".$model->author."\t\t".$model->ac."\t\t".$model->content."\t\t".$model->url."\n\r");
                         }

                         break;
        }
   }
   /**
   * 判断文件是否存在
   * 
   */
   protected function exists($filepath){
       $flag=FALSE;
       if(file_exists($filepath)){
           $flag=TRUE;
       }
       
       return $flag;
   }
   /**
   /*获取文件内容
   /* string $file:文件
   /* int $row:行数
   /* 
   */
  /* protected function outFile($file,$row=1){
	$fp=fopen($file,'r');
	if($row>1){

	}
   } */
   /*打开文件输入数据
  /*  string $file :文件名
  /*  string $type : 操作文件方式
  /*  return void
  */  
     public function inFile($file,$data=array(),$type='w'){
        $fp=fopen($file,$type);
        if(is_string($data)){

          fwrite($fp,$data);

         }else if(is_array($data)){
           fwrite($fp,arrToPhp($data));
         }
        fclose($fp);
     }
}    
?>
