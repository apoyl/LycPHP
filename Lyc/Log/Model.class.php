<?php
    /*  Copyright (C) 2014 apoyl.com. All Rights Reserved.
    /*  Author:凹凸曼
    /*  Email: jar-c@163.com
    /*  配置文件 Lyc\Log\Model.class.php
    */
namespace Lyc\Log;
class Model{
    public $time=0;
    public $author='';
    public $ip='';
    public $ac='';
    public $content='';
    public $url='';
    
    public function __construct($data=array()){
        $this->deal($data);
    }
    
    private function deal($data){
        if(!($data&&is_array($data))){
             throw new LogException('MODEL ERROR:param');
        }
        
          foreach($data as $k=>$v){
                $this->{$k}=$v;
            }
    }
}   
      
?>
