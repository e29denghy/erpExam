<?php

	require_once('../share/function/function_consi_ques.php');
	require_once('../share/function/sqlHelper.php');
/*-----------------------------------------------
	//function： 下载考生已提交附加题答案
	//3.return：交卷成功
------------------------------------------------*/

$load_user_addi_user_log_id=isset($_POST["load_user_addi_user_log_id"])?$_POST["load_user_addi_user_log_id"]:null;

$load_user_addipapers_id=isset($_POST["load_user_addipapers_id"])?$_POST["load_user_addipapers_id"]:null;

$load_user_add_id=isset($_POST["load_user_add_id"])?$_POST["load_user_add_id"]:null;

if($load_user_addi_user_log_id!==null && $load_user_addipapers_id!==null && $load_user_add_id!==null){

	$sql_select_user_id="select useransw_id from flow_examlog_useransw_add where  examination_log_id='{$load_user_addi_user_log_id}' and  paperquestions_id='{$load_user_addipapers_id}' and questions_add_id='{$load_user_add_id}';";
	// echo $sql_select_user_id;
	$res_select_user_id=get_attrs_from_table($sql_select_user_id);
	//print_r($res_select_user_id);
	if(!empty($res_select_user_id)){
		//print_r($res_select_user_id);
		echo json_encode($res_select_user_id);
	}
}
 