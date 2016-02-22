<?php
	
	require_once('../share/function/function_consi_ques.php');
	require_once('../share/function/sqlHelper.php');
/*---------------------------
理论考试题目提交
-----------------------------*/
	
	//对 理论题考生答案表flow_examlogs_useransw_other 操作
	$jscon_selected_answ=isset($_POST["jscon_selected_answ"])?json_decode($_POST["jscon_selected_answ"]):null;
	$jscon_papers_id=isset($_POST["jscon_papers_id"])?$_POST["jscon_papers_id"]:null;
	$jscon_ques_now=isset($_POST["jscon_ques_now"])?$_POST["jscon_ques_now"]:null;
	$jscon_exam_log_id=isset($_POST["jscon_exam_log_id"])?$_POST["jscon_exam_log_id"]:null;

	if($jscon_selected_answ!==null && $jscon_papers_id!==null && 
	 $jscon_ques_now!==null && $jscon_exam_log_id!==null ){
		//选择出题目id
		$sql_ques_id="select questions_id from flow_papers_questions where papers_id='{$jscon_papers_id}' and is_flow='0' and papers_questions_id='{$jscon_ques_now}';";
		//echo $sql_ques_id;
		$res_ques_id=get_attrs_from_table($sql_ques_id);       //选择出题目id
		if(!empty($res_ques_id[0]["questions_id"])){
				//检查是否已经有 答案了
				$sql_checkout="select examination_log_id,paperquestions_id from flow_examlog_useransw_concept where paperquestions_id='{$jscon_ques_now}' and examination_log_id ='{$jscon_exam_log_id}'";
				$res_useransw_id=get_attrs_from_table($sql_checkout);			
				$examination_log_id=isset($res_useransw_id[0]["examination_log_id"])?$res_useransw_id[0]["examination_log_id"]:null;
				if(!empty($examination_log_id)){
					$sql_dele_conce_answ="delete from flow_examlog_useransw_concept where paperquestions_id='{$jscon_ques_now}' and examination_log_id ='{$jscon_exam_log_id}'";
					insert_into_table($sql_dele_conce_answ);
				}
			foreach ($jscon_selected_answ as $key => $value){
				$sql_uploat_answ="insert into flow_examlog_useransw_concept (examination_log_id,paperquestions_id,useransw_id) values ('{$jscon_exam_log_id}','{$jscon_ques_now}','{$jscon_selected_answ[$key]}');";
				//echo $sql_uploat_answ;
				try{
					$res_insert=insert_into_table($sql_uploat_answ);
					echo json_encode(array('message'=>'1'));
				}catch(Exeception $e){
					echo json_encode(array('message'=>'0'));
				}
			}
		}
	}


/*
 *流程题目提交
 */
	$jsflow_answ_data=isset($_POST["jsflow_answ_data"])?json_decode($_POST["jsflow_answ_data"]):null;
	$jsflow_page_now=isset($_POST["jsflow_page_now"])?$_POST["jsflow_page_now"]:null;
	$jsflow_exam_log_id=isset($_POST["jsflow_exam_log_id"])?$_POST["jsflow_exam_log_id"]:null;
	$jsflow_papers_id=isset($_POST["jsflow_papers_id"])?$_POST["jsflow_papers_id"]:null;
	$jsflow_module_id=isset($_POST["jsflow_module_id"])?$_POST["jsflow_module_id"]:null;
	$jsflow_num_option=isset($_POST["jsflow_num_option"])?$_POST["jsflow_num_option"]:null; 


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
			$sql_checkout="select examlog_useransw_id ,papers_question_id from flow_examlog_useransw where examination_log_id='{$jsflow_exam_log_id}' and papers_question_id ='{$jsflow_page_now}'";
				$res_useransw_id=get_attrs_from_table($sql_checkout);
				$check_question_id=isset($res_useransw_id[0]["papers_question_id"])?$res_useransw_id[0]["papers_question_id"]:null;
			if(!empty($check_question_id)){
					$sql_dele_flow_answ="delete from flow_examlog_useransw where examination_log_id ='{$jsflow_exam_log_id}' and papers_question_id='{$check_question_id}'";
					insert_into_table($sql_dele_flow_answ);
				}
			foreach ($jsflow_answ_data as $key => $value) {
				//判断该步骤 是否存在
				$answ_num1=$jsflow_answ_data[$key][0]; 
				$answ_num2=$jsflow_answ_data[$key][1]; 
				$answ_num3=$jsflow_answ_data[$key][2]; 
				$sql_insert_flow_answ="insert into flow_examlog_useransw (examination_log_id,papers_question_id,usersansw_steps_id,usersansw_steps_option1,usersansw_steps_option2,usersansw_steps_option3) values ('{$jsflow_exam_log_id}','{$jsflow_page_now}','".($key+1)."','{$answ_num1}','{$answ_num2}','{$answ_num3}')";
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
 *  下载流程题选项：
 */
	$input_modu_id=isset($_POST["input_modu_id"])?$_POST["input_modu_id"]:null;
	$input_option_style=isset($_POST["input_option_style"])?$_POST["input_option_style"]:null;
	if($input_modu_id !==null && $input_option_style!==null){
		if(!isset($_SESSION['flow_option'])){
			$sql_select_option="select steps_options_id,steps_options from flow_steps where steps_module_id ='{$input_modu_id}' and steps_type='{$input_option_style}'";
			$ret_option=get_attrs_from_table($sql_select_option);
			echo json_encode($ret_option);
		}else{
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
				from flow_examlog_useransw 
				where examination_log_id='{$jsload_exam_log_id}' and  papers_question_id='{$jsload_page_now}' order by usersansw_steps_id asc";
			}else if(count($res_option_num)==3){
				$sql_search_flow="select usersansw_steps_id,usersansw_steps_option1,usersansw_steps_option2,usersansw_steps_option3 
				from flow_examlog_useransw 
				where examination_log_id='{$jsload_exam_log_id}' and  papers_question_id='{$jsload_page_now}' order by usersansw_steps_id asc";
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
 * 根据option_type来选择flow_steps_options
 * 
 */
	$fill_modu_id=isset($_POST["fill_modu_id"])?$_POST["fill_modu_id"]:null;
	$fill_steps_options=isset($_POST["fill_steps_options"])?$_POST["fill_steps_options"]:null;

if($fill_modu_id !==null && $fill_steps_options !==null){
	$sql_search_list="select steps_options_content_id,steps_options_content from flow_steps_options where module_id='".$fill_modu_id."' and steps_options='{$fill_steps_options}' order by step_order asc";
    $res_option_list=get_attrs_from_table($sql_search_list);
    //1
    if(!empty($res_option_list)){
		echo json_encode($res_option_list);
		//rint_r($res_option_list);
    } 
   
}




/*-----------------------------------------------
---保存附加题答案
	//1.储存附加题答案数组
	//2.循环附加题答案数组
	//3.插入
	//4.返回信息
------------------------------------------------*/

	$jsup_answ_upload=isset($_POST["jsup_answ_upload"])?json_decode($_POST["jsup_answ_upload"]):null;
	$jsup_page_now=isset($_POST["jsup_page_now"])?json_decode($_POST["jsup_page_now"]):null;
	$jsup_examination_log_id=isset($_POST["jsup_examination_log_id"])?json_decode($_POST["jsup_examination_log_id"]):null;
	if($jsup_answ_upload!==null && $jsup_page_now!==null && $jsup_examination_log_id!==null){	
		//print_r($jsup_answ_upload);
		foreach ($jsup_answ_upload as $key => $value) {  //控制每一道题目的插入
			
			//检查是否已有答案：有则删除
			//没有则插入
			$sql_check="select  useransw_id, questions_add_id from flow_examlog_useransw_add where examination_log_id='{$jsup_examination_log_id}' and paperquestions_id='{$jsup_page_now}' and questions_add_id='{$jsup_answ_upload[$key][0]}';";			
			//echo $sql_check."1-------------";
			$res_check=get_attrs_from_table($sql_check);
			if(!empty($res_check)){
				$sql_delete_add="delete from flow_examlog_useransw_add where examination_log_id='{$jsup_examination_log_id}' and paperquestions_id='{$jsup_page_now}' and questions_add_id='{$jsup_answ_upload[$key][0]}';";
				//echo $sql_delete_add."2-------------";
				insert_into_table($sql_delete_add);
			}
			//插入附加题答案
			for($i=1;$i<count($jsup_answ_upload[$key]);$i++){
				$sql_insert_add="insert into flow_examlog_useransw_add (examination_log_id,paperquestions_id,questions_add_id,useransw_id) values('{$jsup_examination_log_id}','{$jsup_page_now}','{$jsup_answ_upload[$key][0]}','{$jsup_answ_upload[$key][$i]}');";				
				//echo $sql_insert_add."3-------------";;
				insert_into_table($sql_insert_add);
			}
		}
		/*
		 *擦入session数据 
		 */
		session_start();
		if(!isset($_SESSION['addition_user_answ']))	{
			/*
			 *没有session 
			 */
			$_SESSION['addition_user_answ']=array();
			$arr=array();
			array_push($arr,$jsup_page_now);
			array_push($arr,$jsup_answ_upload);
			array_push($_SESSION['addition_user_answ'],$arr);
		}else{
			/*
			 * 检查是否已有该附加题的session，没有则插入，有则改
			 */
			$flag_page=null;
			$flag_ques=null;// index=1：标志着能找到当前page_now的哪一题
			for($i=0;$i<count($_SESSION['addition_user_answ']);$i++){
				if($_SESSION['addition_user_answ'][$i][0]==$jsup_page_now){
					$flag_page=1;
					for($q=0;$q<count($jsup_answ_upload);$q++){
						for($j=0;$j<count($_SESSION['addition_user_answ'][$i][1]);$j++){
							if($_SESSION['addition_user_answ'][$i][1][$j][0]==$jsup_answ_upload[$q][0]){
								$flag_ques=1;
								$_SESSION['addition_user_answ'][$i][1][$j]=$jsup_answ_upload[$q];
							}
						}
						if($flag_ques==null){
							array_push($_SESSION['addition_user_answ'][$i][1],$jsup_answ_upload[$q]);
							$flag_ques==null;
						}
					}
				}
			}
			if($flag_page==null){
				/*
				 * 没有该附加题的session数据
				 */
				$arr=array();
				array_push($arr,$jsup_page_now);
				array_push($arr,$jsup_answ_upload);
				array_push($_SESSION['addition_user_answ'],$arr);
			}
		}		 		
		echo json_encode(array('message'=>'1'));
	}	

/*-----------------------------------------------
	//function： 提交按钮
	//3.return：交卷成功
------------------------------------------------*/
	$jsupto_examination_log_id=isset($_POST["jsupto_examination_log_id"])?$_POST["jsupto_examination_log_id"]:null;
	$jsupto_exam_id=isset($_POST["jsupto_exam_id"])?$_POST["jsupto_exam_id"]:null;
	$jsupto_user_id=isset($_POST["jsupto_user_id"])?$_POST["jsupto_user_id"]:null;	
	if($jsupto_exam_id!==null && $jsupto_exam_id!==null && $jsupto_examination_log_id !==null){
		$sql_upload_paper="update flow_examination_log set is_end ='1' where users_id='{$jsupto_user_id}' and exam_id='{$jsupto_exam_id}' and examination_log_id='{$jsupto_examination_log_id}';"	;
		//echo $sql_upload_paper;
		try{
			insert_into_table($sql_upload_paper);
			echo json_encode(array("message"=>'1'));
		}
		catch(Exception $e){
			echo json_encode(array("message"=>'0'));
		}
	}
/*-----------------------------------------------
	//function： 下载概念题 考生答案
	//3.return： 
------------------------------------------------*/

	$load_conce_paper_id=isset($_POST["load_conce_paper_id"])?$_POST["load_conce_paper_id"]:null;
	$load_conce_user_id=isset($_POST["load_conce_user_id"])?$_POST["load_conce_user_id"]:null;
	if($load_conce_user_id!==null && $load_conce_paper_id!==null){
		$sql_select_user_answ="select useransw_id from flow_examlog_useransw_concept where 	paperquestions_id='{$load_conce_paper_id}'  and  examination_log_id ='{$load_conce_user_id}';";
		$res_select_user_answ=get_attrs_from_table($sql_select_user_answ);		
		if($res_select_user_answ){
			echo json_encode($res_select_user_answ);
		}
	}

	

?>