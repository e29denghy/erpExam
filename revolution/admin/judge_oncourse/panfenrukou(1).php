<?php
require_once ('../../share/function/sqlHelper.php');
require_once (dirname(__FILE__) . '/function.php');
header("Content-Type:text/html;charset=utf8");
//error_reporting(0);
?>
<?php
	$exam_id=1;//$_GET['exam_id'];
	$js_id=1;//$_GET['js_id'];
	if(isset($_GET['nums_key_option'])){
		$nums_key_option=$_GET['nums_key_option'];//判卷时，判断步骤对错的关键项个数。$_POST['nums_key_option'],可设置给用户输入
	}
	else{
		$nums_key_option=3;
	}

	if(isset($_GET['suanzi'])){
		$suanzi=$_GET['suanzi'];
	}
	else{
		$suanzi=0.7;//判卷时POST过来
	}
	
	$conn_db=SqlHelper::getObj();//连接数据库，选择DB-----------------------------这里你修改回自己的----------------------
	
	$update_exam_js="update flow_exam set judge_strategy_id='".$js_id."' where exam_id='".$exam_id."';";
	$result_update_exam_js=$conn_db->execute_dml($update_exam_js);//更新考试所对应的判卷策略
	
	$str_exam_inf="select flow_exam.exam_id,flow_judge_strategy.* from flow_judge_strategy,flow_exam where flow_judge_strategy.judge_strategy_id=flow_exam.judge_strategy_id and flow_exam.exam_id='".$exam_id."'";
	
	$exam_inf=$conn_db->execute_dql1($str_exam_inf);//$exam_inf存有附加题比例，逻辑错误比例
	
	if(!isset($exam_inf['exam_id']))
	{
	 echo "<script>alert('该考试不存在，请确认！')</script>";
	 echo "<script>window.location.href='../mode_grading_exam.php'</script>";
	}
	
	$user_id=2;//$_POST['users_id'];//---------------------------------------------------------------------------start
	 if(empty($user_id))
	  {
	    echo "<script>alert('考生未登陆，请先登陆！')</script>";
		//这里还要添加一个返回登陆页面，  
	  }//---------------------------------------------------------------------------------------------------end
	//die("this exam does not exist!");
	  $str_examination_log_id="select examination_log_id,papers_id,users_id from flow_examination_log where flow_examination_log.users_id=".$user_id;
	  $inf_examination_log_id=$conn_db->execute_dql1($str_examination_log_id);//得到所有考生考试记录ID。即得到所有考生，放在里面,二维数组

		if (empty($inf_examination_log_id)) {
			echo "<script>alert('该考试考生不存在，请确认！')</script>";
			echo "<script>window.location.href='../mode_grading_exam.php'</script>";
		}
	//循环取每一个考生,$v3存有examination_log_id,papers_id,users_id    
		$examination_log_id=null;
		$branch_answer=null;
		$branchpoint_answer=null;
		$standard_answer_nobranch=null;
		$allpoint_question_id=null;
		$one_question_allbranch=null;
		$res_match=null;
		$a1=array();
		$b1=array();
	
		$a2=array();
		$b2=array();
		// $c2=array();
		$select_branch=null;
		$standard_answer_branch=null;
		$stu_standard_answer=null;
		$all_question_id=null;
		$one_question_allanswer=null;
		$max=null;
		$result_match=null;
		$useranswer_step=null;
		$corre_point=null;
		$cut_step=null;
		$lack_step_nums=null;
		$score_rate=null;
		$step_branch_id=null;
		$question_id=null;
		$add_rate=null;
		$one_question_score=null;
		$correct_step_score=null;
		$use_step_id=null;
		$all_str_onestep_remark=null;
		$all_correct_step_score=null;
		$str_onestep_addremark=null;
		$examlog_useransw_id=null;//每次循环要将变量重置，不然会重复使用不属于该考生的数据
	try{
		$examination_log_id=$inf_examination_log_id['examination_log_id'];//根据这个，可以对步骤题和理论题、附加题筛选。
	
		$str_user_answer=null;
		$str_user_answer="select * from flow_examlog_useransw where examination_log_id=".$examination_log_id;//取得考生所有答案
	
		$str_question_id=null;
		$str_question_id="(select distinct flow_papers_questions.papers_questions_id,flow_papers_questions.questions_id as q_id from flow_papers_questions,flow_examlog_useransw where flow_papers_questions.papers_questions_id=flow_examlog_useransw.papers_question_id and flow_examlog_useransw.examination_log_id=".$examination_log_id.") as question_id_table";
		//这个找出一个考生答案表对应的试卷ID，再通过试卷ID找出对应的流程题目ID
	
		$str_standard_answer=null;
		$str_standard_answer="select flow_answers.*,question_id_table.papers_questions_id from flow_answers,".$str_question_id." where flow_answers.flow_questions_id=question_id_table.q_id";//取得一个考生的所有流程题问题的标准答案。flow_answers.*,question_id_table.papers_questions_id这里把paper_id和question_id关联起来，其中的一个就可以作为标准答案的唯一标识
	
	
		$user_answer=null;
		 echo $str_user_answer."</br>";
		$user_answer=$conn_db->execute_dql2($str_user_answer);
	   
	
		if(!$user_answer)//考生答案为空
		{  
	
			echo "<script>alert('该考试考生".$examination_log_id."答案不存在，请确认！')</script>";
			break;
		}
		//添加返回框提示用户
	
		 
	
		if(is_string(key($user_answer)))//如果是一维数组，则增加一个空数组让其成为二维数组，便于使用foreach
			$user_answer=array($user_answer,array());
	
			$standard_answer=null;
			$standard_answer=$conn_db->execute_dql2($str_standard_answer);
		if(empty($standard_answer))
		{
			echo "<script>alert('该考试标准答案不存在，请确认！')</script>";
			//echo "<script>window.location.href='../mode_grading_exam.php'</script>";
		}
	
	
	
	//if(!$standard_answer)//标准答案为空
		  //添加返回框提示用户
	
		if(is_string(key($standard_answer)))
		   $standard_answer=array($standard_answer,array());//还没有筛选分支
	
	
	
	
		foreach($standard_answer as $k4=>$v4){
			if(!empty($v4)&&$v4['flow_answers_steps_branchsign']=="1")
			{
				$branch_answer[]=$v4;//将所有属于分支的答案放进去。
				if(!empty($v4['flow_answers_steps_branchpoint']))
					{
					$branchpoint_answer[]=$v4;//有分支点的答案放进去
					}
			}
	
	
		    else
			   $standard_answer_nobranch[]=$v4;
		}
	
	
		if($branchpoint_answer){
			$allpoint_question_id=get_all_type1($branchpoint_answer,"papers_questions_id");//考生题目的标准答案有分支点的所有题目ID存入这个一维数组中
		}
	
	
	if(!empty($allpoint_question_id))
	{
	    foreach($allpoint_question_id as $k5=>$v5)
		{
		    if(isset($v5))	  
			{
				foreach($branchpoint_answer as $k6=>$v6)//这个循环取出某个问题ID的所有有分支点的分支
			    {
					if($v6['papers_questions_id']==$v5)
					{
						$one_question_allbranch[]=$v6;//1题（整条记录的）,用这个参数,放入返回分支函数中。这个是参数$standard_answer
					}
			    }
	
	
	
			    foreach($user_answer as $k7=>$v7)
			    {//这个循环每次取出1个问题ID的一个步骤,一条考生答案表记录
	
	                if(!empty($v7)&&$v7['papers_question_id']==$v5)
				  	{
					
						$res_match=match_branch($v7,$one_question_allbranch,$nums_key_option);
	
						if($res_match[0]==true)
						{
	                   		$a1[]=$v7['usersansw_steps_id'];//存放该考生答案步骤的ID
							$b1[$v5][$v7['usersansw_steps_id']]=$res_match[1];//存放该步骤相对应的分支号；
					   	}
					             // var_dump($v7);
		
				    }
			    }
	
			   if(!empty($a1))
				 { 
				   sort($a1);
			       $select_branch=$b1[$v5][$a1[0]];//$c的第一个为考生答案最前的步骤，这里返回当前答案的分支号
				 }
	
			}//if的括号
	
	
	
			 
			 if(isset($select_branch))
		   {
			 foreach($branch_answer as $k8=>$v8)
			 {
			   if($v8['papers_questions_id']==$v5&&$v8['flow_answers_steps_branchid']==$select_branch)
				 {
	
			       $standard_answer_branch[]=$v8;//把选择了分支的答案放进去。
			     }
			 
			 }//根据问题ID和分支号，将$branch_answer扫描一遍，把相关的记录挑出来
		   }
	
	
	
		 }//获取第1题的所有有分支点的分支，2、3、……、n.所有题.里面找出所有问题ID相关的答案分支、$standard_answer_branch存放所有匹配好的分支答案。
	//var_dump($standard_answer_nobranch);
		}//if(!empty($allpoint_question_id))
	
	
	    if($standard_answer_branch==null)
	        $standard_answer_branch=array();
		 $stu_standard_answer=array_merge($standard_answer_nobranch,$standard_answer_branch);//将有分支和没分支答案合并，得到对应考生题ID的标准答案。
	
		  if(is_string(key($stu_standard_answer)))
			   $stu_standard_answer=array($stu_standard_answer,array());
	
	 if(empty($stu_standard_answer))
	{
	 echo "<script>alert('考试ID为".$examination_log_id."的考生，答案匹配不到标准答案，请确认！')</script>";
	 break;
	}
	
	    //var_dump($stu_standard_answer);
		
		 //以上过程找出1个考生的所有标准答案。
		 
		 
		 //下面匹配答案，可以用到上面$v7的做法，进行匹配。用$all_question_id进行问题步骤匹配
	
	    
		  $all_question_id=get_all_type1($stu_standard_answer,"papers_questions_id");//考生答案所有题目ID存入这个一维数组中
	
		  
	      include(dirname(__FILE__).'/fujiati.php');//选出正确的附加题，下面判断是否给分。
	
	      foreach($all_question_id as $k9=>$v9)
		 {
	  //  var_dump($v9);
		      if(isset($v9))
		try{
	
			$res_judge=onequestionpanfen($v9,$stu_standard_answer,$b1,$user_answer,$inf_examination_log_id,$conn_db,$exam_inf,$nums_key_option,$suanzi,$single_add,$multiply_add,$examination_log_id);	  
			  }
			  catch(Exception $e)
			 {
			  if($e->getMessage()=="2")
				  throw $e;
			  else
				  throw new Exception("1"); 
			  }
	
		 }//一个问题ID

		// $percent=($k3+1)/count($arr_examination_log_id);

?>
<!--
<script >
var percent=<?php echo json_encode(number_format($percent,2));?>;
var per_num=percent*100;
$('#per').html(per_num+'%');
</script>
!-->
<?php
//修改判卷界面的百分比进度条
//以下要更新数据库信息。
//以下是理论题的判分。
try {
	include (dirname(__FILE__) . '/lilunti.php');
} catch(Exception $e) {
	throw new Exception("2");
}
$add_score = 0;
$concept_score = 0;
$flow_score = 0;
$str_add_score = "select sum(examlog_score) from flow_examlog_useransw_add where examination_log_id=" . $examination_log_id;
$str_concept_score = "select sum(examlog_score) from flow_examlog_useransw_concept where examination_log_id=" . $examination_log_id;
$str_flow_score = "select sum(score) from flow_exam_result where users_id=" . $inf_examination_log_id['users_id'] . " and papers_id=" . $inf_examination_log_id['papers_id'] . " and exam_id=" . $exam_inf['exam_id'];
$add_score = $conn_db -> execute_dql1($str_add_score);
$concept_score = $conn_db -> execute_dql1($str_concept_score);
$flow_score = $conn_db -> execute_dql1($str_flow_score);
$sum_score = current($add_score) + current($concept_score) + current($flow_score);
// var_dump(current($concept_score));
//var_dump(current($flow_score));
// var_dump($sum_score);
$str_insert_flow_exam_grade = "insert into flow_exam_grade values (" . $examination_log_id . "," . $sum_score . ") on duplicate key update grade=" . $sum_score;
$conn_db -> execute_dml($str_insert_flow_exam_grade);
//存储总分到flow_exam_grade
}//try
catch(Exception $e)
{
switch($e->getMessage)
{
case "1":
$type=1;
break;
case "2":
$type=2;
break;
case "3":
$type=3;
break;
default:
$type=null;
}
$str_insert_error="insert into flow_judge_error values (null,".$exam_id.",".$inf_examination_log_id['papers_id'].",null,".$type.",".$inf_examination_log_id['users_id'].",null,null,null,null)";
$conn_db->execute_dml($str_insert_error);
}
//一个考生，改完一个考生以后，要把前面所有变量资源释放。重新改另外一位考生
//$conn_db->close_connect();//释放连接
// echo "<meta http-equiv='Content-Type' content='text/html; charset=UTF-8' />";
// echo "<script>alert('判卷成功！');window.location.href='../mode_grading_exam.php';</script>"; //mode_grading_exam.php
// echo "<script>window.location.href='../mode_grading_exam.php'</script>";
echo "成功";
var_dump($res_judge);
?>
