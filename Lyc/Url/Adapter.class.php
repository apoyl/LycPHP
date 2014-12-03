<?php
    /*  Copyright (C) 2014 apoyl.com. All Rights Reserved.
    /*  Author:凹凸曼
    /*  Email: jar-c@163.com  
    /*  Url适配器 Lyc\Url\Adapter.class.php
    */ 
namespace Lyc\Url;    
class Adapter{
    protected $lib=null;
    public function __construct($lib){

        $this->lib=$lib;
    }
    
    public function get($url){
        return $this->lib->get($url);
    }
    
    public function post($url,$data=array()){
        return $this->lib->post($url,$data);
    }
    /**
    * 获取响应状态码
    * 
    * @param mixed $url
    */
    public function getCode(){
        return $this->lib->getCode();
    }
    //设置代理
    public function setProxy($proxy=array()){
	$this->lib->setProxy($proxy);
     } 
}
?>
