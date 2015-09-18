<?php
    /*  Copyright (C) 2014 apoyl.com. All Rights Reserved.
    /*  Author:凹凸曼
    /*  Email: jar-c@163.com
    /*  自动加载 Lyc\Loader\Autoloader.class.php
    */
   namespace Lyc\Loader; 
   class Autoloader{
       protected $defaultclass=array('Lyc\Loader\Autoloader','loadClass');

       protected static $_instance;
       protected static $_prodir;
       
       public static function getInstance(){
           if(null===self::$_instance){
               self::$_instance=new self();
           }
           
           return self::$_instance;
       }
       
       public function __construct(){
           spl_autoload_register(array(__CLASS__,'loader'));
       }
       
       protected static function loader($class){
           $c=self::getInstance();
           foreach($c as $v){
               if(is_array($v)){
                   $object=array_shift($v);
                   $method=array_shift($v);
                   if($object==null||$method==null){
                       continue; 
                   }

                   if(call_user_func(array($object,$method),$class)){
                       return true;
                   }
               }
           }
       }
       public static function loadClass($class){

          if(class_exists($class,false)){
              return false;
            }
        
	       if(strrpos($class,'\\')){
		      $class=str_replace('\\',DIRECTORY_SEPARATOR,$class);
             }
         if(stripos($class, 'Lyc')===FALSE){
             $file=self::$_prodir.str_replace('_',DIRECTORY_SEPARATOR,$class).'.php';
          }else{
            $lycspace=str_replace('Lyc'.DIRECTORY_SEPARATOR.'Loader','',__DIR__);
            $file=$lycspace.str_replace('_',DIRECTORY_SEPARATOR,$class).'.class.php';
             }
          self::defaultDir($file);

      }
      
      
      public static function defaultDir($file){
          if($file&&file_exists($file)){	

              include $file;
          }
      }
      //设置项目空间
      public static function proDir($prodir){
          self::$_prodir=$prodir;
      }

   }  
?>
