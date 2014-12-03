<?php
    /*  Copyright (C) 2014 apoyl.com. All Rights Reserved.
    /*  Author:凹凸曼
    /*  Email: jar-c@163.com  
    /*  curl 封装 Lyc\Url\Adapter\Curl.class.php
    */
namespace Lyc\Url\Adapter;
use Lyc\Url\UrlAbstract;
use Lyc\Url\UrlException;
class Curl extends UrlAbstract{
    private $curl=null;
    private $proxy=array('host'=>'','port'=>80,'timeout'=>30);
    private $code=0;

    public function __construct(){
	if(!function_exists('curl_init'))
		throw new UrlException('CURL ERROR:curl_init does not exist');

     }
    private function init($url,$data=array()){
        if(empty($url)){
            throw new UrlException('CURL ERROR: url cannot be empty');
        }
        if($data&&is_array($data)){
            foreach($data as $k=>$v){
                $query[]="$k=".urlencode($v);
            }
            $str=implode('&',$query);
        }
        $timeout=25;        
        $this->curl=curl_init();
        curl_setopt($this->curl,CURLOPT_URL,$url);
        curl_setopt($this->curl,CURLOPT_HEADER,0);
        curl_setopt($this->curl,CURLOPT_RETURNTRANSFER,1);
	if(!empty($this->proxy['host'])){
		curl_setopt($this->curl,CURLOPT_PROXY,$this->proxy['host'].':'.$this->proxy['port']);
		$timeout=$this->proxy['timeout'];	
	}	
        curl_setopt($this->curl,CURLOPT_CONNECTTIMEOUT,$timeout);
    }
    public function get($url){
        $this->init($url);
        $data=$this->run();
	if(!$data)
		throw new UrlException('CURL ERROR:curl cannot open');
	$this->code=curl_getinfo($this->curl,CURLINFO_HTTP_CODE);
	$this->close();
        return $data;
        
    }
    public function post($url,$data=array()){
        $this->init($url,$data);
        curl_setopt($this->curl,CURLOPT_POST,1);
        curl_setopt($this->curl,CURLOPT_POSTFIELDS,$data);
        $data=$this->run();
	if(!$data)
		throw new UrlException('CURL ERROR:curl cannot open');
	$this->code=curl_getinfo($this->curl,CURLINFO_HTTP_CODE);
        $this->close();
        return $data;
    }
    public function getCode(){
        return $this->code;   
    }
    private  function run(){
        $data=curl_exec($this->curl);
        return $data;
    }
    
    private function close(){
        curl_close($this->curl);
    }
    public function setProxy($proxy){
   	$this->proxy=array_merge($this->proxy,$proxy);
     }
}   
?>
