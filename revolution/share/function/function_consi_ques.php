<?php
	header("Content-type:text/html;charset=utf-8");
	/*----------------------------------------------
	@date:2015-04-06
	@desciption   从表中获得的字段
		$table: 要查询的表名
		$attr:  要查询的属性
		return： 一个数组
	----------------------------------------------*/
	function get_attrs_from_table($sql,$indexT=MYSQL_ASSOC){		 
		$s=SqlHelper::getObj();
		//$n=SqlHelper::getConn();
		//var_dump($n);
		if(!empty($s)){
			if($indexT==MYSQL_ASSOC){
				$res=$s->execute_dql2($sql);
			}else{
				$res=$s->execute_dql2($sql,$indexT);
			}
			//$s->close_connect();
			return $res;
		}
	}
	function insert_into_table($sql){		 
		$s=SqlHelper::getObj();

		if(!empty($s)){
			$res=$s->execute_dql($sql);
			//$s->close_connect();
			return $res;
		}
	}
	/*----------------------------------------------

	@date:2015-04-06
	@desciption   从下拉杆的字段中获取id
		$loop_str：  要循环的字符串 
		return： 一个下标
	----------------------------------------------*/
	function get_string_sub_id($loop_str){
		$r=0;
		for($i=0;$i<strlen($loop_str);$i++){
			if($loop_str[$i]=='-'){
				$r=$i; 
				break;
			}
		}
		$result_arr=substr($loop_str,0,$r);
		return $result_arr;
	}
	/*----------------------------------------------

	@date:2015-04-06
	@desciption   从下拉杆的字段中获取难度系数
		$loop_str：  要循环的字符串 
		return： 一个下标
	----------------------------------------------*/
	function get_string_sub_diff($loop_str){
		$s=array();
		$flag=0;
		for($i=0;$i<strlen($loop_str);$i++){
			if($loop_str[$i]=='-'&& $flag==0 ){
				$s->push($i);
				$flag++;
			}
			else if($loop_str[$i]=='-'&& $flag==1 ){
				$s->push($i);
			}
			$len=$s[1]-$s[0];
			$res_st=substr($loo, $s[0],$len);
			return  $res_st;
		}
	}


	/*----------------------------------------------

	@date:2015-04-20
	@desciption  获取用户的饿ip地址
		return： 用户的IP地址
	----------------------------------------------*/
function get_real_ip(){ 
	$ip=false; 
	if(!empty($_SERVER['HTTP_CLIENT_IP'])){ 
		$ip=$_SERVER['HTTP_CLIENT_IP']; 
	}
	if(!empty($_SERVER['HTTP_X_FORWARDED_FOR'])){ 
		$ips=explode (', ', $_SERVER['HTTP_X_FORWARDED_FOR']); 
		if($ip){ array_unshift($ips, $ip); $ip=FALSE; }
		for ($i=0; $i < count($ips); $i++){
			if(!eregi ('^(10│172.16│192.168).', $ips[$i])){
				$ip=$ips[$i];
				break;
			}
		}
	}
	return ($ip ? $ip : $_SERVER['REMOTE_ADDR']); 
}