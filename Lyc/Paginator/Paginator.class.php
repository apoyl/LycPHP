<?php
    /*  Copyright (C) 2014 apoyl.com. All Rights Reserved. 
    /*  Author:凹凸曼
    /*  Email: jar-c@163.com
    /*  分页类 Lyc\Paginator\Paginator.class.php
    */  
 namespace Lyc\Paginator;
 
 class Paginator implements PaginatorInterface{
     
      protected $totalrecord=0; //int:总共的记录数
      
      protected $pnum=6; //int:显示页数
      
      protected $precord=20; //int:每页显示的记录数
      
      protected $pcurrent=1; //init:当前的页码
      
      protected $purl=null;  //string:链接
      
      protected $pviews=null; //string:显示分页视图 
      
      protected   $cnsource=array('首页','上一页','下一页','尾页');
      
      protected   $ensource=array('first','pre','next','last');   
         
      protected $enorcn='cn'; //string:默认中文 'cn' 英文 'en'
      
     public function __construct($totalrecord,$pnum,$precord,$pcurrent,$purl){
         if(!is_numeric($totalrecord)||!is_numeric($pnum)||!is_numeric($pnum)||!is_numeric($pcurrent)){
            
             throw  new PaginatorException('page params must be number!');
         }
         $this->totalrecord=$totalrecord;
         $this->pnum=$pnum;
         $this->precord=$precord;
         $this->pcurrent=$pcurrent;
         $this->purl=$purl;
     }

    public function nextpage(){
         $ptotal=$this->getTotalPage();
         $re=$this->pcurrent+1>$ptotal?$ptotal:($this->pcurrent+1<2?2:$this->pcurrent+1);
         return $re;
    }
    public function prepage(){
         $ptotal=$this->getTotalPage();        
        $re=($this->pcurrent-1<1)?1:($this->pcurrent-1>$ptotal?$ptotal-1:$this->pcurrent-1);
        return $re;
    } 
    protected function getTotalPage(){
       return ceil($this->totalrecord/$this->precord);
    }
  
    protected function getUrl(){
        $temurl=$this->purl;
         if(!preg_match('/\?/i',$temurl)){
            $temurl.='?paged=';
        }else{
            $temurl.='&paged=';
        }   
         return $temurl;    
    }
    
    //返回分页视图    
    public function getPviews(){
	$this->pviews='<span>';
        $url=$this->getUrl();
        $ptotal=$this->getTotalPage();        
        $arrsource=$this->enorcn=='en'?$this->ensource:$this->cnsource;
        $this->pviews.='[<a href="'.$url.'1">'.$arrsource[0].'</a>]';
        $this->pviews.='[<a href="'.$url.$this->prepage().'">'.$arrsource[1].'</a>]';
        
        //$this->pviews.=$this->pcurrent<=1?('[<a href="'.$url.'1"><font color="red">1</font></a>]'):('[<a href="'.$url.'1">1</a>]');
        $i=$this->pcurrent-$this->pnum;
        $i=$i<=0?1:$i;
        for($i=$i;$i<$this->pcurrent;$i++){
            $this->pviews.=$this->pcurrent==$i?('[<a href="'.$url.$i.'"><font color="red">'.$i.'</font></a>]'):('[<a href="'.$url.$i.'">'.$i.'</a>]');                 
        }
        for($i=$this->pcurrent;$i<=$this->pnum+$this->pcurrent&&$i<=$ptotal;$i++){
           
            $this->pviews.=$this->pcurrent==$i?('[<a href="'.$url.$i.'"><font color="red">'.$i.'</font></a>]'):('[<a href="'.$url.$i.'">'.$i.'</a>]');                
        }
       /* if(1!=$ptotal){
        $this->pviews.=$this->pcurrent>=$ptotal?('[<a href="'.$url.$ptotal.'"><font color="red">'.$ptotal.'</font></a>]'):('[<a href="'.$url.$ptotal.'">'.$ptotal.'</a>]'); 
        }   */                
        $this->pviews.='[<a href="'.$url.$this->nextpage().'">'.$arrsource[2].'</a>]';
        $this->pviews.='[<a href="'.$url.$ptotal.'">'.$arrsource[3].'</a>]';
        $this->pviews.='</span>';
        return $this->pviews;
    }
     //设置中英文
   public function setLanuage($language){
       $this->enorcn=strtolower($language);
   }

 }   
    
?>
