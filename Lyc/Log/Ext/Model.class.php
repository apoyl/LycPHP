<?php
    /*  Copyright (C) 2014 apoyl.com. All Rights Reserved.
    /*  Author:凹凸曼
    /*  Email: jar-c@163.com
    /*  日志数据模型 Lyc\Log\Model.class.php
    */
namespace Lyc\Log\Ext;
use Lyc\Log\LogException;
class Model{
    public $time=0;
    public $ip='';
    public $author='';
    public $ac='';
    public $content='';
    public $url='';
    
    public function __construct($data=array()){
        $this->deal($data);
    }
    
    private function deal($data){
        if(!($data&&is_array($data))){
             throw new LogException('LOG ERROR:null param');
        }
        
          foreach($data as $k=>$v){
                $this->{$k}=$v;
            }
    }
}   
      
?>
