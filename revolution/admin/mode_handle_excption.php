<?php
	require "../share/function/sqlHelper.php";
	require "./function_judge_error.php";
	if(isset($_GET['error_id']))
	{
		$error_id=$_GET['error_id'];
		$error_infor=mysql_fetch_array(getErrorInfor($error_id));
		$right_answer=getRightAnswer($error_infor['flow_questions_id']);
		$student_answer=getStudentAnswer($error_infor['student_id'],$error_infor['exam_id'],$error_infor['papers_id'],$error_infor['flow_questions_id']);
		//var_dump($student_answer);
	}
	if(isset($_POST['backExceptionList']))
	{
		echo "<script>window.location.href='./mode_gra_exception.php'</script>";
	}
	if(isset($_POST['saveScore']))
	{
		if($_POST['step_score']=="")
		{
			echo "<script>alert('请输入步骤得分！')</script>";
		}
		else if(!is_numeric($_POST['step_score']))
		{
			echo "<script>alert('得分输入数据类型不正确！')</script>";
		}
		else
		{
			$result=handle_exception($_POST['useransw_steps_id'],$_POST['step_score']);	
			if($result==1)
				echo "<script>alert('保存成功！')</script>";
			else
				echo "<script>alert('发生未知错误，请检查后重新保存！')</script>";
		}
		echo "<script>window.location.href='mode_handle_excption.php?error_id=".$_GET['error_id']."'</script>";
	}

	require_once('../../admin/config/tce_config.php');

	$pagelevel = K_AUTH_ADMIN_MODULES;
	require_once('../../shared/code/tce_authorization.php');
	require_once('../../admin/code/tce_page_header.php');

?>


<div class="handle_except">
	<h1>处理异常</h1>
	<hr/>
	<label>考试名称：</label> <input type="text" readonly="readonly" value="<?php if(isset($error_infor)) echo $error_infor['exam_name']; ?>" size="12" />
    <label>试卷ID：</label> <input type="text" readonly="readonly" value="<?php if(isset($error_infor)) echo $error_infor['papers_id']; ?>" size="4"/>
    <label>考生账号：</label> <input type="text" readonly="readonly" value="<?php if(isset($error_infor)) echo $error_infor['student_id']; ?>" size="8" />
    <br/>
    <label>试题ID：</label> <input type="text" readonly="readonly" value="<?php if(isset($error_infor)) echo $error_infor['questions_id']; ?>" size="8"/>
    <label>试题类型：</label> <input type="text" readonly="readonly" value="<?php if(isset($error_infor)) echo $error_infor['questions_type']; ?>" size="8"/>	
	<label>教师账号：</label> <input type="text" readonly="readonly" value="<?php if(isset($error_infor)) echo $error_infor['teacher_id']; ?>" size="8"/>
	<div class="comp_area">
		<p>题目：</p>
		<textarea cols="20" rows="10" readonly="readonly"><?php if(isset($error_infor)) echo $error_infor['flow_questions_description']; ?></textarea>
		<p>标准答案：</p>
		<textarea cols="20" rows="10" readonly="readonly"><?php
				if(isset($right_answer))
				{
					foreach($right_answer as $row)
					{
						echo "步骤".$row['flow_answers_steps_id'].":";
						$optionNum=null;
						for($i=1;$i<=10;$i++)
						{
							$optionNum="option".$i;
							if($row[$optionNum]==null)
								break;
							else
								echo $row[$optionNum]." ";
						}
						echo "\n";
					}
				}
			?>
        </textarea>	
	</div>
	<div class="clear"></div>
    <form method="post">
	<p>
    	考生答案&nbsp;&nbsp;&nbsp;&nbsp;步骤：
        <select name="useransw_steps_id" id="useransw_steps_id" onchange="getAnswOption()">
        	<option value=""></option>
        	<?php
				foreach($student_answer as $row)
				{
					echo "<option value='".$row['examlog_useransw_id']."'>".$row['usersansw_steps_id']."</option>";
				}
			?>
		</select>
    </p>
    <div id="step_options" style="display:none; margin-left:160px;">
    </div>
    <p>
    	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;步骤得分：
        <input type="text" value="" name="step_score" size="8" />
    </p>
		<div class="clear"></div>
		<div class="handle_excpt_opera">
			<input type="submit" name="saveScore" id="saveScore" value="保存" disabled="disabled"/>
			<input type="submit" name="backExceptionList" value="返回"/>
		</div></form>
	</div>
</div>
<?php 
	require_once('../../admin/code/tce_page_footer.php');
?>
<script type="text/javascript">
 function getAnswOption()
 {
	 var steps_id=document.getElementById("useransw_steps_id").value;
	 var student_answer=<?php echo json_encode($student_answer);?>;
	 if(steps_id!="")
	 {
		 var str="";
		 for(var row in student_answer)
		 {
			 if(student_answer[row]['examlog_useransw_id']==steps_id)
			 {
				 var optionNum=null;
				 for(var i=1;i<=10;i++)
				 {
					 
					 optionNum="option"+i;
					 if(student_answer[row][optionNum]!=null)
					 {
						 str=str+"<p>";
						 str=str+student_answer[row][optionNum];
						 str=str+"</p>";
					 }
					 else
						break;
				 }
				
			 }
		 }
		 document.getElementById("step_options").innerHTML=str;
		 document.getElementById("step_options").style.display="";
		 document.getElementById("saveScore").disabled="";
	 }
	 else
	 {
		 document.getElementById("step_options").style.display="none";
		 document.getElementById("saveScore").disabled="disabled";
	 }
 }
</script>