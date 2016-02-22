///*
// * 下载
// */
//
///*
// * 判卷,显示正确答案
// */
//$("#judge_pap").bind('click',function(){
//	if(examMode!=='0'){
//		return false;
//	}
//	//alert(examMode);
//	$.ajax({
//		type:"post",
//		url:"public_judge_oncourse.php",
//		async:false,
//		dataType:"json",
//		data:{
//			judge_userId:user_id,//examination_log_id,
//			judge_papers_id:papers_id,
//			judge_pageNow:page_now,
//			judge_exam_id:exam_id
//		}
//			,success:function(data, textStatus, jqXHR){
//				//console.log(data);
//				//1 帅选出缺漏的步骤
//				//2 根据缺漏的步骤插入上一步的步骤后面（步骤为1的插入第一个位置）
//				//3 data[0] :正确步骤
//				//4 data[1] :题目标准答案 step ，one， two，three
//				set_correct_flow(data);
//		}
//		,error: function(xhr) {
//			alert('添加失败' + xhr.responseText);
//		}
//	});
//});
///*
// *设置
// */
//function set_correct_flow(data){
//	var t = data[1].length;
//	//初始化所有步骤的值
//	var array_list = [];
//	for (var i = 0; i < t; i++) {
//		array_list.push((i + 1));
//	}
//	var arr_corr = data[0][1]; //正确的步骤号
//	console.log(arr_corr);
//	$(".AnswForm").each(function() {
//		if (arr_corr.indexOf($(this).find(".step").html()) == -1) {
//			$(this).css("background-color", "#F5FDFF");
//		}
//	})
//	var arr_all = data[1]; //完整的正确步骤数据
//	console.log(arr_all);
//	
//	var arr_lack = arr_dive(array_list, arr_corr); //缺漏的步骤号
//	console.log(arr_lack);
//	var step_before;
//	for (var i = 0; i < arr_lack.length; i++) {
//		var nodeTable = $("#1").clone();
//		step_before = arr_lack[i] - 1; //完整答案的下标
//		nodeTable.find(".step").html(arr_all[step_before][0]);
//	
//		nodeTable.find("select[name=1]").find("option[value=" + arr_all[step_before][1] + "]").attr("selected", "selected");
//		nodeTable.find("select[name=2]").find("option[value=" + arr_all[step_before][2] + "]").attr("selected", "selected");
//		nodeTable.find("select[name=3]").find("option[value=" + arr_all[step_before][3] + "]").attr("selected", "selected");
//		nodeTable.css("background-color", "#028BB3");
//		if (arr_lack[i] === 1) { //缺少第一步
//			nodeTable.insertBefore($(".AnswForm").find(":first"));
//		} else {
//			//不是缺少第一步
//			$(".AnswForm").each(function(index) {
//				$("#up,#down,#delete,#copy,#upFlowAnsw").attr("disabled", true);
//				if ($(this).find("select[name=1] option:selected").val() == arr_all[step_before - 1][1] && $(this).find("select[name=2] option:selected").val() == arr_all[step_before - 1][2] && $(this).find("select[name=3] option:selected").val() == arr_all[step_before - 1][3]) {
//					nodeTable.insertAfter($(this));
//				}
//			});
//	
//			//添加附加题
//		}
//	}
//}
///*
// * 第一个数组减去第二个数组
// */
//function arr_dive(aArr, bArr) { 
//	if (bArr.length == 0) {
//		return aArr
//	}
//	var diff = [];
//	var str = bArr.join("&quot;&quot;");
//	for (var e in aArr) {
//		if (str.indexOf(aArr[e]) == -1) {
//			diff.push(aArr[e]);
//		}
//	}
//	return diff;
//}
