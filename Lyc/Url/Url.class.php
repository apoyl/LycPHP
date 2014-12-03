<?php
    /*  Copyright (C) 2014 apoyl.com. All Rights Reserved.
    /*  Author:凹凸曼
    /*  Email: jar-c@163.com  
    /*  Url Lyc\Url\Url.class.php
    */  
namespace Lyc\Url;
use Lyc\Url\Adapter\Contents;
use Lyc\Url\Adapter\Curl;
use Lyc\Url\Adapter\Sock;
class Url {
    
                  
    public static function &getInstance($flag=''){
	$robj=null;
        switch($flag){
            case "sock": 
                          $robj = new Adapter(new Sock());
                          break;
            case "curl":  
                          $robj = new Adapter(new Curl());
                          break;
            default    : 
                          $robj =new Adapter(new Contents());
                          break;
        }
	return $robj;
        
    }

}
?>
