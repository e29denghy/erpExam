<?php
require_once ('../../share/function/sqlHelper.php');
require_once(dirname(__FILE__).'/function.php');
header("Content-Type:text/html;charset=utf8");
error_reporting(0);
?>
<!DOCTYPE html>
<html lang="zh-cn">
  <head>
    <meta charset="utf-8">
    <title></title>
    <script src="../../share/jscripts/modernizr-2.8.2.js"></script>
    <link rel="stylesheet" href="../../share/styles/main.css">
    <link rel="stylesheet" href="../../share/styles/load4.css">
  </head>
  <body>
    <main style="margin-top:90px">
      <div class="inner">
        <div class="load-container load4">
          <div class="loader">Loading...
          </div>
          <span style='margin-left:40px;'>  正在判卷中... </span ><span id='per'></span>
        </div>
      </div>
    </main>
   
  </body>
</html>
<script src="../../share/jscripts/jquery.min.js"></script>

<?php
$exam_id=$_GET['exam_id'];-------------------------------这里考试ID不一定是1，你怎样传递的？--------------
$js_id=$_GET['js_id'];--------------------------------------------这里的策略也不一定是1-------------------
if(isset($_GET['nums_key_option']))
$nums_key_option=$_GET['nums_key_option'];//判卷时，判断步骤对错的关键项个数。$_POST['nums_key_option'],可设置给用户输入
else
$nums_key_option=2;//----------------------------按照我们定得，应该是2个关键项作为唯一标识----------------------

if(isset($_GET['suanzi']))
$suanzi=$_GET['suanzi'];
else
$suanzi=0.7;//判卷时POST过来

$conn_db=SqlHelper::getObj();//连接数据库，选择DB

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
//---------------------------------------------------------------------这些可以删除s--------------------------
//$str_select_usergroups_id='select usergroups_id from flow_exam_usergroups where exam_id='.$exam_inf['exam_id'];//查询语句

//$arr_group_id=$conn_db->execute_dql2($str_select_usergroups_id);//返回结果数组,用户组ID
//if(!isset($arr_group_id))
//{
 //echo "<script>alert('该考试用户组不存在，请确认！')</script>";
 //echo "<script>window.location.href='../mode_grading_exam.php'</script>";

//}



//if(is_string(key($arr_group_id)))//如果是一维数组，则增加一个空数组让其成为二维数组，便于使用foreach
//          $arr_group_id=array($arr_group_id,array());


//$i=0;
//foreach($arr_group_id as $k1=>$v1){
	
//	if(isset($v1)) 
//	{
//	 $group_id[]=$v1['usergroups_id'];//存储组ID，把考生组都记录下来，$i记录一共有多少个组。
	// $i++;
	//}
//}//3个组

   //  $str_group_id="usrgrp_group_id=".$group_id[0];
	 //for($a=1;$a<$i;$a++){
//	 $str_group_id.=" OR usrgrp_group_id=".$group_id[$a];
	// }//1||2||3，把每个组的ID得出，然后由下面查出所有组的用户ID、



 // $str_select_stu_id="(select distinct usrgrp_user_id as u_id from tce_usrgroups where ".$str_group_id."  order //by u_id asc) as userid";//查询考生ID
 //----------------------------------------------------------------------删除到这里e---------------------------
   $str_examination_log_id="select examination_log_id,papers_id,users_id from flow_examination_log where flow_examination_log.users_id=".$user_id." and exam_id = '{$exam_id}'";
  $inf_examination_log_id=$conn_db->execute_dql1($str_examination_log_id);//得到所有考生考试记录ID。即得到所有考生，放在里面,二维数组
 
  if(!isset($inf_examination_log_id))
{
 echo "<script>alert('考生没有参与考试，请确认！')</script>";
// echo "<script>window.location.href='../mode_grading_exam.php'</script>";

}

//foreach($arr_examination_log_id as $k3=>$inf_examination_log_id){//循环取每一个考生,$inf_examination_log_id存有examination_log_id,papers_id,users_id---------------------------------------------------------------------------- 
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
	$user_answer=$conn_db->execute_dql2($str_user_answer);
	if(!$user_answer)//考生答案为空
	{  

		echo "<script>alert('该考试考生".$examination_log_id."答案不存在，请确认！')</script>";//----------------------------------把$inf_examination_log_id改为$examination_log_id--------------------------
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
		echo "<script>window.location.href='../mode_grading_exam.php'</script>";
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
			 // ---------------------------------------------------------------------------------------------start
		foreach($stu_standard_answer as $k10=>$v10)//这个循环取出某个问题ID的所有答案
		   {
		      if(!empty($v10)&&$v10['papers_questions_id']==$v9)
			 {
			  $one_question_allanswer[]=$v10;//1题（所有步骤整条记录的）,用这个参数,放入返回步骤函数中。这个是参数$standard_answer
			 }
		   }
		  // var_dump($one_question_allanswer);

		   $max=count_standardanswer_step($one_question_allanswer,$v9);//一题的所有步骤

		   $k=0;

		 //  var_dump($one_question_allanswer);

		  foreach($user_answer as $k11=>$v11)
		   {//这个循环每次取出1个问题ID的一个步骤,一条考生答案表记录
                if(!empty($v11)&&$v11['papers_question_id']==$v9)
			  {
					
				  $a2[]=$v11['usersansw_steps_id'];//存放该考生答案步骤的ID

				  $result_match[]=match_answer($v11,$one_question_allanswer,$nums_key_option,$max);

				  //if($v9=="1")
					  
			 

				  //把$result_match[1]存储到表flow_exam_judge的remark内
				  $b2[$v11['usersansw_steps_id']]=$result_match[$k][1];//存放该考生步骤相对应的标准答案步骤ID号；
				 //  var_dump($resulst_match[$k][1]);

			//	 $c2[$v11['usersansw_steps_id']]=$v11['examlog_useransw_id'];
				   
				   $k++;//这个存放考生答案的全部步骤数量
				   
			  }
		   }

//var_dump($result_match);


		   if(!empty($a2))
			 { 
			   sort($a2);
		       foreach($a2 as $k12=>$v12)
			   {
                $useranswer_step[]=$b2[$v12];//$useranswer_step表示根据考生答案步骤，匹配好的标准答案步骤即ADEFG，步骤一对应于[0] 
              //  $examlog_useransw_id[]=$c2[$v12];
			   }
		      
			 }


			 if($exam_inf['branch_control']==3&&!empty($b1[$v9]))//逻辑控制等于3
			 {


              if(count($b1)<2)
				 array_push($b1,0);

	
			   foreach($b1[$v9] as $kb1=>$vb1)
				 {
				 //  echo "aaaaaaaaa";
			      if($vb1!=null)
					 {
					     if(!isset($corre_point))
					    {
					     $corre_point=$vb1;
					     continue;
					    }
					 if($corre_point!=$vb1)
						{
                        $cut_step=$kb1;//这个步骤以后的都要剪掉不给分。
						break;
						}
					 }
					}

                if(!empty($cut_step))
				 array_splice($useranswer_step,($cut_step-1));
				  array_pop($b1);
			 }

                 
				  

             

		   if(!empty($useranswer_step))
		 {
            $Error_Logger=array();
			$Error_Logger_Site=array();

			$Error_Accident=array();
			$Error_Accident_Site=array();

			$current_point=0;



            foreach($useranswer_step as $k12=>$v12)//这里k12的值比考生答案步骤小1
			{
				if($v12>$max)//判卷流程3.1
				{
                  $Error_Accident[]=$v12;
                  $Error_Accident_Site[]=$k12+1;
				  continue;
				}
				else //4.2
				{
				 if(isset($answer_sequence[0])&&(($v12-$useranswer_step[$current_point]-1)<0))//R(i)-R(i-1),5.2
				     {
					 $Error_Logger[]=$v12;
					 $Error_Logger_Site[]=$k12+1;
					 continue;//将逻辑错误的步骤记录起来，结束当次循环，执行下次循环。
				     }

				 $answer_sequence[]=$v12;//最长子序列。
				 $current_point=$k12;

				}
              

			} //将答案序列按顺序找出子序列；



          

		//	exit(0);
           if(!empty($answer_sequence))
		 {

		    array_unshift($answer_sequence,"0");
			
            //以上得出0 sequence的序列，用来找出缺省步骤。

			foreach($answer_sequence as $k13=>$v13)
			{
 
			  if($k13==0)
				  continue;//第一个数直接跳过
			  else
			  {
				  $lack_step_nums=$v13-$answer_sequence[$k13-1];
				  switch($lack_step_nums)
				  {
				   case 0:
				   case 1:
					   $score_rate=1;
				        break;
				   case 2:
					   $score_rate=0.8;
				        break;
					case 3:
					   $score_rate=0.5;
					    break;
					case 4:
					   $score_rate=0.3;
					    break;
					default :
						$score_rate=0;
					    break;
              
				   }//缺漏步骤扣分策略

                   foreach($result_match as $k14=>$v14)
				   {
					   if($v14[1]==$v13)//返回序列等于答案序列
					   
					   {
						$step_branch_id=$v14[2];
					    break;
					   }
				   }




				   foreach($stu_standard_answer as $k15=>$v15)
				   {   
					   $question_add_id=null;

					   if($v15['papers_questions_id']==$v9)
					   {
						  $question_id=$v15['flow_questions_id'];
					      break;//根据试卷试题ID获取题目ID
					   }
				   }

				  // echo "bbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbb?</br>";

				   $str_isset_add=null;

				   if($step_branch_id==null)
					   $step_branch_id=0;//数据库存储0为没有分支


				   $str_isset_add="select questions_add_id from flow_questions_add where questions_flow_step_id=".$v13." and flow_steps_blanchid=".$step_branch_id." and questions_flow_id=".$question_id;//$v11为步骤题的考生答案一条记录

				   $question_add_id=$conn_db->execute_dql2($str_isset_add);//这个ID用作后面附加题判分。1个步骤所有题目ID

//var_dump($question_add_id);


           try{
				   if(!empty($question_add_id))
					  {
					 //  echo "!!!!!!!!!!!!!!!!!!!!";
                     //    var_dump($question_id);
					   include(dirname(__FILE__).'/panfenfujiati.php');
					   $add_rate=$exam_inf['score_step_add'];//这个是一场考试的比率，针对该场考试所有考生。
					   
					  }
				   else
					   $add_rate=1;//附加题的得分比率
			  }
			  catch(Exception $e)
				  {
			             throw new Exception("3");
			      }


				   $str_one_question_score="select score from flow_papers_questions where papers_questions_id=".$v9." and papers_id=".$inf_examination_log_id['papers_id'];

				   $one_question_score=$conn_db->execute_dql1($str_one_question_score);





				   $correct_step_score=$score_rate*$one_question_score['score']*$add_rate/$max;//$one_question_score['score']为一道步骤题的分,$score_rate为减去缺漏步骤的步骤得分比率，$add_rate为附加题比率

                   foreach($useranswer_step as $kb2=>$vb2)
				   {
				    if($vb2==$v13)
					   {	
					     $use_step_id=$kb2;
					     break;
					   }
				   }


				   $one_step_full_score=($one_question_score['score']/$max);
                   $str_onestep_remark="。考生答案第".($use_step_id+1)."步u_step(".($use_step_id+1).")匹配到标准答案第".$v13."步s_step(".$v13.")，得分为：".$one_step_full_score."分";
				   
				  
				   if($add_rate!=1)
				   {
				    $str_onestep_remark.="，扣去附加题分数比例，应得分为".($one_step_full_score*$add_rate)."分";
				   
				   }

				   if($lack_step_nums>1)
				  {
				   $str_onestep_remark.="，该步骤缺省".$lack_step_nums."步，应得分".($score_rate*$one_step_full_score*$add_rate)."分";
				   }

				   $all_str_onestep_remark[]=$str_onestep_remark;//一题所有每个步骤的remark存在里面

				   $all_correct_step_score[]=$correct_step_score;//一题的每个步骤所有分数存在里面

				  //var_dump($all_str_onestep_remark);


				 //  $str_update_step_score="update flow_exam_judge set score=".$correct_step_score." where questions_flow_step_id=".$v13." and match_branch_id=".$step_branch_id." and questions_flow_id=".$question_id;

				//   $conn_db->execute_dml($str_update_step_score);

		
				   
				   //更新flow_exam_judge表

			  }
			}//k13的foreach结束
			
            array_shift($answer_sequence);
		 }//if(!empty($answer_sequence));

			$all_step_score=0;
		if(!empty($all_correct_step_score))
			{
			  foreach($all_correct_step_score as $k16=>$v16){
			    $all_step_score=$all_step_score+$v16;
			   }
			}

			$n=count($Error_Logger);//统计逻辑错误的个数。

			if($exam_inf['extra_steps_control']==2)//扣除多余步骤策略
			 {
				if(!empty($Error_Accident))
				{
			      $n=$n+count($Error_Accident);
                 if(!empty($all_str_onestep_remark))
                  $str_acci_remark="。意外步骤为：";
				 else
                  $str_acci_remark="意外步骤为：";

				 if(!empty($Error_Accident_Site ))
				{
				  foreach($Error_Accident_Site as $kEA=>$vEA)
					{

					  if($kEA==0)
						  $str_acci_remark.="第".$vEA."步";
                      else
				          $str_acci_remark.="、第".$vEA."步";
				    }
				}
					$str_acci_remark.="按照逻辑分扣除";
				}
			 }

			$one_flowque_score=$all_step_score*(1-$n*$exam_inf['logic_deduct']);//这个是一道流程题的得分。

			$str_a2=null;
			if(!empty($a2))
		 {
			foreach($a2 as $ka2=>$va2)
			 {
				if($ka2==0)
			    $str_a2=$va2;
				else
					$str_a2.="、".$va2;
			 }
		 }
			 $str_useranswer_step=null;

			 if(!empty($useranswer_step))
			{
			 foreach($useranswer_step as $kus=>$vus)
			 {
				 if($kus==0)
                   $str_useranswer_step=$vus;
				 else
			       $str_useranswer_step.="、".$vus;
			 }
			}
			 $str_answer_sequence=null;
			 if(!empty($answer_sequence))
		{
			foreach($answer_sequence as $kas=>$vas)
			 {
				if($kas==0)
			    $str_answer_sequence=$vas;
				else
					$str_answer_sequence.="、".$vas;
			 }
		}
 			if(count($a2)>count($useranswer_step))
				$str_cut=",答案分支选择错误，后面步骤不匹配";
			else
				$str_cut=null;

			$str_step_score="考生答案序列u_step:".$str_a2.",匹配到标准答案序列s_step:".$str_useranswer_step.$str_cut."。得分序列:".$str_answer_sequence."。正确步骤应得分为：".$all_step_score."分";


			
      if(!empty($all_str_onestep_remark))
		 {
			foreach($all_str_onestep_remark as $kasor=>$vasor)
			 {
			   $str_onestep_addremark.=$vasor;
			 }
		 }

			 $str_step_score.=$str_onestep_addremark;//追加每一个步骤的remark

			 if(!empty($str_acci_remark))
               $str_step_score.=$str_acci_remark;

             if(!empty($Error_Logger))
			 {
			if(!empty($str_step_score))
              $str_logger_remark="。逻辑错误为：";
			else
              $str_logger_remark="逻辑错误为：";
              foreach($Error_Logger_Site as $kEL=>$vEL)
			   {
				 if($kEL==0)
						  $str_logger_remark.="第".$vEL."步";
                      else
				          $str_logger_remark.="、第".$vEL."步";
			   }
                 $str_logger_remark.="。应扣除总分的".(100*$n*$exam_inf['logic_deduct'])."% ";
			   
			 }

			 if(!empty($str_logger_remark))
                $str_step_score.=$str_logger_remark;//追加逻辑错误remark
			 
			$str_result_remark=$str_step_score;
            $str_result_remark.="。该题总得分为：".$one_flowque_score;


            $str_insert_flow_exam_result="insert into flow_exam_result values (".$inf_examination_log_id['users_id'].",".$exam_inf['exam_id'].",".$inf_examination_log_id['papers_id'].",".$v9.",".$one_flowque_score.",'".$str_result_remark."') on duplicate key update score=".$one_flowque_score.",result_remark='".$str_result_remark."'";
			

			$conn_db->execute_dml($str_insert_flow_exam_result);



			//以上是一题总得分，要扣减逻辑分。以下是每题的每个步骤得分
			for($cc=1;$cc<$k+1;$cc++)
			{
			  foreach($user_answer as $kua=>$vua)
				{
			     if($vua['papers_question_id']==$v9&&$vua['usersansw_steps_id']==$cc)
					{
					 $examlog_useransw_id=$vua['examlog_useransw_id'];
					 break;
					}
			    }
               if(!empty($b1[$v9]))
				$branch_id=$b1[$v9][$cc];
			   else
				   $branch_id=null;
				$step_id=$b2[$cc];

                $judge_score=0;
				if(!empty($answer_sequence))
			{
				foreach($answer_sequence as $kase=>$vase)
				{
				 if($vase==$step_id)
					{

					 $error_notkeyoption_nums=count($result_match[$step_id-1][3]);
                     $all_notkeyoption_nums=1;
					 
					 if($error_notkeyoption_nums!==0)
                        $all_notkeyoption_nums=$result_match[$step_id-1][4]-$nums_key_option;

					 $judge_score=$all_correct_step_score[$kase]*(1-(1-$suanzi)*$error_notkeyoption_nums/$all_notkeyoption_nums);
				     break;
					}
				
				}
			}
				


				$str_judge_remark_logger=null;
				$str_judge_remark_accident=null;

           if(!empty($Error_Logger_Site))
			{
				foreach($Error_Logger_Site as $kels=>$vels)
				{
				  if($vels==$cc)
					{
					  $str_judge_remark_logger="逻辑错误";
					  break;
					}
				}
			}
           if(!empty($Error_Accident_Site))
			{
				foreach($Error_Accident_Site as $kals=>$vals)
				{
				  if($vals==$cc)
					{
					  $str_judge_remark_accident="意外选项错误";
					  break;
					}
				}
			}

				if(!empty($str_judge_remark_logger))
					$str_judge_remark=$str_judge_remark_logger;

                else if(!empty($cut_step)&&$cc==($cut_step-1))
                    $str_judge_remark="该步骤分支匹配错误，后面的都不得分";
				else if(!empty($str_judge_remark_accident))
                    $str_judge_remark=$str_judge_remark_accident;

				else if(!empty($cut_step)&&$cc>($cut_step-1))
					$str_judge_remark="步骤不得分";
				else 
                    $str_judge_remark="步骤正确";


	
                if($branch_id==null)
					$branch_id=0;

			    
				$str_insert_flow_exam_judge="insert into flow_exam_judge values(".$examlog_useransw_id.",".$branch_id.",".$step_id.",".$judge_score.",'".$suanzi."','".$str_judge_remark."') on duplicate key update score=".$judge_score.",judge_remark='".$str_judge_remark."'";

				$conn_db->execute_dml($str_insert_flow_exam_judge);
			


			
			}
			

		 }//if(isset($useranswer_step))结束
		 //---------------------------------------------------------------------------------------------------end

		  }
		  catch(Exception $e)
		 {
		  if($e->getMessage()=="2")
			  throw $e;
		  else
			  throw new Exception("1"); 
		  }

	 }//一个问题ID

	 $percent=($k3+1)/count($arr_examination_log_id);
	?>
	<script >
		var percent=<?php echo json_encode(number_format($percent,2));?>;
		var per_num=percent*100;
		$('#per').html(per_num+'%');
	</script>

	<?php
	 //修改判卷界面的百分比进度条
	
	 //以下要更新数据库信息。

  //以下是理论题的判分。

try{
    include(dirname(__FILE__).'/lilunti.php');
   }
   catch(Exception $e)
	{
      throw new Exception("2");
   }


  $add_score=0;
  $concept_score=0;
  $flow_score=0;



  $str_add_score="select sum(examlog_score) from flow_examlog_useransw_add where examination_log_id=".$examination_log_id;

  $str_concept_score="select sum(examlog_score) from flow_examlog_useransw_concept where examination_log_id=".$examination_log_id;

  $str_flow_score="select sum(score) from flow_exam_result where users_id=".$inf_examination_log_id['users_id']." and papers_id=".$inf_examination_log_id['papers_id']." and exam_id=".$exam_inf['exam_id'];


  $add_score=$conn_db->execute_dql1($str_add_score);


  $concept_score=$conn_db->execute_dql1($str_concept_score);

  $flow_score=$conn_db->execute_dql1($str_flow_score);


  $sum_score=current($add_score)+current($concept_score)+current($flow_score);

  //var_dump(current($add_score));
 // var_dump(current($concept_score));
 //var_dump(current($flow_score));

 // var_dump($sum_score);

  $str_insert_flow_exam_grade="insert into flow_exam_grade values (".$examination_log_id.",".$sum_score.") on duplicate key update grade=".$sum_score;

  $conn_db->execute_dml($str_insert_flow_exam_grade);


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
 // }//一个考生，改完一个考生以后，要把前面所有变量资源释放。重新改另外一位考生----------------------------------------------把循环的括号不要-------------------------------------------------
  $conn_db->close_connect();//释放连接
  echo "<meta http-equiv='Content-Type' content='text/html; charset=UTF-8' />";
  echo "<script>alert('判卷成功！');window.location.href='../mode_grading_exam.php';</script>"; //mode_grading_exam.php  
// echo "<script>window.location.href='../mode_grading_exam.php'</script>";
  echo "aaaaaaaaaaa";
  var_dump($answer_sequence); //--------------------------------------这个是正确序列，看你怎样传递--------------------------
?>
