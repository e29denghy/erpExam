<?php 
class import extends SqlHelper
{//导入excel功能
	public $data;
	public $db;
	public function __construct($path){
		
		//ODBC连接Excel数据库（myExcel.xls）：
		//resource odbc_connect ( string $dsn , string $user , string $password [, int $cursor_type ] )
		//方式一：驱动方式
		$cn = odbc_connect("DRIVER=Microsoft Excel Driver (*.xls);dbq=".realpath($path),"","",SQL_CUR_USE_ODBC ) or die(odbc_errormsg());
		//方式二：数据源方式
		//控制面板 - ODBC - 选择系统DSN - 添加 - Microsoft Excel Driver (*.xls) - 完成 - 输入数据源名：myExcel_conn - 选择Excel文件（myExcel.xls）
		//$cn = odbc_connect("myExcel_conn","","",SQL_CUR_USE_ODBC ) or die(odbc_errormsg());
		
		//执行SQL语句：下面执行一个查询语句select：resource odbc_exec ( resource $connection_id , string $query_string [, int $flags ] )
		$rs = odbc_exec ($cn,"select * from [Sheet1$]");
		while($d = odbc_fetch_array($rs)){
			$this->data[] = $d;
		}
		odbc_free_result($rs);
		odbc_close($cn);
		$this->db=SqlHelper::getObj();
	}
	public function import_flow($userID,$subjectID)
	{//导入流程题
		$count=array(0,0);
		foreach($this->data as $row)
		{
			$sql_importFlow="insert into flow_questions (flow_questions_subject_id,flow_questions_description,flow_questions_explanation,flow_questions_difficulty,flow_questions_enabled,flow_questions_user_id) values ('".$subjectID."','".iconv('gb2312','utf-8',$row['description'])."','".iconv('gb2312','utf-8',$row['explanation'])."','".(int)$row['difficulty']."','".(int)$row['enabled']."','".$userID."')";
			$result=$this->db->execute_dml($sql_importFlow);
			if($result==1)
			{
				$count[0]++;
			}
			$count[1]++;
		}
		return $count;
	}
	public function import_optionContent($moduleID)
	{//导入步骤选项内容
		$count=array(0,0);
		foreach($this->data as $row)
		{
			$sql_importOptionContent="insert into flow_steps_options values ('".$moduleID."','".iconv('gb2312','utf-8',$row['steps_options'])."','".iconv('gb2312','utf-8',$row['steps_options_content'])."');";
			$result=$this->db->execute_dml($sql_importOptionContent);
			if($result==1)
			{
				$count[0]++;
			}
			$count[1]++;
		}
		return $count;
	}
	public function import_quesother($userID,$subjectID)
	{//导入理论题
		$count=array(0,0);
		foreach($this->data as $row)
		{
			$sql_importConcept="insert into flow_questions_concept (questions_concept_subject_id,questions_concept_description,questions_concept_explanation,questions_concept_type,questions_concept_difficulty,questions_concept_enabled,questions_concept_users_id) values ('".$subjectID."','".iconv('gb2312','utf-8',$row['description'])."','".iconv('gb2312','utf-8',$row['explanation'])."','".(int)$row['type']."','".(int)$row['difficulty']."','".(int)$row['enabled']."','".$userID."');";
			//var_dump($row);
			
			//$flow_id=(int)$row['flow_id'];
			$result=$this->db->execute_dml($sql_importConcept);
			if($result==1)
			{
				$count[0]++;
			}
			/*if((int)$row['is_add']==1)
			{
				$sql_getAddID="select LAST_INSERT_ID();";
				$array_add_id=$this->db->execute_dql($sql_getAddID);
				while($row=mysql_fetch_array($array_add_id))
				{
					$add_id=$row[0];
				}			
				$sql_setLink="insert into flow_add values('".$flow_id."','".$add_id."');";
				$this->db->execute_dml($sql_setLink);
			}*/
			$count[1]++;
		}
		return $count;
	}
}
?>