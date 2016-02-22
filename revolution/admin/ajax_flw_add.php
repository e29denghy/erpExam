<?php
	require_once("../share/function/sqlHelper.php");
	require_once("../share/function/function_consi_ques.php");
	//返回module的数组
	$str_subject_num=isset($_REQUEST["json_subject_id"])?$_REQUEST["json_subject_id"]:null;

	if($str_subject_num!==null){
			$sql="SELECT subject_id,subject_name
			FROM tce_subjects
			WHERE subject_module_id ={$str_subject_num}";
			$subject_res=get_attrs_from_table($sql);
			echo json_encode($subject_res);	  				
	}

	//返回题目内容的数组
	$json_module_id=isset($_REQUEST["json_module_id"])?$_REQUEST["json_module_id"]:null;

	if($json_module_id!==null){
		$sql="SELECT flow_questions_id,flow_questions_description,flow_questions_difficulty,flow_questions_enabled
		FROM flow_questions
		WHERE flow_questions_subject_id =".$json_module_id.";"; 
			$content_res=get_attrs_from_table($sql);
		echo json_encode($content_res);	  				
	}

	//添加题目
	$json_user_id=isset($_REQUEST["json_user_id"])?$_REQUEST["json_user_id"]:null;
	$json_flw_module=isset($_REQUEST["json_flw_module"])?$_REQUEST["json_flw_module"]:null;
	$json_flw_content=isset($_REQUEST["json_flw_content"])?$_REQUEST["json_flw_content"]:null;
	$json_isEnabled=isset($_REQUEST["json_isEnabled"])?$_REQUEST["json_isEnabled"]:null;
	$json_flw_difficulty=isset($_REQUEST["json_flw_difficulty"])?$_REQUEST["json_flw_difficulty"]:null;
	if($json_user_id !==null && $json_flw_module!==null && $json_flw_content!==null && $json_isEnabled!==null &&   $json_flw_difficulty!==null){
		$sql_add="insert into flow_questions (flow_questions_subject_id, flow_questions_description,flow_questions_difficulty,flow_questions_enabled,flow_questions_user_id) values('".$json_flw_module."','".$json_flw_content."','".$json_flw_difficulty."','".$json_isEnabled."','".$json_user_id."');";
		$res_add=insert_into_table($sql_add);
	}

	//添加题目
	$json_upda_user_id=isset($_REQUEST["json_upda_user_id"])?$_REQUEST["json_upda_user_id"]:null;
	$json_upda_flw_module=isset($_REQUEST["json_upda_flw_module"])?$_REQUEST["json_upda_flw_module"]:null;
	$json_upda_flw_number=isset($_REQUEST["json_upda_flw_number"])?$_REQUEST["json_upda_flw_number"]:null;
	$json_upda_flw_content=isset($_REQUEST["json_upda_flw_content"])?$_REQUEST["json_upda_flw_content"]:null;
	$json_upda_isEnabled=isset($_REQUEST["json_upda_isEnabled"])?$_REQUEST["json_upda_isEnabled"]:null;
	$json_upda_flw_difficulty=isset($_REQUEST["json_upda_flw_difficulty"])?$_REQUEST["json_upda_flw_difficulty"]:null;
	if($json_upda_user_id !==null && $json_upda_flw_module!==null && $json_upda_flw_number !==null && $json_upda_flw_content!==null && $json_upda_isEnabled!==null &&   $json_upda_flw_difficulty!==null){

		$sql_add="update flow_questions set flow_questions_subject_id='".$json_upda_flw_module.
		"', flow_questions_description='".$json_upda_flw_content.
		"',flow_questions_difficulty='".$json_upda_flw_difficulty.
		"',flow_questions_enabled='".$json_upda_isEnabled.
		"',flow_questions_user_id='".$json_upda_user_id."' where flow_questions_id='".$json_upda_flw_number."';";
		$res_add=insert_into_table($sql_add);
	}


//删除题目
	$json_dele_flw_number=isset($_REQUEST["json_dele_flw_number"])?$_REQUEST["json_dele_flw_number"]:null;
	if($json_dele_flw_number !==null){
		$sql_add="delete from flow_questions where flow_questions_id ='".$json_dele_flw_number."';";
		try{
			$res_add=insert_into_table($sql_add);
		}
		catch(Exception  $e){
			echo "<script>alert('删除出错!');</script>";
		}
	}


//下载答案的数目
	$json_answ_current_ques=isset($_REQUEST["json_answ_current_ques"])?$_REQUEST["json_answ_current_ques"]:null;
	if($json_answ_current_ques !==null){
		$sql="select flow_answer_id,flow_answers_steps_branchid from flow_answers where flow_questions_id='".$json_answ_current_ques."'group by flow_answers_steps_branchid";
		$res_num=get_attrs_from_table($sql);
		echo json_encode($res_num);
	}

?>