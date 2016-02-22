<?php
	require "../share/function/sqlHelper.php";
	if(isset($_POST['mps_content']))
	{
		//echo "ok";
		$db=SqlHelper::getObj();
		//var_dump(json_decode($_POST['mps_content']));
		$mps_infor=json_decode($_POST['mps_content']);
		$mps_id=$mps_infor[0];
		$result=0;//0是成功，1是插入新组卷策略失败，2是删除条目失败，3是插入条目失败，4是更新条目失败
		if($mps_id=='new')
		{//插入新组卷策略
			$sql_getMPSID="select max(mpstrategy_id) from flow_makepapers_strategys;";
			echo $sql_getMPSID;
			$result_getMPSID=$db->execute_dql($sql_getMPSID);
			var_dump($result_getMPSID) ;
			while($row=mysqli_fetch_array($result_getMPSID,MYSQL_NUM))
			{
				$newMPSID=$row[0]+1;
			}
			for($i=1;$i<count($mps_infor,0);$i++)
			{
				$sql_insertMPS="insert into flow_makepapers_strategys(mpstrategy_id,subject_id,subject_flow_num,subject_concept_num,subject_flow_difficulty,subject_concept_difficulty,subject_flow_score,subject_concept_score,subject_question_select_order,subject_selectoptions_order) values('".$newMPSID."','".$mps_infor[$i][2]."','".$mps_infor[$i][3]."','".$mps_infor[$i][6]."','".$mps_infor[$i][4]."','".$mps_infor[$i][7]."','".$mps_infor[$i][5]."','".$mps_infor[$i][8]."','".$mps_infor[$i][9]."','".$mps_infor[$i][10]."');";
				$result_insertMPS=$db->execute_dml($sql_insertMPS);
				if($result_insertMPS==0)
					$result=1;//删除条目失败
			}
		}
		else
		{//更新组卷策略
			//echo count($mps_infor,0);
	/*删除组卷策略条目开始*/
			$sql_getMpsItemId="select mps_item_id from flow_makepapers_strategys where mpstrategy_id='".$mps_id."' order by mps_item_id;";
			$getMpsItemId=$db->execute_dql2($sql_getMpsItemId);
			//var_dump($getMpsItemId);
			for($i=0;$i<count($getMpsItemId,0);$i++)
			{
				$db_mpsi_id[$i]=$getMpsItemId[$i]['mps_item_id'];
			}
			//var_dump($db_mpsi_id);
			for($i=1;$i<count($mps_infor,0);$i++)
			{
				$page_mpsi_id[$i]=$mps_infor[$i][0];
			}
			//var_dump($page_mpsi_id);
			//var_dump(array_diff($db_mpsi_id,$page_mpsi_id));
			if(isset($db_mpsi_id))
			{
				$delete_mpsi_id=array_diff($db_mpsi_id,$page_mpsi_id);
				foreach($delete_mpsi_id as $row)
				{
					$sql_deletempsi="delete from flow_makepapers_strategys where mps_item_id='".$row."';";
					$result_deletempsi=$db->execute_dml($sql_deletempsi);
					if($result_deletempsi==0)
						$result=2;//删除条目失败
				}
			}
	/*删除组卷策略条目结束*/
			for($i=1;$i<count($mps_infor,0);$i++)
			{
				if($mps_infor[$i][0]=='new')
				{//插入新组卷策略条目
					$sql_insertmpsi="insert into flow_makepapers_strategys(mpstrategy_id,subject_id,subject_flow_num,subject_concept_num,subject_flow_difficulty,subject_concept_difficulty,subject_flow_score,subject_concept_score,subject_question_select_order,subject_selectoptions_order) values('".$mps_id."','".$mps_infor[$i][2]."','".$mps_infor[$i][3]."','".$mps_infor[$i][6]."','".$mps_infor[$i][4]."','".$mps_infor[$i][7]."','".$mps_infor[$i][5]."','".$mps_infor[$i][8]."','".$mps_infor[$i][9]."','".$mps_infor[$i][10]."');";
					echo $sql_insertmpsi;
					$result_insertmpsi=$db->execute_dml($sql_insertmpsi);
					if($result_insertmpsi==0)
						$result=3;//插入条目失败
					//echo "new".$result;
				}
				else
				{//更新组卷策略条目
					$sql_updatempsi="update flow_makepapers_strategys set subject_id='".$mps_infor[$i][2]."',subject_flow_num='".$mps_infor[$i][3]."',subject_flow_difficulty='".$mps_infor[$i][4]."',subject_flow_score='".$mps_infor[$i][5]."',subject_concept_num='".$mps_infor[$i][6]."',subject_concept_difficulty='".$mps_infor[$i][7]."',subject_concept_score='".$mps_infor[$i][8]."',subject_question_select_order='".$mps_infor[$i][9]."',subject_selectoptions_order='".$mps_infor[$i][10]."' where mps_item_id='".$mps_infor[$i][0]."';";
					$result_updatempsi=$db->execute_dml($sql_updatempsi);
					if($result_updatempsi==0)
						$result=4;//更新条目失败
					//echo "update".$result;
				}
			}
		}
		echo '<html>'; 
		echo '<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8" /></head>'; 
		switch($result)
		{
			case 1:echo "<script>alert('新增组卷策略发生错误，请重新操作！')</script>";break;
			case 2:echo "<script>alert('删除组卷策略条目发生错误，请重新操作！')</script>";break;
			case 3:echo "<script>alert('新增组卷策略条目发生错误，请重新操作！')</script>";break;
			case 4:echo "<script>alert('修改组卷策略条目发生错误，请重新操作！')</script>";break;
			default:echo "<script>alert('提交成功！')</script>";
		}
		echo '</html>'; 
		//$db->close_connect();
	}
	echo "<script>window.location.href='mana_set_ques_content.php'</script>";
?>