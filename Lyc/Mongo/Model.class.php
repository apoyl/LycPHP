<?php
    /*  Copyright (C) 2014 apoyl.com. All Rights Reserved.
    /*  Author:凹凸曼
    /*  Email: jar-c@163.com  
    /*  Mongo数据库操作类 Lyc\Mongo\Model.class.php
    */
namespace Lyc\Mongo;
class Model implements MongoInterface{
    protected $db=null;
    protected $name='';
    protected $primary='';
    
    public function __construct($db){
        $this->db=$db;
    }

    public function add(array $data){
        $col=$this->getCollection();
        return $col->insert($data);
    }

    public function del(array $query){
        $col=$this->getCollection();	
        return $col->remove($query);
    }

    public function update($query=array(),$set=array()){
        $col=$this->getCollection();
        return $col->update($query,$set);
    }

    public function getAll($query=array(),$fields=array()){
        $col=$this->getCollection();
        $cursor=$col->find($query,$fields);
        while($cursor->hasNext()){
            $r[]=$cursor->getNext();
        }
        return $r;
    }
    public function setTable($name){
	if(empty($name))
		throw new MongoException('MONGO DB ERROR:tablename must exist');
        $this->name=$name;
	return $this;
    }
    public function setPrimary($name){
	if(empty($name))
		throw new MongoException('MONGO DB ERROR:primary key must exist');
        $this->primary=$name;
	return $this;
    }

    public function getOne($query=array(),$fields=array()){
        $col=$this->getCollection();
        $r=$col->findOne($query,$fields);
 
        return $r;
    }

    protected function getCollection(){
        $db=$this->db;
        $name=$this->name;
        return $db->$name;        
    }

    public function search($skip=0,$limit=0,$sort=array(),$query=array(),$fields=array()){
        $col=$this->getCollection();
        $cursor=$col->find($query,$fields)->sort($sort)->skip($skip)->limit($limit);
        while($cursor->hasNext()){
            $r[]=$cursor->getNext();
        }
        return $r;
    }
    
    public function totalNum($query=array(),$fields=array()){
        $col=$this->getCollection();
        return $col->find($query,$fields)->count();
    }

    public function getLastPri(){
        $arr=$this->search(0,1,array($this->primary=>-1),array(),array($this->primary));
            
        return $arr[0][$this->primary];
    }
   
}    
 
?>
