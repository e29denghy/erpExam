<?php
	function update_step_option($steps_module_id,$steps_type,$steps_options_id,$steps_options)
	{//更新步骤选项
		$db=SqlHelper::getObj();
		$sql_update="update flow_steps set steps_options='".$steps_options."' where steps_module_id='".$steps_module_id."' and steps_type='".$steps_type."' and steps_options_id='".$steps_options_id."';";
		$result_update=$db->execute_dml($sql_update);
		return $result_update;
	}
	function insert_step_option($steps_module_id,$steps_type,$steps_options_id,$steps_options)
	{//新增步骤选项
		$db=SqlHelper::getObj();
		$sql_insert="insert into flow_steps values('".$steps_module_id."','".$steps_type."','".$steps_options_id."','".$steps_options."');";
		$result_insert=$db->execute_dml($sql_insert);
		return $result_insert;
	}
	function delete_step_option($steps_module_id,$steps_type,$steps_options_id)
	{//删除步骤选项
		$db=SqlHelper::getObj();
		$sql_delete="delete from flow_steps where steps_module_id='".$steps_module_id."' and steps_type='".$steps_type."' and steps_options_id='".$steps_options_id."';";
		$result_delete=$db->execute_dml($sql_delete);
		return $result_delete;
	}
?>