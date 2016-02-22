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
	{//导入按钮被按下时，调用导入函数
		$import=new import($_FILES['import_flow']['tmp_name']);//文件路径
		$count=$import->import_flow($user_id,$_POST['selectSubject']);
		echo "<script>alert('读取".$count[1]."道题，成功导入".$count[0]."道题！');</script>";
		echo "<script>window.location.href='".basename($_SERVER['PHP_SELF'])."'</script>"; 
	}
?>

<div class="import_flow">
 	<h1>导入流程题</h1>
	<hr/>
 	<form method="post" ENCTYPE="multipart/form-data" >
    	<?php
        	$module=getModule();//获取科目列表
			$subject=getSubject();//获取章节列表
		?>
		<div class="row">
	        <span class="label">
	        	<label>&nbsp;所属科目：</label>
	        </span>
	        <span class="formw">
		 		<select name="selectModule" id="select1" onchange="get_subject()" style="width:150px;">
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
	        	<label>&nbsp;所属章节：</label>
	        </span>
	        <span class="formw">
		 		<select name="selectSubject" id="select2" style="width:150px;">
		        	<option></option>
			 	</select>
	        </span>
		</div>
	 	<div class="row">
	        <span class="label">
	        	<label>导入excel：</label>
	        </span>
	        <span class="formw">
		 		<input type="file" name="import_flow"/>
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
		 		<input type="submit" name="import" value="导入"/>&nbsp;&nbsp;&nbsp;
		 		<input type="button" style="width:75px;" value="下载模板"  id="load_demoFile_quesFlow" name="import"/>
		 		<input type="button" value="添加试题"/>
	        </span>
		</div>
 	</form>
</div>

<?php 
	require_once('../../admin/code/tce_page_footer.php');
?>
<script type="text/javascript">
 
	var obj=document.getElementById('load_demoFile_quesFlow');
	obj.onclick=function(){
		var r = window.confirm("确认下载流程题excel导入模板文件吗？")
		if(r){
			window.location.href="../flow_question.xls";
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
	function input_file(){
		$("input[name='import']").click(function(){
			alert('aaaaa');
		});
	}
</script>