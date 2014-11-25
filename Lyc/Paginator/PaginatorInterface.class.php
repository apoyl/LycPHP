<?php
    /*  Copyright (C) 2014 apoyl.com. All Rights Reserved.
    /*  Author:凹凸曼
    /*  Email: jar-c@163.com 
    /*  分页接口 Lyc\Paginator\PaginatorInterface.class.php
    */
  namespace Lyc\Paginator;
  Interface PaginatorInterface{
     //返回分页视图 
     public function getPviews();
     //设置中英文
     public function setLanuage($language);
  }     
?>
