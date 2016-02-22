<?php
	function insertTest($test_name,$test_description,$test_user_id,$test_enable,$test_password)
	{//添加测验
		$db=SqlHelper::getObj();
		$sql_insert="insert into flow_test(test_name,test_description,test_user_id,test_enable,test_password) values('".$test_name."','".$test_description."','".$test_user_id."','".$test_enable."','".$test_password."');";
		$result_insert=$db->execute_dml($sql_insert);
		return $result_insert;
	}
	function updateTest($test_id,$test_name,$test_description,$test_enable,$test_password)
	{//更新测验信息
		$db=SqlHelper::getObj();
		$sql_update="update flow_test set test_name='".$test_name."',test_description='".$test_description."',test_enable='".$test_enable."',test_password='".$test_password."' where test_id='".$test_id."';";
		$result_update=$db->execute_dml($sql_update);
		return $result_update;
	}
	function deleteTest($test_id)
	{//删除测验
		$db=SqlHelper::getObj();
		$sql_delete="delete from flow_test where test_id='".$test_id."';";
		$result_delete=$db->execute_dml($sql_delete);
		return $result_delete;
	}
?>