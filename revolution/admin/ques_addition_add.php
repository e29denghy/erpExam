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
//echo '<script type="text/javascript" src="../../revolution/share/jscripts/json.js"></script>';
$user_arr=get_attrs_from_table("select user_id from tce_users where user_name='".$_SESSION['session_user_name']."';");
foreach ($user_arr as $key => $value) {
	$user_id=$user_arr[$key]['user_id'];
}

$att_ques_id=isset($_REQUEST["flow_id"])?$_REQUEST["flow_id"]:null;	// 当前的流程题id 
$step_num=isset($_REQUEST["step_num"])?$_REQUEST["step_num"]:null;	// 当前的附加题对应的步骤
$blance_id=isset($_REQUEST["blance_id"])?$_REQUEST["blance_id"]:null;
?>
  		<div class="add_attach" id="add_attach">
  			<h3>添加附加题</h3>
  			<div class="row">
		        <span class="label">
					<label>对应流程题：</label>
		        </span>
		        <span class="formw">
					<input type="text" readonly="readonly" style="width:146px;" id="add_flw_ques"/>		
		        </span>
			</div>	
			<div class="row">
		        <span class="label">
					<label>对应流程题步骤：</label>
		        </span>
		        <span class="formw">
					<select id="att_flow_step"  style="width:150px;">
					</select>		
		        </span>
			</div>			
		
			<div class="row">
		        <span class="label">
					<label>题目内容:</label>
		        </span>
		        <span class="formw">
					<select name="atta_content" style="width:150px;" id="atta_content" >
						<option>+</option>
					</select>	
		        </span>
			</div>

			<div class="row">
		        <span class="label">	
		        </span>
		        <span class="formw">
					<textarea id="atta_conten_area" cols="40" rows="7">
					</textarea>	
		        </span>
			</div> 
			
			<div class="row">
		        <span class="label">	
		        	<label>题型:</label>
		        </span>
		        <span class="formw">
					<input type="radio" name="qtype" id="qtype_sing" value="single_cho">单选题
					<input type="radio" name="qtype" id="qtype_multi" value="multi_cho">多选题
					<input type="radio" name="qtype" id="qtype_printScreen" value="image_cho">截图题
		        </span>
			</div>

			<div class="row">
		        <span class="label">	
		        	<label>题目是否可用:</label>
		        </span>
		        <span class="formw">
					<input type="checkbox" id="attac_avail" name="attac_avail"/>
		        </span>
			</div>
			<!--
			<div class="row">
			        <span class="label">
						<label>题目内容:</label>
			        </span>
			        <span class="formw">
						<select name="atta_content" id="atta_content" >
							<option>+</option>
						</select>	
			        </span>
			</div>
			-->
			<div class="att_opera">
				<input type="button" value="添加"  id="att_insert">
				<input type="button" value="更新"  id="att_update">
				<input type="button" value="删除"  id="att_delete">
				<input type="button" value="返回题目" onclick="window.location.href='ques_flw_add.php'" id ="btn_add_answ" >
			</div>
  		</div>
  		<hr/>
  		<div class="add_att_answ">
  			<h3>添加附加题答案</h3>
			<div class="row">
		        <span class="label">
					<label>附加题目id：</label>
		        </span>
		        <span class="formw">
					<input type='text' style="width:146px;" readonly="readonly" id="atta_answ_id">
		        </span>
			</div>
			<div class="row">
		        <span class="label">
					<label>答案内容：</label> 
		        </span>
		        <span class="formw">
					<select id="atta_answ_content"  style="width:150px;">
  						<option>+</option>
		  			</select>
		        </span>
			</div>
			<div class="row">
		        <span class="label">
		        </span>
		        <span class="formw">
		  			<textarea cols="40" rows="7" id="atta_answ_content_area">
		  			</textarea>
		        </span>
			</div>			
			<div class="row">
		        <span class="label">
					<label>是否可用：</label> 
		        </span>
		        <span class="formw">
		  			<input type="checkbox" id="atta_answ_avail"/>
		        </span>
			</div>
			<div class="row">
		        <span class="label">
					<label>是否正确：</label>
		        </span>
		        <span class="formw">
		  			<input type="checkbox" id="atta_answ_isright"/>	
		        </span>
			</div>
			<div class="att_answ_opera">
				<input type="button" value="添加" id="att_answ_insert" />
				<input type="button" value="更新" id="att_answ_update"/>
				<input type="button" value="删除" id="att_answ_dele"/>
			</div>
  		</div>
<script>
/*-------------------------------------------
	添加流程题答案
---------------------------------------------*/
	var auth_id="<?php echo $user_id;?>";
	var att_ques_id="<?php  echo $att_ques_id;
	?>";
	var step_num="<?php  echo $step_num;
	?>";
	var blance_id="<?php  echo $blance_id;
	?>";
	//设置add_flw_ques
	$("#add_flw_ques").val(att_ques_id);
	//设置步骤锁定
	var option_null=$('<option>').val("-1").text("");
	$('#att_flow_step').append(option_null);
	for(var i=0;i<step_num;i++){
		var option=$('<option>').val((i+1)).text((i+1));
		$('#att_flow_step').append(option);
	}


</script>

<script src="../share/jscripts/Ajax.js"></script>
<?php 
	require_once('../../admin/code/tce_page_footer.php');
?>