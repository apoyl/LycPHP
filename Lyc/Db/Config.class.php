<?php
    /*  Copyright (C) 2014 apoyl.com. All Rights Reserved.
    /*  Author:凹凸曼
    /*  Email: jar-c@163.com    
    /*  配置文件 Lyc\Db\Config.class.php
    */
    namespace Lyc\Db;
    class Config{
        protected $myhost="localhost";
        protected $dbname="test";
        protected $dbroot="root";
        protected $dbpwd="admin";
        protected $dbport=3306;
        protected $dbcharset='gb2312'; //数据库编码
        protected $linkstyle=0; //0默认 非持久连接 1相反
        protected $dbstyle='mysql'; //默认连接 mysql 支持mssql
	
	
        public function __construct($db){
             $this->init($db);
        }
        
        protected function init($db){
            foreach($db as $k=>$v){
                $this->$k=$v;
            }
        }
    }  
?>
