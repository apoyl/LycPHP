<?php
    /*  Copyright (C) 2014 apoyl.com. All Rights Reserved.
    /*  Author:凹凸曼
    /*  Email: jar-c@163.com  
    /*  file_get_contents封装 Lyc\Url\Adapter\Contents.class.php
    */
namespace Lyc\Url\Adapter;
use Lyc\Url\UrlAbstract;
use Lyc\Url\UrlException;
class Contents extends UrlAbstract{
     
    private $proxy=array('host'=>'','port'=>80,'timeout'=>30);
    private $code=0;  

    public function __construct(){
	if(!function_exists('file_get_contents'))
		throw new UrlException('URL ERROR:file_get_contents does not exist');
    } 
    public function get($url){   
        if(empty($url)){
            throw new UrlException('URL ERROR :url cannot be empty');
        }
        $opt=array(
        'http'=>array(
            'method'=>'GET',
            'timeout'=>25
        )
        );
	$proxy=$this->getProxyContext();
	if($proxy)
		$opt['http']=array_merge($opt['http'],$proxy['http']);
        $context=stream_context_create($opt);            
        $data=@file_get_contents($url,false,$context);
        if(!$data){
            throw new UrlException('URL ERROR:file_get_contents cannot open');
        }
	$this->code=(int)substr($http_response_header[0],9,3);

        return $data;
    }
    
    public function post($url,$data=array()){
        
        if(empty($url)){
            throw new UrlException('URL ERROR :url cannot be empty');
        }  
        $params='';
        if($data&&is_array($data)){
        $params=http_build_query($data);
        }
        
        $opt=array(
        'http'=>array(
            'method'=>'POST',
            'timeout'=>25,
            'header'=>"Content-type: application/x-www-form-urlencoded\r\n".
            "Content-Length:".strlen($params)."\r\n",
            'content'=>$params
        )
        );
	$proxy=$this->getProxyContext();
	if($proxy)
		$opt['http']=array_merge($opt['http'],$proxy['http']);
        $context=stream_context_create($opt);
        $data=@file_get_contents($url,false,$context);
        if(!$data){
            throw new UrlException('URL ERROR:file_get_contents cannot open');
       }
	$this->code=(int)substr($http_response_header[0],9,3);
        return $data;
    }
    public function setProxy($proxy=array()){
	$this->proxy=$proxy;
    }
    private function getProxyContext(){
		$proxy=array();
		if(!empty($this->proxy['host'])){
		$proxy=array(
			'http'=>array(
				'proxy'=>'tcp://'.$this->proxy['host'].':'.(isset($this->proxy['port'])?$this->proxy['port']:80),
				'request_fulluri'=>true,
				'timeout'=>isset($this->proxy['timeout'])?$this->proxy['timeout']:30,
			)
			);
		
	   }
	 return $proxy;

	}
     public function getCode(){
		return $this->code;
	}
}  
?>
