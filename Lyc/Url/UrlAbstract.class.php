<?php
    /*  Copyright (C) 2014 apoyl.com. All Rights Reserved.
    /*  Author:凹凸曼
    /*  Email: jar-c@163.com  
    /*  Url抽象类 Lyc\Url\UrlAbstract.class.php
    */
namespace Lyc\Url;
abstract class UrlAbstract{
    
    public function __construct(){
        
    }
    /**
    * get请求数据
    * 
    * @param mixed $url
    */
    abstract public function get($url);
    
    /**
    * post提交数据
    * 
    * @param mixed $url
    * @param mixed $data
    */
    abstract public function post($url,$data=array());
     

    
    public function __toString(){
    }
    
}
?>
