<?php
    /*  Copyright (C) 2014-2015 apoyl.com. All Rights Reserved.
    /*  Author:凹凸曼
    /*  Email: jar-c@163.com 
     /*    试图类 Lyc\View\View.class.php
    */
  namespace Lyc\View;

  class View {
      protected $tpldir='';
      protected $suffix='.phtml';
      protected $vars=array();
      public function __construct($tpldir){
          if(empty($tpldir)){
              echo 'VIEW ERROR: Template path can not be empty ';
              exit;
          }
          $this->tpldir=$tpldir;
      }
      public function tpl($file){
          $fullpath=$this->tpldir.$file.$this->suffix;
          if(!file_exists($fullpath)){
              echo 'VIEW ERROR: Template ['.$file.'] cannot exist';
              exit;
          }
          if($this->vars){
              foreach ($this->vars as $k=>$v){
                  $$k=$v;
              }
          }
          include $fullpath;
      }

      public function setVar($k,$v){
          if(!$k) throw new ViewException('VIEW ERROR: Template variable name can not be empty');
          $this->vars[$k]=$v;
      }

  }     
?>
