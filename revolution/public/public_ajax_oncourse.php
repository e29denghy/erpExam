<?php
	require_once('../share/function/function_consi_ques.php');
	require_once('../share/function/sqlHelper.php');
	/*
	 * 用户处理课堂练习中的ajax请求
 	 *流程题目提交
 	 */
	$jsflow_answ_data=isset($_POST["jsflow_answ_data"])?json_decode($_POST["jsflow_answ_data"]):null;
	$jsflow_page_now=isset($_POST["jsflow_page_now"])?$_POST["jsflow_page_now"]:null;
	$jsflow_exam_log_id=isset($_POST["jsflow_exam_log_id"])?$_POST["jsflow_exam_log_id"]:null;
	$jsflow_papers_id=isset($_POST["jsflow_papers_id"])?$_POST["jsflow_papers_id"]:null;
	$jsflow_module_id=isset($_POST["jsflow_module_id"])?$_POST["jsflow_module_id"]:null;
	$jsflow_num_option=isset($_POST["jsflow_num_option"])?$_POST["jsflow_num_option"]:null; 
	$jsflow_repeat_id=isset($_POST["jsflow_repeat_id"])?$_POST["jsflow_repeat_id"]:null; 
	if($jsflow_answ_data!==null && $jsflow_page_now!==null && $jsflow_exam_log_id!==null
		&& $jsflow_papers_id!==null  && $jsflow_num_option!==null){
		//上传考试流程题答案
			//选择出题目id
			$sql_ques_id="select questions_id from flow_papers_questions where papers_id='{$jsflow_papers_id}' and is_flow='1' and papers_questions_id='{$jsflow_page_now}';";
			$res_ques_id=get_attrs_from_table($sql_ques_id);
			//插入
		if(!empty($res_ques_id[0]["questions_id"])){
			//将答案选项装成编号
			//插入考试答案记录表
			//检查里面有没有这题的题号有则删除
			$sql_checkout="select examlog_useransw_id ,papers_question_id 
			from flow_examlog_useransw_oncourse 
			where examination_log_id='{$jsflow_exam_log_id}' 
			and papers_question_id ='{$jsflow_page_now}' 
			and repeat_id='{$jsflow_repeat_id}'";
				$res_useransw_id=get_attrs_from_table($sql_checkout);
				$check_question_id=isset($res_useransw_id[0]["papers_question_id"])?$res_useransw_id[0]["papers_question_id"]:null;
			if(!empty($check_question_id)){
					$sql_dele_flow_answ="delete from flow_examlog_useransw_oncourse 
					where examination_log_id ='{$jsflow_exam_log_id}' 
					and papers_question_id='{$check_question_id}' 
					and repeat_id='{$jsflow_repeat_id}'";
					insert_into_table($sql_dele_flow_answ);
				}
			foreach ($jsflow_answ_data as $key => $value) {
				//判断该步骤 是否存在
				$answ_num1=$jsflow_answ_data[$key][0]; 
				$answ_num2=$jsflow_answ_data[$key][1]; 
				$answ_num3=$jsflow_answ_data[$key][2]; 
				$sql_insert_flow_answ="insert into flow_examlog_useransw_oncourse 
				(examination_log_id,repeat_id,papers_question_id,usersansw_steps_id,
				usersansw_steps_option1,usersansw_steps_option2,usersansw_steps_option3) 
				values ('{$jsflow_exam_log_id}','{$jsflow_repeat_id}','{$jsflow_page_now}','".($key+1)."','{$answ_num1}','{$answ_num2}','{$answ_num3}')";
				try {
					insert_into_table($sql_insert_flow_answ);
				}catch (Exception $e) {
					echo json_encode(array('message'=>'0'));
					exit(-1);
				}
			}
			$res_addition=load_addition($res_ques_id[0]["questions_id"],$jsflow_page_now,$jsflow_answ_data);
			echo json_encode($res_addition);
		}else{
			echo json_encode(array('message'=>'0'));
		}
	}

	/*
	 * 检查流程题目中的答案数量
	 */
	 
	$jsflow_page_now_on=isset($_POST["jsflow_page_now_on"])?$_POST["jsflow_page_now_on"]:null;
	$jsflow_exam_log_id_on=isset($_POST["jsflow_exam_log_id_on"])?$_POST["jsflow_exam_log_id_on"]:null;
	$jsflow_papers_id_on=isset($_POST["jsflow_papers_id_on"])?$_POST["jsflow_papers_id_on"]:null;
	$jsflow_module_id_on=isset($_POST["jsflow_module_id_on"])?$_POST["jsflow_module_id_on"]:null;
	$repeat_id_on=isset($_POST["repeat_id_on"])?$_POST["repeat_id_on"]:null;
	
	if( $jsflow_page_now_on!==null && $jsflow_exam_log_id_on!==null
		&& $jsflow_papers_id_on!==null && $jsflow_module_id_on!==null && $repeat_id_on!==null){
			//选择出题目id
			$sql_ques_id="select questions_id 
			from flow_papers_questions 
			where papers_id='{$jsflow_papers_id_on}' 
			and is_flow='1' 
			and papers_questions_id='{$jsflow_page_now_on}';";
			$res_ques_id=get_attrs_from_table($sql_ques_id);
			//插入
//			print_r($res_ques_id);
		if(!empty($res_ques_id[0]["questions_id"])){
			//将答案选项装成编号
			//插入考试答案记录表
			//检查里面有没有这题的题号有则删除
			$sql_checkout="select examlog_useransw_id ,papers_question_id from
			 flow_examlog_useransw_oncourse 
			 where examination_log_id='{$jsflow_exam_log_id_on}' 
			 and papers_question_id ='{$jsflow_page_now_on}' 
			 and repeat_id='{$repeat_id_on}'";
			$res_useransw_id=get_attrs_from_table($sql_checkout);
			if(empty($res_useransw_id)){
				echo json_encode(array("info"=>"isnull"));
			}else{
				echo json_encode(array("info"=>"nonull"));
			}
		}
	}
		
		
/*
 * descri:功能: 1.把考答案放到session中
 *function：获取可回答的附加题s 
 */
	function load_addition($flow_ques_id,$page_now,$examUser_data){
		$ques_id;
		$examUser_data;
		$current_step=0;
		$max_step=0;
		$max_step_arr=array();
		$max_step_arr["flow_ques_id"]=$flow_ques_id;
		$max_step_arr["page_now"]=$page_now;
		//选项的个数，2个还是3个	
		if(count($examUser_data[0])==2){
			$sql_select_ques="select
			flow_answers_steps_id,
			flow_answers_steps_option1,
			flow_answers_steps_option2,
			from flow_answers where flow_questions_id='{$flow_ques_id}';";
		}else if(count($examUser_data[0])==3){
			$sql_select_ques="select
			flow_answers_steps_id,
			flow_answers_steps_option1,
			flow_answers_steps_option2,
			flow_answers_steps_option3 from flow_answers where flow_questions_id='{$flow_ques_id}';";
		}
		//判断步骤的标号 选出正确的步骤题
		$res_select_ques=get_attrs_from_table($sql_select_ques);
		//print_r($res_select_ques);
		for($i=0;$i<count($examUser_data);$i++){
			$arr_addition_modle=null;
			for($j=0;$j<count($res_select_ques);$j++){
				if($examUser_data[$i][0]==
				$res_select_ques[$j]["flow_answers_steps_option1"]
				&&$examUser_data[$i][1]==
				$res_select_ques[$j]["flow_answers_steps_option2"] && $res_select_ques[$j]['flow_answers_steps_id']>$max_step ){
					$max_step=$res_select_ques[$j]['flow_answers_steps_id'];
					$arr_addition_modle=array(
						'addition_step' =>$res_select_ques[$j]['flow_answers_steps_id'],
						'current_step' =>($i+1));
				}
			}
			if(!empty($arr_addition_modle)){
				array_push($max_step_arr,$arr_addition_modle);
			}
		}	
		//print_r($res_select_ques);

		// 选择附加题题目
		$max_step_arr=array_merge($max_step_arr);
		//print_r($max_step_arr);
		//echo count($max_step_arr);
		if(count($max_step_arr)>2){
			$merge=array();
			for($i=0;$i<(count($max_step_arr)-2);$i++){
				
				$sql_search_addition="
				select questions_add_id,questions_add_description ,questions_add_type 
				from flow_questions_add 
				where questions_flow_id='{$max_step_arr["flow_ques_id"]}' and questions_flow_step_id='{$max_step_arr[$i]['addition_step']}' and questions_add_enabled ='1';";
				
				$res_sql=get_attrs_from_table($sql_search_addition);  //包含所有的正确的流程步骤
				//print_r($res_sql);	
				if(!empty($res_sql)){
					for($j=0;$j<count($res_sql);$j++){
						array_push($max_step_arr[$i],$res_sql[$j]);
					}
					array_push($merge,'1');
				}else{											//找不到附加题在，删除该数组
					array_push($merge,'0');
				}
			}
			//剔除数组
			$i=0;
			$length=count($max_step_arr)-2;
			while($i<$length){
				if($merge[$i]=='0'){
					unset($max_step_arr[$i]);
				}
				$i++;
			}
			$max_step_arr=array_merge($max_step_arr);   //重新排序
			//print_r($max_step_arr);	
			//$_SESSION["addition"]=array();
			//array_push($_SESSION["addition"],$max_step_arr);
			//print_r($max_step_arr);
			//echo json_encode($max_step_arr);
		}
		//选择附加题答案选项
		//print_r($_SESSION["addition"]);
		//print_r($max_step_arr);	
		for($i=0;$i<(count($max_step_arr)-2);$i++){
			for($j=0;$j<(count($max_step_arr[$i])-2);$j++){
				if($max_step_arr[$i][$j]!=='-1'){
					$sql_sear_answ_add="select answers_other_id,answers_other_description from flow_answers_other where answers_is_add='1' and answers_other_question_id='{$max_step_arr[$i][$j]['questions_add_id']}' and answers_other_enabled='1';";
	       			//print_r($sql_sear_answ_add);
		       		$res_sql_answ=get_attrs_from_table($sql_sear_answ_add);
					if(!empty($res_sql_answ)){
						$max_step_arr[$i][$j]['option1']=$res_sql_answ[0];
						$max_step_arr[$i][$j]['option2']=$res_sql_answ[1];
						$max_step_arr[$i][$j]['option3']=$res_sql_answ[2];
						$max_step_arr[$i][$j]['option4']=$res_sql_answ[3];
					}
				}
				//
			}
		}
		//print_r($max_step_arr);	
		//print_r($max_step_arr[1]);  //流程题题目
		 //判断是否已经存在了$_SESSION["addition"]，若是已经存在则在里面寻找该题的session，若找不到则新增，若是不存在则新建一个session
		session_start();
		if(isset($_SESSION["addition"])){
			$check_have=null;
			for($i=0;$i<count($_SESSION["addition"]);$i++){
				if($_SESSION["addition"][$i]["page_now"]==$max_step_arr["page_now"]){
					$check_have=1;
					$_SESSION["addition"][$i]=$max_step_arr;
					//print_r($_SESSION["addition"]);
				}
			}
			if($check_have==null){
				
				array_push($_SESSION["addition"],$max_step_arr);
				//print_r($_SESSION["addition"]);
			}		
		}else{
			$_SESSION["addition"]=array();
			array_push($_SESSION["addition"],$max_step_arr);
		}		
		//print_r($max_step_arr);
		return $max_step_arr; 
	}

	
	
	/*
	 * 检查数据库有用户的多少个答案
	 * checkRepeatTime
	 */
	$r_page_now=isset($_POST["r_page_now"])?$_POST["r_page_now"]:null;
	$r_exam_log_id=isset($_POST["r_exam_log_id"])?$_POST["r_exam_log_id"]:null;
	//$r_papers_id=isset($_POST["r_papers_id"])?$_POST["r_papers_id"]:null;
	$r_module_id=isset($_POST["r_module_id"])?$_POST["r_module_id"]:null;
	$checkRepeatTime=isset($_POST["checkRepeatTime"])?$_POST["checkRepeatTime"]:null;
//	checkRepeatTime:repeatTimes
//	r_page_now_on:1
//	r_exam_log_id_on:102
//	r_papers_id_on:7
//	r_module_id_on:1
	if($checkRepeatTime =='repeatTimes' && $r_exam_log_id !==null && 
	$r_page_now !==null &&  $r_module_id!==null ){
		$sql="select repeat_id from
			 flow_examlog_useransw_oncourse 
			 where examination_log_id='{$r_exam_log_id}' 
			 and papers_question_id ='{$r_page_now}' 
			group by repeat_id";
		try{
			$res_useransw_id=get_attrs_from_table($sql,MYSQL_NUM);
			if(!empty($res_useransw_id)){
				echo json_encode($res_useransw_id);
			}
		}catch(Exception $e){
			
		}
			
	}

		/*
	 * 返回考生附加题 判分数组
	 */
	 $pageNow=isset($_REQUEST["pageNow"])?$_REQUEST["pageNow"]:null;
	 $userAnswer=isset($_REQUEST["customeOper"])?$_REQUEST["customeOper"]:null;
	 if($userAnswer=="userAnswer"){
	 	session_start();
		 if(isset($_SESSION["judge"])){
		 	for($i=0;$i<count($_SESSION["judge"]);$i++){
		 		if($_SESSION["judge"][$i][0]==$pageNow){
		 			echo json_encode($_SESSION["judge"][$i][1][2]);		 				 			
		 		}

		 	}

		 }
	 }
	 
 /*
 *  页面下载已做过得题目 的选择
 */
	$jsload_exam_id=isset($_POST["jsload_exam_id"])?$_POST["jsload_exam_id"]:null;
	$jsload_page_now=isset($_POST["jsload_page_now"])?$_POST["jsload_page_now"]:null;
	$jsload_exam_log_id=isset($_POST["jsload_exam_log_id"])?$_POST["jsload_exam_log_id"]:null;
	$jsload_papers_id=isset($_POST["jsload_papers_id"])?$_POST["jsload_papers_id"]:null;
	$jsload_module_id=isset($_POST["jsload_module_id"])?$_POST["jsload_module_id"]:null;
	$jsload_option_num=isset($_POST["jsload_option_num"])?$_POST["jsload_option_num"]:null;
	$jsload_repeat_id=isset($_POST["jsload_repeat_id"])?$_POST["jsload_repeat_id"]:null;
if($jsload_exam_id !==null && $jsload_page_now !==null && $jsload_exam_log_id !==null && $jsload_papers_id !==null &&
	$jsload_module_id !==null && $jsload_option_num !==null){
	//判断：概念题 流程题
	$sql_search_ques="select questions_id,is_flow from flow_papers_questions where  papers_questions_id='{$jsload_page_now}' and papers_id ='{$jsload_papers_id}'";
	//echo $sql_search_ques;
	$res_ques=get_attrs_from_table($sql_search_ques);
	if(!empty($res_ques)){
		if($res_ques[0]["is_flow"]=='0'){
			//是概念题  根据examlog_id 和题目序号
			$sql_search_concept="select useransw_id 
			from flow_examlog_useransw_concept where paperquestions_id='{$jsload_page_now}' and  examination_log_id='{$jsload_exam_log_id}' order by";
			$res_search_concept=get_attrs_from_table($sql_search_concept);
		
			$arr=array();
			$arr[0]=array('message'=>'0');
			$arr[1]=$res_search_concept;
			echo json_encode($arr);
			//echo json_encode(array('message'=>'1'));
		}else{
			 
			//是流程题  根据examlog_id 和题目序号 选择出考生答案
			 
			$sql_option_num="select steps_options_id from flow_steps where steps_type  ='{$jsload_option_num}';";
			$res_option_num=get_attrs_from_table($sql_option_num);
			 
			if(count($res_option_num)==2){
				$sql_search_flow="select usersansw_steps_id,usersansw_steps_option1,usersansw_steps_option2 
				from flow_examlog_useransw_oncourse 
				where examination_log_id='{$jsload_exam_log_id}' and 
				papers_question_id='{$jsload_page_now}' and 
				repead_id='{$jsload_repeat_id}' order by usersansw_steps_id asc";
			}else if(count($res_option_num)==3){
				$sql_search_flow="select usersansw_steps_id,usersansw_steps_option1,usersansw_steps_option2,usersansw_steps_option3 
				from flow_examlog_useransw_oncourse 
				where examination_log_id='{$jsload_exam_log_id}' 
				and  papers_question_id='{$jsload_page_now}'
				and repeat_id='{$jsload_repeat_id}' order by usersansw_steps_id asc";
			}
			//echo $sql_search_flow;
			$res_search_flow=get_attrs_from_table($sql_search_flow);
			//根据考生答案选择
			foreach($res_search_flow as $key => $value) {
				
				if(count($res_option_num)==3){
					$sql_exchan1="select steps_options_content from flow_steps_options where module_id='".$jsload_module_id."' and steps_options_content_id ='".$res_search_flow[$key]['usersansw_steps_option1']."';";
					$sql_exchan2="select steps_options_content from flow_steps_options where module_id='".$jsload_module_id."' and steps_options_content_id ='".$res_search_flow[$key]['usersansw_steps_option2']."';";
					$sql_exchan3="select steps_options_content from flow_steps_options where module_id='".$jsload_module_id."' and steps_options_content_id ='".$res_search_flow[$key]['usersansw_steps_option3']."';"; 
					
					//echo $sql_exchan1;
					//打印sql转化语句
					
					$res1=get_attrs_from_table($sql_exchan1); 
					$res2=get_attrs_from_table($sql_exchan2);
					$res3=get_attrs_from_table($sql_exchan3);
					 
					 /*
					$res_search_flow[$key]['usersansw_steps_option1']=$res1[0]['steps_options_content'];
					$res_search_flow[$key]['usersansw_steps_option2']=$res2[0]['steps_options_content'];
					$res_search_flow[$key]['usersansw_steps_option3']=$res3[0]['steps_options_content'];
					*/

				}else if (count($res_option_num)==2) {
					$sql_exchan1="select steps_options_content from flow_steps_options where module_id='".$jsload_module_id."' and steps_options_content_id ='".$res_search_flow[$key]['usersansw_steps_option1']."';";
					$sql_exchan2="select steps_options_content from flow_steps_options where module_id='".$jsload_module_id."' and steps_options_content_id ='".$res_search_flow[$key]['usersansw_steps_option2']."';";
					
					//echo $sql_exchan1;
					//打印sql转化语句
					$res1=get_attrs_from_table($sql_exchan1); 
					$res2=get_attrs_from_table($sql_exchan2);
					/*
					$res_search_flow[$key]['usersansw_steps_option1']=$res1[0]['steps_options_content'];
					$res_search_flow[$key]['usersansw_steps_option2']=$res2[0]['steps_options_content'];
					*/
				}
		}
			if(!empty($res_search_flow)){
				$arr=array();
				$arr[0]=array('message'=>'1');
				$arr[1]=$res_search_flow;
				echo json_encode($arr);
			}
		}
	}
}