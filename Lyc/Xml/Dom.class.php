<?php
    /*  Copyright (C) 2014 apoyl.com. All Rights Reserved.
    /*  Author:凹凸曼(lyc)
    /*  Email: jar-c@163.com  
    /*  xml节点 Lyc\Xml\Dom.class.php
    */
namespace Lyc\Xml;
use DOMDocument;
class Dom extends DOMDocument{
    public function __construct($ver='1.0',$encoding='utf-8'){
        parent::__construct($ver,$encoding);


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
    public function create($root,$key,$value='',$cdata=0){
        
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
}    
      
?>
