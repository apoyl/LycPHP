<?php
    /*  Copyright (C) 2014 apoyl.com. All Rights Reserved.
    /*  Author:凹凸曼
    /*  Email: jar-c@163.com
    /*  Log接口 Lyc\Log\LogInterface.class.php
    */
namespace Lyc\Log;
Interface LogInterface{
	/*
	* 写入日志文件
	*/
	public function write($data);
	
	/*
	* 读取日志文件,在内存
	*/
	public function read($start,$limit);

}
?>
