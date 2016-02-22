<?php
	function getJudgeError()
	{//获取判卷异常表
		$db=SqlHelper::getObj();
		$sql_getJE="select flow_judge_error.*,exam_name from flow_judge_error,flow_exam where flow_exam.exam_id=flow_judge_error.exam_id order by error_id";
		$JudgeError=$db->execute_dql2($sql_getJE);
		return $JudgeError;
	}
	function getErrorInfor($error_id)
	{//获取异常详细信息
		$db=SqlHelper::getObj();
		$sql_getEI="select exam_name,flow_exam.exam_id,flow_judge_error.papers_id,flow_judge_error.questions_id,questions_type,student_id,teacher_id,flow_questions_description,flow_questions_id 
from flow_judge_error,flow_exam,flow_questions,flow_papers_questions 
where .exam_id 
and flow_questions.flow_questions_id=flow_papers_questions.questions_id 
and flow_papers_questions.is_flow=1 
and flow_papers_questions.papers_id=flow_judge_error.papers_id
and flow_papers_questions.papers_questions_id=flow_judge_error.questions_id
and error_id='".$error_id."';";
		$ErrorInfor=$db->execute_dql($sql_getEI);
		$db->close_connect();
		return $ErrorInfor;
	}
	function getRightAnswer($question_id)
	{//获取正确答案
		$db=SqlHelper::getObj();
		$sql_getRA="SELECT flow_answers_steps_id,(select steps_options_content from flow_steps_options where steps_options_content_id=flow_answers_steps_option1) as option1,(select steps_options_content from flow_steps_options where steps_options_content_id=flow_answers_steps_option2) as option2,(select steps_options_content from flow_steps_options where steps_options_content_id=flow_answers_steps_option3) as option3,(select steps_options_content from flow_steps_options where steps_options_content_id=flow_answers_steps_option4) as option4,(select steps_options_content from flow_steps_options where steps_options_content_id=flow_answers_steps_option5) as option5,(select steps_options_content from flow_steps_options where steps_options_content_id=flow_answers_steps_option6) as option6,(select steps_options_content from flow_steps_options where steps_options_content_id=flow_answers_steps_option7) as option7,(select steps_options_content from flow_steps_options where steps_options_content_id=flow_answers_steps_option8) as option8,(select steps_options_content from flow_steps_options where steps_options_content_id=flow_answers_steps_option9) as option9,(select steps_options_content from flow_steps_options where steps_options_content_id=flow_answers_steps_option10) as option10  FROM flow_answers where flow_questions_id='".$question_id."' order by flow_answers_steps_id;";
		$RightAnswer=$db->execute_dql2($sql_getRA);
		return $RightAnswer;
	}
	function getStudentAnswer($student_id,$exam_id,$papers_id,$papers_questions_id)
	{//获取考生答案
		$db=SqlHelper::getObj();
		$sql_getSA="SELECT examlog_useransw_id,usersansw_steps_id,(select steps_options_content from flow_steps_options where steps_options_content_id=usersansw_steps_option1) as option1,(select steps_options_content from flow_steps_options where steps_options_content_id=usersansw_steps_option2) as option2,(select steps_options_content from flow_steps_options where steps_options_content_id=usersansw_steps_option3) as option3,(select steps_options_content from flow_steps_options where steps_options_content_id=usersansw_steps_option4) as option4,(select steps_options_content from flow_steps_options where steps_options_content_id=usersansw_steps_option5) as option5,(select steps_options_content from flow_steps_options where steps_options_content_id=usersansw_steps_option6) as option6,(select steps_options_content from flow_steps_options where steps_options_content_id=usersansw_steps_option7) as option7,(select steps_options_content from flow_steps_options where steps_options_content_id=usersansw_steps_option8) as option8,(select steps_options_content from flow_steps_options where steps_options_content_id=usersansw_steps_option9) as option9,(select steps_options_content from flow_steps_options where steps_options_content_id=usersansw_steps_option10) as option10 from flow_examlog_useransw where examination_log_id in (select examination_log_id from flow_examination_log where users_id='".$student_id."' and exam_id='".$exam_id."' and papers_id='".$papers_id."') and papers_question_id='".$papers_questions_id."' order by usersansw_steps_id";
		$StudentAnswer=$db->execute_dql2($sql_getSA);
		return $StudentAnswer;
	}
	function handle_exception($useransw_id,$score)
	{
		$db=SqlHelper::getObj();
		$sql_isexist="select count(*) from flow_exam_judge where examlog_useransw_id='".$useransw_id."';";
		$result_isexist=$db->execute_dql($sql_isexist);
	if($result_isexist)
		{
			$isexist=$row[0];
		}
		if($isexist!=1)
		{
			$sql_insertNew="insert into flow_exam_judge(examlog_useransw_id,score,judge,judge_remark) values('".$useransw_id."','".$score."','x','异常处理');";
			$result_insertNew=$db->execute_dml($sql_insertNew);
			if($result_insertNew==1)
			{
				$result=1;
			}
			else
			{
				$result=0;
			}
		}
		else
		{
			$sql_update="update flow_exam_judge set score='".$score."',judge='x',judge_remark='异常处理' where examlog_useransw_id='".$useransw_id."';";
			$result_update=$db->execute_dml($sql_update);
			if($result_update==0)
			{
				$result=0;
			}
			else
			{
				$result=1;
			}
		}
		$db->close_connect();
		return $result;
	}
?>