<?php
	require_once("../share/function/sqlHelper.php");
	require_once("../share/function/function_consi_ques.php");
	/*
	 * 	 author:lincong quan
	 * 	 desc:返回在试卷集
	 */

	 
/*
 * 下载test_id对应的试卷号paper_id
 */
$test_id = isset($_REQUEST["test_id"])?$_REQUEST["test_id"]:NULL;
if (isset($test_id)) {
	$sql = "select paper_id from flow_paper where test_id='{$test_id}'";
	$res=get_attrs_from_table($sql);
	echo json_encode($res);
}
/*
 * 载入题目
 * 获取grid中的题目数据
 */
$grid_paper_id = isset($_REQUEST["grid_paper_id"])?$_REQUEST["grid_paper_id"]:NULL;
if(isset($_REQUEST["grid_paper_id"])){
	$sql="select flow_questions.flow_questions_id as qId,flow_questions.flow_questions_description as qDescri ,flow_papers_questions.papers_questions_id as qOrder,flow_questions.flow_questions_explanation as qExplan ,flow_questions.flow_questions_difficulty as qDiflt,flow_questions.flow_questions_enabled 
	as qAvail from flow_questions left join flow_papers_questions on flow_papers_questions.questions_id = flow_questions.flow_questions_id 
	where flow_papers_questions.is_flow='1' and flow_papers_questions.papers_id ='{$grid_paper_id}'";
	$res=get_attrs_from_table($sql);
	echo json_encode($res);
}
/*
 * 上传更改的数据（一条一条的增加）
 */	
 $qId = isset($_REQUEST["qId"])?$_REQUEST["qId"]:NULL;
 $qDescri = isset($_REQUEST["qDescri"])?$_REQUEST["qDescri"]:NULL;
 $qOrder = isset($_REQUEST["qOrder"])?$_REQUEST["qOrder"]:NULL;
 $qExplan = isset($_REQUEST["qExplan"])?$_REQUEST["qExplan"]:NULL;
 $qDiflt = isset($_REQUEST["qDiflt"])?$_REQUEST["qDiflt"]:NULL;
 $qAvail = isset($_REQUEST["qAvail"])?$_REQUEST["qAvail"]:NULL;
 $test_number = isset($_REQUEST["test_number"])?$_REQUEST["test_number"]:NULL;
 if(isset($qId) && isset($qDescri) && isset($qOrder) && isset($qExplan) && 
 isset($qDiflt) && isset($qAvail) && isset($test_number) ){
 	try{
 		$sql="update flow_questions set flow_questions_description='{$qDescri}',flow_questions_explanation='{$qExplan}', 
 		flow_questions_difficulty='{$qDiflt}',flow_questions_enabled='{$qAvail}' 
 		where flow_questions_id='{$qId}'";
 		$res=insert_into_table($sql);
 		$sql_two="update flow_papers_questions set papers_questions_id='{$qOrder}' 
 		where papers_id='{$test_number}' and questions_id ='{$qId}' and is_flow ='1';";
		$res=insert_into_table($sql_two);
		echo json_encode(array("info"=>"1"));
  	}catch(Exception $e){
  		echo json_encode(array("info"=>'0'));
  	}	
 }
/*
 * 删除当前试卷
 */
 $delete_test_id=  isset($_REQUEST["delete_test_id"])?$_REQUEST["delete_test_id"]:NULL;
 if(isset($delete_test_id)){
 	$sql_o="select count(*) from flow_papers_questions where papers_id='{$delete_test_id}';";
 	$res_o=get_attrs_from_table($sql_o);
 	if(!$res_o){
 		$sql_t="delete from flow_paper where paper_id ='{$delete_test_id}'";
		$s=SqlHelper::getObj();
		$res_flag=$s->execute_dml($sql_t);
		if($res_flag==0){
			echo json_encode(array("info"=>"error"));
		}else {
			echo json_encode(array("info"=>"success"));
		}
 	}else{
 		echo json_encode(array("info"=>"warning"));
 	}
 	
 }
?>