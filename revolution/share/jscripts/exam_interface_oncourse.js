//文件打开初始配置
$(document).ready(function(){
	if($('.se_content').attr("name")!==undefined){
		load_concept_answ();
	}else{
		checkRepeatTime();
		input_option();//load_answ();
	}
});


/*
 * 遍历数据库查询当前题目的数量
 */

function checkRepeatTime(){
	$.ajax({
	url:'public_ajax_oncourse.php'//改为你的动态页
	,type:'POST'
	,data:{
		checkRepeatTime:"repeatTimes"
		,r_page_now:page_now
		,r_exam_log_id:examination_log_id
		,r_papers_id:papers_id
		,r_module_id:module_id
	}
	,async:false
	,dataType:"json"
	,success:function(data, textStatus, jqXHR){
		if(data!==null){
			for(var i=0;i<data.length;i++){
				var option=$("<option>").val(data[i][0]);
				option.html(data[i][0]);
				if(i==0){
					option.attr("selected",true);
				}
				$("#repeat_time").append(option);
			}
		}else{
			var option = $("<option>").attr("selected",true);
			option.val("1");
			option.html("1");
			$("#repeat_time").append(option);
		}
   	}
	,error:function(xhr){
	}
	});
}
/*
 * 再做一次  按钮判断
 */
$("#doAgain").bind("click",function(){
	var num=$("#repeat_time").find("option").length;
	var repeat_id=num;
	$.ajax({
	url:'public_ajax_oncourse.php'//改为你的动态页
	,type:'POST'
	,data:{
		jsflow_page_now_on:page_now
		,jsflow_exam_log_id_on:examination_log_id
		,jsflow_papers_id_on:papers_id
		,jsflow_module_id_on:module_id
		,repeat_id_on:repeat_id
	}
	,async:true
	,dataType:"json"
	,success:function(data, textStatus, jqXHR){
		if(data["info"]=='isnull'){
			alert("请填写当前答案！");
		}
		if(data["info"]=='nonull'){
			repeat_id=parseInt(repeat_id)+1+'';
			var option=$("<option>").attr("value",repeat_id);
			option.attr("selected",true);
			option.html(repeat_id);
			$("#repeat_time option").attr("selected",false);
			$("#repeat_time").append(option);
			
			//格式化所有的表单
			initTable($(".AnswForm:first"));
			$(".AnswForm:not(:first)").remove();
			$(".AnswForm:first").find("select[name=2] option:first,select[name=1] option:first,select[name=3] option:first").attr("selected",true);
		}
   	}
	,error:function(xhr){
	}
	});
})
  /*
   * @param:null
   *desci：提交流程按钮
   *function：提交流程题的步骤
   */
$('#upFlowAnsw').live("click",function(){
	var repeat_id=$("#repeat_time").find("option:selected").val();
	$.dialog.tips('提交试题中...',600,'../../../../images/loading.gif');
	//获取考试记录id  ,试题 题目id 
	var papers_questions_id=page_now;
	var exam_log_id=examination_log_id;
	var flow_paper_id=papers_id;
	var flow_module_id=module_id;
	//alert(module_id);
	//alert(papers_id);
	//alert(examination_log_id);
	//alert(page_now);
	//获取考生答案
	var option_text=$("#select_option").find("option:selected").text();
    var option_num_a=option_text.split('-');
	var num_option=0;
    for(var i=0;i<option_num_a.length;i++){
    	if(option_num_a[i]!==''){
    		num_option++;
    	}
    }
	var num_answ=$('.AnswForm').length;
	var arr=[];
	for(var i=0;i<num_answ;i++){
      arr[i] = [];
    }
    if(num_option=='2'){
    	for (i = 0; i <num_answ; i++){
			var select1_list=$('#'+(i+1)+'').find("select[name='1']  option:selected").val();    //单据
			var select1_oper=$('#'+(i+1)+'').find("select[name='2']  option:selected").val();	//操作
			 
			arr[i][0]=select1_list;
			arr[i][1]=select1_oper;
		}
	}
	else if(num_option=='3'){
		for (i = 0; i <num_answ; i++){
			var select1_list=$('#'+(i+1)+'').find("select[name='1']  option:selected").val();    //单据
			var select1_oper=$('#'+(i+1)+'').find("select[name='2']  option:selected").val();	//操作
			var select1_role=$('#'+(i+1)+'').find("select[name='3']  option:selected").val();	//角色
			arr[i][0]=select1_list;
			arr[i][1]=select1_oper;
			arr[i][2]=select1_role;
		}
	}
	$.ajax({
	url:'public_ajax_oncourse.php'//改为你的动态页
	,type:'POST'
	,data:{
		 jsflow_answ_data:JSON.stringify(arr)
		,jsflow_page_now:page_now
		,jsflow_exam_log_id:examination_log_id
		,jsflow_papers_id:flow_paper_id
		,jsflow_module_id:flow_module_id
		,jsflow_num_option:num_option
		,jsflow_repeat_id:repeat_id
	}
	,async:true
	,dataType:"json"
	,success:function(data, textStatus, jqXHR){
		//显示附加题
		showAddition(data);
		$.dialog.tips('附加题加载完毕',1,'../../../../images/tips.gif',function(){
		});
		
		//页面跳转 下一题
		//location.href='select_ques_face.php?examination_log_id='+examination_log_id+'&papers_questions_id='+page_now;
   	}
	,error:function(xhr){
		alert('添加失败');
	}
	});
})

/*
   * 下载session的判卷结果
   */
function load_judge_session(){
	var repeat_id=$("#repeat_time").find("option:selected").val();
	$.ajax({
		url: 'judge_session.php', //改为你的动态页
		type: 'POST',
		data: {
			judge_page_now: page_now,
			judge_repeat_id: repeat_id
		},
		async: false,
		dataType: "json",
		success: function(data, textStatus, jqXHR) {
			if(data!==null){
				set_correct_flow(data);
			}
		},
		error: function(xhr) {
//			console.log(xhr.responseText);
			alert('添加失败' + xhr.responseText);
		}
	})
}
  /*
   * 判卷,显示正确答案
   */
$("#judge_pap").live('click',function(){
	$.dialog.tips('数据加载中...',600,'../../../../images/loading.gif');
	$("<span class='tips'>").insertAfter($("#select_option"));
	var repeat_id=$("#repeat_time").find("option:selected").val();
	$.ajax({
		type:"post",
		url:"public_judge_oncourse.php",
		async:false,
		dataType:"json",
		data:{
			judge_userId:user_id,//examination_log_id,
			judge_examination_log_id:examination_log_id,
			judge_papers_id:papers_id,
			judge_pageNow:page_now,
			judge_exam_id:exam_id,
			judge_question_id:$(".lQuestArea h3").attr("name"),
			judge_repeat_id:repeat_id
		}
		,success:function(data, textStatus, jqXHR){
				//1 帅选出缺漏的步骤
				//2 根据缺漏的步骤插入上一步的步骤后面（步骤为1的插入第一个位置）
				//3 data[0] :正确步骤
				//4 data[1] :题目标准答案 step ，one， two，thre
			if (data !== null && data!==undefined) {
				
				set_correct_flow(data);
				$.dialog.tips('数据加载完毕',1,'../../../../images/tips.gif',function(){});
			}else{
				$.dialog.tips('数据加载完毕',0,'../../../../images/tips.gif',function(){});				
			}
		}
		,error: function(xhr) {
			alert('添加失败' + xhr.responseText);
		}
	});
});
/*
   *设置正确步骤的答案
   */
function set_correct_flow(data){
	var t = data[1].length;
	//初始化所有步骤的值
	var array_list = [];
	for (var i = 0; i < t; i++) {
		array_list.push((i + 1));
	}
	//设置正确和错误的步骤颜色
	var repeat_flag=[];
	var nextFlw=-1; //下一个步骤的查询起点
	var arr_corr = data[0][1]; //正确的步骤号
	for(var i=0;i<arr_corr.length;i++){
		var step=arr_corr[i];
		var one = data[1][(parseInt(step)-1)][1];
		var two =data[1][(parseInt(step)-1)][2];
		var three =data[1][(parseInt(step)-1)][3];
		
		$(".AnswForm").each(function(index) {
			if(index <= nextFlw){
				return true;
			}
			var uOne=$(this).find("select[name=1] option:selected").val();
			var uTwo=$(this).find("select[name=2] option:selected").val();
			var uThree=$(this).find("select[name=3] option:selected").val();
			if (uOne == one && two==uTwo && uThree==three) {
				//正确的步骤
				if(repeat_flag[(parseInt(step)-1)]){
					//正确步骤----重复的步骤 --错误
					$(this).css("background-color", "rgb(234, 234, 234)");
					$(this).css("color", "rgb(161, 161, 161)");
					$(this).find("select").css("color", "rgb(161, 161, 161)");
					$(this).find("tr:first td:first span").attr("class","checkError");
				}else{
					//正确步骤----不重复的步骤 --正确
					if($(this).find(".step").html()!==step){
						$(this).find(".step").html(step);
						$(this).find(".step").css("color","red");
					}	
					$(this).find("tr:first td:first span").attr("class","checkRight");
					$(this).css("background-color", "#D0E8F9");
					$(this).css("color", "black");
					$(this).find("select").css("color", "black");
					repeat_flag[parseInt(step)-1]=1;
					nextFlw=index;
				}
				
			}else{
				//错误的步骤
				$(this).css("background-color", "rgb(234, 234, 234)");
				$(this).css("color", "rgb(161, 161, 161)");
				$(this).find("select").css("color", "rgb(161, 161, 161)");
				$(this).find("tr:first td:first span").attr("class","checkError");
			}
	})
	}
	if(arr_corr==''){
		$(".AnswForm").each(function(index){
			$(this).css("background-color", "rgb(234, 234, 234)");
			$(this).css("color", "rgb(161, 161, 161)");
			$(this).find("select").css("color", "rgb(161, 161, 161)");
			$(this).find("tr:first td:first span").attr("class","checkError");
		});
	}
	var arr_all = data[1]; //完整的正确步骤数据
	var arr_lack = arr_dive(array_list, arr_corr); //缺漏的步骤号
	var step_before;
	var addition_flag;
	for (var i = 0; i < arr_lack.length; i++) {
		//设置节点信息
		var nodeTable = $("#1").clone();
		step_before = arr_lack[i] - 1; //完整答案的下标
		nodeTable.find(".step").html(arr_all[step_before][0]);
		nodeTable.find("select[name=1]").find("option[value=" + arr_all[step_before][1] + "]").attr("selected", "selected");
		nodeTable.find("select[name=2]").find("option[value=" + arr_all[step_before][2] + "]").attr("selected", "selected");
		nodeTable.find("select[name=3]").find("option[value=" + arr_all[step_before][3] + "]").attr("selected", "selected");
		nodeTable.css("color", "red");
		nodeTable.find("select").css("color", "red");
		$(this).find("tr:first td:first span").attr("class","check");
		if(arr_lack[i] =='1') {//缺少第一步
			nodeTable.insertAfter($(".AnswForm:last"));
		}else {
			//不是缺少第一步
			$(".AnswForm").each(function(index) {
				if ($(this).find("select[name=1] option:selected").val() == arr_all[step_before - 1][1] && $(this).find("select[name=2] option:selected").val() == arr_all[step_before - 1][2] && $(this).find("select[name=3] option:selected").val() == arr_all[step_before - 1][3]) {
					nodeTable.insertAfter($(this));
				}
			});
		}
		$("#up,#down,#delete,#copy,#upFlowAnsw").attr("disabled", true);
		/*
		 * 显示附加题, 每一个步骤的附加题显示
		 */
		var str;
		var atta_box=$(".atta_addition").find(".addBox:first").clone();
		var quesListNum=0;
		for(var j=0;j<data[2].length;j++){
			str=arr_lack[i]+"";
			if(data[2][j][2]==str && j%4==0){
				quesListNum++;
				addition_flag=1;
				nodeTable.find('.addtion_Bbox input').css("display","block");
				nodeTable.find('.addtion_Bbox input').attr("id","AC"+arr_lack[i]);
			$("#save_answer").css("display","none");
			$(".atta_addition").find(".addBox:not(:first)").remove();
			$(".atta_addition").find(".addContent #modle:not(:first)").remove();
				//			data[2][i].qID;     0
				//			data[2][i].qDesc;   1
				//			data[2][i]qStep;    2
			    //			data[2][i].qType    3
				//			data[2][i]aId;      4
				//			data[2][i]aDesc;    5
				//			data[2][i]aRight;   6
		 		atta_box.find(".addContent").attr("name",data[2][j][2]);
				atta_box.find("#selectQueLeft").html("第"+data[2][j][2]+"个步骤");
				var type=data[2][j][3]==1?'1':'0';
				if(type==1){
					var text_type="(单选题)";
				}else{
					var text_type="(多选题)";
				}
				if(quesListNum==1){
					//var atta_content_modle=atta_box.find(".addContent:first .selectQuest:first").clone();
					atta_box.find("#modle:first").attr("name",data[2][j][0]);//附加题id
					atta_box.find(".orderNum").html(quesListNum+"."+text_type);//附加题序列题号
					atta_box.find(".quesContent").text(data[2][j][1]);//附加题id
					if(data[2][j][6]=='1'){
						atta_box.find("#A").attr("checked",true);
					}
					if(data[2][j+1][6]=='1'){
						atta_box.find("#B").attr("checked",true);
					}
					if(data[2][j+2][6]=='1'){
						atta_box.find("#C").attr("checked",true);
					}
					if(data[2][j+3][6]=='1'){
						atta_box.find("#D").attr("checked",true);
					}
					atta_box.find("#A").val(data[2][j][4]);
					atta_box.find("#A").attr("disabled",true);
					atta_box.find("#labelA").html("A."+data[2][j][5]);
					
					atta_box.find("#B").val(data[2][j+1][4]);
					atta_box.find("#B").attr("disabled",true);
					atta_box.find("#labelB").html("B."+data[2][j+1][5]);
					
					atta_box.find("#C").val(data[2][j+2][4]);
					atta_box.find("#C").attr("disabled",true);
					atta_box.find("#labelC").html("C."+data[2][j+2][5]);
					
					atta_box.find("#D").val(data[2][j+3][4]);
					atta_box.find("#D").attr("disabled",true);
					atta_box.find("#labelD").html("D."+data[2][j+3][5]);
				}else{
					var atta_content_modle=atta_box.find(".addContent:first .selectQuest:first").clone();
					atta_content_modle.attr("name",data[2][j][0]);//附加题id
					atta_content_modle.find(".orderNum").html(quesListNum+"."+text_type);//附加题序列题号
					atta_content_modle.find(".quesContent").text(data[2][j][1]);//附加题id
					
					atta_content_modle.find("#A").val(data[2][j][4]);
					atta_content_modle.find("#labelA").html("A."+data[2][j][5]);
					
					atta_content_modle.find("#B").val(data[2][j+1][4]);
					atta_content_modle.find("#labelB").html("B."+data[2][j+1][5]);
					
					atta_content_modle.find("#C").val(data[2][j+2][4]);
					atta_content_modle.find("#labelC").html("C."+data[2][j+2][5]);
					
					atta_content_modle.find("#D").val(data[2][j+3][4]);
					atta_content_modle.find("#labelD").html("D."+data[2][j+3][5]); 
					atta_content_modle.insertAfter(atta_box.find(".addContent #modle:last")); 
				}
			}
		}
				//点击打开附加题
				$('#AC'+arr_lack[i]+'').dialog({
			 		id:'additionCorr'+arr_lack[i],
			 		iconTitle:false,
			 		content:atta_box[0].innerHTML,
			 		title:'附加题答题界面',
			 		cover:true,
			 		bgcolor:'#ccc',
			 		opacity:0.5,
			 		width:720,
			 		autoSize:true,
			 		loadingText:"正在加载数据中",
			 		top:30,
					init:function(){
					//	load_session_addition_user_answ(this.dg);
						if(judgeOn==1){
							var userAnsw=judge_user_addition();
							this["DOM"].content.find(".selectQuest").each(function(){
								$(this).find("#A,#B,#C,#D").attr("disabled",true)
							});
							this["DOM"].content.find(".ui_state_highlight").attr("disabled",true);
							this["DOM"].find(".selectQuest").each(function(){
								var quesNum=$(this).attr("name");
								var answRest="";
								var answRight=[];
								for(var i=0;i<userAnsw.length;i++){
									if(userAnsw[i][0]==quesNum){
										answRight.push(userAnsw[i][6]);
									}
								}
								if(answRight[0]=='1'){
									answRest+='A ';
								}								
								if(answRight[1]=='1'){
									answRest+='B ';
								}
								if(answRight[2]=='1'){
									answRest+='C ';
								}
								if(answRight[3]=='1'){
									answRest+='D ';
								}
								$(this).find("span.rightAnsw").html("正确答案: "+answRest);
							});
						}
					},
					onCancel:function(){
					}
			 	});	
			 	
		if(addition_flag==undefined){
			nodeTable.find('.addtion_Bbox input').css("display","none");
		}
		addition_flag=null;
		judgeOn=1;
	}
}
/*
   * 第一个数组减去第二个数组
   */
function arr_dive(aArr, bArr){
	if (bArr.length == 0) {
		return aArr
	}
	var diff = [];
	var str = bArr.join("&quot;&quot;");
	for (var e in aArr) {
		if (str.indexOf(aArr[e]) == -1) {
			diff.push(aArr[e]);
		}
	}
	return diff;
}

/*
   * 判断考生附加题答案
   */
function judge_user_addition(){
	var resUserAnsw=[];
	$.ajax({
		url:"public_ajax_oncourse.php",
		data:{
			customeOper:"userAnswer",
			pageNow:page_now},
		dataType:"json",
		async:false,
		success:function(data, textStatus, jqXHR){
			if(data!=null){
				resUserAnsw=data;
				console.log(resUserAnsw);
			}else{
				alert("请先进行判卷！");
			}
		},
		error:function(xhr){
			alert('添加失败' + xhr.responseText);
		}
	})
	if(resUserAnsw!=null){
		return resUserAnsw;
	}
}


/*
 *desci：下一页按钮
 *function：显示下移个题目
 */
$('#next_page').live("click",function(){
	//考生答题结果存储
	var con_selected_answ=[];
	var answ_text=$('input[name="answ"]:checked').each(function(){
		 con_selected_answ.push($(this).val());
	});
	//参数设置
	var con_papers_id=papers_id;
	var con_exam_log_id=examination_log_id;
	var con_ques_now=page_now;
	//alert(con_papers_id);
	$.ajax({
		url:'public_ajax.php'//改为你的动态页
		,type:'POST'
		,data:{
			 jscon_selected_answ:JSON.stringify(con_selected_answ)
			,jscon_papers_id:con_papers_id
			,jscon_ques_now:con_ques_now
			,jscon_exam_log_id:con_exam_log_id
			}
		,async:true
		,dataType:"json"
		,success:function(data, textStatus, jqXHR){
			//alert('添加成功!');			
		}
		,error:function(xhr){
			//alert('添加失败'+xhr.responseText);
		}
	}); 
})

//
///*
// *desci：提交流程按钮
// *function：提交流程题的步骤
// */
//$('#upFlowAnsw').live("click",function(){
//	if(examMode =='2'){
//		$.dialog.tips('提交试题中...',600,'../../../../images/loading.gif');
//		//获取考试记录id  ,试题 题目id 
//		var papers_questions_id=page_now;
//		var exam_log_id=examination_log_id;
//		var flow_paper_id=papers_id;
//		var flow_module_id=module_id;
//
//		var option_text=$("#select_option").find("option:selected").text();
//	    var option_num_a=option_text.split('-');
//		var num_option=0;
//	    for(var i=0;i<option_num_a.length;i++){
//	    	if(option_num_a[i]!==''){
//	    		num_option++;
//	    	}
//	    }
//		var num_answ=$('.AnswForm').length;
//		var arr=[];
//		for(var i=0;i<num_answ;i++){
//	      arr[i] = [];
//	    }
//	    if(num_option=='2'){
//	    	for (i = 0; i <num_answ; i++){
//				var select1_list=$('#'+(i+1)+'').find("select[name='1']  option:selected").val();    //单据
//				var select1_oper=$('#'+(i+1)+'').find("select[name='2']  option:selected").val();	//操作
//				 
//				arr[i][0]=select1_list;
//				arr[i][1]=select1_oper;
//			}
//		}
//		else if(num_option=='3'){
//			for (i = 0; i <num_answ; i++){
//				var select1_list=$('#'+(i+1)+'').find("select[name='1']  option:selected").val();    //单据
//				var select1_oper=$('#'+(i+1)+'').find("select[name='2']  option:selected").val();	//操作
//				var select1_role=$('#'+(i+1)+'').find("select[name='3']  option:selected").val();	//角色
//				arr[i][0]=select1_list;
//				arr[i][1]=select1_oper;
//				arr[i][2]=select1_role;
//			}
//		}
//		$.ajax({
//		url:'public_ajax.php'//改为你的动态页
//		,type:'POST'
//		,data:{
//			 jsflow_answ_data:JSON.stringify(arr)
//			,jsflow_page_now:page_now
//			,jsflow_exam_log_id:examination_log_id
//			,jsflow_papers_id:flow_paper_id
//			,jsflow_module_id:flow_module_id
//			,jsflow_num_option:num_option //选项数量
//		}
//		,async:false
//		,dataType:"json"
//		,success:function(data, textStatus, jqXHR){
//			//显示附加题
//			console.log(data);
//			//return false;
//			showAddition(data);
//			$.dialog.tips('附加题加载完毕',1,'../../../../images/tips.gif',function(){
//			});
//			
//			//页面跳转 下一题
//			//location.href='select_ques_face.php?examination_log_id='+examination_log_id+'&papers_questions_id='+page_now;
//	 	}
//		,error:function(xhr){
//			alert('添加失败');
//		}
//		});
//	}
//
//})
//显示可用的附加题
function showAddition(data){
	//alert('success');
	/*
	 * json传值的个数
	 */
	var jslength=0;
	for(var js2 in data){
		jslength++;
	}
	//alert(data.flow_ques_id);
	if(jslength>2){
		$("#save_answer").css("display","none");
		$(".atta_addition").find(".addBox:not(:first)").remove();
		$(".atta_addition").find(".addContent #modle:not(:first)").remove();
		for(var i=0;i<(jslength-2);i++){  //控制第几个步骤
			data[i].addition_step;//控制步骤的正确的步骤号
			data[i].current_step;//控制考生步骤号
			$('#'+data[i].current_step+'').find("input[name='addition_tag']").attr("id","A"+data[i].current_step+"");
			$('#A'+data[i].current_step+'').css("display","block");
			var jsleng_j=0;
			for(var js2 in data[i]){
				jsleng_j++;
			}
	 		var atta_box=$(".atta_addition").find(".addBox:first").clone();
	 		atta_box.find(".addContent").attr("name",data[i].current_step);
			atta_box.find("#selectQueLeft").html("第"+data[i].current_step+"个步骤");
		for(var j=0;j<(jsleng_j-2);j++){ //控制步骤下的第几道题
			//判断是否是截图题
			if(data[i][j].questions_add_type!='-1'){ //不是截图题目
				var type=data[i][j].questions_add_type==1?'1':'0';
				if(type==1){
					var text_type="(单选题)";
				}else{
					var text_type="(多选题)";
				}
				if(j==0){
					var atta_content_modle=atta_box.find(".addContent:first .selectQuest:first").clone();
					atta_box.find("#modle:first").attr("name",data[i][j].questions_add_id);//附加题id
					atta_box.find(".orderNum").html((j+1)+"."+text_type);//附加题序列题号
					atta_box.find(".quesContent").text(data[i][j].questions_add_description);//附加题id
					
					atta_box.find("#A").val(data[i][j].option1.answers_other_id);
					atta_box.find("#labelA").html("A."+data[i][j].option1.answers_other_description);
					
					atta_box.find("#B").val(data[i][j].option2.answers_other_id);
					atta_box.find("#labelB").html("B."+data[i][j].option2.answers_other_description);
					
					atta_box.find("#C").val(data[i][j].option3.answers_other_id);
					atta_box.find("#labelC").html("C."+data[i][j].option3.answers_other_description);
					
					atta_box.find("#D").val(data[i][j].option4.answers_other_id);
					atta_box.find("#labelD").html("D."+data[i][j].option4.answers_other_description);
				}else{
					var atta_content_modle=atta_box.find(".addContent:first .selectQuest:first").clone();
					
					atta_content_modle.attr("name",data[i][j].questions_add_id);//附加题id
					atta_content_modle.find(".orderNum").html((j+1)+"."+text_type);//附加题序列题号
					atta_content_modle.find(".quesContent").text(data[i][j].questions_add_description);//附加题id
					
					atta_content_modle.find("#A").val(data[i][j].option1.answers_other_id);
					atta_content_modle.find("#labelA").html("A."+data[i][j].option1.answers_other_description);
					
					atta_content_modle.find("#B").val(data[i][j].option2.answers_other_id);
					atta_content_modle.find("#labelB").html("B."+data[i][j].option2.answers_other_description);
					
					atta_content_modle.find("#C").val(data[i][j].option3.answers_other_id);
					atta_content_modle.find("#labelC").html("C."+data[i][j].option3.answers_other_description);
					
					atta_content_modle.find("#D").val(data[i][j].option4.answers_other_id);
					atta_content_modle.find("#labelD").html("D."+data[i][j].option4.answers_other_description); 
				
					atta_content_modle.insertAfter(atta_box.find(".addContent #modle:last"));
				}
			}else{
				//不是截图题目
				$()					
			}
		}
		//点击打开附加题
		$('#A'+data[i].current_step+'').dialog({
	 		id:'addition'+data[i].current_step,
	 		iconTitle:false,
	 		content:atta_box[0].innerHTML,
	 		title:'附加题答题界面',
	 		cover:true,
	 		bgcolor:'#ccc',
	 		opacity:0.5,
	 		width:720,
	 		autoSize:true,
	 		loadingText:"正在加载数据中",
	 		lock:true,
	 		top:30,
			init:function(){
				load_session_addition_user_answ(this["DOM"].content.get(0));
				if (judgeOn == 1) {
					this["DOM"].content.find(".selectQuest").each(function(){
						$(this).find("#A,#B,#C,#D").attr("disabled",true)
					});
					this["DOM"].content.find(".ui_state_highlight").attr("disabled",true);
					//$(this.dg).find("#lhgdg_addition1_dgcancelBtn").css("display","none");
					var userAnsw = judge_user_addition();
					this["DOM"].content.find(".selectQuest").each(function() {
						var quesNum = $(this).attr("name");
						var answRest = "";
						var answRight = [];
						for (var i = 0; i < userAnsw.length; i++) {
							if (userAnsw[i][0] == quesNum) {
								answRight.push(userAnsw[i][6]);
							}
						}
						if (answRight[0] == '1') {
							answRest += 'A ';
						}
						if (answRight[1] == '1') {
							answRest += 'B ';
						}
						if (answRight[2] == '1') {
							answRest += 'C ';
						}
						if (answRight[3] == '1') {
							answRest += 'D ';
						}
						$(this).find("span.rightAnsw").html("正确答案: " + answRest);
					});
				}
			},
			button:[
			{
			    name: '保存',
			    focus: true,
			    callback: function(){
			    	update_addition(this["DOM"].content.get(0));
			    }
			},
			{
			    name: '取消'
			}
			]
	 	});	
	}
}
}
/*
 *
 *description:页面打开，下载流程题
 *function：答题页面载入已答选项
 */
//1.格式化表单
//2.载入选定的选项
//3.载入答案
function input_option(){
	var option_style=$('#select_option').find("option:selected").val();
	//alert(option_style);
	$.ajax({
	url:'public_ajax.php'//改为你的动态页
	,type:'POST'
	,data:{
		input_modu_id:module_id
		,input_option_style:option_style
	}
	,async:false
	,dataType:"json"
	,success:function(data, textStatus, jqXHR){
		//格式化表单突tr个数
		if(data!==null){
			var option_want=data.length;
			var option_now=$('#1 tr').length;
			 
			if(option_want<option_now){
				$(".AnswForm:not('#1')").remove();
				while(option_now!==option_want){
					$('#1').find("tr:last-child").remove();
				 	option_now--;
				}
			}

			if(option_want>option_now){
				$(".AnswForm:not('#1')").remove();
				while(option_now!==option_want){
					option_now++;
				}
				//设置选项名称和select的name属性
				var option=$('#1').find("tr:last-child").clone();
				var name_last=$('#1').find("tr:last-child select").attr('name');
				 
				var name_now=parseInt(name_last)+1;

				option.find("td select").attr('name',name_now);
				option.find("td select option").remove();
				$("#1").append(option);
			}
			//设置选项名称
			$('#1').find("tr").each(function (index){
				$(this).find('label').html(data[index].steps_options);
				//alert("aaaa");
			});
			$('#1').find("tr").each(function (i){
				//alert($(this).find('label').html());
				var steps_options=$(this).find("label").html();
				fill_option($(this),steps_options);
			});
			load_answ();
		}
	}
	,error: function(xhr){
		alert('添加失败'+xhr.responseText);
	}
	});
}

//为每个选项添加下拉款
function fill_option(obj_site,steps_options){
	$.ajax({
	url:'public_ajax.php'//改为你的动态页
	,type:'POST'
	,data:{
		fill_modu_id:module_id
		,fill_steps_options:steps_options 
	}
	,async:false
	,dataType:"json"
	,success:function(data, textStatus, jqXHR){
		//格式化表单tr个数
		//alert(data[0].steps_options_content_id);
		// alert(data[0].steps_options_content);
		if(data.length!==0){
			obj_site.find("td select").append($("<option selected='selected' value=''>").text("请选择"));
			 
			for(var i=0;i<data.length;i++){
				var option=$("<option>").val(data[i].steps_options_content_id).html(data[i].steps_options_content);
				obj_site.find("td select").append(option);
			}
			//alert($('#1').find("select[name='2'] option:selected").text());

		}
	}
	,error: function(xhr){
		alert('添加失败'+xhr.responseText);
	}
	});
}

$('#select_option').live('change',function(){
	
	input_option();
	// load_answ();
})
function initTable(obj){
	obj.find("#copy,#delete").attr("disabled",false);
	obj.attr("background-color","#D0E8F9");
	obj.find("span").removeClass("checkError");
	obj.find("span").removeClass("checkRight");
	obj.find("label,td,span,select").css("color","black");
	$("#upFlowAnsw").attr("disabled",false);
}
$('#repeat_time').live('change',function(){
	$(".AnswForm:not(:first)").remove();
	//$(".AnswForm:first").find()
	initTable($(".AnswForm:first"));
	
	input_option();
})
//下载概念题 考生答案
function load_concept_answ(){
	var concept_id=$('.se_content').attr("name");

    $.ajax({
	url:'public_ajax.php'
	,type:'POST'
	,data:{
		load_conce_paper_id:page_now
	   ,load_conce_user_id:examination_log_id
	}
	,async:true
	,dataType:"json"
	,success:function(data, textStatus, jqXHR){
		if(data!==null){
			for(var i=0;i<data.length;i++){
				$('.se_content').find("input[value='"+data[i].useransw_id+"']").attr("checked",true);
			}
		}
	 }
	,error: function(xhr){
		alert('添加失败'+xhr.responseText);
	}
	});
}
//下载table中的选项答案
function load_answ(){
	/*
	var page_now=page_now;
    	var module_id=module_id;
    	var user_id=user_id;
    var exam_id=exam_id;
    var papers_id=papers_id;
    var examination_log_id=examination_log_id;
    */
    var repead_id=$("#repeat_time").find("option:selected").val();
    var option_num=$("#select_option").find("option:selected").val();
    //确定第一个table的select框多少
    var option_text=$("#select_option").find("option:selected").text();
    var option_num_a=option_text.split('-');
    var num_option=0;
    for(var i=0;i<option_num_a.length;i++){
    	if(option_num_a[i]!==''){
    		num_option++;
    	}
    }    

    $.ajax({
	url:'public_ajax_oncourse.php'
	,type:'POST'
	,data:{
		 jsload_exam_id:exam_id
		,jsload_page_now:page_now
		,jsload_exam_log_id:examination_log_id
		,jsload_papers_id:papers_id
		,jsload_module_id:module_id
		,jsload_option_num:option_num
		,jsload_repeat_id:repead_id
	}
	,async:true
	,dataType:"json"
	,success:function(data, textStatus, jqXHR){
		//确定table的多少，在分配答定案
			if(data[0].message=='1'){
				//设置table 中的select选项内容
					//格式化table
//					console.log(data);
					var dataObjCloned=JSON.parse(JSON.stringify( data ));
					//alert(dataObjCloned[1][0].usersansw_steps_option2);
					inputTable(dataObjCloned);
					}else{
						for(var i=0;i<data[1].length;i++){
							$("input[name='answ'][value='"+data[1][i].useransw_id+"']").attr('checked','true');
						}
					}
	 }
	,error: function(xhr){
		alert('添加失败'+xhr.responseText);
	}
	});
}
//配置table的表格的数据
function inputTable(dataObjCloned){
	var num_table=$('.AnswForm').length;
	var num_array=dataObjCloned[1].length;
	//如果现有table多余，删除一部分
	if(num_table>num_array){
		var differ=num_table-num_array;
		for(var i=0;i<differ;i++){
			$('#1').find("input#delete").click();
		}
	}
	//如果现有table缺少，添加一部分
	if(num_table<num_array){
		var differ=num_array-num_table;
		for(var i=0;i<differ;i++){
			$('#1').find("input#copy").click();
		}
	}

	//aind("tr:last-child td select option").length);
	//到这里 项的

	if(dataObjCloned[1][0].usersansw_steps_option3!==undefined){
		for(var i=0;i<dataObjCloned[1].length;i++){
			$('#'+(i+1)+'').find("select[name='1'] option:selected").attr("selected"," ");
			$('#'+(i+1)+'').find("select[name='1'] option[value='"+dataObjCloned[1][i].usersansw_steps_option1+"']").attr("selected","selected");
		
			$('#'+(i+1)+'').find("select[name='2'] option:selected").attr("selected"," ");
			$('#'+(i+1)+'').find("select[name='2'] option[value='"+dataObjCloned[1][i].usersansw_steps_option2+"']").attr("selected","selected");

			$('#'+(i+1)+'').find("select[name='3'] option:selected").attr("selected"," ");
			$('#'+(i+1)+'').find("select[name='3'] option[value='"+dataObjCloned[1][i].usersansw_steps_option3+"']").attr("selected","selected");				
			
			if($('#'+(i+1)+'').find("select[name='1'] option:selected").val()!=='' && $('#'+(i+1)+'').find("select[name='3'] option:selected").val()!=='' 
				&& $('#'+(i+1)+'').find("select[name='3'] option:selected").val()!==''){
				//alert("aaaaaaaaaaaaaaaaaaaaaaaa");
				//load_attach_addition($('#'+(i+1)+'').find("select[name='1']"));
				//$('#'+(i+1)+' select[name="1"],#'+(i+1)+' select[name="2"],#'+(i+1)+' select[name="3"]').change();
			}
		}
	}

	if(dataObjCloned[1][0].usersansw_steps_option3==undefined){
	//到这里 是2个选项的
		for(var i=0;i<dataObjCloned[1].length;i++){
			$('#'+(i+1)+'').find("select[name='1'] option:selected").attr("selected"," ");
			$('#'+(i+1)+'').find("select[name='1'] option[value='"+dataObjCloned[1][i].usersansw_steps_option1+"']").attr("selected","selected");
			
			//alert(dataObjCloned[1][i].usersansw_steps_option1);
			
			$('#'+(i+1)+'').find("select[name='2'] option:selected").attr("selected"," ");
			$('#'+(i+1)+'').find("select[name='2'] option[value='"+dataObjCloned[1][i].usersansw_steps_option2+"']").attr("selected","selected");
			if($('#'+(i+1)+'').find("select[name='1'] option:selected").val()!=='' && $('#'+(i+1)+'').find("select[name='2'] option:selected").val()!==''){
				$('#'+(i+1)+' select[name="1"],#'+(i+1)+' select[name="2"],#'+(i+1)+' select[name="3"]').change();
			}
		}
	}
	load_session_addition();
	
	if(examMode!==0){
		load_judge_session();
	}
}
/*
 *description:
 *function：保存  上传答案
 */
$('#submit_test').live('click',function(){
	if(confirm("确认交卷？")){
		uploadPaper();
	}
})
function uploadPaper(){
	$.ajax({
			url:'public_ajax.php'//改为你的动态页
			,type:'POST'
			,data:{
				  jsupto_examination_log_id:examination_log_id
				 ,jsupto_exam_id:exam_id
				 ,jsupto_user_id:user_id
			}
			,async:false
			,dataType:"json"
			,success:function(data, textStatus, jqXHR){
				if(data.message=='1'){
					alert("交卷成功！");
				}
				window.location.href="examinator_face.php";
			}
			,error:function(xhr){
				alert('交卷失败！'+xhr.responseText);
			}
	})
}
/*
 *description:
 *function：保存  上传附加题答案
 */
$('#save_answer').live('click',function(){
	//$(this).parents(".addContent").find("#modle").each(function(){
		var answ_upload=[];
		var num=$(".selectQuest").length;
		 //alert(num);
		for(var i=0;i<num;i++){
			answ_upload[i]=[];
		}
		//控制题目的条数
		$(".selectQuest").each(function(index){        
			if($(this).attr('name')!==""){				
				var question_id=$(this).attr('name');
				answ_upload[index].push(question_id);
				//存储多选项
				var ques_answ_arr=$(this).find("input:checked").each(function(ind){
					answ_upload[index].push(($(this).val()));
					//alert(arr_upload[(index-1)]);
				});
			}
		});
		$.ajax({
			url:'public_ajax.php'//改为你的动态页
			,type:'POST'
			,data:{
				jsup_answ_upload:JSON.stringify(answ_upload)
				,jsup_page_now:page_now
				,jsup_examination_log_id:examination_log_id
			}
			,async:true
			,dataType:"json"
			,success:function(data, textStatus, jqXHR){
				 alert("保存成功！");				 
			}
			,error:function(xhr){
				alert('添加失败'+xhr.responseText);
			}
		})
});
function update_addition(obj){
		var answ_upload=[];
		//控制题目的条数
		var question_id;
		var ques_answ_arr;
		//alert($(DG.dg).find("#modle").attr("name"));
		var num=$(obj).find(".selectQuest").length;
		 //alert(num);
		for(var i=0;i<num;i++){
			answ_upload[i]=[];
		}
		$(obj).find(".selectQuest").each(function(index){      
			if($(this).attr('name')!==""){				
				question_id=$(this).attr('name');
				answ_upload[index].push(question_id);
				//存储多选项
				ques_answ_arr=$(this).find("input:checked").each(function(ind){
					answ_upload[index].push(($(this).val()));
				});
			}
		});
		
		$.ajax({
			url:'public_ajax.php'//改为你的动态页
			,type:'POST'
			,data:{
				jsup_answ_upload:JSON.stringify(answ_upload)
				,jsup_page_now:page_now
				,jsup_examination_log_id:examination_log_id
			}
			,async:true
			,dataType:"json"
			,success:function(data, textStatus, jqXHR){
			}
			,error:function(xhr){
				alert('添加失败'+xhr.responseText);
			}
		})
}
//下载附加题
function load_session_addition(){
	$.ajax({
		url:'session_exam.php'//改为你的动态页
		,type:'POST'
		,data:{
			load_addition_page_now:page_now
		}
		,async:false
		,dataType:"json"
		,success:function(data, textStatus, jqXHR){
			//alert(data);
			if(data!==null){
				showAddition(data);
				$("#save_answer").css("display","block");
			}
		}
		,error:function(xhr){
			alert('添加失败'+xhr.responseText);
		}
	})
}
//下载考生答案
function load_session_addition_user_answ(obj){
	var arr_step_num=[];
	$(obj).find(".selectQuest").each(function(){
		arr_step_num.push($(this).attr("name"));
	});
	$.ajax({
			url:'session_exam.php'//改为你的动态页
			,type:'POST'
			,data:{
				load_user_page_now:page_now,
				load_user_ques_num:JSON.stringify(arr_step_num)
			}
			,async:false
			,dataType:"json"
			,success:function(data, textStatus, jqXHR){
			 	if(data!==null){
			 		for(var i=0;i<data.length;i++){
			 			$(obj).find(".selectQuest[name='"+data[i][0]+"']").find("input").attr("checked",false);
						for(var j=1;j<data[i].length;j++){
							$(obj).find(".selectQuest[name='"+data[i][0]+"'] input[value='"+data[i][j]+"']").attr("checked",true);
						}
					}	
			 	}
			}
			,error:function(xhr){
				alert('添加失败'+xhr.responseText);
			}
		})
	}
function  uploadImage(quesNum,quesContent){
}

