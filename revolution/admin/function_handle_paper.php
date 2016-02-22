<?php
	function getPaperInfor()
	{//获取组卷信息
		$db=SqlHelper::getObj();
		$sql_getPaperInfor="select Count(*) as paper_count,test_id,mpstrategy_id from flow_paper group by test_id;";
		$result=$db->execute_dql2($sql_getPaperInfor);
		//$db->close_connect();
		return $result;
	}
	function getMpstrategy()
	{//获取组卷策略列表
		$db=SqlHelper::getObj();
		$sql_getMpstrategy="select mps_item_id,mpstrategy_id,module_id,module_name,flow_makepapers_strategys.subject_id,subject_name,subject_flow_num,subject_concept_num,subject_flow_difficulty,subject_concept_difficulty,subject_flow_score,subject_concept_score,subject_question_select_order,subject_selectoptions_order from flow_makepapers_strategys,tce_subjects,tce_modules where flow_makepapers_strategys.subject_id=tce_subjects.subject_id and tce_modules.module_id=tce_subjects.subject_module_id order by mps_item_id";
		$MpstrategyInfor=$db->execute_dql2($sql_getMpstrategy);
		//$db->close_connect();
		return $MpstrategyInfor;
	}
	function deleteMpstrategy($MPS_id)
	{//删除组卷策略
		$db=SqlHelper::getObj();
		$sql_deleteMPS="delete from flow_makepapers_strategys where mpstrategy_id='".$MPS_id."';";
		$result_delete=$db->execute_dml($sql_deleteMPS);
		//$db->close_connect();
		return $result_delete;
	}
	function makePaper($testID,$mpsID,$paperCount,$no_diff)
	{//组卷
		$db=SqlHelper::getObj();
		$sql_getMPSInfor="select * from flow_makepapers_strategys where mpstrategy_id='".$mpsID."';";
		$result_getMPSInfor=$db->execute_dql2($sql_getMPSInfor);//获取组卷策略
		$count=0;
		for($i=0;$i<$paperCount;$i++)
		{//循环依次组卷
			$sql_newPaper="insert into flow_paper(test_id,mpstrategy_id) values('".$testID."','".$mpsID."');";
			$result_newPaper=$db->execute_dml($sql_newPaper);//插入新试卷
			if($result_newPaper==1)
			{
				$count++;
				$sql_newPaperID="select LAST_INSERT_ID();";
				$result_newPaperID=$db->execute_dql($sql_newPaperID);
				while($row=mysqli_fetch_array($result_newPaperID))
				{
					$newPaperID=$row[0];
				}//获取新试卷id
				//echo "新试卷id".$newPaperID;
				
				$pq_id=1;//初始化试卷试题id
				foreach($result_getMPSInfor as $row)
				{//循环读取组卷策略每一项
					if($row['subject_question_select_order']==1)
					{
						$order_flow="flow_questions_id";
						$order_concept="questions_concept_id";
					}
					else
					{
						$order_flow="rand()";
						$order_concept="rand()";
					}//设置选题是否为随机
					if($no_diff==0)
					{
						$diff_flow="and `flow_questions_difficulty`=".$row['subject_flow_difficulty']." ";
						$diff_concept="and `questions_concept_difficulty`=".$row['subject_concept_difficulty']." ";
					}
					else
					{
						$diff_flow="";
						$diff_concept="";
					}//设置选题是否忽略难度
					$sql_getFlow="select flow_questions_id From flow_questions where `flow_questions_subject_id`=".$row['subject_id']." ".$diff_flow."and `flow_questions_enabled`='1' Order By ".$order_flow." Limit ".$row['subject_flow_num']."";
					$sql_getConcept="select questions_concept_id From flow_questions_concept  where `questions_concept_subject_id`=".$row['subject_id']." ".$diff_concept."and `questions_concept_enabled`='1' Order By ".$order_concept." Limit ".$row['subject_concept_num']."";
					$result_getFlow=$db->execute_dql2($sql_getFlow);//从题库中选取流程题
					$result_getConcept=$db->execute_dql2($sql_getConcept);//从题库中选取理论题
					$everyConceptScore=$row['subject_concept_score'];
					$everyFlowScore=$row['subject_flow_score'];
					if(count($result_getFlow,0)<$row['subject_flow_num']||count($result_getConcept,0)<$row['subject_concept_num'])
					{
						$sql_delEmptyPQ="delete from flow_papers_questions where papers_id='".$newPaperID."';";
						$result_delEmptyPQ=$db->execute_dml($sql_delEmptyPQ);
						$sql_delEmptyPaper="delete from flow_paper where paper_id='".$newPaperID."';";
						$result_delEmptyPaper=$db->execute_dml($sql_delEmptyPaper);
						
						$count=-1;
						return $count;
					}
					else
					{
						foreach($result_getFlow as $row)
						{//插入试卷与流程题的关联
							$sql_newPQ="insert into flow_papers_questions values('".$newPaperID."','".$pq_id."','".$row['flow_questions_id']."','1','".$everyFlowScore."');";
							$result_newPQ=$db->execute_dml($sql_newPQ);
							$pq_id++;
						}
						foreach($result_getConcept as $row)
						{//插入试卷与理论题的关联
							$sql_newPQ="insert into flow_papers_questions values('".$newPaperID."','".$pq_id."','".$row['questions_concept_id']."','0','".$everyConceptScore."');";
							$result_newPQ=$db->execute_dml($sql_newPQ);
							$pq_id++;
						}
					}
				}
			}
		}
		return $count;//返回组好卷子套数
	}
?>