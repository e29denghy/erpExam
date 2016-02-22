<?php
/*-------------------------------------------------
descri：考生登录
--------------------------------------------------*/

	require_once('../share/function/function_consi_ques.php');
	require_once('../share/function/sqlHelper.php');

	$exam_login_user_id=isset($_REQUEST['exam_login_user_id'])?$_REQUEST['exam_login_user_id']:null;

	//echo ($exam_login_user_id) ;

	if($exam_login_user_id!==null){
		$sele_exam='select exam_id from flow_exam_usergroups where usergroups_id in(select usrgrp_group_id from tce_usrgroups where usrgrp_user_id='.$exam_login_user_id.' );';
		$res_exam_id=get_attrs_from_table($sele_exam);
		date_default_timezone_set("PRC");
		$data_now=date('Y-m-d H:i:s');
		//循环取值，获得可允许的数组
		//获得所有的测试exam_id数组 flow_exam.
		//select flow_exam_usergroups.exam_id from flow_exam_usergroups left join tce_usrgroups on flow_exam_usergroups.usergroups_id =tce_usrgroups.usrgrp_group_id and tce_usrgroups.usrgrp_user_id='{$exam_login_user_id}';

		//选择允许在考试组里面的所有测试exam-id
		$sql_request_exam="
		select tce_modules.module_name,flow_exam.exam_id,
		flow_exam.exam_module_id,flow_exam.test_id,flow_exam.exam_begin_time,
		flow_exam.exam_end_time,flow_exam.exam_duration_time,flow_exam.exam_name
		,flow_exam.exam_mode 
from flow_exam,tce_modules
where flow_exam.exam_id in 
(select flow_exam_usergroups.exam_id from flow_exam_usergroups left join tce_usrgroups on 
	flow_exam_usergroups.usergroups_id =tce_usrgroups.usrgrp_group_id where tce_usrgroups.usrgrp_user_id='{$exam_login_user_id}') 
and tce_modules.module_id = flow_exam.exam_module_id 
and '{$data_now}' between flow_exam.exam_begin_time and flow_exam.exam_end_time";
		//echo $sql_request_exam;
		$res_sql_request_exam=get_attrs_from_table($sql_request_exam);
		//select 
		//循环取值，获得odule_name 
		foreach ($res_sql_request_exam as $key => $value) {
			/*
			$sql_sear_modu="select module_name from tce_modules where module_id='{$res_sql_request_exam[$key]["exam_module_id"]}';";
			//echo $sql_sear_modu;
			$res_sear_modu=get_attrs_from_table($sql_sear_modu);
			if(!empty($res_sear_modu)){
				$res_sql_request_exam[$key]["module_name"]=$res_sear_modu[0]['module_name'];
			}
			*/
			//检查是否已经考过试
			$sql_check_exam_log="select examination_log_id,is_end from flow_examination_log where users_id='{$exam_login_user_id}' and exam_id='{$res_sql_request_exam[$key]["exam_id"]}';";		
			//echo $sql_check_exam_log;
			$res_check_exam_log=get_attrs_from_table($sql_check_exam_log);
			//检查是否在这个考试组里面
			//print_r($res_check_exam_log);
			if(!empty($res_check_exam_log)){
				if($res_check_exam_log[0]["is_end"]=='1'){
					$res_sql_request_exam[$key]["is_end"]='1';
				}else{
					$res_sql_request_exam[$key]["is_end"]='0';
				}
			}else{
				$res_sql_request_exam[$key]["is_end"]='0';
			}
	}
	//print_r($res_sql_request_exam);
	if(!empty($res_sql_request_exam)){
		echo json_encode($res_sql_request_exam);
	}	 
		//print_r($res_sql_request_exam);
}
?>