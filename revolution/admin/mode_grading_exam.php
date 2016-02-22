<?php
	require "../share/function/sqlHelper.php";
	require "../admin/function_get_selectlist.php";
	if(isset($_POST['grade_exam']))
	{
		if($_POST['selectExam']==""||$_POST['selectJS']=="")
		{
			echo "<script>alert('请选择考试和判卷策略！')</script>";
		}
		else
		{
			echo "<script>window.location.href='../admin/judge_function/panfenrukou.php?exam_id=".$_POST['selectExam']."&&js_id=".$_POST['selectJS']."'</script>";
		}
		echo "<script>window.location.href='".basename($_SERVER['PHP_SELF'])."'</script>"; 
	}
	if(isset($_POST['judge_error']))
	{
		echo "<script>window.location.href='./mode_gra_exception.php'</script>";
	}


		
	require_once('../../admin/config/tce_config.php');

	$pagelevel = K_AUTH_ADMIN_MODULES;
	require_once('../../shared/code/tce_authorization.php');
	require_once('../../admin/code/tce_page_header.php');

?>


<div class="grading">

	<h3>判卷</h3>
	<hr/>
    <?php
	   $exam=getExam();//获取考试列表
       $module=getModule();//获取科目列表
	  $judgeStrategy=getJudgeStrategy();//获取判卷策略列表
	?>
    <form method="post">
    	<div class="row">
        <span class="label">
		<label>科目名称：</label>
        </span>
        <span class="formw">
                <select name="selectModule" id="selectModule" onchange="javascript:getExam();" style="width:150px;">
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
	 	<select name="selectExam" id="selectExam" onchange="javascript:getExamInfor();" style="width:150px;">
        <option value=""></option>
	 	</select>
         </span>
        </div>
		<div class="row">
        <span class="label">
		<label>开始时间：</label>
        </span>
        <span class="formw">
		<input type="text" id="beginTime" name="beginTime" style=" width:146px;" readonly="readonly">
        </span>
        </div>
        <div class="row">
        <span class="label">
        <label>结束时间：</label>
        </span>
        <span class="formw">
		<input type="text" id="endTime" name="endTime"  style=" width:146px;" readonly="readonly">
        </span>
        </div>
        <div class="row">
        <span class="label">
        <label>成绩公布时间：</label>
        </span>
        <span class="formw">
		<input type="text" id="announceScoreTime" name="announceScoreTime"  style=" width:146px;"  readonly="readonly">
        </span>
        </div>
        <div class="row">
        <span class="label">
        <label>判卷策略：</label>
        </span>
        <span class="formw">
	 	<select name="selectJS" id="selectJS" style="width:150px;">
            	<option value=""></option>
                <?php
                    foreach($judgeStrategy as $row)
                    {
                        echo "<option value='".$row['judge_strategy_id']."'>".$row['judge_strategy_id']."</option>";
                    }
                ?>
			</select>
            &nbsp;<a href="mana_judge_strategy.php">管理判卷策略</a>
        </span>
        </div>
        <p/>
        <div class="row">
        	 <span class="label">
        	</span>
        	<span class="formw">
	 			 
         	</span>
        </div>
        <div class="row">
        	 <span class="label">
        	</span>
        	<span class="formw">
	 			<input type="submit" value="判卷" id="grade_exam" name="grade_exam" >
        		<input type="submit" value="查看判卷异常" name="judge_error" >
         	</span>
        </div>
    </form>
</div>
<?php 
	require_once('../../admin/code/tce_page_footer.php');
?>
<script type="text/javascript">
	function getExam()
	{
		var module_id=document.getElementById("selectModule").value;
		var ExamInfor=<?php echo json_encode($exam);?>;
		document.getElementById("selectExam").length=1;
		var exam_id=document.getElementById("selectExam");
		if(module_id!="")
		{
			for(var row in ExamInfor)
			{
				if(ExamInfor[row]['exam_module_id']==module_id)
				{
					exam_id.options[exam_id.length]=new Option(ExamInfor[row]['exam_name'],ExamInfor[row]['exam_id']);
				}
			}
		}
		getExamInfor();
	}
	function getExamInfor()
	{
		 var exam_id=document.getElementById("selectExam").value;
		 var ExamInfor=<?php echo json_encode($exam);?>;
		 if(exam_id!="")
		 {
			 for(var row in ExamInfor)
			 {
				 if(ExamInfor[row]['exam_id']==exam_id)
				 {
					 document.getElementById("beginTime").value=ExamInfor[row]['exam_begin_time'];
					 document.getElementById("endTime").value=ExamInfor[row]['exam_end_time'];
					 document.getElementById("announceScoreTime").value=ExamInfor[row]['exam_announce_score_time'];
					 document.getElementById("selectJS").value=ExamInfor[row]['judge_strategy_id'];
				 }
			 }
		 }
		 else
		 {
			 document.getElementById("beginTime").value="";
			 document.getElementById("endTime").value="";
			 document.getElementById("announceScoreTime").value="";
			 document.getElementById("selectJS").value="";
		 }	 
	}
</script>
