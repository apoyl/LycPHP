<?php
    /*  Copyright (C) 2014-2015 apoyl.com. All Rights Reserved.
    /*  Author:凹凸曼
    /*  Email: jar-c@163.com 
    /*  Route类 Lyc\Route\Route.class.php
    */
  namespace Lyc\Route;
  class Route implements RouteInterface{
	
	protected $ctr='Index';
	protected $module='';
	protected $method='index';

	public function __construct(){
		$this->dealUri();		
	}
	//解析uri
	private function dealUri(){
		$uri=$_SERVER['REQUEST_URI'];	
		$arr=parse_url($uri);
		if(isset($arr['path'])&&$arr['path']!='/'){
			$arr=array_filter(explode('/',$arr['path']));
			$this->module=isset($arr[1])?ucfirst($arr[1]):$this->module;
			$this->ctr=isset($arr[2])?ucfirst($arr[2]):$this->ctr;
			$this->method=isset($arr[3])?$arr[3]:$this->method;
				
		}else{
			$this->module='App';
			$this->ctr='Index';
			$this->method='index';
		}
	
	}
	//获取模块
	public function getModule(){
		return $this->module;
	}
	//获取控制器类 
    	public function getCtr(){
		return $this->ctr;
	}
	//获取方法
	public function getMethod(){
		return $this->method;
	}

  }     
?>
