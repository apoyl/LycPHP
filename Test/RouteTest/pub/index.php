<?php
    /*  Copyright (C) 2014-2015 apoyl.com. All Rights Reversed.
    /*  Author:凹凸曼
    /*  Email: jar-c@163.com  
    /*  站点单一入口文件 index.php
    */ 
use Lyc\Route\RouteDispatcher;
use Lyc\Loader\Autoloader;
require_once __DIR__.'/../../../Lyc/Loader/Autoloader.class.php';
Autoloader::getInstance();
$r=dirname(__FILE__).'/../mod';
set_include_path(get_include_path().PATH_SEPARATOR.$r);

$dispatcher=new RouteDispatcher();
$dispatcher->go();

?>
