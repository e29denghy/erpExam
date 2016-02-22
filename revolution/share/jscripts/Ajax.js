/*--------------------------
流程步骤的答案添加事件
--------------------------*/
$('#flw_answ_add').live("click",function(){  
	var num_answ=$('.AnswForm').length;
	var add_flag=$('#flw_answ_amount').find("option:selected").val();
	if(add_flag!=="+"){
		return false;
	}
	var blance_checked = $('#blance_checked').attr('checked');
	var flow_number_start = $('#flow_number_start').find("option:selected").text();
	var flow_number_end = $('#flow_number_end').find("option:selected").text();
	if(blance_checked =="checked"){
		blance_checked=1;
	}else{
		blance_checked=0;
	}
	//  获取章节信息
	var ques_num=$("#flw_number").find("option:selected").val();
	var add_module=$("#flw_subject").find("option:selected").val();

	var arr=[]; 
	for(var i=0;i<num_answ;i++){
      arr[i] = [];
    }
    for (i = 0; i <num_answ; i++){
		var select1_list=$('#'+(i+1)+'').find("select[name='1']  option:selected").val();    //单据
		var select1_oper=$('#'+(i+1)+'').find("select[name='2']  option:selected").val();	//操作
		var select1_role=$('#'+(i+1)+'').find("select[name='3']  option:selected").val();	//角色
		arr[i][0]=select1_list;
		arr[i][1]=select1_oper;
		arr[i][2]=select1_role;
	}
	$.ajax({
	url:'ajax_upload.php'//改为你的动态页
	,type:'POST'
	,data:{
		 add_data:JSON.stringify(arr)
		,add_ques_num:ques_num
		,add_start:flow_number_start
		,add_end:flow_number_end
		,add_check:blance_checked
		,add_module_num:add_module}
	,async:true
	,dataType:"json"
	,success:function(data, textStatus, jqXHR){
		alert('添加成功!');
		$("#flw_number").change();
		$('#flw_answ_amount').change();
		clearTable();
	}
	,error:function(xhr){
		alert('添加失败'+xhr.responseText);

	}
	});
})
 
/*--------------------------
当前下拉框答案分支序号 改变 ，下载相应的答案
--------------------------*/
 $('#flw_answ_amount').live("change",function(){
 	var sele_answ_num=$('#flw_answ_amount').find("option:selected").val();
 	if(sele_answ_num!=='+'){ 
		var sele_ques_number=$("#flw_number").find("option:selected").val(); 
		var sele_modu_number=$("#flw_subject").find("option:selected").val();
		$.ajax({
		url:'ajax_upload.php'//改为你的动态页
		,type:"POST"
		,data:{
		sele_modu:sele_modu_number
		,sele_curr_answ:sele_answ_num
		,sele_ques:sele_ques_number
		}//调用json.js类库将json对象转换为对应的JSON结构字符串
		,async:true
		,dataType:"json"
		,success:function(data, textStatus, jqXHR){
			//alert('PHP接收JSON数据成功');
			//格式化table
			var num_table=$('.AnswForm').length;
			var num_array=data.length;
			//alert(num_table);
			//alert(num_array);

			if(num_table>num_array){
				var differ=num_table-num_array;
				for(var i=0;i<differ;i++){
					$('#1').find("input#delete").click();
				}
			}
			if(num_table<num_array){
				var differ=num_array-num_table;
				for(var i=0;i<differ;i++){
					$('#1').find("input#copy").click();
				}
			}
			
			//alert(data[0].flow_answers_steps_option1);
			for(var i=0;i<data.length;i++){
				$('#'+(i+1)+'').find("select[name='1'] option:selected").attr("selected"," ");
				$('#'+(i+1)+'').find("select[name='1'] option[value='"+data[i].flow_answers_steps_option1+"']").attr("selected","selected");
			
				$('#'+(i+1)+'').find("select[name='2'] option:selected").attr("selected"," ");
				$('#'+(i+1)+'').find("select[name='2'] option[value='"+data[i].flow_answers_steps_option2+"']").attr("selected","selected");
	
				$('#'+(i+1)+'').find("select[name='3'] option:selected").attr("selected"," ");
				$('#'+(i+1)+'').find("select[name='3'] option[value='"+data[i].flow_answers_steps_option3+"']").attr("selected","selected");
				
			}
			changeBlanceStart();//配置分支 步骤的开始的数量和结束的数量
			//设置分支信息
			//是否有分支
			//分支开始
			//分支结束
			var bransign=data[0].flow_answers_steps_branchsign;
			var bran_start=0;
			var bran_end=0;
			var bran_start_flag=0;
			//z设置分支开始，结束
			for(var i=0;i<data.length;i++){
				if(data[i].flow_answers_steps_branchpoint==1 && bran_start_flag==0){
					bran_start=i;
					bran_start_flag=1;	
				}
				if(data[i].flow_answers_steps_branchpoint==1){
					bran_end=i;
				}
			}
			//是否有分支
			if(bransign==1){
				$('#blance_checked').attr("checked",true);
				$('#flow_number_start').mouseover();
				$('#flow_number_end').mouseover();
				$('#flow_number_start').find("option:selected").attr("selected","");
				$('#flow_number_start').find("option[value='"+(bran_start+1)+"']").attr("selected","selected");
				 
				$('#flow_number_end').find("option:selected").attr("selected","");
				$('#flow_number_end').find("option[value='"+(bran_end+1)+"']").attr("selected","selected");

			}
			//alert("分支开始和分支结束");
			//alert(bran_start);
			//alert(bran_end);
		}
		,error:function(xhr){alert('PHP页面有错误！'+xhr.responseText);}
		});		
	}else{
		clearTable();
		changeBlanceStart();
	}
 });
/*
 * newBlance 按钮，点击当前的答案，变为新的分支
 */
$("#newBlance").live("click",function(){
	$("#flw_answ_amount").find("option[value='+']").attr("selected","selected");
});
function clearTable(){
		var kid=$('.AnswForm#1').clone();
		kid.find("select option:selected").each(function(){
			//alert($(this).attr("selected"));
			$(this).removeAttr("selected");
			//alert($(this).attr("selected"));
		});
		kid.find("select option[value='请选择']").each(function(){
			$(this).attr("selected","selected");
		});

		$('.AnswForm').remove();
		$(".table_box").append(kid);
		
		$('#blance_checked').attr("checked",false);
}
 /*--------------------------
 	更新答案
--------------------------*/
$('#flw_answ_update').live("click",function(){  
	var num_answ=$('.AnswForm').length;
	var add_flag=$('#flw_answ_amount').find("option:selected").val();
	if(add_flag=="+"){
		return false;
	}	
	var upda_answ_blan_num=$('#flw_answ_amount').find("option:selected").val();

	//alert(flag);    获取表单中 分支的信息

	var upda_blance_checked = $('#blance_checked').attr('checked')=="checked"?1:0;
	var upda_flow_number_start = $('#flow_number_start').find("option:selected").val();
	var upda_flow_number_end = $('#flow_number_end').find("option:selected").val();
	if(upda_flow_number_start>upda_flow_number_end){
		alert("分支信息出错！");
		return false;
	}
	if(blance_checked =="checked"){
		blance_checked=1;
	}else{
		blance_checked=0;
	}
	//alert(blance_checked);
	//  获取章节信息
	var upda_ques_num=$("#flw_number").find("option:selected").val();
	var upda_add_module=$("#flw_subject").find("option:selected").val();
	//流程题数据存入
	var arr=[]; 
	for(var i=0;i<num_answ;i++){
      arr[i] = [];
    }
    for (i = 0; i <num_answ; i++){
		var select1_list=$('#'+(i+1)+'').find("select[name='1']  option:selected").val();    //单据
		var select1_oper=$('#'+(i+1)+'').find("select[name='2']  option:selected").val();	//操作
		var select1_role=$('#'+(i+1)+'').find("select[name='3']  option:selected").val();	//角色
		arr[i][0]=select1_list;
		arr[i][1]=select1_oper;
		arr[i][2]=select1_role;
	}
	//console.log(arr);
	$.ajax({
	url:'ajax_upload.php'//改为你的动态页
	,type:'POST'
	,data:{upda_data: JSON.stringify(arr)
		,upda_ques_num: upda_ques_num
		,upda_start: upda_flow_number_start
		,upda_end: upda_flow_number_end
		,upda_check: upda_blance_checked
		,upda_module_num: upda_add_module
		,upda_blance: upda_answ_blan_num
	}
	,async:true
	,dataType:"json"
	,success:function(data, textStatus, jqXHR){
		alert('更新成功！');
		clearTable();
		$("#flw_number").change();
		//$('#flw_answ_amount').change();
		
	}
	,error:function(xhr){alert('更新出错'+xhr.responseText);}
	});
})
 
/*
 * 删除相应答案
 */
 $('#flw_answ_delete').live("click",function(){
 	var dele_answ_blan_num=$('#flw_answ_amount').find("option:selected").val();
 	if(dele_answ_blan_num!=='+'){
		var dele_ques_number=$("#flw_number").find("option:selected").val(); 
		$.ajax({
		url:'ajax_upload.php'//改为你的动态页
		,type:"POST"
		,data:{
			dele_curr_answ:dele_answ_blan_num
			, dele_ques:dele_ques_number
		}
		,async:true
		,dataType:"json"
		,success:function(data, textStatus, jqXHR){
			if(data.message==true){
				alert("删除成功！");
				clearTable();
				$("#flw_number").change();
				//$('#flw_answ_amount').change();
			}
		}
		,error:function(xhr){
			alert('删除出错！'+xhr.responseText);}
		});		
	}
 });
/*
 * 
 * 分支开始： 下载相应的option
 * 分支结束： 下载相应的option
 * 
 */

function changeBlanceStart() {
	var num_now = $('#flow_number_start option').length;
	var number_list = $('.AnswForm').length;
	var user_id = "<?php echo $_SESSION['session_user_name'];?>";
	if (num_now !== number_list + 1) {
		$('#flow_number_start option').remove();
		$('#flow_number_end option').remove();
		$('#flow_number_start').append("<option value='-1'></option>");
		$('#flow_number_end').append("<option value='-1'></option>");
		for (var i = 0; i < number_list; i++) {
			$('#flow_number_start').append("<option value='" + (i + 1) + "'>" + (i + 1) + "</option>");
			$('#flow_number_end').append("<option value='" + (i + 1) + "'>" + (i + 1) + "</option>");
		}
	}
}

/*
 *设置附加题题目
 **/
$("#att_flow_step").change(function(){
	select_play();
});
function select_play(){
	var att_step_id=$('#att_flow_step').find("option:selected").text();
	//alert(auth_id);
	//var args;
	//alert(att_step_id);
	//alert(att_ques_id);
	var att_flow_blan_id=blance_id;
	
	if(att_flow_blan_id!==''){
		
		$.ajax({
			url:'ajax_upload.php'//改为你的动态页
			,type:'POST'
			,data:{att_step:att_step_id
				,att_ques_num:att_ques_id
				,attr_blan:att_flow_blan_id
			}
			,async:true
			,dataType:"json"
			,success:function(data, textStatus, jqXHR){
				//alert('PHP接收JSON数据成功');
			 	console.log(data);
				//data[i].questions_add_id;
				//data[i].questions_add_description;
				//data[i].questions_add_type;
				//data[i].questions_add_enabled;
				//1.题型设置 qtype_sing qtype_multi
				//2.题目可用attac_avail
				//3.题目内容id atta_content
				//4.题目描述atta_conten_area
				//设置题目可用
				//alert(data[0].questions_add_id);
			 	//附加题题目列表--打印出相应的option到题目id中
			 	if(data.length>0){
			 		$("#atta_content").empty(); 
	      			var option_add = $("<option>").val("+").text("+"); 
	      			$("#atta_content").append(option_add); 
				 	for(var i=0;i<data.length;i++){
					 	if(data[i].questions_add_id){
			      			var option1 = $("<option>").val(data[i].questions_add_id).text(data[i].questions_add_id); 
			      			$("#atta_content").append(option1);  
				 		}
			 		}
			 	}else{
			 		$("#atta_content").empty(); 
	      			var option_add = $("<option>").val("+").text("+"); 
	      			$("#atta_content").append(option_add); 
			 	}
			 	//
			 	//附加题题目内容下拉框 ----发生改变
			 	//
			 	$('#atta_content').live('change',function(){
			 		var selected_id=$("#atta_content").find("option:selected").text();

			 		if(selected_id!=='+'){
				 		var arr_seleted_index;
				 		//alert($(this).text());
				 		//取出数组的下标
				 		for(var i=0;i<data.length;i++){
				 			if(selected_id==data[i].questions_add_id){
				 				arr_seleted_index=i;
				 				break;
				 			}
				 		}
				 		if(!isNaN(arr_seleted_index)){
				 			//alert("aaaa");
				 			//附加题的设置题目可用 
						 	if(data[arr_seleted_index].questions_add_enabled==='1'){
						 		$('#attac_avail').attr("checked",true);
						 	}else{
						 		$('#attac_avail').attr("checked",false);
						 	}
						 	//附加题设置题目类型 单选 多选
							//alert("题目类型："+data[arr_seleted_index].questions_add_type);
						 	switch(data[arr_seleted_index].questions_add_type){
						 		case '0':
						 			$('#qtype_multi').attr("checked",true);
						 			break;
						 		case '1':
						 			$('#qtype_sing').attr("checked",true);
						 			break;
						 		case '-1':
						 			$('#qtype_printScreen').attr("checked",true);
						 			break;	
						 		default :
						 			break;				 				
						 	}
						 	//设置题目textarea的具体内容
						 	if(data[arr_seleted_index].questions_add_description){
						 		$('#atta_conten_area').val(data[arr_seleted_index].questions_add_description);
						 	}
				 		}

				 		//在下一个表单显示附加题目的id
				 		$('#atta_answ_id').val($('#atta_content').find("option:selected").val());
				 		//在下一个表单显示附加答案的内容列表
				 		attr_answ_id_sele();

			 		}else{
			 			$('#atta_conten_area').val('');
			 			$('#qtype_sing').attr('checked',false);
			 			$('#qtype_multi').attr('checked',false);
			 			$('#attac_avail').attr('checked',false);
			 			$('#qtype_printScreen').attr('checked',false);
			 			
			 		}

			 		//级联附加题答案 select 
			 		//
			 		//有附加题答案则下载，没有则显示+
			 			


			 	});
			}
			,error:function(xhr){alert('PHP页面有错误！'+xhr.responseText);}
		});
			
	}

}


/*-------------------------------------------
	附加题添加按钮
---------------------------------------------*/
$("#att_insert").live("click",function(){
	 
	var att_add_check=$('#atta_content').find('option:selected').text();
	//alert(att_add_check);
	if(att_add_check=="+"){
		var att_add_id=att_add_check;
		var att_add_flow_id = att_ques_id;
		var att_add_flow_step_id= $('#att_flow_step').find("option:selected").text();
		var att_add_flow_blan=blance_id;
		var att_add_ques_descr= $('#atta_conten_area').val();
		//att_type =1 表示单选
		//att_type =0 表示多选
		//att_type =-1 表示截图
		if($('#qtype_sing').attr("checked")=="checked"){
			var att_type= '1';
		}else if($('#qtype_multi').attr("checked")=="checked"){
			var att_type= '0';
		}else if($('#qtype_printScreen').attr("checked")=="checked"){
			var att_type= '-1';
		}
		var att_add_enabled= $('#attac_avail').attr("checked")=="checked"?1:0;
		var att_add_users_id= auth_id;
		 /*
		alert(att_add_flow_id);
		alert(att_add_flow_step_id);
		alert(att_add_flow_blan);
		alert(att_add_ques_descr);
		alert(att_type);
		alert(att_add_enabled);
		alert(att_add_users_id);
		 */
				$.ajax({
				url:'ajax_upload.php'//改为你的动态页
				,type:'POST'
				,data:{
					json_att_id:att_add_id
					,json_att_add_flow_id:att_add_flow_id
					,json_att_add_flow_step_id:att_add_flow_step_id
					,json_att_add_flow_blan:att_add_flow_blan
					,json_att_add_ques_descr:att_add_ques_descr
					,json_att_type:att_type
					,json_att_add_enabled:att_add_enabled
					,json_att_add_users_id:att_add_users_id
				}
				,async:true
				,dataType:"json"
				,success:function(data, textStatus, jqXHR){
					//alert(data.message);
					if(data){
						if(data.message=='1'){
							alert("添加成功！");
							$('#atta_conten_area').val('');
							select_play();
							
						}else{
							alert("添加失败！");
						}						
					}

				}	 
				,error:function(xhr){
					alert('添加失败！'+xhr.responseText);
				}
			});	
		}else{
			alert("添加出错！");
		}


});
/*-------------------------------------------
	附加题更新按钮
---------------------------------------------*/
$("#att_update").live("click",function(){
	var att_add_check=$('#atta_content').find('option:selected').text();
	//alert(att_add_check);
	if(att_add_check!=="+"){
		var att_add_id=att_add_check;
		var att_add_flow_id = att_ques_id;
		var att_add_flow_step_id= $('#att_flow_step').find("option:selected").text();
		var att_add_flow_blan=blance_id;
		var att_add_ques_descr= $('#atta_conten_area').val();
		//var att_type= $('#qtype_sing').attr("checked")=="checked"?1:0;
		if($('#qtype_sing').attr("checked")=="checked"){
			var att_type= '1';
		}else if($('#qtype_multi').attr("checked")=="checked"){
			var att_type= '0';
		}else if($('#qtype_printScreen').attr("checked")=="checked"){
			var att_type= '-1';
		}
		var att_add_enabled= $('#attac_avail').attr("checked")=="checked"?1:0;
		var att_add_users_id= auth_id;
		//alert(att_type);
		 /*
		alert(att_add_flow_id);
		alert(att_add_flow_step_id);
		alert(att_add_flow_blan);
		alert(att_add_ques_descr);
		
		alert(att_add_enabled);
		alert(att_add_users_id);
		*/
				$.ajax({
				url:'ajax_upload.php'//改为你的动态页
				,type:'POST'
				,data:{
					json_att_id:att_add_id
					,json_att_upda_flow_id:att_add_flow_id
					,json_att_upda_flow_step_id:att_add_flow_step_id
					,json_att_upda_flow_blan:att_add_flow_blan
					,json_att_upda_ques_descr:att_add_ques_descr
					,json_upda_type:att_type
					,json_att_upda_enabled:att_add_enabled
					,json_att_upda_users_id:att_add_users_id
				}
				,async:true
				,dataType:"json"
				,success:function(data, textStatus, jqXHR){
					if(data){
						if(data.message=='1'){
							alert("更新成功！");
							$('#atta_conten_area').val('');
							select_play();
						}else{
							alert("更新失败！");
						}
					}
				}	 
				,error:function(xhr){
					alert('更新失败！'+xhr.responseText);
				}
			});	
		}else{
			alert("更新出错！");
		}
});
/*-------------------------------------------
	附加题删除按钮
---------------------------------------------*/
$("#att_delete").live("click",function(){
	var att_add_check=$('#atta_content').find('option:selected').text();
	//alert(att_add_check);
	if(att_add_check!=="+"){
		var att_dele_id=att_add_check;		
		//alert(att_dele_id);
		$.ajax({
		url:'ajax_upload.php'//改为你的动态页
		,type:'POST'
		,data:{
			json_att_dele_id:att_dele_id
		}
		,async:true
		,dataType:"json"
		,success:function(data, textStatus, jqXHR){   
			if(data){
				if(data.message=='1'){
					alert("删除成功！");

					$('#atta_conten_area').val('');
					select_play();
				}else{
					alert("删除失败！");
				}
			}
		}	 
		,error:function(xhr){
			alert('删除失败！'+xhr.responseText);
		}
	});	
}
});

/*-------------------------------------------
	附加题答案 附加题目id 框
---------------------------------------------*/

function attr_answ_id_sele(){
	var att_answ_selected_id=$('#atta_answ_id').val();
	//alert(att_answ_selected_id);
	$.ajax({
		url:'ajax_upload.php'//改为你的动态页
		,type:'POST'
		,data:{attr_answ_selected_id:att_answ_selected_id
		}
		,async:true
		,dataType:"json"
		,success:function(data, textStatus, jqXHR){
			//alert('请求页面成功！');
			if(data){
				$('#atta_answ_content').empty();
				var option_add=$('<option selected="selected">').val("+").text("+");
				$('#atta_answ_content').append(option_add);
				for(var i=0;i<data.length;i++){
					var option=$('<option>').val(i).text(data[i].answers_other_id);
					$('#atta_answ_content').append(option);
				}
				}else{
					$('#atta_answ_content').empty();
					var option_add1=$('<option selected="selected">').val("+").text("+");
					$('#atta_answ_content').append(option_add1);
				}
		}
		,error:function(xhr){
			alert('PHP页面有错误！'+xhr.responseText);
		}
	});
}

/*-------------------------------------------
	附加题答案  点击答案内容select 之后的显示
---------------------------------------------*/
$('#atta_answ_content').live("change",atta_answ_conte_select);
function atta_answ_conte_select(){
	var atta_answ_content= $('#atta_answ_content').find("option:selected").text();
	if(atta_answ_content!=="+"){
		$.ajax({
			url:'ajax_upload.php'//改为你的动态页
			,type:'POST'
			,data:{
				json_answ_content_id:atta_answ_content,
				json_atta_answ_is_add:'1'
			}
			,async:true
			,dataType:"json"
			,success:function(data, textStatus, jqXHR){  
				 //附加题答案的具体参数
				 if(data!=null){
				 	for(var i=0;i<data.length;i++){

				 		if(data[i].answers_other_enabled==1){
				 			$('#atta_answ_avail').attr("checked",true);
				 		}else{
				 			$('#atta_answ_avail').attr("checked",false);
				 		}
				 		if(data[i].answers_other_isright==1){
				 			$('#atta_answ_isright').attr("checked",true);
				 		}else{
				 			$('#atta_answ_isright').attr("checked",false);
				 		}
				 		$('#atta_answ_content_area').val(data[i].answers_other_description);
				 	}
				 }
			}	 
			,error:function(xhr){
				alert('页面出错！'+xhr.responseText);
			}
		});
	}else{
		$('#atta_answ_avail').attr("checked",false);
		$('#atta_answ_isright').attr("checked",false);
		$('#atta_answ_content_area').val('');
	} 
	
}

/*-------------------------------------------
	附加题答案  添加按钮 之后的显示
---------------------------------------------*/
$('#att_answ_insert').live("click",function(){
	var atta_answ_id=$('#atta_answ_id').val();
	var atta_answ_content=$('#atta_answ_content').find("option:selected").val();
	var atta_answ_content_area=$('#atta_answ_content_area').val();
	var atta_answ_avail=($('#atta_answ_avail').attr("checked"))=="checked"?"1":0;
	var atta_answ_isright=($('#atta_answ_isright').attr("checked"))=="checked"?"1":0;
	
	if(atta_answ_content=="+"){
		$.ajax({
			url:'ajax_upload.php'//改为你的动态页
			,type:'POST'
			,data:{
				json_atta_answ_id:atta_answ_id,
				json_atta_answ_content:atta_answ_content,
				json_atta_answ_isadd:"1",
				json_atta_answ_content_area:atta_answ_content_area,
				json_atta_answ_avail:atta_answ_avail,
				json_atta_answ_isright:atta_answ_isright
			}
			,async:true
			,dataType:"json"
			,success:function(data, textStatus, jqXHR){
				//alert('请求页面成功！');
				if(data.message=="1"){
					alert("添加成功！");
					$('#atta_answ_avail').attr("checked",false);
					$('#atta_answ_isright').attr("checked",false);
					$('#atta_answ_content_area').val('');					
				}
				attr_answ_id_sele();
			}
			,error:function(xhr){
				alert('PHP页面有错误！'+xhr.responseText);
			}
		});
	}
});

/*-------------------------------------------
	附加题答案 更新按钮 之后的显示
---------------------------------------------*/

$('#att_answ_update').live("click",function(){
	var atta_answ_id=$('#atta_answ_id').val();
	var atta_answ_content=$('#atta_answ_content').find("option:selected").text();
	var atta_answ_content_area=$('#atta_answ_content_area').val();
	var atta_answ_avail=($('#atta_answ_avail').attr("checked"))=="checked"?"1":0;
	var atta_answ_isright=($('#atta_answ_isright').attr("checked"))=="checked"?"1":0;
	if(atta_answ_content!=="+"){
		$.ajax({
			url:'ajax_upload.php'//改为你的动态页
			,type:'POST'
			,data:{
				upda_atta_answ_id:atta_answ_id,
				upda_atta_answ_content:atta_answ_content,
				upda_atta_answ_isadd:"1",
				upda_atta_answ_content_area:atta_answ_content_area,
				upda_atta_answ_avail:atta_answ_avail,
				upda_atta_answ_isright:atta_answ_isright}
			,dataType:"json"
			,success:function(data, textStatus, jqXHR){
				//alert('请求页面成功！');
				if(data.message=="1"){
					alert("更新成功！");
					$('#atta_answ_avail').attr("checked");
					$('#atta_answ_isright').attr("checked");
					$('#atta_answ_content_area').val('');
				}
				attr_answ_id_sele();
			}
			,error:function(xhr){
				alert('PHP页面有错误！'+xhr.responseText);
			}
		});
	}
});	


/*-------------------------------------------
	附加题答案  删除按钮 之后的显示
---------------------------------------------*/
 
$('#att_answ_dele').live("click",function(){
	var atta_answ_content=$('#atta_answ_content').find("option:selected").text();
	if(atta_answ_content!=="+"){
		$.ajax({
			url:'ajax_upload.php'//改为你的动态页
			,type:'POST'
			,data:{
				dele_atta_answ_content:atta_answ_content
			}
			,async:true
			,dataType:"json"
			,success:function(data, textStatus, jqXHR){
				//alert('请求页面成功！');
				if(data.message=="1"){
					alert("删除成功！");
				}
				attr_answ_id_sele();
				$('#atta_answ_avail').attr("checked",false);
				$('#atta_answ_isright').attr("checked",false);
				$('#atta_answ_content_area').val('');
			}
			,error:function(xhr){
				alert('PHP页面有错误！'+xhr.responseText);
			}
		});
	}
});	
 