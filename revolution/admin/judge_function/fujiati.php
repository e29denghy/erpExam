<?php
  $str_add_correct="select paperquestions_id,answers_other_question_id,questions_add_type,useransw_id,questions_flow_id,flow_questions_add.questions_add_id from flow_examlog_useransw_add,flow_answers_other,flow_questions_add where answers_other_isright=1 and flow_answers_other.answers_other_id=flow_examlog_useransw_add.useransw_id and answers_is_add=1 and  answers_other_question_id=flow_questions_add.questions_add_id and examination_log_id=".$examination_log_id;//answers_other_question_id可以查询题目表找出是否为多选题

 $add_correct_id=$conn_db->execute_dql2($str_add_correct);//这里返回所有正确的试卷试题ID。

//var_dump($v9);

//var_dump($add_correct_id);
   if(is_string(key($add_correct_id)))//如果是一维数组，则增加一个空数组让其成为二维数组，便于使用foreach
     {
		 $add_correct_id=array($add_correct_id,array());
		 $nums_id=count($add_correct_id)-1;
	 }
	 else
	     $nums_id=count($add_correct_id);

$single_add=array();
$multiply_add=array();
 if(!empty($add_correct_id))
 {
    //这里根据answers_other_question_id在问题表中，找出是否为多选题，从而对下面做出判分。要用is_add=1来区分附加题还是理论题.然后再在对应的问题表找出该题是单选还是多选。
	foreach($add_correct_id as $ka=>$va)
    {
	 if($va!=null)//去除加入的空数组
     {

	  if($va['questions_add_type']==0)//单选
		 $single_add[]=$va;
	  else 
		 $multiply_add[]=$va;	
	 }
	}
 }



?>