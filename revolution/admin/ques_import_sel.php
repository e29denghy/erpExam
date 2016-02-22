<?php
	require "../share/function/sqlHelper.php";
	require "../admin/function_get_selectlist.php";
	include "../share/function/import.php";
	require_once('../../admin/config/tce_config.php');

	$pagelevel = K_AUTH_ADMIN_MODULES;
	require_once('../../shared/code/tce_authorization.php');
	require_once('../../admin/code/tce_page_header.php');
	
	require_once('../share/function/function_consi_ques.php');
    //user_id 获得考生的id
    $user_arr=get_attrs_from_table("select user_id from tce_users where user_name='".$_SESSION['session_user_name']."';");
    foreach ($user_arr as $key => $value) {
     $user_id=$user_arr[$key]['user_id'];
    }

	if(isset($_POST['import']))
	{
		$import=new import($_FILES['import_quesother']['tmp_name']);
		$count=$import->import_quesother($user_id,$_POST['selectSubject']);
		echo "<script>alert('读取".$count[1]."道题，成功导入".$count[0]."道题！');</script>";
		echo "<script>window.location.href='".basename($_SERVER['PHP_SELF'])."'</script>"; 
	}
?>

<div class="import_flow">
 	<h1>导入理论题</h1>
 	<hr/>
 	<form method="post" ENCTYPE="multipart/form-data">
	 	<?php
        	$module=getModule();//获取科目列表
			$subject=getSubject();//获取章节列表
		?>
	 	<label>&nbsp;所属科目：</label>
	 	<select name="selectModule" id="select1" onchange="get_subject()" style="width:150px;">
        	<option></option>
        	<?php
				foreach($module as $row)
				{
	 				echo "<option value='".$row['module_id']."'>".$row['module_name']."</option>";
				}
			?>
	 	</select>
	 	<p/>
	 	<label>&nbsp;所属章节：</label>
	 	<select name="selectSubject" id="select2" style="width:150px;">
        	<option></option>
	 	</select>
	 	<p/>
	 	<label>导入Excel：</label><input type="file" name='import_quesother'/>
	 	<div style="text-align:center;">
		 	<input type="submit" value="导入" name="import"/>&nbsp;&nbsp;&nbsp;<input type="button" id="load_demo_concept" style="width:75px;" value="下载模板" name="load_demo_concept"/>
		 	<input type="submit" value="返回"/>
		</div>
 	</form>
</div>

<?php 
	require_once('../../admin/code/tce_page_footer.php');
?>
<script type="text/javascript">
	var obj=document.getElementById('load_demoFile_sel');
	obj.onclick=function(){
		var r = window.confirm("确认下载理论题excel导入模板文件吗？")
		if(r){
			window.location.href="../";
		}
	}
	function get_subject()
	{//触发获取当前选中的科目所包含的章节
		var module_id=document.getElementById("select1").value;
		//var subject_infor=new Array();
		document.getElementById("select2").options.length=0;
		var select_subject=document.getElementById('select2');   
		//subject_infor=document.getElementById("subject").value;
		subject_infor=<?php echo json_encode($subject);?>;
		for(var row in subject_infor)
		{
			if(subject_infor[row]['subject_module_id']==module_id)
			{
				//var option_content=subject_infor[row]['subject_id']+"  "+subject_infor[row]['subject_name'];
				//alert(option_content);
				select_subject.options[select_subject.length]=new Option(subject_infor[row]['subject_name'],subject_infor[row]['subject_id']);
			}
		}
	}
</script>