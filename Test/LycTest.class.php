<?php
    /*  Copyright (C) 2014 apoyl.com. All Rights Reserved.
    /*  Author:凹凸曼
    /*  Email: jar-c@163.com
    /*  测试基类 框架 Test\LycTest.class.php
    */
   namespace Test;
   class LycTest{
       private $child=null;
       private $sta=null;  //统计
       protected $methods;  //调用方法  数组
       public function __construct($obj){
       date_default_timezone_set('Asia/Shanghai');
           $this->initIncludePath();
           $this->child=$obj;
           $this->sta=new Sta();
           $this->Auto();
           $this->shutdown();
       }
       //脚本执行完毕，调用此函数  
       private function shutdown(){
           
           register_shutdown_function(array($this,'toHtml'));
           
       }
       //设置环境变量
       private function initIncludePath(){
              $dir=dirname(__FILE__);
              $dirlyc=str_replace(DIRECTORY_SEPARATOR.'Test','',$dir);
               set_include_path(implode(PATH_SEPARATOR,array($dirlyc,get_include_path()))); 
       }
       //自动加载类对应的(.*)Test方法
       private function Auto(){
           $methods=get_class_methods($this->getClass());
           $this->methods=$this->getMethods($methods);
           foreach($this->methods as $v){
               $this->child->$v(); 
           }
       }
       //获取类名
       private function getClass(){
           return get_class($this->child);
       }
       //过滤test 方法
       private function getMethods($methods){
                 $arr=preg_grep('/^(\w)+(Test)$/',$methods);
                 return $arr;
       }
       //获取运行记录信息
       private function getClassMsg(){
           if(function_exists("debug_backtrace")){
                  return array_reverse(debug_backtrace());
           }
           return array();
       }
        //获取行数
       private function showLine(){
           $stack=$this->getClassMsg();
           foreach($stack as $v){
                if(strncmp($v['function'],'assert',strlen('assert'))==0){

                    return ' at [' . $v['file'] . ' line ' . $v['line'] . ']';                    
                }
           }
           
           return '';

       }
       //判断变量值是否大于等于某个数字 默认大于等于0
       protected function assertGe($param1,$param2=0){
              
		if(is_numeric($param1)&&is_numeric($param2)&&$param1>=$param2){
		   $this->sta->increaseRight();
		   return;
		 }
		
		
		$this->dealMsg('assertGe',$param1,$param2);	
	}
       //两个变量值（数字、字符、数组、对象） 是否相等
       protected function assertEqual($param1,$param2){
               if($this->aO($param1,$param2)){
	       	   $this->sta->increaseRight();
		   return;
		}
               if($this->aE($param1,$param2)){
                   $this->sta->increaseRight();
                   return;
               }
		$this->dealMsg('assertEqual',$param1,$param2);	       
        }
       private function  dealMsg($method,$param1,$param2){
		 $msg=$this->getClass().'-&gt'.'  '.$method.' expectation fails ['.(is_object($param1)?'OBJECT '.get_class($param1):(is_array($param1)?'Array':$param1)).'] and ['.(is_object($param2)?'OBJECT '.get_class($param2):(is_array($param2)?'Array':$param2)).']';
		$this->sta->errors($msg.$this->showLine());
		$this->sta->increaseWrong();
 
	}
       private function  aE($param1,$param2){
               $f=TRUE;     //初始化参数成功
               if(is_array($param1)&&is_array($param2)){
		   if(count($param1)!=count($param2)) 
			$f=FALSE;
		   else{
                   	foreach($param1 as $k=>$v){
                        	if(isset($param2[$k])&&$v!==$param2[$k]){
                            
                             		 $f=FALSE;
                              		break;
                       		 }
                      	} 
		   }
               }else if($param1!==$param2){
                   $f=FALSE; 
               }
		
               return $f;       
      }
      //判断对象
      private function aO($param1,$param2){
      	       $f=TRUE;
	       if(is_object($param1)||is_object($param2)){
	       		$p1=is_object($param1)?get_class($param1):$param1;
			$p2=is_object($param2)?get_class($param2):$param2;
	       		if($p1!=$p2){
	       			$f=FALSE;
	      		 }
		}else{
			$f=FALSE;
		}

	       return $f;
      }
       //显示效果
       public function toHtml(){
            $html=new Html('utf-8');
            $html->head($this->getClass());
            $html->body($this->sta);
            $html->foot($this->sta);
       }
   }
//html输出类
class   Html{
    
    protected $char_set='';
    
    public function __construct($char_set = 'ISO-8859-1'){
             $this->char_set=$char_set;
    }
                                             
    public function  head($testclass){ 
        $this->sendNoCacheHeaders(); 
        print "<!DOCTYPE HTML PUBLIC \"-//W3C//DTD HTML 4.01 Transitional//EN\" \"http://www.w3.org/TR/html4/loose.dtd\">";
        print "<html>\n<head>\n<title>$testclass</title>\n";
        print "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=" .
                $this->char_set . "\">\n";
        print "<style type=\"text/css\">\n";
        print "</style>\n";
        print "</head>\n<body>\n";
        print "<h1>$testclass</h1>\n";
        flush();
    }
    function sendNoCacheHeaders() {
        if (! headers_sent()) {
           // header("Expires: Mon, 26 Jul 2016 10:00:00 GMT");
            header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
            header("Cache-Control: no-store, no-cache, must-revalidate");
            header("Cache-Control: post-check=0, pre-check=0", false);
            header("Pragma: no-cache");
        }
    }    
    public function body($staobj){
          if($arr=$staobj->getErrors()){
              foreach($arr as $v){
              print '<div><strong style="color:red">Error:</strong>'.$v.'</div>';
              }
          } 
    } 

    public function foot($staobj){
        $colour = ($staobj->getWrong()> 0 ? "red" : "blue");
        print "<div style=\"";
        print "padding: 8px; margin-top: 1em; background-color: $colour; color: white;";
        print "\">";
        print " test cases complete:\n";
        print "<strong>" . $staobj->getRight() . "</strong> passes, ";
        print "<strong>" . $staobj->getWrong() . "</strong> fails  ";
        print "</div>\n";
        print "</body>\n</html>\n";        
    }
}
//统计类
class Sta{
    private $right=0;    //成功量
    private $wrong=0;    //失败量
    private $errors=array();  //错误信息 

    
    public function __construct(){
        
    }
    
    public function increaseWrong(){
        $this->wrong++;
    }
    
    public function increaseRight(){
         $this->right++;
    }
    public function  errors($msg){
        $this->errors[]=$msg;
    }
    
    public function getErrors(){
        return $this->errors;
    }
    public function getRight(){
        return $this->right;
    }
    
    public function getWrong(){
        return $this->wrong;
    }
} 
?>
