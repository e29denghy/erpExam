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
    <script src="../share/jscripts/timer.js" type="text/javascript"></script> <script type="text/javascript">
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

<div class="try_grading">
	<h1>试判卷</h1>
	<hr/>
	<div>
		<label>科目名称：</label>
		<select>
			<option>科目名称：</option>
			<option>科目名称：</option>
			<option>科目名称：</option>
			<option>科目名称：</option>
		</select>
		<p/>
		<label>测试名称：</label>
		<select>
			<option>测试名称：</option>
			<option>测试名称：</option>
			<option>测试名称：</option>
			<option>测试名称：</option>
		</select>
		<p/>
		<label>开始时间：
</label>
		<select>
			<option>开始时间：</option>
			<option>开始时间：</option>
			<option>开始时间：</option>
			<option>开始时间：</option>
		</select>
		<p/>
		<span class="try_grading_opera">
			<input type="button" value="试判卷" id="try_grading"/>
			<input type="button" value="取消" id="try_grading"/>
			<input type="button" value="导出试判卷成绩" id="try_grading"/>
		</span>
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
	<span class="langselector" title="change language"> 
		<a href="/tcexam-master/tcexam-master/public/code/index.php?lang=ar" class="langselector" title="Arabian">AR</a> | 
		<a href="/tcexam-master/tcexam-master/public/code/index.php?lang=az" class="langselector" title="Azerbaijani">AZ</a> | 
		<a href="/tcexam-master/tcexam-master/public/code/index.php?lang=bg" class="langselector" title="Bulgarian">BG</a> | 
		<a href="/tcexam-master/tcexam-master/public/code/index.php?lang=br" class="langselector" title="Brazilian Portuguese">BR</a> | <span class="selected" title="Chinese">CN</span> | 
		<a href="/tcexam-master/tcexam-master/public/code/index.php?lang=de" class="langselector" title="German">DE</a> | 
		<a href="/tcexam-master/tcexam-master/public/code/index.php?lang=el" class="langselector" title="Greek">EL</a> | 
		<a href="/tcexam-master/tcexam-master/public/code/index.php?lang=en" class="langselector" title="English">EN</a> | 
		<a href="/tcexam-master/tcexam-master/public/code/index.php?lang=es" class="langselector" title="Spanish">ES</a> | <a href="/tcexam-master/tcexam-master/public/code/index.php?lang=fa" class="langselector" title="Farsi">FA</a> | 
		<a href="/tcexam-master/tcexam-master/public/code/index.php?lang=fr" class="langselector" title="French">FR</a> | 
		<a href="/tcexam-master/tcexam-master/public/code/index.php?lang=hi" class="langselector" title="Hindi">HI</a> | 
		<a href="/tcexam-master/tcexam-master/public/code/index.php?lang=he" class="langselector" title="Hebrew">HE</a> | 
		<a href="/tcexam-master/tcexam-master/public/code/index.php?lang=hu" class="langselector" title="Hungarian">HU</a> | 
		<a href="/tcexam-master/tcexam-master/public/code/index.php?lang=id" class="langselector" title="Indonesian">ID</a> | 
		<a href="/tcexam-master/tcexam-master/public/code/index.php?lang=it" class="langselector" title="Italian">IT</a> | 
		<a href="/tcexam-master/tcexam-master/public/code/index.php?lang=jp" class="langselector" title="Japanese">JP</a> | 
		<a href="/tcexam-master/tcexam-master/public/code/index.php?lang=mr" class="langselector" title="Marathi">MR</a> | 
		<a href="/tcexam-master/tcexam-master/public/code/index.php?lang=ms" class="langselector" title="Malay (Bahasa Melayu)">MS</a> | 
		<a href="/tcexam-master/tcexam-master/public/code/index.php?lang=nl" class="langselector" title="Dutch">NL</a> | 
		<a href="/tcexam-master/tcexam-master/public/code/index.php?lang=pl" class="langselector" title="Polish">PL</a> | 
		<a href="/tcexam-master/tcexam-master/public/code/index.php?lang=ro" class="langselector" title="Romanian">RO</a> | 
		<a href="/tcexam-master/tcexam-master/public/code/index.php?lang=ru" class="langselector" title="Russian">RU</a> | 
		<a href="/tcexam-master/tcexam-master/public/code/index.php?lang=tr" class="langselector" title="Turkish">TR</a> | 
		<a href="/tcexam-master/tcexam-master/public/code/index.php?lang=vn" class="langselector" title="Vietnamese">VN</a>
	</span> 
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