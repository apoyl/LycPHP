<?php
    /*  Copyright (C) 2014 apoyl.com. All Rights Reserved.
    /*  Author:凹凸曼
    /*  Email: jar-c@163.com  
    /*  Mongo接口 Lyc\Mongo\MongoInterface.class.php
    */
namespace Lyc\Mongo;
Interface MongoInterface{
   
   /**
    * 添加数据
    * 
    * @param array $data
    * @return boolean
    */
    public function add(array $data);

   /**
    * 删除数据
    * 
    * @param array $query
    * @return boolean
    */
    public function del(array $query);

    /**
    * 更新数据
    * 
    * @param array $query 查询的内容
    * @param array $set   需更新的数据
    * 
    */
    public function update($query=array(),$set=array());

    /**
    * 获取数据集合
    * 
    * @param array $query
    * @param array $fields
    * @return array
    */
    public function getAll($query=array(),$fields=array());
    
    //设置表       
    public function setTable($name);
    
    //设置唯一键
    public function setPrimary($name);
    /**
    * 获取一条记录
    * 
    * @param array $query
    * @param array $fields
    * @return array
    */
    public function getOne($query=array(),$fields=array());
 
   /**
    * 搜索函数
    * 
    * @param int $skip
    * @param int $limit
    * @param array $sort
    * @param array $query
    * @param array $fields
    * @return array
    */
    public function search($skip=0,$limit=0,$sort=array(),$query=array(),$fields=array());
   
   /**
    * 根据条件获取数据总数
    * 
    * @param array $query
    * @param array $fields
    * @return  int
    */ 
    public function totalNum($query=array(),$fields=array());
    
    /**
    * 获取唯一键的最大值
    * @return string or int
    */
    public function getLastPri();   
}    
 
?>
