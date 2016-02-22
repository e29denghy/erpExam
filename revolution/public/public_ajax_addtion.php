<?php

	require_once('../share/function/function_consi_ques.php');
	require_once('../share/function/sqlHelper.php');
/*-----------------------------------------------
	//1.检查相应的答案中包含附加题的步骤
	//2.提取步骤
	//3.并与流程中的步骤作比较
	//4.若是相同则显示该步骤
	//5.返回数据
------------------------------------------------*/

	$ld_page_now=isset($_POST["ld_page_now"])?$_POST["ld_page_now"]:null;
	$ld_exam_log_id=isset($_POST["ld_exam_log_id"])?$_POST["ld_exam_log_id"]:null;
	$ld_papers_id=isset($_POST["ld_papers_id"])?$_POST["ld_papers_id"]:null;
	$ld_module_id=isset($_POST["ld_module_id"])?$_POST["ld_module_id"]:null;
	$ld_max_step=isset($_POST["ld_max_step"])?json_decode($_POST["ld_max_step"]):null;
	$ld_num_option=isset($_POST["ld_num_option"])?$_POST["ld_num_option"]:null;
	$ld_arr_answ_step=isset($_POST["ld_arr_answ_step"])?json_decode($_POST["ld_arr_answ_step"]):null;
	$ld_current_change_step=isset($_POST["ld_current_change_step"])?$_POST["ld_current_change_step"]:null;

	if($ld_arr_answ_step!==null &&  $ld_page_now!==null && $ld_num_option!==null
	 && $ld_exam_log_id!==null && $ld_papers_id!==null && $ld_module_id!==null && $ld_max_step!==null){
		//1.根据paper_id查询出相应流程题的question_id
		$sql_sear_flow_ques="select questions_id from flow_papers_questions where  is_flow='1' and papers_id='{$ld_papers_id}' and  papers_questions_id='{$ld_page_now}'";
		//echo $sql_sear_flow_ques;
		$res_sear_flow_ques=get_attrs_from_table($sql_sear_flow_ques);	 //流程题目id为：$res_sear_flow_ques[0]['questions_id']
		//print_r($res_sear_flow_ques);
		
		//根据流程题的question_id 判断是否有流程题步骤
		$sql_sear_steps_flow="select flow_answers_steps_id  from flow_answers where flow_questions_id ={$res_sear_flow_ques[0]['questions_id']} and flow_answers_steps_option1='{$ld_arr_answ_step[0]}' and flow_answers_steps_option2='{$ld_arr_answ_step[1]}'; ";
			$res_sear_steps_flow=get_attrs_from_table($sql_sear_steps_flow);	
			//var_dump($res_sear_steps_flow);
		if(!empty($res_sear_steps_flow)){
			//print_r($ld_max_step."<".$res_sear_steps_flow[0]["flow_answers_steps_id"]);
				if($res_sear_steps_flow[0]["flow_answers_steps_id"]>=$ld_max_step[0] && $res_sear_steps_flow[0]["flow_answers_steps_id"]>=$ld_current_change_step){

					$ld_max_step[0]=$res_sear_steps_flow[0]["flow_answers_steps_id"];    //记录当前的步骤
					$ld_max_step[1]=$ld_current_change_step;
					//判断当前的步骤是否有锁定附加题
					$sql_sear_addition="select questions_add_id,questions_add_description,questions_add_type from flow_questions_add where questions_flow_id ='{$res_sear_flow_ques[0]['questions_id']}' and questions_flow_step_id='{$res_sear_steps_flow[0]["flow_answers_steps_id"]}' and questions_add_enabled='1';";
					$res_sear_addition=get_attrs_from_table($sql_sear_addition);	
					//var_dump($res_sear_steps_flow);
					//print_r($sql_sear_addition);
					array_push($res_sear_addition,$ld_max_step);
					echo json_encode($res_sear_addition);
					//print_r($res_sear_addition);
				}else{
					echo json_encode(array('0' =>$ld_max_step));
					//print_r(array('0' =>$ld_max_step));
				}
		}else{
			echo json_encode(array('0' =>$ld_max_step));
			//print_r(array('0' =>$ld_max_step));
		}	
		
	}

?>