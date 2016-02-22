<?php
	
	function getModule()
	{//获取科目列表
		//global $db;
		$db=SqlHelper::getObj();
		$sql_getModule="select module_id,module_name from tce_modules order by module_id";
		$ModuleInfor=$db->execute_dql2($sql_getModule);
		
		return $ModuleInfor;
	}
	function getSubject()
	{//获取章节列表
		//global $db;
		$db=SqlHelper::getObj();
		$sql_getSubject="select subject_id,subject_name,subject_module_id from tce_subjects order by subject_id";
		$SubjectInfor=$db->execute_dql2($sql_getSubject);
		
		return $SubjectInfor;
	}
	function getSteptype()
	{//获取步骤类型列表
		//global $db;
		$db=SqlHelper::getObj();
		$sql_getSteptype="select distinct steps_type,steps_module_id from flow_steps order by steps_type";
		$SteptypeInfor=$db->execute_dql2($sql_getSteptype);
		
		return $SteptypeInfor;
	}
	function getStepOption()
	{//获取步骤选项列表
		//global $db;
		$db=SqlHelper::getObj();
		$sql_getStepOption="select steps_options_id,steps_options,steps_type,steps_module_id from flow_steps order by steps_options_id";
		$StepOptionInfor=$db->execute_dql2($sql_getStepOption);
		
		return $StepOptionInfor;
	}
	function getTest()
	{//获取测验列表
		//global $db;
		$db=SqlHelper::getObj();
		$sql_getTest="select test_id,test_name,test_description,test_enable,test_password from flow_test order by test_id";
		$TestInfor=$db->execute_dql2($sql_getTest);
		
		return $TestInfor;
	}
	function getPaper()
	{//获取试卷列表
		$db=SqlHelper::getObj();
		$sql_getPaper="select paper_id,flow_paper.test_id,test_name from flow_paper,flow_test where flow_test.test_id=flow_paper.test_id order by paper_id";
		$PaperInfor=$db->execute_dql2($sql_getPaper);
		
		return $PaperInfor;
	}
	function getGroup()
	{//获取用户组列表
		$db=SqlHelper::getObj();
		$sql_getGroup="select * from tce_user_groups order by group_id";
		$GroupInfor=$db->execute_dql2($sql_getGroup);
		
		return $GroupInfor;
	}
	function getExam()
	{//获取考试的试卷列表
		$db=SqlHelper::getObj();
		$sql_getExam="select * from flow_exam order by exam_id";
		$ExamInfor=$db->execute_dql2($sql_getExam);
		
		return $ExamInfor;
	}
	function getExamPaper()
	{//获取考试的试卷列表
		$db=SqlHelper::getObj();
		$sql_getExamPaper="select * from flow_exam_paper";
		$ExamPaperInfor=$db->execute_dql2($sql_getExamPaper);
		
		return $ExamPaperInfor;
	}
	function getJudgeStrategy()
	{//获取判卷策略列表
		$db=SqlHelper::getObj();
		$sql_getJudgeStrategy="select * from flow_judge_strategy order by judge_strategy_id;";
		$JudgeStrategyInfor=$db->execute_dql2($sql_getJudgeStrategy);
		
		return $JudgeStrategyInfor;
	}
	function getExamUsergroup()
	{//获取考生组列表
		$db=SqlHelper::getObj();
		$sql_getExamUsergroup="select * from flow_exam_usergroups;";
		$ExamUsergroupInfor=$db->execute_dql2($sql_getExamUsergroup);
		
		return $ExamUsergroupInfor;
	}
	function getUserExam($userID)
	{//获取当前用户id所参加考试
		$db=SqlHelper::getObj();
		$sql_getUserExam="select exam_id from flow_exam_usergroups,tce_usrgroups where usrgrp_user_id='".$userID."' and usergroups_id=usrgrp_group_id group by exam_id;";
		$result_getUserExam=$db->execute_dql2($sql_getUserExam);
		
		return $result_getUserExam;
	}
	function getUserExamGrade($userID)
	{//获取当前用户id所参加考试成绩
		$db=SqlHelper::getObj();
		$sql_getUserExamGrade="select exam_id,grade from flow_examination_log,flow_exam_grade where flow_examination_log.examination_log_id=flow_exam_grade.examination_log_id and users_id='".$userID."';";
		$result_getUserExamGrade=$db->execute_dql2($sql_getUserExamGrade);
		
		return $result_getUserExamGrade;
	}
	function getUserExamlogID($userID,$exam_id)
	{//获取考生考试记录id
		$db=SqlHelper::getObj();
		$sql_getUserExamlogID="select examination_log_id from flow_examination_log where users_id='".$userID."' and exam_id='".$exam_id."';";
		$result_getUserExamlogID=$db->execute_dql($sql_getUserExamlogID);
		while($row=mysql_fetch_array($result_getUserExamlogID))
		{
			$result=$row[0];
		}
		
		if(!isset($result))
			return -1;
		else
			return $result;
	}
	function getUserAnswlog($examlog_id)
	{
		
	}
?>