<?php
    /*  Copyright (C) 2014 apoyl.com. All Rights Reserved.
    /*  Author:凹凸曼
    /*  Email: jar-c@163.com
    /*  操作数据库 Lyc\Db\Manager.class.php
    */
    namespace Lyc\Db;
    class Manager implements DbInterface{
        
        private $connect=null;
        
        public function __construct($dbarr=array()){
            $this->connect=Connect::getInstance($dbarr);
        }
       //以数组的方式返回，多行数据 
        public function fetchArray($sql=null){
            
            if(empty($sql)){
               throw new DbException('<b>SQL ERROR</b> : null query ! <br>');
            }
            $query=$this->query($sql);
            if($query===false) return null;
            $confunc=$this->connect->getDbStyle().'_fetch_array';
            while($arr=$confunc($query)){
                $array[]=$arr;
            }
		
            if(!is_array($array)) return null;
           
                foreach($array as $k=>$v){
                    foreach($v as $kk=>$vv){
                        if(is_numeric($kk)) continue;
                        $arr[$k][$kk]=$vv;
                    }
                }
            return $arr;
        }
        //以数组的方式返回，多行数据  严格的按照类型返回
        public function fetchArrayStrict($sql=null){
            
            if(empty($sql)){
               throw new DbException('<b>SQL ERROR</b> : null query ! <br>');
            }
            $query=$this->query($sql);
            if($query===false) return null;
            $confunc=$this->connect->getDbStyle().'_fetch_array';
            while($arr=$confunc($query)){
                $array[]=$arr;
            }

            if(!is_array($array)) return null;
                       
                foreach($array as $k=>$v){
                    foreach($v as $kk=>$vv){
                        if(!is_numeric($kk)) continue;
                        $type=mysql_field_type($query,$kk);
                        $name=mysql_field_name($query,$kk);

                        if($type=='int'){
                            $arr[$k][$name]=(int)$vv;
                        }else{
                            $arr[$k][$name]=$vv;
                        }
                    }
                }

            return $arr;
        }
        
       //以对象的方式返回数据
       public function fetchArrayObject($sql=null){
            if(empty($sql)){
               throw new DbException('<b>SQL ERROR</b> : null query ! <br>');
            }
            $query=$this->query($sql);
            if($query===false) return null;
            $confunc=$this->connect->getDbStyle().'_fetch_object';
            while($arr=$confunc($query)){
                $array[]=$arr;
            }

            return $array;
       }
        //以数组的方式返回，一行数据
        public function fetchRow($sql=null){
            if(empty($sql)){
                throw new DbException('<b>SQL ERROR</b> : null query ! <br>');
            }
            $query=$this->query($sql);
            if($query===false) return null;
            $confunc=$this->connect->getDbStyle().'_fetch_array';
            $arr=@$confunc($query);
            if(!is_array($arr)) return null;
            foreach($arr as $k=>$v){
                if(is_numeric($k)) continue;
                $arra[$k]=$v;
            }
            return $arra;
        }
       //添加一条记录
       public function add($arr=array(),$tab){
           if(!is_array($arr)){
               throw new DbException('<b>ARRAY ERROR</b> : null ! <br>');
           }
	   $common=$fields=$values='';
           foreach($arr as $k=>$v){
                 $fields.=$common.$k;
                 $values.=$common."'".$v."'";
                 $common=',' ; 
           }
           $query=$this->query('insert into '.$tab.'('.$fields.') values('.$values.')');
            if($query===false) return null;
           return $query;
       }
      
       //更新一条记录
       public function update($arr=array(),$tab,$where){
           if(!is_array($arr)){
               throw new DbException('<b>ARRAY ERROR</b> : null !<br>');
           }
           $common='';
           foreach($arr as $k=>$v){
               $strings.=$common.$k.'="'.$v.'"';
               $common=',';
           }
           $query=$this->query('update '.$tab.' set '.$strings.'  where  '.$where);
            if($query===false) return null;
           return $query;
       }
       
       //删除记录
       public function remove($tab,$where=''){
           if(!empty($where)) $where='where '.$where; 
           $query=$this->query('delete from '.$tab.' '.$where.'');
            if($query===false) return null;
           return $query;
           
       }
             
       //得到列记录
       public function fetchColArray($sql=null){
            if(empty($sql)){
                throw new DbException('<b>SQL ERROR</b> : null query ! <br>');
            }
            $arr=$this->fetchArray($sql);
            if(!is_array($arr)) return null;
            foreach($arr as $k=>$v){
                foreach($v as $kk=>$vv){
                  $array[$kk][]=$vv;
                }
            }
            return $array;
       }
      //得到当前插入记录的id 
      public function getInsertId(){
          $confunc=$this->connect->getDbStyle().'_insert_id';
          return $confunc($this->connect->getDb());
      }
      //得到所有记录总和
       public function getNumRows($sql=null){
            if(empty($sql)){
                throw new DbException('<b>SQL ERROR</b> : null query ! <br>');
            }           
           $confunc=$this->connect->getDbStyle().'_num_rows';
           $query=$this->query($sql);
            if($query===false) return null;           
           $nums=$confunc($query);
           return $nums;
       }
       
       //受影响的所有的行数
       public function getAffectedRows(){
           $confunc=$this->connect->getDbStyle().'_affected_Rows';
           return $confunc();
           
       }
        //执行一条sql查询
        private function query($sql){
            $confunc=$this->connect->getDbStyle().'_query';

            $result=$confunc($sql,$this->connect->getDb());
             if(!$result) $this->queryError($sql);
            return $result;
        }
        
      public function close(){
          $this->connect->close();
      }
      
      private function queryError($sql){
          $e=new Debug();
          $e->getDebug()==-1?0:($e->getDebug()==0?$e->queryError($sql):$e->queryDebug($sql));

       }
	   
	 public  function getTables(){
	 		$tables=array();
			$t=$this->fetchArray('show tables');
			foreach($t as $k=>$v){
				$tables[]=$v;
			}
			return $tables;
	 
	 }
   }
?>
