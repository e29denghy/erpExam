<?php
header("Content-type:text/html;charset=utf-8");

require_once('../../admin/config/tce_config.php');

$pagelevel = K_AUTH_ADMIN_MODULES;
require_once('../../shared/code/tce_authorization.php');
require_once('../../admin/code/tce_page_header.php');


require_once("../share/function/sqlHelper.php");
require_once('../share/function/function_consi_ques.php');
?>
<style>
.ui-jqgrid tr.jqgrow td {
	white-space: normal !important;
	height: auto;
	vertical-align: text-top;
	padding: 2px;
	word-break:break-word;
}
</style>
	<body>
		<!--Jquery核心文件引用-->
		<script src="../share/jscripts/jquery-1.9.1.js" type="text/javascript"></script>

		<!--JqueryUI的JS/CSS引用-->
		<script src="../share/jscripts/jquery-ui-1.10.3/ui/jquery-ui.js" type="text/javascript"></script>
		<script src="../share/jscripts/jquery-ui-1.10.3/ui/i18n/jquery.ui.datepicker-zh-CN.js" type="text/javascript"></script>
		<link href="../share/jscripts/jquery-ui-1.10.3/themes/base/jquery-ui.css" rel="stylesheet" type="text/css" />

		<!--jqGrid的JS/CSS引用-->
		<script src="../share/jscripts/jquery.jqGrid-4.5.4/jquery.jqGrid.min.js" type="text/javascript"></script>
		<script src="../share/jscripts/jquery.jqGrid-4.5.4/i18n/grid.locale-cn.js" type="text/javascript"></script>
		<link href="../share/jscripts/jquery.jqGrid-4.5.4/ui.jqgrid.css" rel="stylesheet" type="text/css" />
		<link href="../share/styles/flw_mDefault.css" rel="stylesheet" type="text/css" />
	
		<script type="text/javascript">
			function pageInit() {
				var paper_id=$("#test_number").find("option:selected").val();
				jQuery("#ques_list").jqGrid({
					url:"ajax_paper_question.php?grid_paper_id="+paper_id,
					datatype: "json",
					colNames: ['qId', 'qDescri','qOrder', 'qExplan', 'qDiflt', 'qAvail'],
					colModel : [
                     {name : 'qId',index : 'qId',width : 40,editable:true,align:"center",sorttype : "int"}, 
                     {name : 'qDescri',index : 'qDescri',editable:true, width : 390,sorttype : "date"},
                     {name : 'qOrder',index : 'qOrder',editable:true,align : "center", width : 200}, 
                     {name : 'qExplan',index : 'qExplan',editable:true,align : "center", width : 200}, 
                     {name : 'qDiflt',index : 'qDiflt',editable:true, width : 60,align : "center",sorttype : "float"}, 
                     {name : 'qAvail',index : 'qAvail',editable:true, width : 70,align : "center",sorttype : "float"}, 
                   ],
					multiselect: true,
					caption: "Manipulating Array Data",
					paper: "ques_paper",
					viewrecords: true,
					height:700,
					hidegrid: false,
					pgbutton: true,
					pgtext: true,
					editurl : "ajax_paper_question.php?rowEditing="+paper_id,
				});
				$("#test_number").change(function(){
					var paper_id=$("#test_number").find("option:selected").val();
					$("#ques_list").clearGridData();
					 $("#ques_list").jqGrid("setGridParam", {   
				       url:"ajax_paper_question.php?grid_paper_id="+paper_id   
				    }).trigger('reloadGrid');  
				});
				/*
				 * 点击编辑
				 */
				$(".editRow").click(function() {
					var sel_id=jQuery('#ques_list').jqGrid('getGridParam','selrow');
					jQuery("#ques_list").jqGrid('editRow', sel_id);
					this.disabled = 'true';
				    jQuery(".saveRow,.cancelEdit").attr("disabled", false);
				    jQuery(".saveRow,.cancelEdit").css("background-color", "#4490f7");
				    jQuery(".editRow").css("background-color", "#rgb(189, 212, 243)");
				});
				/*
				 * 保存编辑
				 */
				  jQuery(".saveRow").click(function() {
				  	
				  	var sel_id=jQuery('#ques_list').jqGrid('getGridParam','selrow');
				  	
//				  	var rowdata=jQuery("#ques_list").jqGrid('getRowData',sel_id);
//					ques_id = rowdata["qId"];//列名和jGrid定义时候的值一样

					jQuery("#ques_list").saveRow(sel_id, function(){
				    	alert("添加成功!");
				    	var paper_id=$("#test_number").find("option:selected").val();
						$("#ques_list").clearGridData();
						$("#ques_list").jqGrid("setGridParam", {   
					       url:"ajax_paper_question.php?grid_paper_id="+paper_id   
					    }).trigger('reloadGrid');  
				    }, "ajax_paper_question.php",{test_number:$("#test_number").find("option:selected").val()});
				    jQuery(".saveRow,.cancelEdit").attr("disabled", true);
				    jQuery(".editRow").attr("disabled", false);
				    jQuery(".editRow").css("background-color", "#4490f7");
				    jQuery(".saveRow,.cancelEdit").css("background-color", "rgb(189, 212, 243)");
				  });
				 /*
				 * 取消编辑
				 */ 
				jQuery(".cancelEdit").click(function() {
					var sel_id=jQuery('#ques_list').jqGrid('getGridParam','selrow');
				    jQuery("#ques_list").jqGrid('restoreRow', sel_id);
				    jQuery(".saveRow,.cancelEdit").attr("disabled", true);
				    jQuery(".editRow").attr("disabled", false);
				    jQuery(".editRow").css("background-color", "#4490f7");
				    jQuery(".saveRow,.cancelEdit").css("background-color", "rgb(189, 212, 243)");
				  });
			}
		</script>
		<div class="table-head">
			<h2>查询试卷集</h2>
			<label for="">试卷号</label>
			<select id="test_number">
			</select>
			<button class="deletePaper">删除当前试卷</button>
			<hr/>
			<table id="ques_list"></table>
			<div id="ques_paper"></div>
		</div>
		<button class="editRow">编辑表格</button>
		<button class="saveRow" disabled="disabled">保存编辑</button>
		<button class="cancelEdit" disabled="disabled">取消编辑</button>
		<button class="backup">返回组卷策略</button>
<?php 
	require_once('../../admin/code/tce_page_footer.php');
?>
<script type="text/javascript">
	var test_id=null;
	$(function(){
		test_id=<?php echo json_encode($_REQUEST['test_id']); ?> ;
		load_test_paper();
})
	/*
	 * delete this paper
	 */
	$(".backup").bind("click",function(){
		window.location.href='mana_consitu_paper.php';
	});
	$(".deletePaper").bind("click",function(){
		var paper_id=$("#test_number").find("option:selected").val();
		$.ajax({
		url: 'ajax_paper_question.php', //改为你的动态页
		type: 'POST',
		data: {
			delete_test_id:paper_id
		},
		async: true,
		dataType: "json",
		success: function(data, textStatus, jqXHR) {
			if(data['info']=='success'){
				alert("删除成功！");
				load_test_paper();
			}else if(data['info']=='error'){
				alert("删除失败！");
			}else if(data["info"]=="warning"){
				alert("此试卷已用作考试！");
			}
			
		},
		error: function(xhr) {
			alert('添加失败' + xhr.responseText);
		}
	});
	});
/*
 * 下载
 */
function load_test_paper() {
	$("#test_number").find("option").remove();
	$.ajax({
		url: 'ajax_paper_question.php', //改为你的动态页
		type: 'POST',
		data: {
			test_id:test_id
		},
		async: true,
		dataType: "json",
		success: function(data, textStatus, jqXHR) {
			if(data!==null){
				var option=null;
				for(var i=0;i<data.length;i++){
					option=$("<option>");
					if(i==0){
						option.attr("selected","selected");
					}
					option.val(data[i].paper_id);
					option.html(data[i].paper_id);
					$("#test_number").append(option);
				}
				pageInit();
			}
		},
		error: function(xhr) {
			alert('添加失败' + xhr.responseText);
		}
	});
}

</script>