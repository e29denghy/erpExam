<?php

	require_once('../share/function/function_consi_ques.php');
	require_once('../share/function/sqlHelper.php');
/*-----------------------------------------------
	//function： 下载附加题答案
	//2.args：附加题的id
	//3.return：答案内容
------------------------------------------------*/

	$jsload_answ_add=isset($_POST["jsload_answ_add"])?json_decode($_POST["jsload_answ_add"]):null;
	$jsload_page_now=isset($_POST["jsload_page_now"])?$_POST["jsload_page_now"]:null;
	$jsload_examination_log_id=isset($_POST["jsload_examination_log_id"])?$_POST["jsload_examination_log_id"]:null;

	
	if($jsload_answ_add!==null && $jsload_examination_log_id!==null && $jsload_page_now!==null ){
		$return_arr=array();
		foreach ($jsload_answ_add as $key => $value) {
			$sql_sear_answ_add="select questions_add_id,useransw_id from flow_examlog_useransw_add where examination_log_id='{$jsload_examination_log_id}' and paperquestions_id='{$jsload_page_now}' and questions_add_id='{$jsload_answ_add[$key]}';";
			//echo $sql_sear_answ_add;
			$res_sear_answ_add=get_attrs_from_table($sql_sear_answ_add);
			array_push($return_arr, $res_sear_answ_add);
		}		
		echo json_encode($return_arr);
	}
	
/*-----------------------------------------------
	//function：下载附加题选项
	//3.return：返回选项id和选项的描述
------------------------------------------------*/

$load_att_add_id=isset($_POST["load_att_add_id"])?$_POST["load_att_add_id"]:null;
	if($load_att_add_id!==null){
		$sql_select_addi_option="select answers_other_id,answers_other_description from flow_answers_other where  answers_is_add='1' and  answers_other_question_id='{$load_att_add_id}' and answers_other_enabled='1';";
		$res_select_addi_option=get_attrs_from_table($sql_select_addi_option);
		if(!empty($res_select_addi_option)){
			echo json_encode($res_select_addi_option);
		}
	}

