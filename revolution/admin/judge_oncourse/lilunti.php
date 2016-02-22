<?php
 $str_concept_correct="select paperquestions_id,answers_other_question_id,questions_concept_type,useransw_id from flow_examlog_useransw_concept,flow_answers_other,flow_questions_concept where answers_other_isright=1 and flow_answers_other.answers_other_id=flow_examlog_useransw_concept.useransw_id and answers_is_add=0 and answers_other_question_id=questions_concept_id and examination_log_id=".$examination_log_id;//answers_other_question_id可以查询题目表找出是否为多选题

 $concept_correct_id=$conn_db->execute_dql2($str_concept_correct);//这里返回所有正确的试卷试题ID。

//var_dump($concept_correct_id);

   if(is_string(key($concept_correct_id)))//如果是一维数组，则增加一个空数组让其成为二维数组，便于使用foreach
     {
		 $concept_correct_id=array($concept_correct_id,array());
		 $nums_id=count($concept_correct_id)-1;
	 }
	 else
	     $nums_id=count($concept_correct_id);

 if(!empty($concept_correct_id))
 {
	 //这里根据answers_other_question_id在问题表中，找出是否为多选题，从而对下面做出判分.is_add=null

	foreach($concept_correct_id as $kc=>$vc)
    {
	 if($vc)//去除加入的空数组
     {
	  if($vc['questions_concept_type']==0)//单选
		 $single_concept[]=$vc;
	  else
		 $multiply_concept[]=$vc;	
	 }
	}

	 if(!empty($single_concept))
	{
//var_dump($nums_id);

	 for($x=0;$x<$nums_id;$x++)
	 {
	  if($single_concept[$x]!=null)
		 {

	   $singlecon_id=$single_concept[$x]['paperquestions_id'];

        $str_one_question_score_li="select score from flow_papers_questions where papers_questions_id=".$singlecon_id." and papers_id=".$inf_examination_log_id['papers_id'];

        $one_question_score_li=$conn_db->execute_dql1($str_one_question_score_li);
       
        


     $update_singlecon_score="update flow_examlog_useransw_concept set examlog_score='".$one_question_score_li['score']."' where paperquestions_id=".$singlecon_id." and examination_log_id=".$examination_log_id;//这里1分，真实情况要根据出卷分配的分数

     $affected_concept=$conn_db->execute_dml($update_singlecon_score);//根据返回0.1.2用来写错误报告
		 }//if($single_concept[$x]!=null)

	 }
    }//if($single_concept),

    
    //以上为单选的批改

	

	
	
	if(!empty($multiply_concept))
	{
	 if(is_string(key($multiply_concept)))//如果是一维数组，则增加一个空数组让其成为二维数组，便于使用foreach
         $multiply_concept=array($multiply_concept,array());
    
	$all_mulquestion_id=get_all_type2($multiply_concept,'answers_other_question_id','paperquestions_id');

	//可能会有重复项question_id。useransw_id唯一可以用来更新数据库


	foreach($all_mulquestion_id as $kid=>$vid)//对每一个ID进行扫描三个表，得出该ID在每个表的个数，从而判分。
	  {
	
		if($vid!=null)//这里是对每一道题分别判分，所以每次选项数量都要重新计算。
		{
		 $nums_correct_option=0;//正确选项个数
		 $nums_user_option=0;//考生选项个数
		 $nums_standard_option=0;//标准答案选项个数。

         $str_one_question_score_limul="select score from flow_papers_questions where papers_questions_id=".$vid['paperquestions_id']." and papers_id=".$inf_examination_log_id['papers_id'];

         $one_question_score_limul=$conn_db->execute_dql1($str_one_question_score_limul);



		 foreach($multiply_concept as $kid2=>$vid2)
		 {
			 if($vid2['paperquestions_id']==$vid['paperquestions_id'])
             $nums_correct_option++;
		 }

		 $str_nums_user_option="select count(useransw_id) from flow_examlog_useransw_concept where paperquestions_id=".$vid['paperquestions_id']." and examination_log_id=".$examination_log_id;

		 $r1=$conn_db->execute_dql1($str_nums_user_option);



		 if($r1)
            $nums_user_option=current($r1);
		 else
            $nums_user_option=0;

		 $str_nums_standard_option="select count(answers_other_id) from flow_answers_other where answers_is_add=0 and answers_other_isright=1 and answers_other_question_id=".$vid['answers_other_question_id'];
         
		 $r2=$conn_db->execute_dql1($str_nums_standard_option);
		 
		 if($r2)
           $nums_standard_option=current($r2);
		 else
		   $nums_standard_option=0;


		 if($nums_user_option>$nums_correct_option)//说明多选题中有错误选项
			{
			  $str_update_mulconcept_score="update flow_examlog_useransw_concept set examlog_score=0 where paperquestions_id=".$vid['paperquestions_id']." and examination_log_id=".$examination_log_id;
              $conn_db->execute_dml($str_update_mulconcept_score);//将该题所有答案选项分数置0；

			}


		 else //考生答案没有错误选项
		 {
			if($nums_standard_option!=0)
               $option_score=$nums_user_option/$nums_standard_option;//这里只是当分值为1时，若分数不是1，这里只是比率
			else
               $option_score=0;
            
			

           $str_update_mulconcept_score="update flow_examlog_useransw_concept set examlog_score=".($one_question_score_limul['score']*$option_score/$nums_user_option)." where paperquestions_id=".$vid['paperquestions_id']." and examination_log_id=".$examination_log_id;//更新多选题正确选项的分数
              $conn_db->execute_dml($str_update_mulconcept_score);
			  
		 }


		}//if($vid!=null)

	  }//foreach($all_mulquestion_id

	}//if(!empty($multiply_concept))，
 
 
 }//if(!empty($concept_correct_id))


?>