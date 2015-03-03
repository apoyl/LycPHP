<?php
    /*  Copyright (C) 2014-2015 apoyl.com. All Rights Reserved.
    /*  Author:凹凸曼
    /*  Email: jar-c@163.com 
    /*  算法接口 Lyc\Algorithm\AlgorithmInterface.class.php
    */
namespace Lyc\Algorithm;

Interface AlgorithmInterface{
    
    //冒泡排序 
    public function bubbleSort(array $arr);
    
    //快速排序
    public function quickSort(array $arr);
    
    //直接插入排序
    public function insertSort(array $arr);
    
    //直接选择排序
    public function selectSort(array $arr);
    
    //二分查找（已排好序数组里查找某个元素)
    public function binSearch(array $arr,$k,$low=0,$high=-1);
    
    //顺序查找（数组里查找某个元素）
    public function seqSearch(array $arr,$k);
    
} 
?>
