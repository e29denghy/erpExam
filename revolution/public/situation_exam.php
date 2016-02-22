<?xml version="1.0" encoding="UTF-8" ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="CN" lang="CN" dir="ltr">
<head>
<title>测验列表</title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<meta name="language" content="CN" />
<meta name="tcexam_level" content="1" />
<meta name="description" content="[TCExam] 这是考试系统的主页，从这个页面你可以开始或继续你的测验 [TCExam (c) 2004-2008 Nicola Asuni - Tecnick.com s.r.l. - www.tcexam.com]" />
<meta name="author" content="nick"/>
<meta name="reply-to" content="" />
<meta name="keywords" content="TCExam, eExam, e-exam, web, exam" />
<link rel="stylesheet" href="../share/styles/default.css" type="text/css" />
<link rel="stylesheet" href="../share/styles/flw_mDefault.css" type="text/css" />
<link rel="shortcut icon" href="./favicon.ico" />
    <script src="../share/jscripts/jquery-1.7.2.min.js"></script>
<script src="../share/jscripts/exam_event.js"></script>
</head>
<body>
<div class="header">
  <div class="left"></div>
  <div class="right"> <a name="timersection" id="timersection"></a>
    <form action="/tcexam-master/tcexam-master/public/code/index.php" id="timerform">
      <div>
        <label for="timer" class="timerlabel">时间:</label>
        <input type="text" name="timer" id="timer" value="" size="29" maxlength="29" title="时间/计时器" readonly="readonly"/>
        &nbsp;</div>
    </form>
    <script src="../share/jscripts/timer.js" type="text/javascript"></script> 
    <script type="text/javascript">
//<![CDATA[
FJ_start_timer(false, 1427077579, '对不起，测验时间已到', false, 1427077579489);
//]]>
</script> 
  </div>
</div>
<div id="scrollayer" class="scrollmenu"> 
  <!--[if lte IE 7]>
<style type="text/css">
ul.menu li {text-align:left;behavior:url("../../shared/jscripts/IEmen.htc");}
ul.menu ul {background-color:#003399;margin:0;padding:0;display:none;position:absolute;top:20px;left:0px;}
ul.menu ul li {width:200px;text-align:left;margin:0;}
ul.menu ul ul {display:none;position:absolute;top:0px;left:190px;}
</style>
<![endif]--> 
  <a name="menusection" id="menusection"></a>
  <div class="hidden"><a href="#topofdoc" accesskey="2" title="[2] 跳过导航菜单">跳过导航菜单</a></div>
  <ul class="menu">
    <li><span class="active">主页</span></li>
    <li><a href="tce_test_allresults.php" title="用户成绩" accesskey="r">成绩</a></li>
    <li><a href="tce_page_user.php" title="用户" accesskey="u">用户</a> 
      <!--[if lte IE 6]><iframe class="menu"></iframe><![endif]-->
      <ul>
        <li><a href="tce_user_change_email.php" title="修改邮箱">修改邮箱</a></li>
        <li><a href="tce_user_change_password.php" title="修改密码">修改密码</a></li>
      </ul>
    </li>
    <li><a href="../../admin/code/index.php" title="管理区" accesskey="a">后台</a></li>
    <li><a href="tce_logout.php" title="在本链接上点击退出系统（会话结束）" accesskey="q">注销</a></li>
  </ul>
</div>
<div class="situation_exam">
	<h1>试卷作答情况</h1>
	<hr/>
	<div class="situation_table">

		<label>序号：</label><input type="text" readonly="readonly" value="" size="8"/>
		<label>作答情况：</label><input type="text" readonly="readonly" value="" size="8"/>
		<p/>

		<div class="row">
			<span class="label">
				<label for="test_name" title="测验名称">题目内容：</label>
			</span>
			<span class="formw">
				<p>
				1、（试题题干描述：）XX年xx月xx
				日，向xx公司提出采购意向，采购xx
				原料xx数量，我司报价xx元/件；xx月
				xx日，xx公司同意我司采购请求，但
				单价调整为xx元。双方于xx月xx日签
				订采购订单……</p>
			</span>
		</div>
		<div class="row">
			<span class="label">
				<label for="test_name" title="测验名称">标准答案：</label>
			</span>
			<span class="formw">
				<table class="site_block">
					<tr>
						<td >步骤1</td>
						<td>
							<span>角色：</span>2级工程师<br/>
							<span>操作：</span>扫描<br/>
							<span>单据：</span>验货单<br/>	
						</td>
					</tr>	
					<tr>
						<td>步骤1</td>
						<td>
							<span>角色：</span>2级工程师<br/>
							<span>操作：</span>扫描<br/>
							<span>单据：</span>验货单<br/>	
						</td>
					</tr>
					<tr>
						<td>步骤1</td>
						<td>
							<span>角色：</span>2级工程师<br/>
							<span>操作：</span>扫描<br/>
							<span>单据：</span>验货单<br/>	
						</td>
					</tr>
				</table>		
			</span>
		</div>

		<div class="row">
			<span class="label">
				<label for="test_name" title="测验名称">考生答案：</label>
			</span>
			<span class="formw">
				<table class="site_block">
					<tr>
						<td>步骤1</td>
						<td>
							<span>角色：</span>2级工程师<br/>
							<span>操作：</span>扫描<br/>
							<span>单据：</span>验货单<br/>	
						</td>
					</tr>	
					<tr>
						<td>步骤2</td>
						<td>
							<span>角色：</span>2级工程师<br/>
							<span>操作：</span>扫描<br/>
							<span>单据：</span>验货单<br/>	
						</td>
					</tr>
					<tr>
						<td>步骤3</td>
						<td>
							<span>角色：</span>2级工程师<br/>
							<span>操作：</span>扫描<br/>
							<span>单据：</span>验货单<br/>	
						</td>
					</tr>
				</table>		
			</span>
		</div>
			
	</div>
	
</div>


<div class="minibutton" dir="ltr"> 
	<a href="#timersection" accesskey="3" title="[3] 跳到时间/计时器" class="white">跳到时间/计时器</a> 
	<span style="color:white;">|</span> 
	<a href="#menusection" accesskey="4" title="[4] 跳到导航菜单" class="white">跳到导航菜单</a> 
</div>

<div class="userbar"> 
	<span title="显示已连接用户的相关信息">用户: admin</span> 
	<a href="tce_logout.php" class="logoutbutton" title="在本链接上点击退出系统（会话结束）">注销</a> 
</div>


<div class="minibutton" dir="ltr">
	<span class="copyright">
		<a href="http://www.tcexam.org">TCExam</a> ver. 12.1.024 - Copyright &copy; 2004-2014 Nicola Asuni - <a href="http://www.tecnick.com">Tecnick.com LTD</a>
	</span>
</div>
<div class="minibutton" dir="ltr"> 
	<a href="http://validator.w3.org/check?uri=http://localhost/tcexam-master/tcexam-master/public/code/index.php" class="minibutton" title="This Page Is Valid XHTML 1.0 Strict!">W3C <span>XHTML 1.0</span>
	</a> 
		<span style="color:white;">|</span> 
	<a href="http://jigsaw.w3.org/css-validator/" class="minibutton" title="This document validates as CSS!">W3C 
		<span>CSS 2.0</span>
	</a> 
	<span style="color:white;">|</span> 
	<a href="http://www.w3.org/WAI/WCAG1AAA-Conformance" class="minibutton" title="Explanation of Level Triple-A Conformance">W3C 
		<span>WAI-AAA</span>
	</a> 
</div>
</body>
</html>