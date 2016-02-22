<?php
//$arr1=array('usersansw_steps_option1'=>'1','usersansw_steps_option2'=>'3','usersansw_steps_option3'=>'4');

//$arr2=array('flow_questions_id'=>1,'flow_answers_steps_option1'=>'1','flow_answers_steps_option2'=>'3','flow_answers_steps_option3'=>'2','flow_answers_steps_branchsign'=>'yes','flow_answers_steps_branchid'=>'222');
//$arr3=array('flow_questions_id'=>1,'flow_answers_steps_option1'=>'2','flow_answers_steps_option2'=>'4','flow_answers_steps_option3'=>'4','flow_answers_steps_branchsign'=>'yes','flow_answers_steps_branchid'=>'333');

//$arr4=array($arr2,$arr3);

//$arr1=array($arr1,array());
//var_dump($arr1);

//$str="flow_answers_steps_option"."1";


//$r=get_all_type2($arr4,"flow_answers_steps_option1","flow_answers_steps_option2");

//$arr6=array(1);
//var_dump($r);//----------测试






function get_all_type1($arr,$keyword){//用来获取所有题号，或分支号，不重复的(鉴于同一题有很多步骤，会有很多重复题id)

	$res=array();

	//var_dump($arr);
   if(is_array($arr))
	{

	foreach($arr as $key=>$value)
	{
		if($value!=null)
	 {


	  if(!in_array($value[$keyword],$res))
	   {
        $res[]=$value[$keyword]; 
	   }
	 }
	}
	 
	}
	 if($res)
	  return $res;
	  else
		  return 0;

}

function get_all_type2($arr,$keyword1,$keyword2){//用来获取所有题号，或分支号，不重复的(鉴于同一题有很多步骤，会有很多重复题id)
	$res_help=array();
	foreach($arr as $key=>$value){
		if($value!=null)
	{


	  if(!in_array($value[$keyword1],$res_help))
	   {

		$value2k[$keyword1]=$value[$keyword1];
		$value2k[$keyword2]=$value[$keyword2];

        $res_help[]=$value[$keyword1];
        $res[]=$value2k; 
	   }
	}
	 
	}
	 if($res)
	  return $res;
	  else
		  return 0;

}



function match_answer($one_answer,$standard_answer,$num,$max){//当用到错误项信息时，若没有匹配到，一定返回错误位置。若匹配成功，可能有错误位置，也可能没有错误位置。使用这个函数时，要判断错误信息是否存在。
	
     $res=array();//作为结果返回值.$res[0]存放是否匹配成功，$res[1]存放步骤ID,$res[2]存放所有错误信息的位置

	 $is_match=false;// 是否匹配成功的标志,开始为false

	 $i=0;
	 $j=0;
	 $pattern="/flow_answers_steps_option/i";

     if(is_string(key($standard_answer)))
        $standard_answer=array($standard_answer,array());//将数组变为二维数组。

	 //var_dump($standard_answer);

	 foreach($standard_answer as $key=>$value)
  {
	 if($value==null)
		 break;
	
	if($i==0)
	{
     foreach($value as $k=>$v)//这个循环用于统计标准答案option个数
	   {
		 if(preg_match($pattern,$k))
		  {
	        if(!$v)
			  break;
		    else 
			  $i++;
		  }
	   }
	} 


	if($i>0)
   {	
		for($j=1;$j<$i+1;$j++)//这个循环结束，可以判断匹配是否成功
	{

		  $stu_option2="usersansw_steps_option".$j;
		  $stand_option2="flow_answers_steps_option".$j;
		 if($j<$num+1)//关键项判断
		  {
              if(!($value[$stand_option2]==$one_answer[$stu_option2]))
				 break;
		  }

 		 else if(!($value[$stand_option2]==$one_answer[$stu_option2]))//这个是，对非关键OPTION的判断
		  {
			   $Error_notkey_option[]=$j;//将所有非关键选项错误的位置全部保存在数组内，用于后面错题反馈。
		  }


	}

	if($j>$num)
		{
		$is_match=true;
	    }
	    
   }

   if($is_match==true)
	   break;//如果匹配到就跳出循环，不匹配其他步骤了。

  }
  
  if($is_match==false)
	  {
	   $res[0]=false;
	   $res[1]=$max+5;
	   $res[2]=null;
	   return $res;
      }
	else if($is_match==true)
	{$res[0]=true;

	 $res[1]=$value['flow_answers_steps_id'];//返回步骤ID号

	 if(!empty($value['flow_answers_steps_branchid']))
		 $res[2]=$value['flow_answers_steps_branchid'];//返回分支号
	 else 
		 $res[2]=null;

	if(isset($Error_notkey_option))//可能全对，或者是分支匹配没用到。
	    $res[3]=$Error_notkey_option;
	else $res[3]=null;


	    $res[4]=$i;//option数量

	return $res;//匹配成功的话，把非关键项错误的位置返回
	}    


 }//$one_answer需要匹配的一条考生答案记录，$standard_answer是标准答案记录，$num是设定需要前几个项正确，来确定这个步骤是否正确。最后返回匹配到的步骤。调用前确保题目ID已经筛选好，都是相同的。




function match_branch($one_answer,$standard_answer,$num){//$res[0]存放是否匹配成功,$res[1]存放分支号
      $res=array();
	  $is_match=false;

	  $i=0;
	  $j=0;
	  $pattern="/flow_answers_steps_option/i";

	 // var_dump($standard_answer);

	   if(is_string(key($standard_answer)))
        $standard_answer=array($standard_answer,array());

	  

	  foreach($standard_answer as $key=>$value)
  {
	 if($value==null)
		 break;

     if($i==0)
	{
     foreach($value as $k=>$v)//这个循环用于统计标准答案option个数
	   {
		 if(preg_match($pattern,$k))
		  {
	        if(!$v)
			  break;
		    else 
			  $i++;
		  }
	   }
	}

  if($i>0)
    {	
		for($j=1;$j<$num+1;$j++)//这个循环结束，可以判断匹配是否成功
	  {

		  $stu_option2="usersansw_steps_option".$j;
		  $stand_option2="flow_answers_steps_option".$j;
	
          if(!($value[$stand_option2]==$one_answer[$stu_option2]))
			  break;  
	  }
	if($j>$num)
		{
		$is_match=true;
	    }   
    }
       
	   if($is_match==true)
	   break;//如果匹配到就跳出循环，不匹配其他步骤了。
   }
   if($is_match==false)
	  {
	   $res[0]=false;
	   return $res;
      }
	else if($is_match==true)
	  {
		$res[0]=true;
		$res[1]=$value['flow_answers_steps_branchid'];//返回分支号。
		return $res;
	  }


}


function count_standardanswer_step($answer,$question_id)//分支筛选后，才能使用。一个题目ID答案的步骤数量。
{

	 
	 if(is_string(key($answer)))
        $answer=array($answer,array());

	 $i=0;

	 foreach($answer as $key=>$value)
	{
      if(!empty($value)&&$value['papers_questions_id']==$question_id)
		  $i++;

	}

    return $i;
}

function onequestionpanfen($v9,$stu_standard_answer,$b1,$user_answer,$v3,$conn_db,$exam_inf,$nums_key_option,$suanzi,$single_add,$multiply_add,$examination_log_id)
{

		
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


				   $str_one_question_score="select score from flow_papers_questions where papers_questions_id=".$v9." and papers_id=".$v3['papers_id'];

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


            $str_insert_flow_exam_result="insert into flow_exam_result values (".$v3['users_id'].",".$exam_inf['exam_id'].",".$v3['papers_id'].",".$v9.",".$one_flowque_score.",'".$str_result_remark."') on duplicate key update score=".$one_flowque_score.",result_remark='".$str_result_remark."'";
			

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


		 }//if(isset($v9))的括号
	 


?>