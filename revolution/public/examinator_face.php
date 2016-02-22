<?php
/*-----------------------------------------
主页：考试界面
-----------------------------------------*/

	header("Content-type:text/html;charset=utf-8");
	require_once('../share/function/function_consi_ques.php');
	require_once('../share/function/sqlHelper.php');
	require_once('./public_ajax.php');
	$thispage_title = "考试";
	require_once('../../public/config/tce_config.php');
	$pagelevel = K_AUTH_PUBLIC_INDEX;
	require_once('../../shared/code/tce_authorization.php');
	require_once('../../public/code/tce_page_header.php');
    //user_id 获得考生的id
    $user_arr=get_attrs_from_table("select user_id from tce_users where user_name='".$_SESSION['session_user_name']."';");
    if(!empty($user_arr)){
    	$user_id=$user_arr[0]['user_id'];
    	//print_r($user_id);
    }
?>
<div class="examinator_face">
	<h1>考试</h1>
	<hr/>
	<form action="select_ques_face.php" method="POST"  onsubmit="return checkInfo();" id="form_upload">
		<div class="exam_center">
			<div class="row">
				<span class="label">
					<label for="test_mode" title="模式">模式:</label>
				</span>
				<span class="formw">
					<select name="test_mode" style="width:170px;" id="test_mode">
							<option value='0' selected="selected">课堂练习</option>
							<option value='1'>考试</option>
					</select>
				</span>
			</div>
			<div class="row">
				<span class="label">
					<label for="test_subject" title="科目名称">科目名称:</label>
				</span>
				<span class="formw">
					<select name="test_subject" style="width:170px;" id="exam_subject">
					</select>
				</span>
			</div>
			<div class="row">
				<span class="label">
					<label for="test_name" title="考试名称">考试名称:</label>
				</span>
				<span class="formw">
					<select name="test_name" style="width:170px;" id="exam_name">
						 
					</select>
				</span>
			</div>
			<div class="row">
				<span class="label">
					<label for="test_start" title="开始时间">开始时间:</label>
				</span>
				<span class="formw">
					<select name="test_start" style="width:170px;"  id="exam_start">
					</select>
				</span>
			</div>
			<div class="row">
				<span class="label">
					<label for="test_over" title="结束时间">结束时间:</label>
				</span>
				<span class="formw">
					<select name="test_over" style="width:170px;" id="exam_end">
					</select>
				</span>
			</div>
			<div class="row">
				<span class="label">
					<label for="test_duration" title="考试时长">考试时长:</label>
				</span>
				<span class="formw">
					<input name="test_duration" style="width:166px;"  readonly="readonly" id="test_duration">
					</input>&nbsp;<span>分钟</span>
				</span>
			</div>
			<div class="row">
				<span class="label">
					<label for="test_status" title="状态">状态:</label>
				</span>
				<span class="formw">
					<input  readonly="readonly" name="test_status" style="width:166px;" id="exam_status"/>
					<span class="pass-item-error">考试不可用</span>
					<span class="pass-item-succ"></span>
				</span>
			</div>
		</div>
		<div class="clear"></div>
		<div class="examintor_opera">
			<input type="submit" id="in_exam" value="进入考试"/>
		</div>
	</form>
</div>
    <script src="../share/jscripts/jquery-1.7.2.min.js"></script> 
    <script>
		var user_id="<?php echo $user_id; ?>";
		function checkInfo(){
			var t_face_modu_id=$('#exam_subject').find("option:selected").val();
			var t_face_exam_id=$('#exam_name').find("option:selected").val();
			var test_status=$('#exam_status').val();
			if(test_status==='考试不可用'){
				alert("当前考试不可用");
				return false;
			}
			if(test_status==='已完成'){
				alert("你已进行过这次考试！");
				return false;
			}
			if(t_face_modu_id=='-1' || t_face_exam_id=='-1'){
				if(t_face_modu_id=='-1'){
					alert("请选择科目!");
				}else{
					alert("请选择考试!");
				}
				return false;
			}
			if($('#exam_start').find('option:selected').val()==null){
				alert("请选择考试时间!");
				return false;
			}
			if($('#exam_end').find('option:selected').val()==null){
				alert("请选择考试时间!");
				return false;
			}
			switch($("#test_mode").find("option:selected").val()){
				case '0':
					$('#form_upload').attr('action',"select_ques_face_onCourse.php");
					return true;
				case '1':
					$('#form_upload').attr('action','select_ques_face.php');
					return true;
				default:
					break;	
			}
		}
	</script>
    <script src="../share/jscripts/exam_event.js"></script>
	<script src="../share/jscripts/examinator.js"></script>

<?php
    require_once('../../public/code/tce_page_footer.php');
?>