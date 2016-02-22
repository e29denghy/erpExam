<?php
/*-----------------------------------------
理论题考试界面
-----------------------------------------*/
header("Content-type:text/html;charset=utf-8");
require_once('../../public/config/tce_config.php');
require_once('../../shared/code/tce_authorization.php');
require_once('../../public/code/tce_page_header.php');
require_once('../share/function/function_consi_ques.php');
require_once('../share/function/sqlHelper.php');
require_once('./public_ajax.php');
?>

<?	
require_once('../../public/code/tce_page_footer.php');
?>