<?php
header("Content-type:text/html;charset=utf-8");

require_once('../../admin/config/tce_config.php');

$pagelevel = K_AUTH_ADMIN_MODULES;
require_once('../../shared/code/tce_authorization.php');
require_once('../../admin/code/tce_page_header.php');


require_once("../share/function/sqlHelper.php");
require_once('../share/function/function_consi_ques.php');

$thispage_title = "试题管理";


echo '<script type="text/javascript" src="../../revolution/share/jscripts/jquery-1.7.2.min.js"></script>'.K_NEWLINE;
echo '<script type="text/javascript" src="../../revolution/share/jscripts/exam_event.js"></script>';
echo '<script type="text/javascript" src="./ajax_ques_flw.js"></script>';

//user 的id
$user_arr=get_attrs_from_table("select user_id from tce_users where user_name='".$_SESSION['session_user_name']."';");
foreach ($user_arr as $key => $value) {
	$user_id=$user_arr[$key]['user_id'];
}
//module的name
$sql="select module_id,module_name from tce_modules;";
$sub_res=get_attrs_from_table($sql);
//echo $sub_res[0]["module_id"];
?>
<!--
<div class="row">
        <span class="label">
			<label>对应流程题步骤：</label>
        </span>
        <span class="formw">
        </span>
</div>
-->
<script>
	var module_name=[];
	<?php
		foreach ($sub_res as $key => $value) {
		?>
		module_name[<?php echo $key;?>]=[];
		module_name[<?php echo $key;?>][0]="<?php echo $sub_res[$key]['module_id'];?>";
		module_name[<?php echo $key;?>][1]="<?php echo $sub_res[$key]['module_name'];?>";
		<?php
		}
		?>
		$(document).ready(function(){
			for(var i=0;i<module_name.length;i++){
				var option=$('<option>').val(module_name[i][0]).text(module_name[i][1]);
				$('#flw_subject').append(option);
			}
		});
</script>
<div class="test_manager">
  		<div class="flw_addition" id='flw_addition'>
	  		<h3>添加流程题</h3>
	  		<hr/>
	  		<div class="flw_add_left">
			  		<div class="row">
					    <span class="label">
					    	<label>题库科目：</label>
					    </span>
					    <span class="formw">
							<select id="flw_subject" style="width:150px;" name="sub_name" >
								<option></option>
							</select>
					    </span>
				    </div>
					<div class="row">
				        <span class="label">
							<label>科目模块：</label>
				        </span>
				        <span class="formw">
							<select id="flw_module" name="module_name" style="width:150px;">
								<option></option>
					  		</select>
				        </span>
					</div>
			  		<input type="hidden" style="width:150px;" name="selected_id" id="selected_id"/ >
			  		<div class="row">
				        <span class="label">
							<label>题目内容：</label>
				        </span>
				        <span class="formw">
							<select id="flw_number" name="ques_name" style="width:150px;">
								<option></option>
					  		</select>
	
				        </span>
					</div>
					<div class="row">
				        <span class="label">
							
				        </span>
				        <span class="formw">
							<textarea cols="37" rows="8" id="flw_content">
							</textarea>
	
				        </span>
					</div>
					<div class="row">
			        <span class="label">
						<label for="enabled" title="是否可用">是否可用：</label>
			        </span>
			        <span class="formw">
						<input type="checkbox" id="isEnabled" >
			        </span>
					</div>
					<div class="row">
				        <span class="label">
							<label>难度：</label>
				        </span>
				        <span class="formw">
							<select id="flw_difficulty" style="width:150px;" name="flw_difficulty">
								<option value="0"></option>
								<option value="1">1</option>
								<option value="2">2</option>
								<option value="3">3</option>
								<option value="4">4</option>
								<option value="5">5</option>
								<option value="6">6</option>
								<option value="7">7</option>
								<option value="8">8</option>	 
								<option value="9">9</option>
								<option value="10">10</option>
			  				</select>
		        		</span>
					</div>
					<div class="flw_opera">
						<input type="button" value="添加" name="flw_mode"  id="flw_insert"/>
						<input type="button" value="更新" name="flw_mode" id="flw_update"/>
						<input type="button" value="删除" name="flw_mode" id="flw_delete"/>
			  			<input type="button" value="添加步骤选项" onclick="location='next.php';" id="flw_insert" />
			  			<input type="button" value="导入选项步骤" onclick="location='next.php';"  id="flw_inport_opt" />
					</div>
				
  			</div>
  		</div>		
	 	<div class="flw_right" id="flw_right">
	 			<h3>添加流程题答案</h3>
	 			<hr/>
				<div class="row">
			        <span class="label">
						<label class="current_answ">流程题答案:</label>
			        </span>
			        <span class="formw">
			 			<select id="flw_answ_amount" style="width:150px;">
			 			</select>
			 			<input type="button" id="newBlance" name="" value="添加为新分支" /><sub>(将当前答案添加为新分支)</sub>
			        </span>
				</div>	
				<div class="table_box">		 				
		 			<?php	
						$n=1;
			 			echo '<table class="AnswForm" id="1" width="411" border="0" bgcolor="#CCCCCC">'.K_NEWLINE;
				      	echo '<tr>'.K_NEWLINE;
						echo '<td width="41" rowspan="3">步骤</td>';
						echo '<td class="step" rowspan="3">1</td>';
						echo '<td width="216">';
						echo '<label>单据</label>&nbsp;&nbsp;';
						echo '<select name="1" style="width:165px;">';
						echo '<option selected="selected" value="请选择">请选择</option>';
						    //----------------------------单据
		                    $sql_search_list="select steps_options_content_id,steps_options_content from flow_steps_options where module_id='1' and steps_options='单据' order by step_order asc";
		                    $res_option_list=get_attrs_from_table($sql_search_list);
		                    //var_dump($res_option_list);
		                    //----------------------------操作
		                    $sql_search_opera="select steps_options_content_id,steps_options_content from flow_steps_options where module_id='1' and steps_options='操作' order by step_order asc";
		                    $res_option_opera=get_attrs_from_table($sql_search_opera);
		                    //var_dump($res_option_opera);
		                    //----------------------------角色
		                    $sql_search_role="select steps_options_content_id,steps_options_content from flow_steps_options where module_id='1' and steps_options='角色' order by step_order asc";
		                    $res_option_role=get_attrs_from_table($sql_search_role);
		                    //var_dump($res_option_role);

		                    for($i=0;$i<count($res_option_list);$i++){
		                        echo '<option value="'.$res_option_list[$i]["steps_options_content_id"].'">'.$res_option_list[$i]["steps_options_content"].'</option>';
		                    }
						echo '</select>';
						echo '</td>';
						echo '<td width="128" rowspan="3"><label>';
						echo '<input type="button" name="copy" id="copy" value="复制" />';
						echo '<input type="button" name="delete" id="delete" value="删除" />';
						echo '<input type="button" name="up" id="up" value="上移↑"  />';
						echo '<input type="button" name="down" id="down" value="下移↓" />';
						echo '</label>';
						echo '</td>';
				      	echo '</tr>';
					    echo '<tr>';
						echo '<td>';
						echo '<label>操作</label>&nbsp;&nbsp;';
						echo '<select name="2" style="width:165px;">';
						echo '<option selected="selected" value="请选择">请选择</option>';
	                    for($i=0;$i<count($res_option_opera);$i++){
	                        echo '<option value="'.$res_option_opera[$i]["steps_options_content_id"].'">'.$res_option_opera[$i]['steps_options_content'].'</option>';
	                    } 
						echo '</select>';
						echo '</td>';
					    echo '</tr>';
					    echo '<tr>';
					    echo '<td>';
					    echo '<label>角色</label>&nbsp;&nbsp;';
						echo '<select name="3" style="width:165px;">';
						echo '<option selected="selected" value="请选择">请选择</option>';
						for($i=0;$i<count($res_option_role);$i++){
                        	echo '<option value="'.$res_option_role[$i]["steps_options_content_id"].'">'.$res_option_role[$i]['steps_options_content'].'</option>';
                    	} 
						echo '</select>';
					    echo '</td>';
				      	echo '</tr>';
			    		echo '</table>';
					?>

				</div>
				<div class="row">
			        <span class="label">
						<label class="current_answ">是否有分支:</label>
			        </span>
			        <span class="formw">
			  			<input type="checkbox" value="1" id="blance_checked" name='blance'/>
			        </span>
				</div>	

				<div class="row">
			        <span class="label">
						<label class="current_answ" >分支开始:</label>
			        </span>
			        <span class="formw">
			  			<select name="start_blance" id="flow_number_start" style="width:150px;">
							<option></option>
						</select>
			        </span>
				</div>	 			 	
				<div class="row">
			        <span class="label">
						<label class="current_answ" >分支结束:</label>
			        </span>
			        <span class="formw">
			  			<select name="end_blance" id="flow_number_end" style="width:150px;">
							<option></option>
						</select>
			        </span>
				</div>	 		
	    		<div class="flw_answ_oper">
		    		<input type="button" value="添加" name="添加" id="flw_answ_add"/>
		    		<input type="button" value="更新" name="更新" id="flw_answ_update"/>
		    		<input type="button" value="删除" name="删除" id="flw_answ_delete"/>
		    		<input type="button" value="添加附加题" id="flw_attchment" />
		    	</div>	
	 	</div>
  	
  	

</div>
<script>
/*-------------------------------------------
	添加流程题答案
---------------------------------------------*/
	var  auth_id="<?php echo $user_id;?>";
 	
	;
</script>
<script>
/*-------------------------------------------
	页面跳转 参数设置
---------------------------------------------*/
	$("#flw_attchment").live('click',pageCall);
	function pageCall(){
		var flw_step_num=$(".AnswForm").length;
		var flw_id=$('#flw_number').find("option:selected").val();
		var blance_id=$('#flw_answ_amount').find("option:selected").val();
		window.location.href="ques_addition_add.php?flow_id="+flw_id+"&step_num="+flw_step_num+"&blance_id="+blance_id+"";
	}
	var modu_current_id=null;
	$("#flw_subject").live('change',function(){
		modu_current_id=$(this).val();

	});
</script>
<script src="../share/jscripts/Ajax.js"></script>
<?php 
	require_once('../../admin/code/tce_page_footer.php');
?>