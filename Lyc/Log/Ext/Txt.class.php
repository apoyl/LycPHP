<?php
    /*  Copyright (C) 2014 apoyl.com. All Rights Reserved.
    /*  Author:凹凸曼(lyc)
    /*  Email: jar-c@163.com  
    /*  Txt Lyc\Log\Adapter\Txt.class.php
    */
namespace Lyc\Log\Ext;
use ReflectionClass;
class Txt{
    private $filepath;
    public function __construct($filepath){
		$this->filepath=$filepath;
	}
    private function format(Model $model){
		$str='';
		foreach($model as $value){
			$str.=$value."\t\t";
		}
		$str.="\n\r";
		return $str;
	}	
    public  function addRow($data){
		$data=$this->format(new Model($data));
		$type='w';
		if(file_exists($this->filepath))
			$type='a+';
		$this->inFile($this->filepath,$data,$type);
                       	
	}		
     private function inFile($file,$data,$type='w'){
        $fp=fopen($file,$type);
        if(is_string($data)){

          fwrite($fp,$data);

         }
        fclose($fp);
     }
    private function outFile($file,$type='r'){
	$line=0;
	$data=array();
        $fp=fopen($file,$type);
	if($fp){
		while($row=stream_get_line($fp,8192,"\n\r")){
			$data[$line]=$row;
			$line++;
		}
	}	
	return $data;
    }
   
    public function fetch($start,$limit){
	
	$data=array();
	$re=$this->outfile($this->filepath,'r');
	$end=$start+$limit;
	$len=count($re);
	$end=$end<$len?$end:$len;
	if($re){
		$class=new ReflectionClass('Lyc\Log\Ext\Model');
		$attris=array_keys($class->getDefaultProperties());
		
	}
	for($i=$start;$i<$end;$i++){
	   if($re[$i]){
		$arr=explode("\t\t",$re[$i]);
		foreach($attris as $k=>$v){
			$data[$i][$attris[$k]]=$arr[$k];
		}			
	   }

	}
	return $data;
    }

}
