<?php
    /*  Copyright (C) 2014-2015 apoyl.com. All Rights Reserved. 
    /*  Author:凹凸曼
    /*  Email: jar-c@163.com  
    /*  上传测试类 Test\UploadTest.class.php
    */
namespace Test;
use Lyc\Upload\Upload;
use Lyc\Loader\Autoloader;
require_once __DIR__.'/../Lyc/Loader/Autoloader.class.php';
Autoloader::getInstance();

class UploadTest extends LycTest{
    public function __construct(){
    	date_default_timezone_set('Asia/Shanghai');
	parent::__construct($this);
    }
    
    public function uploadimgTest(){
	if(@$_POST['sub']=='go'){
		//UPLOADDIR 定义上传文件位置
		define('UPLOADDIR',__dir__.'/upd');
		$upload=new Upload('imgs',UPLOADDIR);
		$re=$upload->move();
		//返回0表示上传成功
		$this->assertEqual($re,0);
		$con=$upload->getContainer();
		foreach($con as $k=>$v){
			if($v->getSize()>80000)
				echo '<p>Pic'.$k.':<a href="'.$v->getUrl().'" target="_blank"><img width="200"  src="'.$v->getUrl().'"</a></p>';
			else
				echo '<p>Pic'.$k.':<a href="'.$v->getUrl().'" target="_blank"><img   src="'.$v->getUrl().'"</a></p>';
		}
		
	}else{
		echo <<<EOT
<form  name="pform" method="post" id="pform" action="./UploadTest.class.php" enctype="multipart/form-data" >
Pic0:<input type="file"  name="imgs[]"  >
Pic1:<input type="file"  name="imgs[]"  >
<br/>
<input type="submit" value="go" name="sub"/>
</form>
EOT;
	}
   }
}    
      new UploadTest();   
?>
