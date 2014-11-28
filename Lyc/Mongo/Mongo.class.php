<?php
    /*  Copyright (C) 2014 apoyl.com. All Rights Reserved.
    /*  Author:凹凸曼
    /*  Email: jar-c@163.com  
    /*  Mongo链接数据库 Lyc\Mongo\Mongo.class.php
    */
namespace Lyc\Mongo;
use MongoClient;
class Mongo{
	private	$dbuser	=	'';
	private	$dbpwd	=	'';
	private	$dbs	=	'';
	private $dbip	=	'localhost';
	private $dbport	=	'27017';
	private $mongo	=	null;
	private $model  = 	null;

	
	public function __construct($dbconfig=array()){
		if(!isset($dbconfig['dbuser']))
			throw new MongoException('MONGO DB ERROR:dbuser must exist');
		if(!isset($dbconfig['dbpwd']))
			throw new MongoException('MONGO DB ERROR:dbpwd must exist');
		if(!isset($dbconfig['dbs']))
			throw new MongoException('MONGO DB ERROR:dbs must exist');
		$this->dbuser	=  $dbconfig['dbuser'];
		$this->dbpwd	=  $dbconfig['dbpwd'];
		$this->dbs	=  $dbconfig['dbs'];
		$this->dbip	=  isset($dbconfig['dbip'])?$dbconfig['dbip']:'localhost';
		$this->dbport	=  isset($dbconfig['dbport'])?$dbconfig['dbport']:'27017';
		$this->connect();
		$this->setModel();	
	}

	protected function connect(){
		$this->mongo=new MongoClient('mongodb://'.$this->dbuser.':'.$this->dbpwd.'@'.$this->dbip.':'.$this->dbport.'/'.$this->dbs);
	         
	}
       //deprecated
        protected function auth(){
		$aut=$this->mdb->authenticate($this->dbuser,$this->dbpwd);
          if(empty($aut['ok'])){
            	throw new MongoException('MONGO DB ERROR:can not connect');
          }            
          }
         public function setModel(){
		$dbs=$this->dbs;
		$mdb=$this->mongo->$dbs;
		if(empty($mdb))
			throw new MongoException('MONGO DB ERROR:can not  connect'); 
		$this->model=new Model($mdb);
        }
	public function getModel(){
		return $this->model;
	}
	
}



?>
