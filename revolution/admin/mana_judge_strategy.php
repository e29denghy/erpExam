<?php
	require "../share/function/sqlHelper.php";
	require "../admin/function_get_selectlist.php";
	require "../admin/function_handle_exam.php";

	require_once('../../admin/config/tce_config.php');

	$pagelevel = K_AUTH_ADMIN_MODULES;
	require_once('../../shared/code/tce_authorization.php');
	require_once('../../admin/code/tce_page_header.php');

	if(isset($_POST['submit_js']))
	{
		if($_POST['selectJS']==""||$_POST['logic_deduct']==""||!isset($_POST['branch_control'])||!isset($_POST['extra_steps_control'])||$_POST['score_step']==""||$_POST['score_add']=="")
		{
			echo "<script>alert('信息均不能为空！')</script>";
		}
		else if(!is_numeric($_POST['logic_deduct']))
		{
			echo "<script>alert('逻辑扣分占比只能输入数值型数据！')</script>";
		}
		else if(!is_numeric($_POST['score_step'])||!is_numeric($_POST['score_add']))
		{
			echo "<script>alert('步骤分附加题分比值只能输入数值型数据！')</script>";
		}
		else if($_POST['selectJS']=="new")
		{
			$result_insert=insertNewJS($_POST['logic_deduct'],$_POST['branch_control'],$_POST['extra_steps_control'],round($_POST['score_step']/$_POST['score_add'],2));
			if($result_insert==1)
			{
				echo "<script>alert('操作成功！')</script>";
			}
			else
			{
				echo "<script>alert('操作失败！')</script>";
			}
		}
		else
		{
			$result_update=updateJS($_POST['selectJS'],$_POST['logic_deduct'],$_POST['branch_control'],$_POST['extra_steps_control'],round($_POST['score_step']/$_POST['score_add'],2));
			if($result_update!=0)
			{
				echo "<script>alert('操作成功！')</script>";
			}
			else
			{
				echo "<script>alert('操作失败！')</script>";
			}
		}
		echo "<script>window.location.href='".basename($_SERVER['PHP_SELF'])."'</script>"; 
	}
	if(isset($_POST['backExam']))
	{
		echo "<script>window.location.href='../admin/mana_exam.php'</script>";
	}
?>

<!--
	body 部分
-->
<div class="exam_management">
	<h1>判卷策略管理</h1>
	<hr/>
    <?php
	   $judgeStrategy=getJudgeStrategy();//获取判卷策略列表
	?>
    <form method="post">
    <div class="row">
		<span class="label">
			<label>判卷策略ID：</label>
		</span>
		<span class="formw">
	 	<select name="selectJS" id="select0" onchange="javascript:getJSInfor()" style="width:150px;">
        <option value=""></option>
        	<?php
				foreach($judgeStrategy as $row)
				{
	 				echo "<option value='".$row['judge_strategy_id']."'>".$row['judge_strategy_id']."</option>";
				}
			?>
	 	</select>
        &nbsp;<a id="createJS" href="javascript:newJS()">新建判卷策略</a><a href="javascript:cancelNewJS()" id="cancelCreate" style="display:none;">取消新建</a>
		</span>
	</div>
    <div class="row">
    	<span class="label">
        	<label>逻辑扣分占比：</label>
        </span>
        <span class="formw">
        	<input type="text" name="logic_deduct" style="width:146px;" id="logic_deduct" />%&nbsp;<span style="color:#0060BF; font-size:14px;">（注：逻辑扣分占比为扣所填写正确步骤的比例）</span>
        </span>
    </div>
    <div class="row">
    	<span class="label">
        	<label>分支监控情况：</label>
        </span>
        <span class="formw">
        	<input type="radio" name="branch_control" value="1" id="branch_control[1]" />&nbsp;1 .不监控，即不扣分<br />
            <input type="radio" name="branch_control" value="2" id="branch_control[2]" />&nbsp;2 .扣一部分分数，即扣逻辑分<br />
            <input type="radio" name="branch_control" value="3" id="branch_control[3]" />&nbsp;3 .完全不得分，一旦的步骤走错了，后面步骤均不得分
        </span>
    </div>
    <div class="row">
    	<span class="label">
        	<label>缺漏步骤处理：</label>
        </span>
        <span class="formw">
        	<table style="text-align:center;" border="1px solid" cellpadding="4">
            	<tr>
                	<td>缺漏步骤数</td>
                    <td>得分占比</td>
                </tr>
                <tr>
                	<td>1</td>
                    <td>100%</td>
                </tr>
                <tr>
                	<td>2</td>
                    <td>80%</td>
                </tr>
                <tr>
                	<td>3</td>
                    <td>50%</td>
                </tr>
                <tr>
                	<td>4</td>
                    <td>30%</td>
                </tr>
                <tr>
                	<td>5及以上</td>
                    <td>0%</td>
                </tr>
            </table>
        </span>
    </div>
    <div class="row">
    	<span class="label">
        	<label>多余步骤处理：</label>
        </span>
        <span class="formw">
        	<input type="radio" name="extra_steps_control" value="1" id="extra_steps_control[1]" />&nbsp;1 .多余步骤不扣分<br />
            <input type="radio" name="extra_steps_control" value="3" id="extra_steps_control[2]" />&nbsp;2 .首尾出现多余步骤扣逻辑分
        </span>
    </div>
    <div class="row">
    	<span class="label">
        	<label>步骤分与附加题分比值：</label>
        </span>
        <span class="formw">
        	<input type="text" name="score_step" id="score_step" style="width:78px;" />：<input type="text" name="score_add" id="score_add" style="width:63px;"  />
        </span>
    </div>
	<div class="exam_manage_opera">
		<input type="submit" name="submit_js" value="提交" />
        <input type="submit" name="backExam" value="返回考试管理" />
	</div>
</div>

<?php 
	require_once('../../admin/code/tce_page_footer.php');
?>
<script type="text/javascript">
	function getJSInfor()
	{//获取判卷策略内容
		var js_id=document.getElementById("select0").value;
		if(js_id!=""&&js_id!="new")
		{			  
			js_infor=<?php echo json_encode($judgeStrategy);?>;
			for(var row in js_infor)
			{
				if(js_infor[row]['judge_strategy_id']==js_id)
				{
					document.getElementById("logic_deduct").value=js_infor[row]['logic_deduct'];
					for(var i=1;i<4;i++)
					{
						if(js_infor[row]['branch_control']==i)
							document.getElementById("branch_control["+i+"]").checked=true;
						//else
							//document.getElementById("branch_control["+i+"]").checked=false;
					}
					for(var i=1;i<3;i++)
					{
						if(js_infor[row]['branch_control']==i)
							document.getElementById("extra_steps_control["+i+"]").checked=true;
						//else
							//document.getElementById("extra_steps_control["+i+"]").checked=false;
					}
					document.getElementById("score_step").value=window.parseFloat(js_infor[row]['score_step_add']);
					document.getElementById("score_add").value=1;
				}
			}
		}
		else
		{
			document.getElementById("logic_deduct").value="";
			for(var i=1;i<4;i++)
			{
				document.getElementById("branch_control["+i+"]").checked=false;
			}
			for(var i=1;i<3;i++)
			{
				document.getElementById("extra_steps_control["+i+"]").checked=false;
			}
			document.getElementById("score_step").value="";
			document.getElementById("score_add").value="";
		}
	}
	function newJS()
	{
		var judgeS=document.getElementById("select0");
		judgeS.options[judgeS.length]=new Option("new","new");
		judgeS.options[judgeS.length-1].selected=true;
		getJSInfor();
		document.getElementById("cancelCreate").style.display="";
		document.getElementById("createJS").style.display="none";
	}
	function cancelNewJS()
	{
		var judgeS=document.getElementById("select0");
		judgeS.options[0].selected=true;
		judgeS.length--;
		getJSInfor();
		document.getElementById("cancelCreate").style.display="none";
		document.getElementById("createJS").style.display="";
	}
</script>