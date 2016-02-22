<?php
header("Content-type:text/html;charset=utf-8");
require_once('../share/function/sqlHelper.php');
require_once('../share/function/function_consi_ques.php');

//
//ajax.php页面 ： admin 管理权限中的试题管理
//
//
//
/*--------------------------------------------
|	点击添加按钮，上传流程题答案	
---------------------------------------------*/ 

	$str_data=isset($_POST["add_data"])?$_POST["add_data"]:null;
	$str_ques_num=isset($_POST["add_ques_num"])?$_POST["add_ques_num"]:null;

	$str_start=isset($_POST["add_start"])?$_POST["add_start"]:null;
	$str_end=isset($_POST["add_end"])?$_POST["add_end"]:null;
	$str_check=isset($_POST["add_check"])?$_POST["add_check"]:null;
	$str_modu_num=isset($_POST["add_module_num"])?json_decode($_POST["add_module_num"]):null;

	//echo $str_data;
	//echo $str_ques_num;
	//echo $str_start;
	//echo $str_end;
	//echo json_encode($str_check);
	//echo $str_modu_num;
	//echo $str_check;
	 
	if( $str_data!==null && $str_ques_num!==null){
		insertFLowAnsw($str_data,$str_ques_num,$str_start,$str_end,$str_check,$str_modu_num);
	}


		
	/*
	 * 
	 */
	 function insertFLowAnsw($str_data,$str_ques_num,$str_start,$str_end,$str_check,$str_modu_num,$blacnce_id=-1){
		$json_arr=json_decode($str_data);
		if($blacnce_id==-1){
			$json_ques_num=$str_ques_num;
			$sql_check_blance="select flow_questions_id from flow_answers where flow_questions_id='".$json_ques_num."' group by flow_answers_steps_branchid;";
			//echo $sql_check_blance;
			$res_blance=count(get_attrs_from_table($sql_check_blance));
			$res_blance++;
			
		}else{
			$res_blance=$blacnce_id;
		}

		//echo $res_blance."------------11111111----------------------";
		for($i=0;$i<count($json_arr);$i++){
			if(!empty($str_check)){
				if($i>=($str_start-1) && ($i<=$str_end-1) ){
					// 打印选项数据 1-1
					$answ_num1=$json_arr[$i][0]; 
					$answ_num2=$json_arr[$i][1]; 
					$answ_num3=$json_arr[$i][2]; 

					$sql_input_answ="insert into  flow_answers (flow_questions_id,flow_answers_steps_id,flow_answers_steps_option1,flow_answers_steps_option2,flow_answers_steps_option3,flow_answers_steps_branchsign,flow_answers_steps_branchid,flow_answers_steps_branchpoint) values('".$str_ques_num."','".($i+1)."','".$answ_num1."','".$answ_num2."','".$answ_num3."','".$str_check."','".$res_blance."','1');";	
					$res_succe=insert_into_table($sql_input_answ);
				}else{
					$sql_answ_num1='select steps_options_content_id  from flow_steps_options where module_id="'.$str_modu_num.'" and  steps_options_content="'.$json_arr[$i][0].'" ;';
					$sql_answ_num2='select steps_options_content_id  from flow_steps_options where module_id="'.$str_modu_num.'" and  steps_options_content="'.$json_arr[$i][1].'" ;';
					$sql_answ_num3='select steps_options_content_id  from flow_steps_options where module_id="'.$str_modu_num.'" and  steps_options_content="'.$json_arr[$i][2].'" ;';	
					//echo json_encode($json_arr[$i][0]);
					// 打印选项数据 1-1					
					$answ_num1=$json_arr[$i][0]; 
					$answ_num2=$json_arr[$i][1]; 
					$answ_num3=$json_arr[$i][2]; 
					// 打印 插入 flow_answers sql
					//echo json_encode($sql_input_answ);
					$sql_input_answ='insert into  flow_answers (flow_questions_id,flow_answers_steps_id,flow_answers_steps_option1,flow_answers_steps_option2,flow_answers_steps_option3,flow_answers_steps_branchsign,flow_answers_steps_branchid,flow_answers_steps_branchpoint) values("'.$str_ques_num.'","'.($i+1).'","'.$answ_num1.'","'.$answ_num2.'","'.$answ_num3.'","'.$str_check.'","'.$res_blance.'","0");';
					//echo $sql_input_answ; 
					$res_succe=insert_into_table($sql_input_answ);		
				}
			}else{
				//echo $sql_answ_num1. ."2-1";
				//打印选择选项标号 表sql语句
				$answ_num1=$json_arr[$i][0]; 
				$answ_num2=$json_arr[$i][1]; 
				$answ_num3=$json_arr[$i][2]; 
				$sql_input_answ='insert into flow_answers (flow_questions_id,flow_answers_steps_id,flow_answers_steps_option1,flow_answers_steps_option2,flow_answers_steps_option3,flow_answers_steps_branchsign,flow_answers_steps_branchid,flow_answers_steps_branchpoint) values("'.$str_ques_num.'","'.($i+1).'","'.$answ_num1.'","'.$answ_num2.'","'.$answ_num3.'","'.$str_check.'","0","0");';
				$res_succe=insert_into_table($sql_input_answ);	
			}			
		}
		}
			

/*
 *	点击下拉框，下载不同分支答案，上传流程题答案
 * 	
 */
 	$sele_curr_answ=isset($_POST["sele_curr_answ"])?$_POST["sele_curr_answ"]:null;		
	$sele_modu=isset($_POST["sele_modu"])?$_POST["sele_modu"]:null;	
	$sele_ques=isset($_POST["sele_ques"])?$_POST["sele_ques"]:null;	

	if( $sele_ques!==null &&  $sele_modu!==null){
		//获得flow_answers里面的数据
		$sql_check_blance="select 
		flow_answers_steps_id,
		flow_answers_steps_option1,
		flow_answers_steps_option2,
		flow_answers_steps_option3,
		flow_answers_steps_branchsign,
		flow_answers_steps_branchpoint from flow_answers 
		where flow_questions_id ='".$sele_ques."' and  flow_answers_steps_branchid ='".$sele_curr_answ."' 
		order by flow_answers_steps_id ASC ";
		$res_answ_list=get_attrs_from_table($sql_check_blance);

		//打印select出来的数组
		//print_r($res_answ_list);
		//转换成文字格式
		echo json_encode($res_answ_list);

		//echo $sql_check_blance;
		
		//储存到数组
		//返回
		//当前答案的分支个数 
		
	}
	 
 /*--------------------------------------------
|	删除答案	

---------------------------------------------*/
	 	//$dele_modu=isset($_POST["dele_modu"])?$_POST["dele_modu"]:null;		
		$dele_curr_answ=isset($_POST["dele_curr_answ"])?$_POST["dele_curr_answ"]:null;	
		$dele_ques=isset($_POST["dele_ques"])?$_POST["dele_ques"]:null;	
		//echo $dele_modu; 
		if( $dele_ques!==null){
			$dele_answ_sql="delete from flow_answers where flow_questions_id='".$dele_ques."' and flow_answers_steps_branchid='".$dele_curr_answ."'; ";
			//输出sql delete语句 
			//echo $dele_answ_sql;
			try{
				$return_mes=insert_into_table($dele_answ_sql);		
				echo json_encode(array('message' =>true)); 	
			}catch(Exception $e){
				echo json_encode(array('message' =>false));
			}
		}

 /*--------------------------------------------
|	更新答案	
---------------------------------------------*/

	 	$upda_data=isset($_POST["upda_data"])?$_POST["upda_data"]:null;		
		$upda_ques_num=isset($_POST["upda_ques_num"])?$_POST["upda_ques_num"]:null;	
		$upda_start=isset($_POST["upda_start"])?$_POST["upda_start"]:null;	

		$upda_end=isset($_POST["upda_end"])?$_POST["upda_end"]:null;	
		$upda_check=isset($_POST["upda_check"])?$_POST["upda_check"]:null;		
		$upda_module_num=isset($_POST["upda_module_num"])?$_POST["upda_module_num"]:null;
		$upda_blance=isset($_POST["upda_blance"])?$_POST["upda_blance"]:null;
		
		//echo "---------".$upda_check;

	if( $upda_data!==null &&  $upda_ques_num!==null){
			//echo "---------".$upda_check;
			
			$sql_delete="delete from flow_answers where flow_questions_id='$upda_ques_num' and flow_answers_steps_branchid='{$upda_blance}'	";
			
			insert_into_table($sql_delete);
			insertFLowAnsw($upda_data,$upda_ques_num,$upda_start,$upda_end,$upda_check,$upda_module_num,$upda_blance);
			/*
		    $sql_judge_steps="select flow_answers_steps_id from flow_answers where flow_questions_id='".$upda_ques_num."' and flow_answers_steps_branchid='".$upda_blance."';";
			$res_judge_num=count(get_attrs_from_table($sql_judge_steps));
				for($i=0;$i<count($json_arr);$i++){
					$sql_answ_num1="select steps_options_content_id  from flow_steps_options where module_id='".$upda_module_num."' and  steps_options_content='".$json_arr[$i][0]."';";
					$sql_answ_num2="select steps_options_content_id  from flow_steps_options where module_id='".$upda_module_num."' and  steps_options_content='".$json_arr[$i][1]."';";
					$sql_answ_num3="select steps_options_content_id  from flow_steps_options where module_id='".$upda_module_num."' and  steps_options_content='".$json_arr[$i][2]."';";	
					//echo json_encode($json_arr[$i][0]);
					// 打印选项数据 1-1
					$answ_num1=$json_arr[$i][0];//get_attrs_from_table($sql_answ_num1); 
					$answ_num2=$json_arr[$i][1];//get_attrs_from_table($sql_answ_num2); 
					$answ_num3=$json_arr[$i][2];//get_attrs_from_table($sql_answ_num3); 
					if($upda_check=='1'){
						if($i>=($upda_start-1) && $i<=($upda_end-1)){
							if($i<$res_judge_num){
								$sql_input_answ="update flow_answers set flow_answers_steps_id='".($i+1)."' ,flow_questions_id='".$upda_ques_num."' ,flow_answers_steps_option1='".$answ_num1."',flow_answers_steps_option2='".$answ_num2."',flow_answers_steps_option3='".$answ_num3."',flow_answers_steps_branchsign='1',flow_answers_steps_branchpoint='1' where flow_answers_steps_id='".($i+1)."';";
								//echo $sql_input_answ;
							}else{						
								$sql_input_answ='insert into  flow_answers (flow_questions_id,flow_answers_steps_id,flow_answers_steps_option1,flow_answers_steps_option2,flow_answers_steps_option3,flow_answers_steps_branchsign,flow_answers_steps_branchid,flow_answers_steps_branchpoint) values("'.$upda_ques_num.'","'.($i+1).'","'.$answ_num1.'","'.$answ_num2.'","'.$answ_num3.'","1","'.$upda_blance.'","1");';  	
							}
						}else{
							if($i<$res_judge_num){
								$sql_input_answ="update flow_answers set flow_answers_steps_id='".($i+1)."' ,flow_questions_id='".$upda_ques_num."' ,flow_answers_steps_option1='".$answ_num1."',flow_answers_steps_option2='".$answ_num2."',flow_answers_steps_option3='".$answ_num3."',flow_answers_steps_branchsign='1',flow_answers_steps_branchpoint='0' where flow_answers_steps_id='".($i+1)."';";						
								//echo $sql_input_answ;
							}else{
								$sql_input_answ='insert into  flow_answers (flow_questions_id,flow_answers_steps_id,flow_answers_steps_option1,flow_answers_steps_option2,flow_answers_steps_option3,flow_answers_steps_branchsign,flow_answers_steps_branchid,flow_answers_steps_branchpoint) values("'.$upda_ques_num.'","'.($i+1).'","'.$answ_num1.'","'.$answ_num2.'","'.$answ_num3.'","1","'.$upda_blance.'","0");';  	
							}
						
						}
					}else{
						if($i<$res_judge_num){
							$sql_input_answ="update flow_answers set flow_answers_steps_id='".($i+1)."' ,flow_questions_id='".$upda_ques_num."' ,flow_answers_steps_option1='".$answ_num1."',flow_answers_steps_option2='".$answ_num2."',flow_answers_steps_option3='".$answ_num3."',flow_answers_steps_branchsign='0',flow_answers_steps_branchpoint='0' where flow_answers_steps_id='".($i+1)."';";	
							
						}else{
							$sql_input_answ='insert into  flow_answers (flow_questions_id,flow_answers_steps_id,flow_answers_steps_option1,flow_answers_steps_option2,flow_answers_steps_option3,flow_answers_steps_branchsign,flow_answers_steps_branchid,flow_answers_steps_branchpoint) values("'.$upda_ques_num.'","'.($i+1).'","'.$answ_num1.'","'.$answ_num2.'","'.$answ_num3.'","0","'.$upda_blance.'","0");';  	
							
						}
					}
					try{
						$res_succe=insert_into_table($sql_input_answ);
					}catch(Exception $e){
						echo json_encode(array("message"=>'0'));
					}
						
				}

			$answ_plus=$res_judge_num-count($json_arr);
			if($answ_plus>0){
				for($i=0;$i<$answ_plus;$i++){
					$sql_dele_plus="delete from flow_answers where flow_questions_id='".$upda_ques_num."' and flow_answers_steps_id='".(count($json_arr)+$i+1)."' and flow_answers_steps_branchid='".$upda_blance."';";
					try{
						insert_into_table($sql_dele_plus);
					}catch(Exception $e){
						echo json_encode(array("message"=>'0'));
					}
						
				}
			}
			 */
	}
/*
 *更新数据 
 */
 function updateFlow($upda_data,$upda_ques_num,$upda_start,$upda_end,
 $upda_check,$upda_module_num,$upda_blance){
 	
 }
 /* 
  *	下载附加题内容
  */
 	$att_step_id=isset($_POST["att_step"])?$_POST["att_step"]:null;		
	$att_ques_id=isset($_POST["att_ques_num"])?$_POST["att_ques_num"]:null;	
	$attr_blan_id=isset($_POST["attr_blan"])?$_POST["attr_blan"]:null;	

	if(	 $att_step_id!==null &&  $att_ques_id!==null && $attr_blan_id!=="请选择" ){
		//echo $att_step;
		//echo $att_ques_num;
		//echo $attr_blan;
		$sql_att="select questions_add_id ,questions_add_description, questions_add_type, questions_add_enabled from flow_questions_add where questions_flow_id='".$att_ques_id."' and questions_flow_step_id='".$att_step_id."';";
	//	echo $sql_att;
		try{
			$att_res=get_attrs_from_table($sql_att);
			//print_r($att_res);
			echo json_encode($att_res);
		}catch(Exception $e){
			echo json_encode(array("message"=>'0'));
		}
	}
 /*--------------------------------------------
|	删除附加题内容	
---------------------------------------------*/

	$json_att_dele_id=isset($_POST["json_att_dele_id"])?$_POST["json_att_dele_id"]:null;	

	if( $json_att_dele_id!==null){
		try{
			$sql_att_dele="delete from flow_questions_add where questions_add_id='".$json_att_dele_id."';";
			//echo $sql_att_dele;
			insert_into_table($sql_att_dele);
			echo json_encode(array('message' =>'1'));
		}catch(Exception $e){
			echo json_encode(array('message' =>'0'));
		}
	}

 /*--------------------------------------------
|	更新附加题内容	
---------------------------------------------*/	
	$json_att_id=isset($_POST["json_att_id"])?$_POST["json_att_id"]:null;
 	$json_att_upda_flow_id=isset($_POST["json_att_upda_flow_id"])?$_POST["json_att_upda_flow_id"]:null;		
	$json_att_upda_flow_step_id=isset($_POST["json_att_upda_flow_step_id"])?$_POST["json_att_upda_flow_step_id"]:null;	
	$json_att_upda_flow_blan=isset($_POST["json_att_upda_flow_blan"])?$_POST["json_att_upda_flow_blan"]:null;	
	$json_att_upda_ques_descr=isset($_POST["json_att_upda_ques_descr"])?$_POST["json_att_upda_ques_descr"]:null;	
	$json_upda_type=isset($_POST["json_upda_type"])?$_POST["json_upda_type"]:null;	
	$json_att_upda_enabled=isset($_POST["json_att_upda_enabled"])?$_POST["json_att_upda_enabled"]:null;	
	$json_att_upda_users_id=isset($_POST["json_att_upda_users_id"])?$_POST["json_att_upda_users_id"]:null;	

	if($json_att_upda_flow_id!==null && $json_att_upda_flow_step_id!==null 
		&& $json_att_upda_ques_descr!==null && $json_att_id!==null){
		$sql_add_in_att="update flow_questions_add set questions_flow_id='".$json_att_upda_flow_id."', questions_flow_step_id='".$json_att_upda_flow_step_id."' ,flow_steps_blanchid='".$json_att_upda_flow_blan."' ,questions_add_description='".$json_att_upda_ques_descr."' ,questions_add_type='".$json_upda_type."',questions_add_enabled='".$json_att_upda_enabled."',questions_add_users_id='".$json_att_upda_users_id."' where questions_add_id='".$json_att_id."';";
		 
		try{

			insert_into_table($sql_add_in_att);
			echo json_encode(array('message' =>'1'));
		}catch(Exception $e){
			echo json_encode(array('message' =>'0'));
		}
	}
	
 /*--------------------------------------------
|	添加附加题内容	
---------------------------------------------*/	
	$json_att_id=isset($_POST["json_att_id"])?$_POST["json_att_id"]:null; 	
	$json_att_add_flow_id=isset($_POST["json_att_add_flow_id"])?$_POST["json_att_add_flow_id"]:null;		
	$json_att_add_flow_step_id=isset($_POST["json_att_add_flow_step_id"])?$_POST["json_att_add_flow_step_id"]:null;	
	$json_att_add_flow_blan=isset($_POST["json_att_add_flow_blan"])?$_POST["json_att_add_flow_blan"]:null;	
	$json_att_add_ques_descr=isset($_POST["json_att_add_ques_descr"])?$_POST["json_att_add_ques_descr"]:null;	
	$json_att_type=isset($_POST["json_att_type"])?$_POST["json_att_type"]:null;	
	$json_att_add_enabled=isset($_POST["json_att_add_enabled"])?$_POST["json_att_add_enabled"]:null;	
	$json_att_add_users_id=isset($_POST["json_att_add_users_id"])?$_POST["json_att_add_users_id"]:null;	
	
	if($json_att_add_flow_id!==null && $json_att_add_flow_step_id!==null 
		&& $json_att_add_ques_descr!==null && $json_att_id=='+' ){
		$sql_add_in_att="insert into flow_questions_add (questions_flow_id, questions_flow_step_id ,flow_steps_blanchid ,questions_add_description ,questions_add_type,questions_add_enabled,questions_add_users_id) values('".$json_att_add_flow_id."','".$json_att_add_flow_step_id."','".$json_att_add_flow_blan."','".$json_att_add_ques_descr."','".$json_att_type."','".$json_att_add_enabled."','".$json_att_add_users_id."')";
		//echo $sql_add_in_att;
		try{
			insert_into_table($sql_add_in_att);
			echo json_encode(array('message' =>'1'));
			//print_r(array('message' =>'1'));
		}catch(Exception $e){
			echo json_encode(array('message' =>'0'));
		}
	}

 /*--------------------------------------------
|	显示附加题答案列表
---------------------------------------------*/	

	$attr_answ_selected_id=isset($_POST["attr_answ_selected_id"])?$_POST["attr_answ_selected_id"]:null; 	

	if($attr_answ_selected_id!==null){
		$sql_atta_answ="select answers_other_id from flow_answers_other where answers_other_question_id = '".$attr_answ_selected_id."';";
		//echo $sql_atta_answ;
		try{
			$res_atta_answ=get_attrs_from_table($sql_atta_answ);
			echo json_encode($res_atta_answ);
		}catch(Exception $e){	
			echo json_encode(array('message' =>'0'));
		}
	}

 /*--------------------------------------------
|	显示附加题答案  content 内容列表
---------------------------------------------*/	
$json_answ_content_id=isset($_POST["json_answ_content_id"])?$_POST["json_answ_content_id"]:null; 		

if($json_answ_content_id!==null){
	$sql_select_answ_detail="select answers_is_add,answers_other_question_id,answers_other_description,answers_other_isright,answers_other_enabled from flow_answers_other where answers_other_id='".$json_answ_content_id."' and answers_is_add='1';";
	//echo $sql_select_answ_detail;
	try{
		$res_sele_answ=get_attrs_from_table($sql_select_answ_detail);
		echo json_encode($res_sele_answ);
	}catch(Exception $e){
		echo json_encode(array('message' =>'0'));
	}
	
}



 /*--------------------------------------------
|	添加附加题答案  content 内容列表
---------------------------------------------*/	
$json_atta_answ_id=isset($_POST["json_atta_answ_id"])?$_POST["json_atta_answ_id"]:null;
$json_atta_answ_content=isset($_POST["json_atta_answ_content"])?$_POST["json_atta_answ_content"]:null;
$json_atta_answ_isadd=isset($_POST["json_atta_answ_isadd"])?$_POST["json_atta_answ_isadd"]:null;	
$json_atta_answ_content_area=isset($_POST["json_atta_answ_content_area"])?$_POST["json_atta_answ_content_area"]:null;
$json_atta_answ_avail=isset($_POST["json_atta_answ_avail"])?$_POST["json_atta_answ_avail"]:null;
$json_atta_answ_isright=isset($_POST["json_atta_answ_isright"])?$_POST["json_atta_answ_isright"]:null;	

if($json_atta_answ_id !==null && $json_atta_answ_content =="+" && $json_atta_answ_content_area !==null &&
	 $json_atta_answ_avail !==null && $json_atta_answ_isright !==null  ){
	//$sql_att_insert="insert into flow_answers_other (answers_is_add,answers_other_question_id,answers_other_description,answers_other_isright,answers_other_enabled ) values ('".."','".."','".."','".."','".."',);";
	$sql_att_insert="insert into flow_answers_other (answers_is_add,answers_other_question_id,answers_other_description,answers_other_isright,answers_other_enabled ) values ('".$json_atta_answ_isadd."','".$json_atta_answ_id."','".$json_atta_answ_content_area."','".$json_atta_answ_isright."','".$json_atta_answ_avail."')";
	//echo $sql_att_insert;
	try{
		insert_into_table($sql_att_insert);
		echo json_encode(array("message"=>'1'));
	}catch(Exception $e){
		echo json_encode(array("message"=>'0'));
	}
	

}

 /*--------------------------------------------
|	更新附加题答案  content 内容列表
---------------------------------------------*/	

$upda_atta_answ_id=isset($_POST["upda_atta_answ_id"])?$_POST["upda_atta_answ_id"]:null;
$upda_atta_answ_content=isset($_POST["upda_atta_answ_content"])?$_POST["upda_atta_answ_content"]:null;
$upda_atta_answ_isadd=isset($_POST["upda_atta_answ_isadd"])?$_POST["upda_atta_answ_isadd"]:null;	
$upda_atta_answ_content_area=isset($_POST["upda_atta_answ_content_area"])?$_POST["upda_atta_answ_content_area"]:null;
$upda_atta_answ_avail=isset($_POST["upda_atta_answ_avail"])?$_POST["upda_atta_answ_avail"]:null;
$upda_atta_answ_isright=isset($_POST["upda_atta_answ_isright"])?$_POST["upda_atta_answ_isright"]:null;

if($upda_atta_answ_id !==null && $upda_atta_answ_content !=="+" && $upda_atta_answ_content_area !==null && $upda_atta_answ_isadd !==null &&
	 $upda_atta_answ_avail !==null && $upda_atta_answ_isright !==null ){
		$sql_att_update1 = "update flow_answers_other set answers_is_add='".$upda_atta_answ_isadd."',answers_other_question_id='".$upda_atta_answ_id."',answers_other_description='".$upda_atta_answ_content_area."',answers_other_isright='".$upda_atta_answ_isright."',answers_other_enabled='".$upda_atta_answ_avail."' where answers_other_id='".$upda_atta_answ_content."';";
		//echo $sql_att_update1;
		try{
			insert_into_table($sql_att_update1);
			echo json_encode(array("message"=>'1'));
		}catch(Exception $e){
			echo json_encode(array("message"=>'0'));
		}
	

}
 /*--------------------------------------------
|	删除附加题答案  content 内容列表
---------------------------------------------*/	
$dele_atta_answ_content=isset($_POST["dele_atta_answ_content"])?$_POST["dele_atta_answ_content"]:null; 
if($dele_atta_answ_content!==null){
	$sql_dele_atta_atta="delete from flow_answers_other where answers_other_id='".$dele_atta_answ_content."';";
	try{
		//echo $sql_dele_atta_atta;
		insert_into_table($sql_dele_atta_atta);
		echo json_encode(array("message"=>'1'));
	}catch(Exception $e){
		echo json_encode(array("message"=>'0'));
	}
}




