<?php
    /*  Copyright (C) 2014-2015 apoyl.com. All Rights Reserved.
    /*  Author:凹凸曼
    /*  Email: jar-c@163.com  
    /*  Route调度类 Lyc\Route\RouteDispatcher.class.php
    */ 
namespace Lyc\Route;
class RouteDispatcher{
	protected $route=null;
	protected $path='';
	const CTR='Ctr';
	public function __construct(){
		$this->route=new Route();
		$this->initPath();
	}
	protected function initPath(){
		$arr=array_reverse(explode(PATH_SEPARATOR,get_include_path()));
		$path=isset($arr[0])?$arr[0]:'';
		if(empty($path))
			throw new RouteException('ROUTE ERROR: path is empty!');	
		$module=$this->route->getModule();
		if(empty($module))
			throw new RouteException('ROUTE ERROR: module is empty!');
		$this->path=$path.DIRECTORY_SEPARATOR.$this->route->getModule();

	}
	//加载类
	protected function loadCtr(){		
		$class=$this->route->getCtr();
		if(empty($class))
			throw new RouteException('ROUTE ERROR: controller is empty!');
		$method=$this->route->getMethod();
		$ctrpath=$this->path.DIRECTORY_SEPARATOR.RouteDispatcher::CTR.DIRECTORY_SEPARATOR.$class.'.php';		
		
		if(file_exists($ctrpath))
			require_once $ctrpath;		
	}
	public function go(){
		$this->loadCtr();
		$class=$this->route->getModule().'\\'.RouteDispatcher::CTR.'\\'.$this->route->getCtr();
		$method=$this->route->getMethod().'Action';
		if(!class_exists($class))
			echo "CLASS [$class] NOT FOUND <br/>";	
		else{
			$c=new $class();
			if(!method_exists($class,$method))
				echo "$class->$method() NOT FOUND <br/>";
			else 
				$c->$method();
		}
	}
	
}
?>
