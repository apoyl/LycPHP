<?php
    /*  Copyright (C) 2014-2015 apoyl.com. All Rights Reserved.
    /*  Author:凹凸曼
    /*  Email: jar-c@163.com 
     /*  图片类 Lyc\Upload\Image.class.php
     */
namespace Lyc\Upload;
class Image{
    private $suffix=array('image/jpeg','image/pjpeg','image/gif','image/png');
    private $name='';
    private $type='';
    private $size=0;
    private $tmp_name='';
    private $err=0;
    private $url='';
    private $dateline=0;

    public function getDateline()
    {
        return $this->dateline;
    }

	public function setDateline($dateline)
    {
        $this->dateline = $dateline;
    }

	public function getUrl()
    {
        return $this->url;
    }

	public function setUrl($url)
    {
        $this->url = $url;
    }

	public function getName()
    {
        return $this->name;
    }


    public function getType()
    {
        return $this->type;
    }


    public function getSize()
    {
        return $this->size;
    }

    public function getTmp_name()
    {
        return $this->tmp_name;
    }


    public function getErr()
    {
        return $this->err;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function setType($type)
    {
        $this->type = $type;
    }


    public function setSize($size)
    {
        $this->size = $size;
    }

    public function setTmp_name($tmp_name)
    {
        $this->tmp_name = $tmp_name;
    }

    public function setErr($err)
    {
        $this->err = $err;
    }

	//类型验证
    public function verifSuffix(){
        if(in_array($this->type,$this->suffix))
            return true;
        else 
            return false;
        
    }
    public function getPostfix(){
        $str='imgbatch';
        switch ($this->type){
            case 'image/pjpeg':
            case 'image/jpeg':$str='.jpg';break;
            case 'image/gif':$str='.gif';break;
            case 'image/png':$str='.png';break;
            
        }
        return $str;
    }
    

    
} 
?>
