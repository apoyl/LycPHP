<?php
    /*  Copyright (C) 2014 apoyl.com. All Rights Reversed.
    /*  Author:凹凸曼
    /*  Email: jar-c@163.com  
    /*  算法测试类 Test\AlgorithmTest.class.php
    */ 
namespace Test;
use Lyc\Algorithm\Algorithm;
use Lyc\Url\Url;
use Lyc\Loader\Autoloader;
require_once __DIR__.'/../Lyc/Loader/Autoloader.class.php';
Autoloader::getInstance();
class AlgorithmTest extends LycTest{
    public function __construct(){
	parent::__construct($this);
    }
    //冒泡测试
    public function bubbleTest(){
	$alg=new Algorithm();
	$arr=array(32,96,-3,24,2,3,100);
	$data=$alg->bubbleSort($arr);
	$this->assertEqual($data,array(-3,2,3,24,32,96,100));	
    }
   //快速排序测试
    public function quickTest(){
	$alg=new Algorithm();
	$arr=array(23,-7,79,23,35,98,2);
	$data=$alg->quickSort($arr);
	$this->assertEqual($data,array(-7,2,23,23,35,79,98));
    }
   //选择排序测试
    public function selectTest(){
   	$alg=new Algorithm();
	$arr=array(34,26,-3,67,4,2);
	$data=$alg->selectSort($arr);
	$this->assertEqual($data,array(-3,2,4,26,34,67));
    }
    //插入排序测试
    public function insertTest(){
	$alg=new Algorithm();
	$arr=array(65,2,-45,79,1);
	$data=$alg->insertSort($arr);
	$this->assertEqual($data,array(-45,1,2,65,79));
    }
    //二分查找（已排好序数组里查找某个元素)
    public function binSearchTest(){
	$alg=new Algorithm();
	$arr=array(-3,2,3,10,11,22,33,55);
	$f=$alg->binSearch($arr,22);
	$this->assertEqual($f,5);
    }
    //顺序查找
    public function seqSearchTest(){
	$alg=new Algorithm();
	$arr=array(43,2,-5,28,54);
	$f=$alg->seqSearch($arr,54);
	$this->assertEqual($f,4);
    }
    
}

new AlgorithmTest();
?>
