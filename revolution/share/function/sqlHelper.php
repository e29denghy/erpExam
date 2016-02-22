<?php
	//这个一个工具类,作用是完成对数据库的操作
	class SqlHelper{
		public static $obj;
		public static $conn;
		private static $dbname="erpexam";
		private static $username="root"; 
		private static $password="123456"; 
		private	 static $host="localhost"; 
		private function __construct(){
            is_resource(SqlHelper::$conn)|| SqlHelper::$conn=mysqli_connect(SqlHelper::$host,SqlHelper::$username,SqlHelper::$password,SqlHelper::$dbname) or die("不能连接数据库 : ".mysqli_connect_error());
			if(!SqlHelper::$conn){
				die("连接失败".SqlHelper::$host."-".SqlHelper::$username."-".SqlHelper::$password."-".mysqli_error());
			}
			mysqli_set_charset(SqlHelper::$conn, "utf8");	
		}
		//获取静态连接
		public static function getConn(){
			if(!isset(SqlHelper::$conn)){
				SqlHelper::$obj=new SqlHelper();
			}
			return SqlHelper::$conn;
		}
		//获取静态对象
		public static function getObj(){
			if(!isset(SqlHelper::$conn)){
				SqlHelper::$obj=new SqlHelper();
			}
			return SqlHelper::$obj;
		}
		//执行dql语句
		public function execute_dql($sql){			
			$res=mysqli_query(SqlHelper::$conn,$sql) or die(mysqli_error(SqlHelper::$conn));
			return $res;
		}
		
		public function execute_dql1($sql){
			
			$res=mysqli_query(SqlHelper::$conn,$sql) or die(mysqli_error());
			$row=mysqli_fetch_assoc($res);
            mysqli_free_result($res);
			return $row;
		}
		
		//执行dql语句，但是返回的是一个数组
		public function execute_dql2($sql,$indexT=MYSQL_ASSOC){
			$arr=array(); 
			$res=mysqli_query(SqlHelper::$conn,$sql) or die(mysqli_error(SqlHelper::$conn));
			while($row=mysqli_fetch_array($res,$indexT)){
				$arr[]=$row;
			}
			//这里就可以马上把$res关闭.
			if(!isset($res)){
				mysqli_free_result($res);
			}
			return $arr;
		}
		//考虑分页情况的查询,这是一个比较通用的并体现oop编程思想的代码
		//$sql1="select * from where 表名 limit 0,6";
		//$sql2="select count(id) from 表名"
		public function exectue_dql_fenye($sql1,$sql2,$fenyePage){
			//这里我们查询了要分页显示的数据
			$res=mysqli_query(SqlHelper::$conn,$sql) or die(mysqli_error());
			//$res=>array()
			$arr=array();
			//把$res转移到$arr
			while($row=mysqli_fetch_assoc($res)){
				$arr[]=$row;
			}
			
			mysqli_free_result($res);
			
			$res=mysqli_query(SqlHelper::$conn,$sql) or die(mysqli_error());
			
			if($row=mysqli_fetch_row($res2)){
				$fenyePage->pageCount=ceil($row[0]/$fenyePage->pageSize);
				$fenyePage->rowCount=$row[0];
			}
			
			mysqli_free_result($res2);
			
			//把导航信息也封装到fenyePage对象中
			$navigate="";
			if ($fenyePage->pageNow>1){
				$prePage=$fenyePage->pageNow-1;
				$navigate="<a href='{$fenyePage->gotoUrl}?pageNow=$prePage'>上一页</a>&nbsp;";
			}
			if($fenyePage->pageNow<$fenyePage->pageCount){
				$nextPage=$fenyePage->pageNow+1;
				$navigate.="<a href='{$fenyePage->gotoUrl}?pageNow=$nextPage'>下一页</a>&nbsp;";
			}
			
			$page_whole=10;
			$start=floor(($fenyePage->pageNow-1)/$page_whole)*$page_whole+1;
			$index=$start;
			//整体每10页向前翻
			//如果当前pageNow在1-10页数，就没有向前翻动的超连接
			if($fenyePage->pageNow>$page_whole){
				$navigate.="&nbsp;&nbsp;<a href='{$fenyePage->gotoUrl}?pageNow=".($start-1)."'>&nbsp;&nbsp;<<&nbsp;&nbsp;</a>";
			}
			//定$start 1---》10  floor((pageNow-1)/10)=0*10+1   11->20   floor((pageNow-1)/10)=1*10+1 21-30 floor((pageNow-1)/10)=2*10+1
			for(;$start<$index+$page_whole;$start++){
				$navigate.="<a href='{$fenyePage->gotoUrl}?pageNow=$start'>[$start]</a>";
			}
			
			//整体每10页翻动
			$navigate.="&nbsp;&nbsp;<a href='{$fenyePage->gotoUrl}?pageNow=$start'>&nbsp;&nbsp;>>&nbsp;&nbsp;</a>";
			//显示当前页和共有多少页
			$navigate.=" 当前页{$fenyePage->pageNow}/共{$fenyePage->pageCount}页";
			//把$arr赋给$fenyePage
			$fenyePage->res_array=$arr;
			$fenyePage->navigate=$navigate;
		}
		//执行dml语句
		public  function execute_dml($sql){
			$res=mysqli_query(SqlHelper::$conn,$sql) or die(mysqli_error(SqlHelper::$conn));
			if(!$res){
				return 0; //失败
			}else{
				if(mysqli_affected_rows(SqlHelper::$conn)>0){
					return 1;//表示执行ok
				}else{
					return 2;//表示没有行受到影响
				}
			}
		}
		//关闭连接的方法 
		public function close_connect(){
			if(!empty(SqlHelper::$conn)){
				mysqli_close(SqlHelper::$conn);
			}
		}

		public function __destruct(){
			if(!empty(SqlHelper::$conn)){
				mysqli_close(SqlHelper::$conn);
			}
		}
	}
	//SqlHelper::getConn();
	
?>
