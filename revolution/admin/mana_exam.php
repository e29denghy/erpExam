<?php
	require "../share/function/sqlHelper.php";
	require "../admin/function_get_selectlist.php";
	require "../admin/function_handle_exam.php";

	require_once('../../admin/config/tce_config.php');
	$pagelevel = K_AUTH_ADMIN_MODULES;
	require_once('../../shared/code/tce_authorization.php');
	require_once('../../admin/code/tce_page_header.php');


	if(isset($_POST['submit_exam']))
	{
		if($_POST['examMode']==""||$_POST['selectExam']==""||$_POST['exam_name']==""||$_POST['selectModule']==""||$_POST['selectTest']==""||!isset($_POST['paperList'])||$_POST['beginTime']==""||$_POST['endTime']==""||$_POST['durationTime']==""||$_POST['announceScoreTime']==""||!isset($_POST['group_id'])||$_POST['exam_place']==""||$_POST['js_id']=="")
		{
			echo "<script>alert('信息均不能为空！')</script>";
		}
		else
		{
			if(strtotime($_POST['beginTime'])>=strtotime($_POST['endTime']))
			{
				echo "<script>alert('结束时间应晚于开始时间！')</script>";
			}
			else if(strtotime($_POST['endTime'])>=strtotime($_POST['announceScoreTime']))
			{
				echo "<script>alert('公布成绩时间应晚于结束时间！')</script>";
			}
			else if(intval($_POST['exam_place'])<=0)
			{
				echo "<script>alert('考场数量应大于零！')</script>";
			}
			else if($_POST['selectExam']=="new")
			{
				$result_insert=insertNewExam($_POST['exam_name'],$_POST['selectModule'],$_POST['selectTest'],$_POST['beginTime'],$_POST['endTime'],$_POST['durationTime'],$_POST['announceScoreTime'],$_POST['exam_place'],$_POST['js_id'],$_POST['paperList'],$_POST['group_id'],$_POST['examMode']);
				if($result_insert==1)
				{
					echo "<script>alert('新建成功！')</script>";
				}
				else
				{
					echo "<script>alert('发生未知错误，请重新操作！')</script>";
				}
			}
			else
			{
				$result_update=updateExam($_POST['selectExam'],$_POST['exam_name'],$_POST['selectModule'],$_POST['selectTest'],$_POST['beginTime'],$_POST['endTime'],$_POST['durationTime'],$_POST['announceScoreTime'],$_POST['exam_place'],$_POST['js_id'],$_POST['paperList'],$_POST['group_id'],$_POST['examMode']);
				if($result_update==1||$result_update==2)
				{
					echo "<script>alert('更新成功！')</script>";
				}
				else
				{
					echo $result_update;
					echo "<script>alert('发生未知错误，请重新操作！')</script>";
				}
			}
		}
		echo "<script>window.location.href='".basename($_SERVER['PHP_SELF'])."'</script>"; 
	}
?>

<!--
	body 部分
-->
    <style type="text/css">@import url(../share/jscripts/jscalendar/calendar-blue.css);</style>
    <script type="text/javascript" src="../share/jscripts/jscalendar/calendar.js"></script>
    <script  type="text/javascript" src="../share/jscripts/jscalendar/lang/calendar-en.js"></script>
    <script type="text/javascript" src="../share/jscripts/jscalendar/calendar-setup.js"></script>
<div class="exam_management">
	<h1>考试管理</h1>
	<hr/>
    <?php
	   $exam=getExam();//获取考试列表
       $module=getModule();//获取科目列表
	   $test=getTest();//获取测验列表
	   $paper=getPaper();//获取试卷列表
	   $group=getGroup();//获取用户组列表
	   $examPaper=getExamPaper();//获取考试的试卷列表
	   $judgeStrategy=getJudgeStrategy();//获取判卷策略列表
	   $examUsergroup=getExamUsergroup();//获取考生组列表
	  // $examMode=getExamMode();//获取考生组列表
	?>
    <form method="post">
    <div class="row">
		<span class="label">
			<label>考试ID：</label>
		</span>
		<span class="formw">
	 	<select name="selectExam" id="select0" onchange="javascript:getExamInfor();" style="width:150px;">
        <option value=""></option>
        	<?php
				foreach($exam as $row)
				{
	 				echo "<option value='".$row['exam_id']."'>".$row['exam_id']."</option>";
				}
			?>
	 	</select>
        &nbsp;<a id="createExam" href="javascript:newExam();">新建考试</a><a href="javascript:cancelNewExam();" id="cancelCreate" style="display:none;">取消新建考试</a>
		</span>
	</div>
    <div class="row">
    	<span class="label">
			<label>考试名称：</label>
		</span>
        <span class="formw">
        <input type="text" name="exam_name" id="exam_name" style=" width:146px;" />
        </span>
    </div>
	<div class="row">
		<span class="label">
			<label>科目名称：</label>
		</span>
		<span class="formw">
	 	<select name="selectModule" id="select1" style="width:150px;">
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
			<label>测验名称：</label>
		</span>
		<span class="formw">
	 	<select name="selectTest" id="select2" onchange="javascript:get_paper()" style="width:150px;">
        	<option></option>
        	<?php
				foreach($test as $row)
				{
	 				echo "<option value='".$row['test_id']."'>".$row['test_name']."</option>";
				}
			?>
	 	</select>
		</span>		
	</div>
    <div class="row">
    	<span class="label">
        	<label>测验可用卷：</label>
        </span>
        <span class="formw">
        	<div id="PaperList">
            	
            </div>
        </span>
    </div>
    <div class="row">
		<span class="label">
			<label>开始时间：</label>
		</span>
		<span class="formw">
			<input type="text" id="beginTime" name="beginTime" size="15" value="0000-00-00 00:00:00"><input type="button" value="..." name="chooseBeginTime" id="chooseBeginTime" /> [yyyy-mm-dd hh:mm:ss]
		</span>
	</div> 
    <div class="row">
		<span class="label">
			<label>结束时间：</label>
		</span>
		<span class="formw">
			<input type="text" id="endTime" name="endTime" size="15" value="0000-00-00 00:00:00">
			<input type="button" value="..." name="chooseEndTime" id="chooseEndTime" /> [yyyy-mm-dd hh:mm:ss]
		</span>
	</div>
    <div class="row">
		<span class="label">
			<label>测验时长：</label>
		</span>
		<span class="formw">
			<input type="text" id="durationTime" name="durationTime" value="" size="4"> [min]
		</span>
	</div>  
    <div class="row">
		<span class="label">
			<label>成绩发布时间：</label>
		</span>
		<span class="formw">
			<input type="text" id="announceScoreTime" name="announceScoreTime" value="0000-00-00 00:00:00" size="15" ><input type="button" value="..." name="chooseASTime" id="chooseASTime" /> [yyyy-mm-dd hh:mm:ss]
		</span>
	</div>
    <div class="row">
		<span class="label">
			<label>参加考试组：</label>
		</span>
		<span class="formw">
			<select multiple="multiple" id="select5" name="group_id[]" style="width:100px;">
				<?php
                    foreach($group as $row)
                    {
                        echo "<option value='".$row['group_id']."'>".$row['group_name']."</option>";
                    }
                ?>
			</select>
		</span>
	</div>
    <div class="row">
		<span class="label">
			<label>考场数量：</label>
		</span>
		<span class="formw">
			<input type="text" id="exam_place" name="exam_place" style="width:146px;">
		</span>
	</div>
    <div class="row">
		<span class="label">
			<label>判卷策略：</label>
		</span>
		<span class="formw">
			<select id="select6" name="js_id" style="width:150px;">
            	<option value=""></option>
                <?php
                    foreach($judgeStrategy as $row)
                    {
                        echo "<option value='".$row['judge_strategy_id']."'>".$row['judge_strategy_id']."</option>";
                    }
                ?>
			</select>
			&nbsp;<a href="../admin/mana_judge_strategy.php">管理判卷策略</a>
		</span>
	</div>
	<div class="row">
		<span class="label">
			<label>考试模式：</label>
		</span>
		<span class="formw">
			<select id="examMode" name="examMode" style="width:150px;">
            	<option value=""></option>
            	<option value="1">考试</option>
              	<option value="0">课堂练习</option>
			</select>
		</span>
	</div>
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
			<input type="submit" name="submit_exam" value="确定" />
		</span>
	</div>
    </form>
</div>



<?php 
	require_once('../../admin/code/tce_page_footer.php');
?>
<script type="text/javascript">
	function get_paper()
	{//触发获取测验所包含试卷
		var test_id=document.getElementById("select2").value;
		if(test_id!="")
		{			  
			paper_infor=<?php echo json_encode($paper);?>;
			var paper_list="";
			for(var row in paper_infor)
			{
				if(paper_infor[row]['test_id']==test_id)
				{
					paper_list=paper_list+"<input type='checkbox' id='paperList["+paper_infor[row]['paper_id']+"]' name='paperList["+paper_infor[row]['paper_id']+"]' value='"+paper_infor[row]['paper_id']+"' />&nbsp;"+paper_infor[row]['paper_id']+"<br>";				
				}
			}
			document.getElementById("PaperList").innerHTML=paper_list;
		}
	}
	function getExamInfor()
	{//触发获取考试对应的信息
		var exam_id=document.getElementById("select0").value;
		examInfor=<?php echo json_encode($exam);?>;
		if(exam_id!=""&&exam_id!="new")
		{
			for(var row in examInfor)
			{
				if(examInfor[row]['exam_id']==exam_id)
				{
					document.getElementById("select1").value=examInfor[row]['exam_module_id'];
					document.getElementById("select2").value=examInfor[row]['test_id'];
					get_paper();
					document.getElementById("exam_name").value=examInfor[row]['exam_name'];
					document.getElementById("beginTime").value=examInfor[row]['exam_begin_time'];
					document.getElementById("endTime").value=examInfor[row]['exam_end_time'];
					document.getElementById("durationTime").value=examInfor[row]['exam_duration_time'];
					document.getElementById("announceScoreTime").value=examInfor[row]['exam_announce_score_time'];
					document.getElementById("exam_place").value=examInfor[row]['exam_where'];
					document.getElementById("select6").value=examInfor[row]['judge_strategy_id'];
					document.getElementById("examMode").value=examInfor[row]['exam_mode'];
					examPaper=<?php echo json_encode($examPaper);?>;
					for(var rowExamPaper in examPaper)
					{
						if(examPaper[rowExamPaper]['exam_id']==exam_id)
						{
							document.getElementById("paperList["+examPaper[rowExamPaper]['paper_id']+"]").checked='checked';
							//var exam_paper=document.getElementById("select4");
							//exam_paper.length=0;
							//exam_paper.options[exam_paper.length]=new Option(examPaper[rowExamPaper]['paper_id'],examPaper[rowExamPaper]['paper_id']);
						}
					}
					examUsergroup=<?php echo json_encode($examUsergroup);?>;
					for(var rowExamUsergroup in examUsergroup)
					{
						if(examUsergroup[rowExamUsergroup]['exam_id']==exam_id)
						{
							var exam_usergroup=document.getElementById("select5");
							for(var i=0;i<exam_usergroup.length;i++)
							{
								if(exam_usergroup.options[i].value==examUsergroup[rowExamUsergroup]['usergroups_id'])
								{
									exam_usergroup.options[i].selected='selected';
								}
								else
								{
									exam_usergroup.options[i].selected=false;
								}
							}
						}
					}
				}
			}
		}
		else
		{
			document.getElementById("select1").value="";
			document.getElementById("select2").value="";
			document.getElementById("exam_name").value="";
			document.getElementById("beginTime").value="0000-00-00 00:00:00";
			document.getElementById("endTime").value="0000-00-00 00:00:00";
			document.getElementById("durationTime").value="00:00:00";
			document.getElementById("announceScoreTime").value="0000-00-00 00:00:00";
			document.getElementById("exam_place").value="";
			document.getElementById("select6").value="";
			document.getElementById("examMode").value="";
			get_paper();
			var exam_usergroup=document.getElementById("select5");
			for(var i=0;i<exam_usergroup.length;i++)
			{
				exam_usergroup.options[i].selected=false;
			}
		}
	}
	function newExam()
	{//新建考试
		var exam=document.getElementById("select0");
		exam.options[exam.length]=new Option("new","new");
		exam.options[exam.length-1].selected=true;
		//exam.disabled="disabled";
		getExamInfor();
		document.getElementById("cancelCreate").style.display="";
		document.getElementById("createExam").style.display="none";
	}
	function cancelNewExam()
	{//取消新建考试
		var exam=document.getElementById("select0");
		exam.options[0].selected=true;
		exam.length--;
		exam.disabled="";
		getExamInfor();
		document.getElementById("cancelCreate").style.display="none";
		document.getElementById("createExam").style.display="";
	}
	Calendar.setup({
	 inputField : "beginTime",
	 ifFormat : "%Y-%m-%d %H:%M",
	 button : "chooseBeginTime"
	});
	Calendar.setup({
	 inputField : "endTime",
	 ifFormat : "%Y-%m-%d %H:%M",
	 button : "chooseEndTime"
	});
	Calendar.setup({
	 inputField : "announceScoreTime",
	 ifFormat : "%Y-%m-%d %H:%M",
	 button : "chooseASTime"
	});
</script>
