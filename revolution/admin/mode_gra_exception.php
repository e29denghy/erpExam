<?php
	require "../share/function/sqlHelper.php";
	require "../admin/function_judge_error.php";
		
	require_once('../../admin/config/tce_config.php');

	$pagelevel = K_AUTH_ADMIN_MODULES;
	require_once('../../shared/code/tce_authorization.php');
	require_once('../../admin/code/tce_page_header.php');

?>


<div class="except_face">
	<h1>判卷异常报告</h1>
	<hr/>
    <?php
		$JudgeError=getJudgeError();//获取判卷异常
	?>
    <form method="post">
	<table class="ept_table">
		<tr class="over">
			<td>考试名称</td>
            <td>试卷ID</td>
            <td>题目ID</td>
            <td>题目类型</td>
			<td>考生账号</td>
            <td>出卷老师账号</td>		
			<td>是否已处理</td>			
			<td>处理时间</td>    
 			<td>处理情况</td>
		</tr>
		<?php
			foreach($JudgeError as $row)
			{
				echo "<tr>";
					echo "<td>".$row['exam_name']."</td>";
					echo "<td>".$row['papers_id']."</td>";
					echo "<td>".$row['questions_id']."</td>";
					if($row['questions_type']==1)
						echo "<td>流程题</td>";
					else if($row['questions_type']==2)
						echo "<td>理论题</td>";
					else
						echo  "<td>附加题</td>";
					echo "<td>".$row['student_id']."</td>";
					echo "<td>".$row['teacher_id']."</td>";
					if($row['is_solve']==1)
					{
						echo "<td>是</td>";
						echo "<td>".$row['solve_time']."</td>";
						echo "<td>".$row['solve_remark']."</td>";
					}
					else
					{
						echo "<td>否</td>";
						echo "<td>无</td>";
						echo "<td><input type='button' onclick='error_solve(".$row['error_id'].")' value='处理' /></td>";
					}					
				echo "</tr>";
			}
		?>
	</table>
    </form>
</div>

<?php 
	require_once('../../admin/code/tce_page_footer.php');
?>
<script type="text/javascript">
	function error_solve(error_id)
	{
		window.location.href='mode_handle_excption.php?error_id='+error_id;
	}
</script>