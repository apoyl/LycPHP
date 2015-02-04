<?php
    /*  Copyright (C) 2014-2015 apoyl.com. All Rights Reserved.
    /*  Author:凹凸曼
    /*  Email: jar-c@163.com 
    /*  Route接口 Lyc\Route\RouteInterface.class.php
    */
  namespace Lyc\Route;
  Interface RouteInterface{
	//获取控制器类 
    	public function getCtr();
	//获取方法
	public function getMethod();
     	//获取模块
	public function getModule();
 
  }     
?>
