<?php
header("Content-type:text/html;charset=utf-8");	

	require "../share/function/sqlHelper.php";

	require "../admin/function_get_selectlist.php";

	$thispage_title = "考试";
	 
	
	require_once('../share/function/function_consi_ques.php');
	require_once('../../public/config/tce_config.php');
	$pagelevel = K_AUTH_PUBLIC_INDEX;
	require_once('../../shared/code/tce_authorization.php');
	require_once('../../public/code/tce_page_header.php');
?>


<div class="examinator_face">
	<h1>成绩查询</h1>
	<hr/>
    <?php

        $user_arr=get_attrs_from_table("select user_id from tce_users where user_name='".$_SESSION['session_user_name']."';");
	    foreach ($user_arr as $key => $value) {
	    	$user_id=$user_arr[$key]['user_id'];
	    }
	   $exam=getExam();//获取考试列表
       $module=getModule();//获取科目列表
	   $userExam=getUserExam($user_id);//获取当前用户参加的考试
	   $userExamGrade=getUserExamGrade($user_id);//获取当前用户id所参加考试成绩
	?>
    <form method="post">
		<div class="row">
			<span class="label">
				<label>科目名称：</label>
			</span>
			<span class="formw">
                <select name="selectModule" id="select1" onchange="javascript:getUserExam();" style="width:170px;">
                    <option></option>
                    <?php
                        foreach($module as $row)
                        {
                            echo "<option value='".$row['module_id']."'>".$row['module_name']."</option>";
                        }
                    ?>
                </select>
			</span>
		</div>
		<div class="row">
			<span class="label">
				<label>考试名称：</label>
			</span>
			<span class="formw">
				<select name="exam_id" id="exam_id" style="width:170px;" onchange="javascript:getUserExamInfor();">
                	<option value=""></option>
				</select>
			</span>
		</div>

		<div class="row">
			<span class="label">
				<label>开始时间：</label>
			</span>
			<span class="formw">
				<input type="text" name="exam_start" id="exam_start" style="width:166px; text-align:center;" readonly="readonly" />
			</span>
		</div>

		<div class="row">
			<span class="label">
				<label>结束时间：</label>
			</span>
			<span class="formw">
				<input type="text" name="exam_end" id="exam_end" style="width:166px; text-align:center;" readonly="readonly" />
			</span>
		</div>	
		<div class="row">
			<span class="label">
				<label>成绩公布时间：</label>
			</span>
			<span class="formw">
				<input type="text" name="score_annouce_time" id="score_annouce_time" style="width:166px; text-align:center;" readonly="readonly" />
			</span>
		</div>	
        <div class="row">
			<span class="label">
				<label>考试成绩：</label>
			</span>
			<span class="formw">
				<input type="text" name="exam_score" id="exam_score" style="width:166px; text-align:center;" readonly="readonly" />
			</span>
		</div>	
		<div class="clear"></div> 
		<div class="examintor_opera" >
			<input type="button" value="查询成绩" name="check_grade" id="check_grade" onclick="javascript:getExamGrade();"/>
		</div>
        </form>
</div>



<script type="text/javascript">
	function getUserExam()
	{//获取当前用户所参加考试
		var module_id=document.getElementById("select1").value;
		document.getElementById("exam_id").length=1;
		if(module_id!="")
		{
			var examInfor=<?php echo json_encode($exam);?>;
			var userExam=<?php echo json_encode($userExam);?>;
			var user_exam=document.getElementById("exam_id");
			for(var rowExam in examInfor)
			{
				for(var rowUser in userExam)
				{
					if(examInfor[rowExam]['exam_id']==userExam[rowUser]['exam_id']&&examInfor[rowExam]['exam_module_id']==module_id)
					{
						user_exam.options[user_exam.length]=new Option(examInfor[rowExam]['exam_name'],examInfor[rowExam]['exam_id']);
					}
				}
			}
		}
		getUserExamInfor();
	}
	function getUserExamInfor()
	{
		var exam_id=document.getElementById("exam_id").value;
		if(exam_id!="")
		{
			var examInfor=<?php echo json_encode($exam);?>;
			for(var rowExam in examInfor)
			{
				if(examInfor[rowExam]['exam_id']==exam_id)
				{
					document.getElementById("exam_start").value=examInfor[rowExam]['exam_begin_time'];
					document.getElementById("exam_end").value=examInfor[rowExam]['exam_end_time'];
					document.getElementById("score_annouce_time").value=examInfor[rowExam]['exam_announce_score_time'];
				}
			}
		}
		else
		{
			document.getElementById("exam_start").value="";
			document.getElementById("exam_end").value="";
			document.getElementById("score_annouce_time").value="";
			document.getElementById("exam_score").value="";
		}
	}
	function getExamGrade()
	{
		var exam_id=document.getElementById("exam_id").value;
		if(exam_id!="")
		{
			var userExamGrade=<?php echo json_encode($userExamGrade);?>;
			document.getElementById("exam_score").value="成绩尚未公布";
			for(var row in userExamGrade)
			{
				if(userExamGrade[row]['exam_id']==exam_id)
					document.getElementById("exam_score").value=userExamGrade[row]['grade'];
			}
		}
	}
</script>

<?php
    require_once('../../public/code/tce_page_footer.php');
?>