<?php
    /*  Copyright (C) 2014 apoyl.com. All Rights Reserved.
    /*  Author:凹凸曼
    /*  Email: jar-c@163.com  
    /*  fsockopen 封装 Lyc\Url\Adapter\Sock.class.php
    */ 
namespace Lyc\Url\Adapter;
use Lyc\Url\UrlAbstract;
use Lyc\Url\UrlException;
class Sock extends UrlAbstract{
    
    private $path='';      
    private $port='';
    private $host='';
    private $query='';    
    private $timeout=25;
    private $fp=null;       
    private $proxy=array('host'=>'','port'=>80,'timeout'=>30);
    private $code=0;
    public function __construct(){
    	if(!function_exists('fsockopen'))
		throw new UrlException('SOCK ERROR:fsockopen does not exist');
    } 
    public function get($url,$cookie=false){
         $this->init($url);          

        $req="GET ".$this->path." HTTP/1.1\r\n";
        $req.="Host: ".$this->host."\r\n";
        $req.="Connection: Close\r\n";
        $req.="Cookie: $cookie\r\n";
        $req.="\r\n";
        fwrite($this->fp,$req);
	$re='';
	$re=fgets($this->fp,512);
	$this->code=(int)substr($re,9,3);
        while(!feof($this->fp)){
           $re.=fgets($this->fp,1024);
         }
        fclose($this->fp);
        return substr($re,strpos($re,"\r\n\r\n")+8);
        
        
    }
    public function post($url,$data=array(),$cookie=false,$referrer=''){
       $this->init($url);
	$str='';      
       if($data&&is_array($data)){   
          $str=http_build_query($data);                               
        }

       $req="POST ".$this->path." HTTP/1.1\r\n";
       $req.="Host: ".$this->host."\r\n";
       $req.="Referrer: $referrer\r\n";
       $req.="Content-type: application/x-www-form-urlencoded\r\n";
       $req.="Content-Length: ".strlen($str)."\r\n";
       $req.="Connection: Close\r\n";
       $req.="Cookie: $cookie\r\n\r\n";
       $req.="$str\r\n";
       fwrite($this->fp,$req);
		
	$header=$re='';
	$re=fgets($this->fp,512);
	$this->code=(int)substr($re,9,3);	
       while(!feof($this->fp)){
           $re.=fgets($this->fp,1024);
       }
	
       fclose($this->fp);
       return substr($re,strpos($re,"\r\n\r\n")+8);   

       
              
    }
    /**
    * 初始化，打开fsockopen连接
    * 
    * @param mixed $url
    */
    private function init($url){
        $this->parseUrl($url);
	$host=$this->host;
	$port=$this->port;
	$timeout=$this->timeout;
	if(!empty($this->proxy['host'])){
		$host=$this->proxy['host'];
		$port=isset($this->proxy['port'])?$this->proxy['port']:80;
		$timeout=isset($this->proxy['timeout'])?$this->proxy['timeout']:30;
	}				
        $this->fp=@fsockopen($host,$port,$errno,$errstr,$timeout);
        if(!$this->fp){
            throw new UrlException('SOCK ERROR: cannot open');
        }    
    }
    /**
    * 解析url
    * 
    * @param mixed $url
    */
    private function parseUrl($url){
        if(empty($url)){
            throw new UrlException('SOCK ERROR: url cannot empty');
        }
           $arr=parse_url($url);
           $this->path=(isset($arr['path'])?$arr['path']:'/').(isset($arr['query'])?'?'.$arr['query']:'');
           $this->port=isset($arr['port'])?$arr['port']:80;
           $this->host=$arr['host'];
           
    }
    public function setProxy($proxy){
	$this->proxy=$proxy;
    }
    public function getCode(){
	return $this->code;
    }
}
?>
