<?php
	function insertNewExam($exam_name,$exam_module_id,$test_id,$exam_begin_time,$exam_end_time,$exam_duration_time,$exam_announce_score_time,$exam_where,$judge_strategy_id,$paperList,$exam_group,$exam_mode)
	{//插入新考试
		$db=SqlHelper::getObj();
		$sql_insertNewExam="insert into flow_exam(exam_name,exam_module_id,test_id,exam_begin_time,exam_end_time,exam_duration_time,exam_announce_score_time,exam_where,judge_strategy_id,exam_mode) values('".$exam_name."','".$exam_module_id."','".$test_id."','".$exam_begin_time."','".$exam_end_time."','".$exam_duration_time."','".$exam_announce_score_time."','".$exam_where."','".$judge_strategy_id."','".$exam_mode."')";
		$result_insertNewExam=$db->execute_dml($sql_insertNewExam);//插入新考试
		$sql_newExamID="select LAST_INSERT_ID();";
		$result_newExamID=$db->execute_dql($sql_newExamID);
		while($row=mysqli_fetch_array($result_newExamID))
		{
			$newExamID=$row[0];
		}
		$count=0;
		foreach($paperList as $row)
		{
			$sql_insertExamPaper="insert into flow_exam_paper values('".$row."','".$newExamID."')";
			if($db->execute_dml($sql_insertExamPaper)==1)
			{
				$count++;
			}
		}
		if($count!=count($paperList))
			$result_insertNewExam=2;
		$count=0;
		foreach($exam_group as $row)
		{
			$sql_insertExamGroup="insert into flow_exam_usergroups values('".$row."','".$newExamID."')";
			if($db->execute_dml($sql_insertExamGroup)==1)
			{
				$count++;
			}
		}
		if($count!=count($exam_group))
			$result_insertNewExam=2;
		
		return $result_insertNewExam;
	}
	function updateExam($exam_id,$exam_name,$exam_module_id,$test_id,$exam_begin_time,$exam_end_time,$exam_duration_time,$exam_announce_score_time,$exam_where,$judge_strategy_id,$paperList,$exam_group,$exam_mode)
	{//更新考试信息
		$db=SqlHelper::getObj();
		$sql_update="update flow_exam set exam_name='".$exam_name."',exam_module_id='".$exam_module_id."',test_id='".$test_id."',exam_begin_time='".$exam_begin_time."',exam_end_time='".$exam_end_time."',exam_duration_time='".$exam_duration_time."',exam_announce_score_time='".$exam_announce_score_time."',exam_where='".$exam_where."',judge_strategy_id='".$judge_strategy_id."',exam_mode='".$exam_mode."' where exam_id='".$exam_id."';";
		$result_update=$db->execute_dml($sql_update);
		$sql_deleteExamPaper="delete from flow_exam_paper where exam_id='".$exam_id."';";
		$db->execute_dml($sql_deleteExamPaper);
		$sql_deleteExamGroup="delete from flow_exam_usergroups where exam_id='".$exam_id."';";
		$db->execute_dml($sql_deleteExamGroup);
		$count=0;
		foreach($paperList as $row)
		{
			$sql_insertExamPaper="insert into flow_exam_paper values('".$row."','".$exam_id."')";
			if($db->execute_dml($sql_insertExamPaper)==1)
			{
				$count++;
			}
		}
		if($count!=count($paperList))
			$result_update=3;
		$count=0;
		foreach($exam_group as $row)
		{
			$sql_insertExamGroup="insert into flow_exam_usergroups values('".$row."','".$exam_id."')";
			if($db->execute_dml($sql_insertExamGroup)==1)
			{
				$count++;
			}
		}
		if($count!=count($exam_group))
			$result_update=3;
		
		return $result_update;
	}
	function insertNewJS($logic_deduct,$branch_control,$extra_steps_control,$score_step_add)
	{//插入新判卷策略
		$db=SqlHelper::getObj();
		$sql_insert="insert into flow_judge_strategy(logic_deduct,branch_control,extra_steps_control,score_step_add) values ('".$logic_deduct."','".$branch_control."','".$extra_steps_control."','".$score_step_add."');";
		$result_insert=$db->execute_dml($sql_insert);
		
		return $result_insert;
	}
	function updateJS($judge_strategy_id,$logic_deduct,$branch_control,$extra_steps_control,$score_step_add)
	{//更新判卷策略
		$db=SqlHelper::getObj();
		$sql_update="update flow_judge_strategy set logic_deduct='".$logic_deduct."',branch_control='".$branch_control."',extra_steps_control='".$extra_steps_control."',score_step_add='".$score_step_add."' where judge_strategy_id='".$judge_strategy_id."';";
		$result_update=$db->execute_dml($sql_update);
		
		return $result_update;
	}
?>