//
//考生进入考试界面
//examinator_face.js
//
//
//$("#exam_subject").mouseover(function(){
$(document).ready(function(){
	 $.ajax({
		url:'examinator_ajax.php' 
		,type:"POST"
		,data:{
			exam_login_user_id:user_id
		}
		,async:true
		,dataType:"json"
		,success:function(data, textStatus, jqXHR){
			if(data!==null){
				//科目
			fillTable(data);
	 		$('#exam_name').change(function(){
	 			var monto=0;
	 			for(var i=0;i<data.length;i++){
	 				if($(this).find("option:selected").text()==data[i].exam_name){
	 					monto=1;
	 					$("#exam_start").find("option[value='"+data[i].exam_begin_time+"']").attr("selected","selected");
	 					$('#exam_end').find("option[value='"+data[i].exam_end_time+"']").attr("selected","selected");
	 					$('#test_duration').val(data[i].exam_duration_time);
	 					//alert(data[i].is_end);
	 				}
	 			}
	 			if(monto===0){
	 				$("#exam_start").find("option[value='-1']").attr("selected","selected");
	 				$('#exam_end').find("option[value='-1']").attr("selected","selected");
	 				$('#test_duration').val('');
	 			}
	 		});
			//如果当前是selected设置考试状态
			$("#test_mode").live("change",function(){
					initForm(1);
					var exam_mode = $("#test_mode").find("option:selected").val();
					var add = 0;
					var arr_modu=[];
					for (var i = 0; i < data.length; i++) {
						if (data[i].exam_mode == exam_mode 
							&& arr_modu.indexOf(data[i].exam_module_id)==-1 ) {
							var option = $("<option>").val(data[i].exam_module_id);
							option.html(data[i].module_name);
							if (add == 0) {
								option.attr("selected", true);
							}
							$("#exam_subject").append(option);
							arr_modu.push(data[i].exam_module_id);
							add++;
						}
					}
					
					add = 0;
					var module_id = $("#exam_subject").find("option:selected").val();
					for (var i = 0; i < data.length; i++) {
						if (data[i].exam_module_id == module_id && data[i].exam_mode == exam_mode) {
							var option = $("<option>").val(data[i].exam_id);
							option.html(data[i].exam_name);
							if (add == 0) {
								option.attr("selected", true);
							}
							$("#exam_name").append(option);
							add++;
						}
					}
					add = 0;
					var exam_id = $("#exam_name").find("option:selected").val();
					for (var i = 0; i < data.length; i++) {
						if (data[i].exam_id == exam_id) {
							//开始时间
							var option_bgT = $("<option>").val(data[i].exam_begin_time);
							option_bgT.html(data[i].exam_begin_time);
							if (add == 0) {
								option_bgT.attr("selected", true);
							}
							$("#exam_start").append(option_bgT);
							//结束时间
					
							var option_enT = $("<option>").val(data[i].exam_end_time);
							option_enT.html(data[i].exam_end_time);
							if (add == 0) {
								option_enT.attr("selected", true);
							}
							$("#exam_end").append(option_enT);
							//考试时长
							var option_durT = data[i].exam_duration_time;
							if (add == 0) {
								$("#test_duration").val(option_durT);
							}
					
							//考试状态
							var start = $("#exam_start").find("option:selected").val();
							var end = $("#exam_end").find("option:selected").val();
					
							if (start == data[i].exam_begin_time && end == data[i].exam_end_time) {
								var exam_state = data[i].is_end;
								var exam_desc = exam_state == 0 ? "考试未完成" : "已完成";
								$("#exam_status").val(exam_desc);
							}
							add++;
						}
					}
			});
			$("#exam_subject").live("change",function(){
					initForm(2)
					add = 0;
					var exam_mode=$("#test_mode").find("option:selected").val();
					var module_id = $(this).find("option:selected").val();
					for (var i = 0; i < data.length; i++) {
						if (data[i].exam_module_id == module_id &&
							data[i].exam_mode == exam_mode) {
							var option = $("<option>").val(data[i].exam_id);
							option.html(data[i].exam_name);
							if (add == 0) {
								option.attr("selected", true);
							}
							$("#exam_name").append(option);
							add++;
						}
					}
					add = 0;
					var exam_id = $("#exam_name").find("option:selected").val();
					for (var i = 0; i < data.length; i++) {
						if (data[i].exam_id == exam_id) {
							//开始时间
							var option_bgT = $("<option>").val(data[i].exam_begin_time);
							option_bgT.html(data[i].exam_begin_time);
							if (add == 0) {
								option_bgT.attr("selected", true);
							}
							$("#exam_start").append(option_bgT);
							//结束时间
					
							var option_enT = $("<option>").val(data[i].exam_end_time);
							option_enT.html(data[i].exam_end_time);
							if (add == 0) {
								option_enT.attr("selected", true);
							}
							$("#exam_end").append(option_enT);
							//考试时长
							var option_durT = data[i].exam_duration_time;
							if (add == 0) {
								$("#test_duration").val(option_durT);
							}
					
							//考试状态
							var start = $("#exam_start").find("option:selected").val();
							var end = $("#exam_end").find("option:selected").val();
					
							if (start == data[i].exam_begin_time && end == data[i].exam_end_time) {
								var exam_state = data[i].is_end;
								var exam_desc = exam_state == 0 ? "考试未完成" : "已考";
								$("#exam_status").val(exam_desc);
							}
							add++;
						}
					}				
			})
			
			$("#exam_name").live("change",function(){
					initForm(3)
					add = 0;
					var exam_id = $("#exam_name").find("option:selected").val();
					for (var i = 0; i < data.length; i++) {
						if (data[i].exam_id == exam_id) {
							//开始时间
							var option_bgT = $("<option>").val(data[i].exam_begin_time);
							option_bgT.html(data[i].exam_begin_time);
							if (add == 0) {
								option_bgT.attr("selected", true);
							}
							$("#exam_start").append(option_bgT);
							//结束时间
					
							var option_enT = $("<option>").val(data[i].exam_end_time);
							option_enT.html(data[i].exam_end_time);
							if (add == 0) {
								option_enT.attr("selected", true);
							}
							$("#exam_end").append(option_enT);
							//考试时长
							var option_durT = data[i].exam_duration_time;
							if (add == 0) {
								$("#test_duration").val(option_durT);
							}
					
							//考试状态
							var start = $("#exam_start").find("option:selected").val();
							var end = $("#exam_end").find("option:selected").val();
					
							if (start == data[i].exam_begin_time && end == data[i].exam_end_time) {
								var exam_state = data[i].is_end;
								var exam_desc = exam_state == 0 ? "考试未完成" : "已完成";
								$("#exam_status").val(exam_desc);
							}
							add++;
						}
					}
			})
			
			$("#exam_subject,#exam_name,#exam_start,#exam_end").live('change',function(){
				for(var i=0;i<data.length;i++){
					if( data[i].exam_module_id == $("#exam_subject").find("option:selected").val() &&
					data[i].exam_id == $("#exam_name").find("option:selected").val() &&
					data[i].exam_begin_time == $("#exam_start").find("option:selected").val() &&
					data[i].exam_end_time == $("#exam_end").find("option:selected").val()){
						var is_end=data[i].is_end=='1'?"已考":"未进行";
						$('#exam_status').val(is_end);
					}
				}
				
			});
		}
		}
		,error:function(xhr){
			alert("user_id"+user_id);
			console.log(xhr.responseText);
			alert('失败！'+xhr.responseText);
		}
	});
})
function initForm(id){
	switch(id){
		case 1:
			$("#exam_subject").find("option").remove();
			$("#exam_name").find("option").remove();
			$("#exam_start").find("option").remove();
			$("#exam_end").find("option").remove();
			$("#test_duration").removeAttr("value");
			$("#exam_status").removeAttr("value");
			break;
		case 2:	
			$("#exam_name").find("option").remove();
			$("#exam_start").find("option").remove();
			$("#exam_end").find("option").remove();
			$("#test_duration").removeAttr("value");
			$("#exam_status").removeAttr("value");
			break;
		case 3:	
			$("#exam_start").find("option").remove();
			$("#exam_end").find("option").remove();
			$("#test_duration").removeAttr("value");
			$("#exam_status").removeAttr("value");
			break;	
		case 4:	
			$("#exam_end").find("option").remove();
			$("#test_duration").removeAttr("value");
			$("#exam_status").removeAttr("value");
			break;	
	}	

}
function fillTable(data){
	initForm();
	var exam_mode = $("#test_mode").find("option:selected").val();
	var add = 0;
	for (var i = 0; i < data.length; i++) {
		if (data[i].exam_mode == exam_mode) {
			var option = $("<option>").val(data[i].exam_module_id);
			option.html(data[i].module_name);
			if (add == 0) {
				option.attr("selected", true);
			}
			$("#exam_subject").append(option);
			add++;
		}
	}
	add = 0;
	var module_id = $("#exam_subject").find("option:selected").val();
	for (var i = 0; i < data.length; i++) {
		if (data[i].exam_module_id == module_id) {
			var option = $("<option>").val(data[i].exam_id);
			option.html(data[i].exam_name);
			if (add == 0) {
				option.attr("selected", true);
			}
			$("#exam_name").append(option);
			add++;
		}
	}
	add = 0;
	var exam_id = $("#exam_name").find("option:selected").val();
	for (var i = 0; i < data.length; i++) {
		if (data[i].exam_id == exam_id) {
			//开始时间
			var option_bgT = $("<option>").val(data[i].exam_begin_time);
			option_bgT.html(data[i].exam_begin_time);
			if (add == 0) {
				option_bgT.attr("selected", true);
			}
			$("#exam_start").append(option_bgT);
			//结束时间
	
			var option_enT = $("<option>").val(data[i].exam_end_time);
			option_enT.html(data[i].exam_end_time);
			if (add == 0) {
				option_enT.attr("selected", true);
			}
			$("#exam_end").append(option_enT);
			//考试时长
			var option_durT = data[i].exam_duration_time;
			if (add == 0) {
				$("#test_duration").val(option_durT);
			}
	
			//考试状态
			var start = $("#exam_start").find("option:selected").val();
			var end = $("#exam_end").find("option:selected").val();
	
			if (start == data[i].exam_begin_time && end == data[i].exam_end_time) {
				var exam_state = data[i].is_end;
				var exam_desc = exam_state == 0 ? "考试未完成" : "已完成";
				$("#exam_status").val(exam_desc);
			}
			add++;
		}
	}

}
