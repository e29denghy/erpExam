<?php
	require "../share/function/sqlHelper.php";
	require "../admin/function_get_selectlist.php";
	include "../share/function/import.php";
	require_once('../../admin/config/tce_config.php');

	$pagelevel = K_AUTH_ADMIN_MODULES;
	require_once('../../shared/code/tce_authorization.php');
	require_once('../../admin/code/tce_page_header.php');

	if(isset($_POST['import']))
	{
		$import=new import($_FILES['import_optionContent']['tmp_name']);
		$count=$import->import_optionContent($_POST['selectModule']);
		echo "<script>alert('读取".$count[1]."个选项内容，成功导入".$count[0]."个选项内容！');</script>";
		echo "<script>window.location.href='".basename($_SERVER['PHP_SELF'])."'</script>"; 
	}
?>


<div class="import_opt_file">
 	<h1>导入步骤选项文件</h1>
 	<hr/>
 	<form method="post" ENCTYPE="multipart/form-data">
        <?php
        	$module=getModule();//获取科目列表
		?>
		<div class="row">
	        <span class="label">
				<label>&nbsp;所属科目：</label>
	        </span>
	        <span class="formw">
	  			<select name="selectModule" id="select1" style="width:150px;">
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
				<label>导入excel：</label>
	        </span>
	        <span class="formw">
	  			<input type="file" name='import_optionContent'/>
	        </span>
		</div>	
		<div class="row">
	        <span class="label">
				<label></label>
	        </span>
	        <span class="formw">
	  			 
	        </span>
		</div>
	 	<div class="row">
	        <span class="label">
	        </span>
	        <span class="formw">
		 		<input type="submit" style="width:75px;" value="导入" name="import"/>&nbsp;
		 		<input type="button" style="width:75px;" id="load_demoFile_option" value="下载模板" name="import"/>
	        </span>
		</div>
 	</form>
</div>
<script>
	var obj=document.getElementById('load_demoFile_option');
	obj.onclick=function(){
		var r = window.confirm("确认下载步骤选择excel导入模板文件吗？")
		if(r){
			window.location.href="../flow_steps_options.xls";
		}
	}
</script>
<?php 
	require_once('../../admin/code/tce_page_footer.php');
?>