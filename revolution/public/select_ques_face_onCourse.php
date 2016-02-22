<?php
/*
理论题考试界面
*/
header("Content-type:text/html;charset=utf-8");
require_once('../../public/config/tce_config.php');
require_once('../../shared/code/tce_authorization.php');
require_once('../../public/code/tce_page_header.php');
require_once('../share/function/function_consi_ques.php');
require_once('../share/function/sqlHelper.php');
require_once('./public_ajax.php');
$pagelevel = K_AUTH_PUBLIC_INDEX;
$thispage_title = "考试";
$thispage_description = $l['hp_public_index'];
    //判断考试权限
        //1.从考试记录表中获取考试记录，若是考过，就不能再考。获取test_id  在获取exam_id
        //从flow_exam_paper 获取paper_id
        //根据pape_id去试卷题目关联表 flow_paper_question
        //根据试卷题目关联表 flow_paper_question  获取流程题和非流程题
        //根据非流程题
    $t_face_modu_id=isset($_REQUEST['test_subject'])?$_REQUEST['test_subject']:null;
    $t_face_exam_id=isset($_REQUEST['test_name'])?$_REQUEST['test_name']:null;
    $test_status=isset($_REQUEST['test_status'])?$_REQUEST['test_status']:null;
    $papers_questions_id=isset($_REQUEST['papers_questions_id'])?$_REQUEST['papers_questions_id']:'1';
    $examMode=isset($_REQUEST['test_mode'])?$_REQUEST['test_mode']:NULL;
	$test_duration=isset($_REQUEST['test_duration'])?$_REQUEST['test_duration']:NULL;
	if(isset($test_duration)){
		$_SESSION['examMode']=$examMode;
	}
	if(!isset($_SESSION['examMode'])){
		$_SESSION['examMode']=$examMode;
	}
    //echo "t_face_exam_id".$t_face_exam_id;
    //判断 并获取examination_log_id
    if(isset($t_face_exam_id)){
    	$_SESSION["exam_id"]=$t_face_exam_id;
    }
	if(!isset($_SESSION["exam_id"])){
		if(isset($t_face_exam_id)){
			$_SESSION["exam_id"]=$t_face_exam_id;
		}else{
			echo "<script>alert('改用户的exam_id不存在！');</script>";
		}
	}else{
		$t_face_exam_id=$_SESSION["exam_id"];
	}
	/*保存当前的module_id
	 */ 
	if(!isset($_SESSION["modu_id"])){
		if(isset($t_face_modu_id)){
			$_SESSION["modu_id"]=$t_face_modu_id;
		}else{
			echo "<script>alert('改用户的modu_id不存在！');</script>";
		}
	}else{
		$t_face_modu_id=$_SESSION["modu_id"];
	}
	
    $exam_examination_log_id=isset($_REQUEST['examination_log_id'])?$_REQUEST['examination_log_id']:null;
    
    if(!empty($exam_examination_log_id)){

//      $sql_seach_exam_id="select exam_id from flow_examination_log where examination_log_id='{$exam_examination_log_id}'";
//      $res_seach_exam_id=get_attrs_from_table($sql_seach_exam_id);
//      $t_face_exam_id=$res_seach_exam_id[0]["exam_id"];
		$t_face_exam_id=$_SESSION["exam_id"];
		$t_face_modu_id=$_SESSION["modu_id"];
//      $sql_seach_modu="select exam_module_id from flow_exam  where exam_id ='{$t_face_exam_id}';";
//      $res_seach_modu=get_attrs_from_table($sql_seach_modu);
//      $t_face_modu_id=$res_seach_modu[0]["exam_module_id"];
    }
    //传过来的考试情况
    
    if($test_status=='1'){
        echo "<script>alert('你已进行过这场考试！');</script>";
        echo "<script>window.location.href='examinator_face.php';</script>";
        exit(0);
    }
    //$t_face_modu_id='5';
    //$t_face_exam_id='1';
    //传过来的papers_questions_id
    //获取用户ip地址
    $user_ip=get_real_ip(); 
    $examination_log_id;
    //user_id 获得考生的id
    $user_arr=get_attrs_from_table("select user_id from tce_users where user_name='".$_SESSION['session_user_name']."';");
    if(!empty($user_arr)){
        foreach ($user_arr as $key => $value) {
            $user_id=$user_arr[$key]['user_id'];
            //echo $user_id;
        }
    }else{
        exit(0);
        echo "<script>window.history.back();</script>";
    }
    //@检查是否已经考过这次考试
    $exam_log_id="select examination_log_id,users_ip,papers_id,is_end from flow_examination_log where users_id='{$user_id}' and exam_id ='{$t_face_exam_id}';";
        //echo "-----exam_log_id:".$exam_log_id;
    $res_examlog_id=get_attrs_from_table($exam_log_id);
    
    if(!empty($res_examlog_id)){
        if((isset($res_examlog_id[0]['is_end'])?$res_examlog_id[0]['is_end']:null) =='1'){
            exit(0);
        }else if((isset($res_examlog_id[0]['is_end'])?$res_examlog_id[0]['is_end']:null)=='0'){
            $select_paper_id=$res_examlog_id[0]['papers_id'];
                //print_r($res_examlog_id);
            //设置考试id
            $examination_log_id=$res_examlog_id[0]['examination_log_id'];
            //更新考生的ip信息
            if($user_ip!==$res_examlog_id[0]['users_ip']){
                $sql_upda_log="update flow_examination_log set users_ip='{$user_ip}'; ";
                insert_into_table($sql_upda_log);
            }   
        }
    }else{
            //根据exam_id获取paper_id
        $sql_exam_paper_id="select paper_id from flow_exam_paper where exam_id='{$t_face_exam_id}';";
            //echo "-----sql_exam_paper_id:".$sql_exam_paper_id;
        $res_paper_id=get_attrs_from_table($sql_exam_paper_id);
           // echo "-----res_paper_id:";
        //print_r($res_paper_id);//"100000000000000000000000000000000000000000000000000000000000";
        //随机化种子值  获取随机paper_id
        if(!isset($select_paper_id)){
            srand((double)microtime()*1000000);
            $rand_number= rand(0,(count($res_paper_id)-1));
            foreach ($res_paper_id as $key => $value) {
                    if($key==$rand_number){
                        $select_paper_id=$res_paper_id[$key]['paper_id'];
                        break;
                }
            }           
        }
             //@更新考生记录表
        $sql_update_exam_log="insert into flow_examination_log (users_id,papers_id,exam_id,users_ip) values ('{$user_id}','{$select_paper_id}','{$t_face_exam_id}','{$user_ip}')";
        //echo $sql_update_exam_log;
        $res_insert_exam_log=insert_into_table($sql_update_exam_log);

        //@获取记录后的考生记录id
        $exam_log_id="select examination_log_id,users_ip,papers_id,is_end from flow_examination_log where users_id='{$user_id}' and exam_id ='{$t_face_exam_id}';";
        //echo "-----exam_log_id:".$exam_log_id;
        $res_examlog_id=get_attrs_from_table($exam_log_id);
        $examination_log_id=$res_examlog_id[0]['examination_log_id'];
    }
    // 根据paper_id  select 试卷题目
    ?>
<script src="../share/jscripts/jquery-1.7.2.min.js"></script> 
    <div class="templatePreview">
        <div class="exam_border">
            <div class="exam_bg"></div>
            <div class="exam_page">
                <div class="exam_sidebar">
                    <div class="select_ques_face">
                    <div class="top_ques_list">
                    <div class="topOne">
                    <div class="select">
                    <span class="se_label">单选题:</span>
                    <div class="list">
                        <?php
                       /*     //@考试条目存储在session回话中
                        if(isset($_SESSION["selected_ques_list"])){
                        	$res_question_paper=$_SESSION["selected_ques_list"];
                        	for($i=0;$i<count($_SESSION["selected_ques_list"]);$i++){
                        		if((isset($_SESSION["selected_ques_list"][$i]["papers_id"])?$_SESSION["selected_ques_list"][$i]["papers_id"]:null)==$select_paper_id){
                        			$res_question_paper=$_SESSION["selected_ques_list"][$i];
                        		}
                        	}
                        }*/
                        if(!isset($res_question_paper)){
                                //  获取试卷信息 ----flow_papers_questions 中的 papers_questions_id,    questions_id,    is_flow
                            $sql_question_paper="select papers_questions_id,questions_id,is_flow from flow_papers_questions where papers_id='{$select_paper_id}' order by papers_questions_id;";
                                //echo "-------------sql_paper:".$sql_question_paper;
                                //获得考卷题目内容数组
                            $res_question_paper=get_attrs_from_table($sql_question_paper);
							//print_r($res_question_paper);
                       		$_SESSION["selected_ques_list"]=$res_question_paper;
//                          array_push($_SESSION["selected_ques_list"],$res_question_paper);
                        }
//							 print_r($select_paper_id);
							
                            $paper_question_num=count($res_question_paper);             //试卷题目总数
                            
                            if($res_question_paper!==null){
                                foreach ($res_question_paper as $key => $value) {
                                    if($res_question_paper[$key]["is_flow"]=='0'){
                                        if($papers_questions_id==$res_question_paper[$key]["papers_questions_id"]){
                                            echo '<span class="on_over"><a href="select_ques_face_onCourse.php?examination_log_id='.$examination_log_id.'&papers_questions_id='.$res_question_paper[$key]['papers_questions_id'].'">'.$res_question_paper[$key]["papers_questions_id"].'</a></span>';
                                        }else{
                                            echo '<span><a href="select_ques_face_onCourse.php?examination_log_id='.$examination_log_id.'&papers_questions_id='.$res_question_paper[$key]['papers_questions_id'].'">'.$res_question_paper[$key]["papers_questions_id"].'</a></span>';
                                        }
                                    }
                                }

                    echo '</div>';
                    echo '</div>';
                    echo '<div class="clear"></div>';       
                    echo '<div class="flow">';
                        echo '<span class="flow_label">流程题:</span>';
                        echo '<div class="list">';
                            if($res_question_paper!==null){
                                foreach ($res_question_paper as $key => $value) {
                                    if($res_question_paper[$key]["is_flow"]=='1'){
                                        if($papers_questions_id==$res_question_paper[$key]["papers_questions_id"]){
                                            echo '<span class="on_over"><a href="select_ques_face_onCourse.php?examination_log_id='.$examination_log_id.'&papers_questions_id='.$res_question_paper[$key]['papers_questions_id'].'">'.$res_question_paper[$key]["papers_questions_id"].'</a></span>';
                                        }else{
                                            echo '<span><a href="select_ques_face_onCourse.php?examination_log_id='.$examination_log_id.'&papers_questions_id='.$res_question_paper[$key]['papers_questions_id'].'">'.$res_question_paper[$key]["papers_questions_id"].'</a></span>';
                                        }
                                    }
                                }
                            }
                        echo '</div>';
                    echo '</div>';
					
                    echo '</div>';            
                    }
                echo '<form action="" method="post" id="applyForm">';
				echo '<input type="button" value="判卷" name="add_tip" id="judge_pap" style="  background-color: #EA4451;width: 100px;"/>';
                echo '</form>';
				echo '<form action="upload_file.php" method="post"
				enctype="multipart/form-data" onsubmit="return checkFile()">
				<label for="file">Filename:</label>
				<input type="file" name="file" id="file" /> 
				<br />
				<input type="hidden" name="userId" value="" />
				<input type="hidden" name="examlog_id" value="" />
				<input type="hidden" name="ques_id" value="" />
				<input type="hidden" name="flow_id" value="" />
				<input type="submit" name="submit" value="Submit" />
				</form>';
                echo '<div class="clear"></div>';
                    echo '</div> ';
                echo '</div>';
				
				//var_dump($res_flow_desci);
                if($res_question_paper[($papers_questions_id-1)]['is_flow']=='1'){
                    echo '<div class="lQuestArea">
                        <p>';
                        //@查询题目内容
                        $sql_sea_flow_descri="select flow_questions_description from flow_questions where flow_questions_id='{$res_question_paper[$papers_questions_id-1]['questions_id']}'";
                        $res_flow_desci=get_attrs_from_table($sql_sea_flow_descri);
                        echo "<h3 name='{$res_question_paper[($papers_questions_id-1)]['questions_id']}'>题目</h3>";
						//print_r($res_flow_desci);
                        echo "{$res_question_paper[($papers_questions_id-1)]['papers_questions_id']}.".$res_flow_desci[0]['flow_questions_description'];
                        echo '</p>
                        <p>答题要求：请将上述业务流程在ERP系统中的操作步骤按顺序描述出来，请在右侧答题区域答题。</p>
                        </div>
                        <div class="exam_ques_operaPanl">
                            <input type="button" value ="上一题" id="last_page" onclick="call_last_page('.$papers_questions_id.')" name="lastQues"/>
                            <input type="button" value ="下一题" id="next_page"  onclick="call_next_page('.$papers_questions_id.','.$paper_question_num.')" name="nextQues"/>           
                        </div>
                    '; 
                }
                ?>
                </div>
                <!--   开始content里面的内容
                -->
                <div class="exam_content">
                    <?php 
                    foreach ($res_question_paper as $key => $value) {
                        if($res_question_paper[$key]['papers_questions_id']==$papers_questions_id){
                        if($res_question_paper[$key]['is_flow']=='0'){
                       
                        $sql_sear_ques_descri="select questions_concept_description,questions_concept_type from flow_questions_concept where questions_concept_id='{$res_question_paper[$key]["questions_id"]}'";
                        //echo $sql_sear_ques_descri;
                        //显示理论题的题目
                        $res_concept_desci=get_attrs_from_table($sql_sear_ques_descri);
                        //var_dump($res_concept_desci);
                         //显示理论题的选项  questions_id

                        $sql_sear_option="select answers_other_id,answers_other_description from flow_answers_other where answers_is_add='0' and answers_other_question_id='{$res_question_paper[$key]['questions_id']}' limit 0,4";
                        $res_sear_option=get_attrs_from_table($sql_sear_option);

                        if(!empty($res_concept_desci) && !empty($res_sear_option)){
                            echo '<div class="se_content" name="'.$res_question_paper[$key]["questions_id"].'">'; 
                            echo "<p>";
                            echo $res_question_paper[$key]["papers_questions_id"].".(".($res_concept_desci[0]['questions_concept_type']=='1'?"单选题":"多选题").')'.$res_concept_desci[0]['questions_concept_description'];
                            echo "</p>";
                            echo '<span class="se_option"><input id="a" type="checkbox" name="answ" value="'.$res_sear_option[0]['answers_other_id'].'" id="A">';
                                echo '<label for="a">A.'.$res_sear_option[0]['answers_other_description'].'</label></span>';
                            echo '<span  class="se_option"><input id="b" type="checkbox" name="answ" value="'.$res_sear_option[1]['answers_other_id'].'" id="B">';
                                echo '<label for="b">B.'.$res_sear_option[1]['answers_other_description'].'</label></span>';
                            echo '<span  class="se_option"><input id="c" type="checkbox" name="answ" value="'.$res_sear_option[2]['answers_other_id'].'" id="C">';
                                echo '<label for="c">C.'.$res_sear_option[2]['answers_other_description'].'</label></span>';
                            echo '<span  class="se_option"><input id="d" type="checkbox" name="answ" value="'.$res_sear_option[3]['answers_other_id'].'" id="D">'; 
                                echo '<label for="d">D.'.$res_sear_option[3]['answers_other_description'].'</label></span>';
                            echo '<div class="next_last">';
                                echo '<input type="button" id="last_page" value="上一题" onclick="call_last_page('.$papers_questions_id.')"/>';
                                echo '<input type="button" id="next_page" value="保存，下一题" onclick="call_next_page('.$papers_questions_id.','.$paper_question_num.')"/>';
                            echo '</div>';
                            echo '</div>';
                        }
                    }else if($res_question_paper[$key]['is_flow']=='1'){
                        echo '<div class="testFace">
                          <div class="rAnswArea">
                            <h2>流程题区</h2>';
                        echo '<span class="option_type">选项类型：</span>';
                        //设置选择选项;
                        $sql_select_option="select steps_type,steps_options,steps_options_id from flow_steps where steps_module_id ={$t_face_modu_id}";
                        $res_option=get_attrs_from_table($sql_select_option);
                        
                        $flag_type_now=-1;
                        $option_value='';
                        $option_text='';
                        echo  '<select id="select_option" style="width:150px;">';
                        //var_dump($res_option);
                        $sql_select_answ="select usersansw_steps_option3 from flow_examlog_useransw where papers_question_id='{$papers_questions_id}' and examination_log_id='{$exam_examination_log_id}';";
                        $res_flat_if=get_attrs_from_table($sql_select_answ);
                        

                        for($i=0;$i<count($res_option);$i++){
                            if(strcmp($flag_type_now,$res_option[$i]["steps_type"])!==0){ //进入不同类别
                                //echo $option_value;
                                if(!empty($option_value)){  //
                                    $flag=empty($res_flat_if)?'2':'3';
                                    if($flag==$option_num_current){
                                        echo "<option value='{$option_value}' selected='selected'>{$option_text}-</option>";
                                    }else{
                                        echo "<option value='{$option_value}'>{$option_text}-</option>";        
                                    }
                                    $option_text='';
                                }
                                $flag_type_now=$res_option[$i]["steps_type"];    //设置当下类型
                                $option_value=$res_option[$i]["steps_type"];       //设置value
                            }
                            if(strcmp($flag_type_now,$res_option[$i]["steps_type"])==0){
                                $option_text=$option_text.'-'.$res_option[$i]["steps_options"];
                            }
                            $option_num_current=$res_option[$i]["steps_options_id"];
                        }
                        $flag=empty($res_flat_if)?'2':'3';
                        if($flag==$option_num_current){
                            echo "<option value='{$option_value}' selected='selected'>{$option_text}-</option>"; 
                        }else{
                            echo "<option value='{$option_value}'>{$option_text}-</option>";         
                        }
                        echo '</select> 
                        <span class="repeat_time" style="margin-left:85px">重复的次数：</span>
                        <select id="repeat_time" style="width:150px;">
                        	
                        </select>
                        <input type="button" value="再做一遍" id="doAgain" style="width:90px;"/>
                            <hr/>';
                        echo '<div class="table-box">
                        <table class="AnswForm" id="1">
                        <tr>
                            <td rowspan="3"><span class="">&nbsp;&nbsp;</span>步骤</td>
                            <td class="step" rowspan="3">1</td>
                            <td width="216">
                                <label>单据</label>&nbsp;&nbsp;
                                <select name="1" style="width:150px;">
                                    
                                </select>
                            </td>
                            <td width="128" rowspan="3">
                                <span>
                                    <input type="button" name="copy" id="copy" value="复制" />
                                    <input type="button" name="delete" id="delete" value="删除" />
                                    <input type="button" name="up" id="up" value="上移↑"  />
                                    <input type="button" name="down" id="down" value="下移↓" />
                                </span>
                            </td>
                            <td rowspan="3"  style="width:10px">
                        		<div class="addtion_Bbox" style="width:10px;overflow:visible;">
                        			<input type="button" value="附加题" name="addition_tag" size="12" id="" style="display: none;position: relative;height: 85px;left: 11px;"/>
                        		</div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label>操作</label>&nbsp;&nbsp;
                                <select name="2" style="width:150px;">
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td>
                            <label>角色</label>&nbsp;&nbsp;
                                <select name="3" style="width:150px;">
                            </select>
                            </td>
                        </tr>
                        </table>
                        
						
                        <div class="uploadFlowAnsw">
                          <input type="button" value="提交流程" name="upFlowAnsw" id="upFlowAnsw"/>
                        </div>
                        
                        <div class="atta_addition">
                            <p/>
                            <h2>附加题</h2>
                            <hr/>
                            <div class="addBox">
                                <div class="addContent" name="">
                                    <div class="selectQueLeft" id="selectQueLeft">第一步骤</div>
                                    <div class="selectQuest" id="modle" name="">
                                        <span class="orderNum"></span>&nbsp;
                                        <span class="quesContent"></span><p/>
                                        <input type="checkbox" id="A" value=""/>&nbsp;&nbsp;<lable id="labelA" for="A"></lable><br/>
                                        <input type="checkbox" id="B" value=""/>&nbsp;&nbsp;<lable id="labelB" for="B"></lable><br/>
                                        <input type="checkbox" id="C" value=""/>&nbsp;&nbsp;<lable id="labelC" for="C"></lable><br/>
                                        <input type="checkbox" id="D" value=""/>&nbsp;&nbsp;<lable id="labelD" for="D"></lable><br/>
                                    	<span class="rightAnsw"></span><br/>
                                    </div>
                                </div>  
                            </div>    
                        </div>
                             
                        ';

                    }   
                }
            }
        ?>
			
            </div>
            </div>
           </div>

    
<!--
    判断：1是概念题
          2是流程题
        页面跳转
-->
</div>


<script type="text/javascript" src="../share/jscripts/judge_oncourse.js"></script>
<script type="text/javascript" src="../share/jscripts/jquery.form.js"></script>

<script type="text/javascript">
	var page_now="<?php echo $papers_questions_id; ?>";
    var module_id="<?php echo $t_face_modu_id; ?>";
    var user_id="<?php echo $user_id; ?>";
    var exam_id="<?php echo $t_face_exam_id; ?>";
    var papers_id="<?php echo $select_paper_id; ?>";
    var examination_log_id="<?php echo $examination_log_id; ?>";
    var max_step=[1,1];
    var examMode="<?php echo $_SESSION['examMode']; ?>";
    var judgeOn=0;
    function call_next_page(page_now,total_num){
	page_now++;
		if(page_now<=total_num){
			window.location.href="select_ques_face_onCourse.php?examination_log_id="+examination_log_id+"&papers_questions_id="+page_now;
		}
	}
	function call_last_page(page_now){
		page_now--;
		if(page_now>0){
			window.location.href="select_ques_face_onCourse.php?examination_log_id="+examination_log_id+"&papers_questions_id="+page_now;
		}
	}
</script>
<script>
    $(function(){
        if(examMode!=='2'){
            $('#submit_test').attr("display","none");
            $('#judge_page').attr("display","block");
        }
    })

    function checkFile(){
       	var userId=user_id;
    	var examlog_id=examination_log_id;
    	var ques_id=$(".lQuestArea").find("h3").attr("name");
    	var flow_id=page_now;
    	if(userId == "" || examlog_id == "" || ques_id == "" || flow_id == ""){
    		return false;
    	}
    }
    function changeBlanceStart() {
	}
</script>

<?php 
    require_once('../../public/code/tce_page_footer.php');
?>

<script type="text/javascript" src="../share/jscripts/lhgdialog/lhgdialog.min.js?skin=discuz"></script>
<!--<script type="text/javascript" src="../share/jscripts/lhgdialog/lhgcore.min.js"></script>-->
<script src="../share/jscripts/exam_event.js"></script>

<script src="../share/jscripts/exam_interface_oncourse.js" type="text/javascript"></script>
