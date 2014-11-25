<?php
    /*  Copyright (C) 2014 apoyl.com. All Rights Reserved.
    /*  author:凹凸曼
    /*  email: jar-c@163.com   
    /*  异常类 Lyc\Db\Debug.class.php
    */
   namespace Lyc\Db; 
   class Debug{
       
     protected $debug=1; //debug 测试 -1:不输出任何信息 0：输出错误信息 1：抛出异常信息及错误信息
    
     public function getDebug(){
         return $this->debug;
     }
    
     //查询输出错误信息
     public function queryError($sql){
         print '<b>SQL ERROR:</b>'.$sql.mysql_errno().' errno '.mysql_error();
         exit;
     }
     //查询异常
     public function queryDebug($sql){
         $oput='SQL ERROR:'.$sql.', line  '.mysql_errno().' ,'.mysql_error().' ';        
         echo "<pre>";
         throw new DbException($oput);
         echo "</pre>";
         exit;
     }
     
   }
?>
