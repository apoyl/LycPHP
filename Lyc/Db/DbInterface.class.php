<?php
    /*  Copyright (C) 2014 apoyl.com. All Rights Reserved.
    /*  author:凹凸曼
    /*  email: jar-c@163.com 
    /*  操作数据库接口 Lyc\Db\DbInterface.class.php
    */
   namespace  Lyc\Db;
   interface DbInterface{
       
       //以数组的方式返回，多行数据 
       public function fetchArray($sql=null);
       
       //以对象的方式返回数据
       public function fetchArrayObject($sql=null);
       
       //以数组的方式返回，一行数据
       public function fetchRow($sql=null);
       
       //添加一条记录
       public function Add($arr=array(),$tab);
              
       //更新一条记录
       public function update($arr=array(),$tab,$where);
       
       //删除记录
       public function remove($tab,$where='');
             
       //得到列记录
       public function fetchColArray($sql=null);
       
       //得到当前插入记录的id
       public function getInsertId();
       
       //得到所有记录总和
       public function getNumRows($sql=null);
       
       //受影响的行数
       public function getAffectedRows();
       
   } 
?>
