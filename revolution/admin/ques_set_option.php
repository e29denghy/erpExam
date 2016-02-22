<?php
	require "../share/function/sqlHelper.php";
	require "../admin/function_get_selectlist.php";
	require "../admin/function_handle_stepsoption.php";
	require_once('../../admin/config/tce_config.php');

	$pagelevel = K_AUTH_ADMIN_MODULES;
	require_once('../../shared/code/tce_authorization.php');
	require_once('../../admin/code/tce_page_header.php');
		
	if(isset($_POST['update']))
	{//更新按钮按下时
		$steps_module_id=$_POST['selectModule'];
		$steps_type=$_POST['selectSteptype'];
		$steps_options_id=$_POST['selectOptionNum'];
		$steps_options=$_POST['textOptionName'];
		if($steps_module_id!=null&&$steps_type!=null&&$steps_options_id!=null&&$steps_options!=null)
		{//内容不为空
			$result_update=update_step_option($steps_module_id,$steps_type,$steps_options_id,$steps_options);
			if($result_update==1)
			{
				echo "<script>alert('更新成功！')</script>";
			}
			else
			{
				echo "<script>alert('请重新操作！')</script>";
			}
		}
		echo "<script>window.location.href='".basename($_SERVER['PHP_SELF'])."'</script>"; 
	}
	if(isset($_POST['insert']))
	{//插入按钮按下时
		$steps_module_id=$_POST['selectModule'];
		$steps_type=$_POST['selectSteptype'];
		$steps_options_id=$_POST['selectOptionNum'];
		$steps_options=$_POST['textOptionName'];
		if($steps_module_id!=null&&$steps_type!=null&&$steps_options_id!=null&&$steps_options!=null)
		{
			$result_insert=insert_step_option($steps_module_id,$steps_type,$steps_options_id,$steps_options);
			if($result_insert==1)
			{
				echo "<script>alert('添加成功！')</script>";
			}
			else
			{
				echo "<script>alert('请重新操作！')</script>";
			}
		}
		echo "<script>window.location.href='".basename($_SERVER['PHP_SELF'])."'</script>"; 
	}
	if(isset($_POST['delete']))
	{//删除按钮按下时
		$steps_module_id=$_POST['selectModule'];
		$steps_type=$_POST['selectSteptype'];
		$steps_options_id=$_POST['selectOptionNum'];
		if($steps_module_id!=null&&$steps_type!=null&&$steps_options_id!=null)
		{
			$result_delete=delete_step_option($steps_module_id,$steps_type,$steps_options_id);
			if($result_delete==1)
			{
				echo "<script>alert('删除成功！')</script>";
			}
			else
			{
				echo "<script>alert('请重新操作！')</script>";
			}
		}
		echo "<script>window.location.href='".basename($_SERVER['PHP_SELF'])."'</script>"; 
	}
?>

 <div class="set_option">
<h1>步骤设置</h1>
 	<hr/>
 	<form method="post">
        <?php
        	$module=getModule();//获取科目列表
			$steptype=getSteptype();//获取步骤类型列表
			$stepOption=getStepOption();//获取步骤选项列表
			//var_dump($stepOption);
		?>
		<div class="row">
	    	<span class="label">
	        	<label>科目名称：</label>
	        </span>
	        <span class="formw">
	        	<select name="selectModule" id="select1" onchange="get_steptype()" style="width:150px;" >
	        	<option value=""></option>
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
	        	<label>步骤类型：</label>
	        </span>
	        <span class="formw">
	        	<select name="selectSteptype" id="select2" onchange="get_stepOptionNum()"   style="width:150px;" >
	 			</select>
	 			&nbsp;<a href="javascript:newSteptype();" id="linkhide" style=" font-size:14px;">新增步骤类型</a>
	        </span>
    	</div>
		<div class="row">
	    	<span class="label">
	        	<label>选项编号：</label>
	        </span>
	        <span class="formw">
	        	<select name="selectOptionNum" id="select3" onchange="get_stepOptionName()" style="width:150px;" >
       			</select>
        		&nbsp;<a href="javascript:newStepOption();" id="linkhide" style=" font-size:14px;">新增步骤选项</a>
	 		</span>
    	</div>
	 	<div class="row">
	    	<span class="label">
	        	<label>选项名称：</label>
	        </span>
	        <span class="formw">
	        	<input type="text" name="textOptionName" id="text1" style="width:146px;"  />
	        </span>
    	</div>
	 	<div class="row">
	    	<span class="label">
	        	<label>选项名称：</label>
	        </span>
	        <span class="formw">
	        	<input type="text" name="textOptionName" id="text1" style="width:146px;"  />
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
	        	<div style="  width: 200px; ">
		        	<input type="submit" value="更新" name="update" /> 
				 	<input type="submit" value="添加" name="insert" /> 
				 	<input type="submit" value="删除" name="delete" /> 
			 	</div>
	        </span>
    	</div> 
	</form>
 </div>
<?php 
	require_once('../../admin/code/tce_page_footer.php');
?>
<script type="text/javascript">
	function get_steptype()
	{//触发获取当前选中的科目所包含的步骤类型
		var module_id=document.getElementById("select1").value;
		document.getElementById("select2").options.length=0;
		document.getElementById("select3").options.length=0;
		document.getElementById("text1").value="";
		var select_steptype=document.getElementById('select2');   
		steptype_infor=<?php echo json_encode($steptype);?>;
		select_steptype.options[select_steptype.length]=new Option("","");
		for(var row in steptype_infor)
		{
			if(steptype_infor[row]['steps_module_id']==module_id)
			{
				select_steptype.options[select_steptype.length]=new Option(steptype_infor[row]['steps_type'],steptype_infor[row]['steps_type']);
			}
		}
	}
	function newSteptype()
	{//新增步骤类型
		var module_id=document.getElementById("select1").value;
		if(module_id!="")
		{
		var select_steptype=document.getElementById('select2');
		now=select_steptype.length!=0?select_steptype.options[select_steptype.length-1].value:0;
		//alert(select_steptype.length);
		select_steptype.options[select_steptype.length]=new Option(Number(now)+1,Number(now)+1);
		select_steptype.options[select_steptype.length-1].selected='selected';
		document.getElementById("select3").options.length=0;
		document.getElementById("text1").value="";
		}
		else
		{
			alert("请选择科目名称！");
		}
	}
	function get_stepOptionNum()
	{//触发获取当前选中的步骤类型所包含的选项编号
		var module_id=document.getElementById("select1").value;
		var steptype=document.getElementById("select2").value;
		document.getElementById("select3").options.length=0;
		document.getElementById("text1").value="";
		var select_optionNum=document.getElementById('select3');
		//var text_optionName=document.getElementById("text1");
		option_infor=<?php echo json_encode($stepOption);?>;
		select_optionNum.options[select_optionNum.length]=new Option("","");
		for(var row in option_infor)
		{
			if(option_infor[row]['steps_type']==steptype&&option_infor[row]['steps_module_id']==module_id)
			{
				select_optionNum.options[select_optionNum.length]=new Option(option_infor[row]['steps_options_id'],option_infor[row]['steps_options_id']);
			}
		}
	}
	function get_stepOptionName()
	{//触发获取当前选中的步骤类型所包含的选项名称
		var module_id=document.getElementById("select1").value;
		var steptype=document.getElementById("select2").value;
		var stepOptionNum=document.getElementById("select3").value;
		var text_optionName=document.getElementById("text1");
		option_infor=<?php echo json_encode($stepOption);?>;
		for(var row in option_infor)
		{
			if(option_infor[row]['steps_options_id']==stepOptionNum&&option_infor[row]['steps_type']==steptype&&option_infor[row]['steps_module_id']==module_id)
			{
				text_optionName.value=option_infor[row]['steps_options'];
			}
		}
	}
	function newStepOption()
	{//新增步骤选项
		var select_steptype=document.getElementById('select2');
		if(select_steptype.value!="")
		{
			var select_optionNum=document.getElementById('select3');
			now=select_optionNum.length!=0?select_optionNum.options[select_optionNum.length-1].value:0;
			select_optionNum.options[select_optionNum.length]=new Option(Number(now)+1,Number(now)+1);
			select_optionNum.options[select_optionNum.length-1].selected='selected';
			document.getElementById("text1").value="";
		}
		else
		{
			alert("请选择步骤类型！");
		}
	}
</script>