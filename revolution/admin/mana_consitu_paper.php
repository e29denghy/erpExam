<?php
	require "../share/function/sqlHelper.php";
	require "../admin/function_get_selectlist.php";
	require "../admin/function_handle_test.php";
	require "../admin/function_handle_paper.php";
	
	require_once('../../admin/config/tce_config.php');

	$pagelevel = K_AUTH_ADMIN_MODULES;
	require_once('../../shared/code/tce_authorization.php');
	require_once('../../admin/code/tce_page_header.php');

	
	if(isset($_POST['add']))
	{//添加测验
		if($_POST['test_name']!=""&&$_POST['test_description']!="")
		{
			$result_insert=insertTest($_POST['test_name'],$_POST['test_description'],'2',isset($_POST['test_enable'])==true?1:0,$_POST['test_password']);
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
	if(isset($_POST['update']))
	{//更新测验
		if($_POST['test_name']!=""&&$_POST['test_description']!="")
		{
			$result_update=updateTest($_POST['test_id'],$_POST['test_name'],$_POST['test_description'],isset($_POST['test_enable'])==true?1:0,$_POST['test_password']);
			if($result_update!=0)
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
	if(isset($_POST['delete']))
	{//删除测验
		$result_delete=deleteTest($_POST['test_id']);
		if($result_delete==1)
		{
			echo "<script>alert('删除成功！')</script>";
		}
		else
		{
			echo "<script>alert('请重新操作！')</script>";
		}
		echo "<script>window.location.href='".basename($_SERVER['PHP_SELF'])."'</script>"; 
	}
	if(isset($_POST['makepaper']))
	{
		echo "<script>window.location.href='mana_form_exam_paper.php'</script>"; 
	}
?>

<!--
	body
-->
<script src="../share/jscripts/jquery-1.7.2.min.js" type="text/javascript" charset="utf-8"></script>
 <div class="test_manage">
 	<h1>试卷集管理</h1>
 	<hr/>
    <?php
		$testInfor=getTest();//获取测验信息
		$paperInfor=getPaperInfor();//获取测验已经组好试卷的套数
	?>
 	<form method="post" ENCTYPE="multipart/form-data">
	 	<div class="row">
			<span class="label">
				<label for="test_name" title="测验名称">测验：</label>
			</span>
			<span class="formw">
				<select style="width:154px;" name="test_id" id="test_id" onchange="javascript:select_action()">
		 		<option value="new">+</option>
                <?php
				foreach($testInfor as $row)
				{
	 				echo "<option value='".$row['test_id']."'>".$row['test_id']." ".$row['test_name']."</option>";
				}
				?>
		 		</select>
		 	</span>
	 	</div>
	 	<div class="row">
			<span class="label">
				<label>名称：</label>
			</span>
			<span class="formw">
				<input type="text" name="test_name" id="test_name" style="width:150px;" maxlength="255">
			</span>
		</div>
	 	<div class="row">
			<span class="label">
				<label>描述：</label>
			</span>
			<span class="formw">
				<textarea cols='40' rows="10" name="test_description" id="test_description"></textarea>
			</span>
		</div> 
		<div class="row">
			<span class="label">
				<label>是否可用：</label>
			</span>
			<span class="formw">
				<input type="checkbox" id="test_enable" checked="checked" value="1" name="test_enable">
			</span>
		</div> 
		<div class="row">
			<span class="label">
				<label>密码：</label>
			</span>
			<span class="formw">
				<input type="password" id="test_password" name="test_password" style="width:150px;">
			</span>
		</div>
        <div class="row">
			<span class="label">
				<label>已有试卷套数：</label>
			</span>
			<span class="formw">
				<input type="text" name="paperCount" id="paperCount" value="0" style="width:150px;" readonly="readonly">
                <a  href="" id="managePaper" onclick="return paperClick()" style="display:none;">管理试卷</a>
			</span>
		</div>
	 	<div class="import_opt_file_opera">
		 	<input type="submit" value="添加" name="add" id="add_test" />
		 	<input type="submit" value="更新" name="update" id="update_test" disabled="disabled" />
		 	<input type="submit" value="删除" name="delete" id="delete_test" disabled="disabled" />
		 	<input type="submit" value="组卷" name="makepaper" id="makepaper"/>
		</div>
 	</form>
 </div>
 
<!--
	body
-->
<?php 
	require_once('../../admin/code/tce_page_footer.php');
?>
<script type="text/javascript">
    function paperClick(){
    	var test_id=$("#test_id").find("option:selected").val();
    	if(test_id!==null){
    		$("#managePaper").attr("href","paper_question_manage.php?test_id="+test_id);
    		return true;
    	}
    		return false;		
    }
	function select_action()
	{
		var test_id=document.getElementById("test_id").value;
		if(test_id=="new")
		{
			document.getElementById("add_test").disabled="";
			document.getElementById("update_test").disabled="disabled";
			document.getElementById("delete_test").disabled="disabled";//设置按钮是否可用
			document.getElementById("test_name").value="";
			document.getElementById("test_description").value="";
			document.getElementById("test_enable").checked="checked";
			document.getElementById("test_password").value="";//清空控件内容
			document.getElementById("managePaper").style.display="none";
			document.getElementById("paperCount").value=0;
		}
		else
		{
			document.getElementById("add_test").disabled="disabled";
			document.getElementById("update_test").disabled="";
			document.getElementById("delete_test").disabled="";//设置按钮是否可用
			var testInfor=<?php echo json_encode($testInfor); ?>;//获取php变量test信息
			var paperInfor=<?php echo json_encode($paperInfor);?>;
			for(var row in testInfor)
			{
				if(testInfor[row]['test_id']==test_id)
				{
					document.getElementById("test_name").value=testInfor[row]['test_name'];
					document.getElementById("test_description").value=testInfor[row]['test_description'];
					document.getElementById("test_enable").checked=testInfor[row]['test_enable']==1?"checked":"";
					document.getElementById("test_password").value=testInfor[row]['test_password'];
					break;
				}//获取相应测验信息
			}
			var paper_count=0;
			for(var row in paperInfor)
			{
				if(paperInfor[row]['test_id']==test_id)
				{
					paper_count=paperInfor[row]['paper_count'];
					mpstrategy_id=paperInfor[row]['mpstrategy_id'];
					break;
				}
			}
			if(paper_count==0)
			{
				document.getElementById("managePaper").style.display="none";
			}
			else
			{
				document.getElementById("managePaper").style.display="";
			}
			document.getElementById("paperCount").value=paper_count;
		}
	}
</script>