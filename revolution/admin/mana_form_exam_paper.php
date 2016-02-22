<?php
	require "../share/function/sqlHelper.php";
	require "../admin/function_get_selectlist.php";
	require "../admin/function_handle_paper.php";

	require_once('../../admin/config/tce_config.php');

	$pagelevel = K_AUTH_ADMIN_MODULES;
	require_once('../../shared/code/tce_authorization.php');
	require_once('../../admin/code/tce_page_header.php');


	if(isset($_POST['make_paper']))
	{
		$testID=$_POST['test_list'];
		$paperCount=$_POST['paper_count'];
		$mpstrategyID=$_POST['mpstrategy'];
		if($testID=="")
		{
			echo "<script>alert('请选择测验！');</script>";
		}
		else if($mpstrategyID==""&&$_POST['mps_id']=="")
		{
			echo "<script>alert('请选择组卷策略！');</script>";
		}
		else if($paperCount=="")
		{
			echo "<script>alert('请填写组卷套数！');</script>";
		}
		else if(!isset($_POST['no_diff']))
		{
			echo "<script>alert('请选择组卷时是否忽略难度！');</script>";
		}
		else if($paperCount=="new")
		{
			if(!is_numeric($_POST['add_paper']))
				echo "<script>alert('增加套数必须为数字！');</script>";
			else
			{
				$result=makePaper($testID,$_POST['mps_id'],$_POST['add_paper'],$_POST['no_diff']);
				if($result==-1)
					echo "<script>alert('题库试题不足，请添加试题！');</script>";	
				else
					echo "<script>alert('成功增加".$result."套试卷！');</script>";	
			}
			
		}
		else if(!is_numeric($paperCount))
		{
			echo "<script>alert('组卷套数必须为数字！');</script>";
		}
		else if(!isset($_POST['no_diff']))
		{
			echo "<script>alert('请选择组卷时是否忽略难度！');</script>";
		}
		else
		{
			$result=makePaper($testID,$mpstrategyID,$paperCount,$_POST['no_diff']);
			if($result==-1)
				echo "<script>alert('题库试题不足，请添加试题！');</script>";	
			else
				echo "<script>alert('成功生成".$result."套试卷！');</script>";			
		}
		echo "<script>window.location.href='".basename($_SERVER['PHP_SELF'])."'</script>";
	}
	if(isset($_POST['backTest']))
	{
		echo "<script>window.location.href='../admin/mana_consitu_paper.php'</script>";
	}
?>

<!--
 
	body 部分
 
-->
<div class="form_exam_paper">
	<h1>组卷</h1>
	<hr/>
    <?php
		$testInfor=getTest();//获取测验信息
		$paperInfor=getPaperInfor();//获取测验已经组好试卷的套数
		$mpstrategy=getMpstrategy();//获取组卷策略信息
	?>
	<form method="post" name="form1" action="">
		<div class="row">
				<span class="label">
					<label>测验名称：</label>
				</span>
				<span class="formw">
					<select style="width:154px;" id="test_list" name="test_list" onchange="javascript:getPaperInfor()">
                    <option></option>
			 		<?php
						foreach($testInfor as $row)
						{
							echo "<option value='".$row['test_id']."'>".$row['test_id']." ".$row['test_name']."</option>";
						}
					?>
			 		</select>
			 	</span>
		 </div>
         <div class="row">
				<span class="label">
					<label>组卷策略：</label>
				</span>
				<span class="formw">
					<select style="width:154px;" name="mpstrategy" id="mpstrategy" onchange="javascript:getMPS()">
                    <option value=""></option>
                    <?php
						$i=0;
						$mpstrategy_id=array();
						foreach($mpstrategy as $row)
						{
							$mpstrategy_id[$i]=$row['mpstrategy_id'];
							$i++;
						}
						$mpstrategy_id=array_unique($mpstrategy_id);
						//var_dump($mpstrategy_id);
						foreach($mpstrategy_id as $row)
						{
							echo "<option value='".$row."'>".$row."</option>";
						}
					?>
			 		</select>
                    <input type="text" name="mps_id" id="mps_id" style="display:none;width:150px;" readonly="readonly" />
                    &nbsp;<a href="javascript:displayMpstrategy();" id="dispMPS">查看</a>
                    <a href="javascript:hideMpstrategy();" style="display:none;" id="hideMPS">隐藏</a>&nbsp;|&nbsp;
                    <a href="mana_set_ques_content.php">管理组建策略</a>
			 	</span>
		 </div>
         <div align="center">
         	<table frame="box" cellpadding="4" id="mpstrategy_table" border="1px solid" cellspacing="0" bordercolor="#CCCCFF" style="margin-bottom:20px; color:#003399;display:none; text-align:center;" width="800px">
                <tr>
                    <th rowspan="2">科目</th>
                    <th rowspan="2">章节</th>
                    <th colspan="3">流程题</th>
                    <th colspan="3">理论题</th>
                    <th rowspan="2">题目挑选顺序</th>
                    <th rowspan="2">选择题选项顺序</th>
                </tr>
                <tr>
                    <th>数量</th>
                    <th>难度</th>
                    <th>分值（%）</th>
                    <th>数量</th>
                    <th>难度</th>
                    <th>分值（%）</th>
                </tr>
             </table>
         </div>
		 <div class="row">
				<span class="label">
					<label>组卷套数：</label>
				</span>
				<span class="formw">
					<input type="text" id="paper_count" name="paper_count" style="width:150px;"/>
                    &nbsp;<a href="javascript:displayAddPaper();" id="add_paper">增加</a>
                    <a href="javascript:hideAddPaper();" id="cancel_add" style="display:none;">取消</a>&nbsp;|&nbsp;
                    <a onclick="return paperClick()" class="managePaper" >管理已组试卷</a>
			 	</span>
		 </div>
         <div class="row" style="display:none;" id="addPaper">
				<span class="label">
					<label>增加套数：</label>
				</span>
				<span class="formw">
					<input type="text"  name="add_paper" style="width:150px; " />
			 	</span>
		 </div>
         <div class="row">
				<span class="label">
					<label>忽略难度：</label>
				</span>
				<span class="formw">
					<input type="radio" name="no_diff" value="1" />是
                    <input type="radio" name="no_diff" value="0" />否
			 	</span>
		 </div>
         <br />
		 <div class="form_exam_opera">
			 <input type="submit" value="开始组卷" name="make_paper" id="make_paper" />&nbsp;
			 <input type="submit" name="backTest" value="返回" />
		</div>
	</form>
</div>
<?php 
	require_once('../../admin/code/tce_page_footer.php');
?>
<script src="../share/jscripts/jquery-1.7.2.min.js" type="text/javascript" charset="utf-8">
</script>
<script type="text/javascript">
	function paperClick(){
    	var test_id=$("#test_list").find("option:selected").val();
    	
    	if(test_id!==null){
    		$(".managePaper").attr("href","paper_question_manage.php?test_id="+test_id);
    		return true;
    	}
    		return false;		
    }
	function getPaperInfor()
	{//获取试卷信息
		var paperInfor=<?php echo json_encode($paperInfor);?>;
		var test_id=document.getElementById("test_list").value;
		var paper_count=0;
		var mpstrategy_id=null;
		for(var row in paperInfor)
		{
			if(paperInfor[row]['test_id']==test_id)
			{
				paper_count=paperInfor[row]['paper_count'];
				mpstrategy_id=paperInfor[row]['mpstrategy_id'];
				break;
			}
		}
		if(paper_count==0)
		{
			document.getElementById("mpstrategy").style.display="";
			document.getElementById("paper_count").value="";
			document.getElementById("paper_count").readOnly=false;
			document.getElementById("mpstrategy").value='';
			document.getElementById("mps_id").style.display="none";
			document.getElementById("make_paper").disabled="";
			hideAddPaper()
		}
		else
		{
			document.getElementById("paper_count").value=paper_count;
			document.getElementById("paper_count").readOnly=true;
			document.getElementById("mpstrategy").style.display="none";
			document.getElementById("mps_id").style.display="";
			document.getElementById("mps_id").value=mpstrategy_id;
			document.getElementById("make_paper").disabled="disabled";
		}
	}
	
	function displayMpstrategy()
	{//显示组卷策略
		var mpstrategy=document.getElementById("mpstrategy").value;
		if(mpstrategy=="")
		{
			alert("请选择组卷策略");
		}
		else
		{
			document.getElementById("mpstrategy_table").style.display="";
			document.getElementById("dispMPS").style.display="none";
			document.getElementById("hideMPS").style.display="";
		}
	}
	function hideMpstrategy()
	{//隐藏组卷策略
		document.getElementById("mpstrategy_table").style.display="none";
		document.getElementById("dispMPS").style.display="";
		document.getElementById("hideMPS").style.display="none";
	}
	function displayAddPaper()
	{//显示增加试卷		
		if(document.getElementById("paper_count").readOnly==false)
		{
			alert("非法操作！");
		}
		else
		{
			document.getElementById("addPaper").style.display="";
			document.getElementById("add_paper").style.display="none";
			document.getElementById("cancel_add").style.display="";
			document.getElementById("paper_count").value="new";
			document.getElementById("make_paper").disabled="";
		}
	}
	function hideAddPaper()
	{//隐藏增加试卷
		document.getElementById("addPaper").style.display="none";
		document.getElementById("add_paper").style.display="";
		document.getElementById("cancel_add").style.display="none";
		getPaperInfor();
	}
	function getMPS()
	{//获取组卷策略信息
		var mpstrategy=document.getElementById("mpstrategy").value;
		if(mpstrategy=="")
		{
			alert("请选择组卷策略");
		}
		else
		{
			var mpsInfor=<?php echo json_encode($mpstrategy);?>;
			var mpsTable=document.getElementById("mpstrategy_table");
			var rowCount=mpsTable.rows.length;
			while(rowCount>2)
			{
				mpsTable.deleteRow(rowCount-1);
				rowCount--;
			}
			for(var row in mpsInfor)
			{
				if(mpsInfor[row]['mpstrategy_id']==mpstrategy)
				{
					mpsTable.insertRow();
					rowIndex=mpsTable.rows.length-1;
					mpsTable.rows[rowIndex].insertCell(0).innerHTML=mpsInfor[row]['module_name'];
					mpsTable.rows[rowIndex].insertCell(1).innerHTML=mpsInfor[row]['subject_name'];
					mpsTable.rows[rowIndex].insertCell(2).innerHTML=mpsInfor[row]['subject_flow_num'];
					mpsTable.rows[rowIndex].insertCell(3).innerHTML=mpsInfor[row]['subject_flow_difficulty'];
					mpsTable.rows[rowIndex].insertCell(4).innerHTML=mpsInfor[row]['subject_flow_score'];
					mpsTable.rows[rowIndex].insertCell(5).innerHTML=mpsInfor[row]['subject_concept_num'];
					mpsTable.rows[rowIndex].insertCell(6).innerHTML=mpsInfor[row]['subject_concept_difficulty'];
					mpsTable.rows[rowIndex].insertCell(7).innerHTML=mpsInfor[row]['subject_concept_score'];
					mpsTable.rows[rowIndex].insertCell(8).innerHTML=mpsInfor[row]['subject_question_select_order']==1?"顺序":"随机";
					mpsTable.rows[rowIndex].insertCell(9).innerHTML=mpsInfor[row]['subject_selectoptions_order']==1?"顺序":"随机";
				}
			}
		}
	}
</script>