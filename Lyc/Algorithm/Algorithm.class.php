<?php
    /*  Copyright (C) 2014-2015 apoyl.com. All Rights Reserved.
    /*  Author:凹凸曼
    /*  Email: jar-c@163.com 
    /*  算法类 Lyc\Algorithm\Algorithm.class.php
    */
namespace Lyc\Algorithm;
class Algorithm implements AlgorithmInterface{
    
    //冒泡排序 
    public function bubbleSort(array $arr){
    	$len=count($arr);
	if($len<=1) return $arr;
	for($i=1;$i<$len;$i++){
		for($j=0;$j<$len-$i;$j++){
			if($arr[$j]>$arr[$j+1]){
				$p=$arr[$j];
				$arr[$j]=$arr[$j+1];
				$arr[$j+1]=$p;
			}
		}
	}
	return $arr;	
    }
    
    //快速排序
    public function quickSort(array $arr){
    	$len=count($arr);
	if($len<=1) return $arr;
	$b=$arr[0];
	$larr=$rarr=array();
	for($i=1;$i<$len;$i++){
		if($b>$arr[$i]){
			$larr[]=$arr[$i];
		}else{
			$rarr[]=$arr[$i];
		} 		
	}	    
	return array_merge($this->quickSort($larr),array($b),$this->quickSort($rarr));
    }
    
    //直接插入排序
    public function insertSort(array $arr){
	$len=count($arr);
	if($len<=1) return $arr;
	for($i=1;$i<$len;$i++){
		$t=$arr[$i];
		for($j=$i-1;$j>=0;$j--){
			if($t>$arr[$j]) break;
			$arr[$j+1]=$arr[$j];
			$arr[$j]=$t;
		}
	}        
	return $arr;
    }
    
    //直接选择排序
    public function selectSort(array $arr){
	$len=count($arr);
	if($len<=1) return $arr;
	for($i=0;$i<$len-1;$i++){
		$m=$i;
		for($j=$i+1;$j<$len;$j++){
			if($arr[$j]<$arr[$m]){
				$m=$j;
			}
		}
		if($m!=$i){
			$t=$arr[$i];
			$arr[$i]=$arr[$m];
			$arr[$m]=$t;
		}	
	} 
	return $arr;
    }
    
    //二分查找（已排好序数组里查找某个元素)
    public function binSearch(array $arr,$k,$low=0,$high=-1){
	if(!$arr) return -1;
	$len=count($arr);
	if($len==1){
		if($k==$arr[0]) return 0;
		return -1;
	}
	if($high==-1){
		$high=$len;
	}	
	if($low==$high){
		if($k==$arr[$low]) return $low;
	}
	elseif($low<$high){
		$m=intval(($low+$high)/2);
		if($k==$arr[$m]){
			return $m;
		}
		elseif($k>$arr[$m]){
			return $this->binSearch($arr,$k,$m+1,$high);
		}else{
			return $this->binSearch($arr,$k,$low,$m-1);
		}
	}
	return -1;	
    }
    
    //顺序查找（数组里查找某个元素）
    public function seqSearch(array $arr,$k){
	if(!$arr) return -1;
	foreach($arr as $kk=>$v){
		if($v==$k) return $kk;	
	}
	return -1;
    }
    
} 
?>
