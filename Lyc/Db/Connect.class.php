<?php
    /*  Copyright (C) 2014 apoyl.com. All Rights Reserved.
    /*  Author:凹凸曼
    /*  Email: jar-c@163.com 
    /*  连接数据 Lyc\Db\Connect.class.php
    */
  namespace Lyc\Db;
  use Lyc\Db\DbException;
  class Connect extends Config{
      private $db=null;
      static  $_instance;
      public function __construct($dbarr=array()){
          parent::__construct($this);
	  if($dbarr){
		$this->myhost=$dbarr['myhost'];
		$this->dbname=$dbarr['dbname'];
		$this->dbport=$dbarr['dbport'];
		$this->dbroot=$dbarr['dbroot'];
		$this->dbpwd=$dbarr['dbpwd'];
		$this->dbcharset=isset($dbarr['dbcharset'])?$dbarr['dbcharset']:'gb2312';
		$this->linkstyle=isset($dbarr['linkstyle'])?$dbarr['linkstyle']:0;
		$this->dbstyle=isset($dbarr['dbstyle'])?$dbarr['dbstyle']:'mysql';
		
	  }
          $this->db=$this->connectDb();
	  
      }
      private function connectDb(){
         if($this->linkstyle==1){
             //持久连接待续
         //  mysql_pconnect($this->myhost.':'.$this->dbport,$this->dbroot,$this->dbpwd) or die($this->dbstyle.' failure !');
           throw new DbException('mysql_pconnect is error ! ');
         }else{

            $confunc=$this->dbstyle.'_connect';
            $link=@$confunc($this->myhost.':'.$this->dbport,$this->dbroot,$this->dbpwd);
            if(!$link){
		
		throw new DbException($this->dbstyle.' failure !');
            }
            $confunc=$this->dbstyle.'_query';
            if($this->dbstyle=='mysql'){
            $confunc("set names '".$this->dbcharset."'",$link);
            }
            $confunc=$this->dbstyle."_select_db";
            $confunc($this->dbname,$link) or die ($this->dbstyle.' select_db failure');
            return $link;
         }
      }
     static public function getInstance($dbarr=array()){
          if(is_null(self::$_instance)){
               self::$_instance=new self($dbarr);

          }

          return self::$_instance;
      }
    public function getDb(){
         return $this->db;
    }  
    public function close(){
        $confunc=$this->dbstyle.'_close';
        @$confunc($this->db);
    }
    
    public function getDbStyle(){
        return $this->dbstyle;
    }
  }   
?>
