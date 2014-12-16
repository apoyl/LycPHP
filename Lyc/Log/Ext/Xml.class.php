<?php
    /*  Copyright (C) 2014 apoyl.com. All Rights Reserved.
    /*  Author:凹凸曼(lyc)
    /*  Email: jar-c@163.com  
    /*  Xml类 Lyc\Xml\Dom.class.php
    */
namespace Lyc\Log\Ext;
use DOMDocument;
class Xml extends DOMDocument{
	private $filepath;
	const ROOT='logs';	//根节点
	const SUBROOT='log';	//子节点
    public function __construct($filepath){
        parent::__construct($ver='1.0',$encoding='utf-8');
       	$this->filepath=$filepath;

	 $this->formatOutput=true;
	$this->preserveWhiteSpace=false;
    }
 
    /**
    * 创建文档
    * 
    * @param mixed $root    根节点
    * @param mixed $key     节点名
    * @param mixed $value    节点值
    * @param mixed $cdata     是否创建CDATA 1创建  
    * @return DOMElement    
    */
    private function create($root,$key,$value='',$cdata=0){
        
        $item=$this->createElement($key);
        $root->appendChild($item);
        if(!empty($value)){
            if(1==$cdata){
                $text=$this->createCDATASection($value);
            }else{
                $text=$this->createTextNode($value);            
            }
            
            $item->appendChild($text);
        }
        return $item;
    }
  
   public function addRow($data){
	$model=new Model($data);
	if(file_exists($this->filepath)){
      		 $this->load($this->filepath);
      		 $root=$this->getElementsByTagName(self::ROOT)->item(0);
	}else{
		$root=$this->create($this,self::ROOT);
	}
       $this->inFile($root,$model);        

   }
   
   private function inFile($root,$model){
       $root=$this->create($root,self::SUBROOT);                 
	foreach($model as $key=>$value){
		$this->create($root,$key,$value);
	}

       $this->save($this->filepath);         
   }
   public function fetch($start,$limit){
	$data=array();
	$this->load($this->filepath);
	$root=$this->getElementsByTagName(self::SUBROOT);
	$end=$start+$limit;
	$end=$end<($root->length)?$end:$root->length;
	for($i=$start;$i<$end;$i++){
		$node=$root->item($i);
		foreach($node->childNodes as $v){
	
		      $data[$i][$v->nodeName]=$v->nodeValue;
		
		}
	}
	return $data;
   }
 }    
      
?>
