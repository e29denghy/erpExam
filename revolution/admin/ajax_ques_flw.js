//载入相关的科目模块
$("#flw_subject").live('change',function(){
	var flw_subject_id=$(this).val();
	//alert('添加失败'+xhr.responseText);
	if(flw_subject_id==''){
		return false;
	}
	$.ajax({
		url:'ajax_flw_add.php'//改为你的动态页
		,type:'POST'
		,data:{
			json_subject_id:flw_subject_id
		}
		,async:true
		,dataType:"json"
		,success:function(data, textStatus, jqXHR){
			$('#flw_module').find("option").remove();
			var option=("<option>");
			$('#flw_module').append(option);
			if(data.length!==0){
				for(var i=0;i<data.length;i++){		 
					var option_arr=$("<option>").val(data[i].subject_id).text(data[i].subject_name);
					$('#flw_module').append(option_arr);
				}	
			}else{
				$('#flw_number').find("option").remove();
				$('#flw_content').val('');
				$('#isEnabled').attr("checked",false);
				$('#flw_difficulty').find("option[value='0']").attr("selected","selected");
			}
		}
		,error:function(xhr){

			$('#flw_number').find("option").remove();
			$('#flw_content').val('');
			$('#isEnabled').attr("checked",false);
			$('#flw_difficulty').find("option[value='0']").attr("selected","selected");
		}
	}); 
});


//载入相关的题目内容
$("#flw_module").live('change',function(){
	var flw_module_id=$(this).val();
	$.ajax({
		url:'ajax_flw_add.php'//改为你的动态页
		,type:'POST'
		,data:{
			json_module_id:flw_module_id
			}
		,async:true
		,dataType:"json"
		,success:function(data, textStatus, jqXHR){
			//alert(data);
			//flow_questions_id,flow_questions_description,flow_questions_difficulty,flow_questions_enabled
			$('#flw_number').find("option").remove();
			var option=$("<option>").val("+").text("+");
			$('#flw_number').append(option);
			if(data!==null){
				for(var i=0;i<data.length;i++){		 
					//设置题目列表
					var option_list=$("<option>").val(data[i].flow_questions_id).text(data[i].flow_questions_id);
					$('#flw_number').append(option_list);
				}	
				$('#flw_number').live('change',function(){
					var current_ques=$(this).val();

					//初始化步骤表单
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

					if(current_ques!=='+'){
						for(var i=0;i<data.length;i++){		 
						//设置题目内容
							if(data[i].flow_questions_id==current_ques){
								$('#flw_content').val(data[i].flow_questions_description);  //题目内容
								//alert(data[i].flow_questions_enabled);
								if(data[i].flow_questions_enabled=='1'){					//是否可用
									$('#isEnabled').attr("checked",true);
								}else{
									$('#isEnabled').attr("checked",false);
								}
								$('#flw_difficulty').find("option[value='"+data[i].flow_questions_difficulty+"']").attr("selected","selected");
							}
						}
					}else{
						$('#flw_content').val('');
						$('#isEnabled').attr("checked",false);
						$('#flw_difficulty').find("option[value='0']").attr("selected","selected");

		
					}
				})
			}
		}
		,error:function(xhr){
			alert('添加失败'+xhr.responseText);
		}
	}); 
});


//添加题目
$("#flw_insert").live('click',function(){
	var flw_subject=$("#flw_subject").find("option:selected").val(); 	
	var flw_module=$("#flw_module").find("option:selected").val();
	var flw_number=$("#flw_number").find("option:selected").val();
	var flw_content=$("#flw_content").val();
	var isEnabled= $("#isEnabled").attr("checked")=="checked"?"1":"0";
	var flw_difficulty= $("#flw_difficulty").find("option:selected").val();
	if(flw_number!=="+"){
		return false;
	}
	/*
	alert(flw_subject);
	alert(flw_module);
	alert(flw_number);
	alert(flw_content);
	alert(isEnabled);
	alert(flw_difficulty);
	*/
	$.ajax({
		url:'ajax_flw_add.php'//改为你的动态页
		,type:'POST'
		,data:{
			 json_user_id:auth_id
			,json_flw_module:flw_module
			,json_flw_content:flw_content
			,json_isEnabled:isEnabled
			,json_flw_difficulty:flw_difficulty
			}
		,async:true
		,dataType:"json"
		,success:function(data, textStatus, jqXHR){
			//flow_questions_id,flow_questions_description,flow_questions_difficulty,flow_questions_enabled
			$("#flw_module").change();
			alert("添加成功！");
			$('#flw_content').val('');
			$('#isEnabled').attr("checked",false);
			$('#flw_difficulty').find("option[value='0']").attr("selected","selected");
		}
		,error:function(xhr){
			alert('添加失败'+xhr.responseText);
		}
	}); 
});
//更新题目
$("#flw_update").live('click',function(){
	var flw_subject=$("#flw_subject").find("option:selected").val(); 	
	var flw_module=$("#flw_module").find("option:selected").val();
	var flw_number=$("#flw_number").find("option:selected").val();
	var flw_content=$("#flw_content").val();
	var isEnabled= $("#isEnabled").attr("checked")=="checked"?"1":"0";
	var flw_difficulty= $("#flw_difficulty").find("option:selected").val();
	if(flw_number=="+"){
		return false;
	}
	/*

	alert(flw_subject);
	alert(flw_module);
	alert(flw_number);
	alert(flw_content);
	alert(isEnabled);
	alert(flw_difficulty);
	*/

	$.ajax({
		url:'ajax_flw_add.php'//改为你的动态页
		,type:'POST'
		,data:{
			 json_upda_user_id:auth_id
			,json_upda_flw_module:flw_module
			,json_upda_flw_number:flw_number
			,json_upda_flw_content:flw_content
			,json_upda_isEnabled:isEnabled
			,json_upda_flw_difficulty:flw_difficulty
			}
		,async:true
		,dataType:"json"
		,success:function(data, textStatus, jqXHR){
			$("#flw_module").change();
			alert("更新成功！");
			$('#flw_content').val('');
			$('#isEnabled').attr("checked",false);
			$('#flw_difficulty').find("option[value='0']").attr("selected","selected");
		}
		,error:function(xhr){
			alert('添加失败'+xhr.responseText);
		}
	}); 
});
//删除题目
$("#flw_delete").live('click',function(){
	var flw_number=$("#flw_number").val();
	$.ajax({
		url:'ajax_flw_add.php'//改为你的动态页
		,type:'POST'
		,data:{
			json_dele_flw_number:flw_number
			}
		,async:true
		,dataType:"json"
		,success:function(data, textStatus, jqXHR){
			$("#flw_module").change();
			$('#flw_content').val('');
			$('#isEnabled').attr("checked",false);
			$('#flw_difficulty').find("option[value='0']").attr("selected","selected");
		}
		,error:function(xhr){
			alert('添加失败'+xhr.responseText);
		}
	}); 
});
//显示流程题答案数目
$("#flw_number").live('change',function(){
	//flw_answ_amount
	var current_ques=$(this).val();
	$.ajax({
		url:'ajax_flw_add.php'//改为你的动态页
		,type:'POST'
		,data:{
			json_answ_current_ques:current_ques
			}
		,async:true
		,dataType:"json"
		,success:function(data, textStatus, jqXHR){
			$("#flw_answ_amount").find("option").remove();
			var option_add=$('<option>').val("+").text("+");
			$("#flw_answ_amount").append(option_add);
			if(data.length!==0){
				for(var i=0;i<data.length;i++){
					var option_bran=$("<option>").val(data[i].flow_answers_steps_branchid).text(data[i].flow_answers_steps_branchid);
					$("#flw_answ_amount").append(option_bran);
				}
			}
		}
		,error:function(xhr){
			alert('添加失败'+xhr.responseText);
		}
	});

});