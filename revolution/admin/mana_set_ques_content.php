<?php

	require_once('../../admin/config/tce_config.php');

	$pagelevel = K_AUTH_ADMIN_MODULES;
	require_once('../../shared/code/tce_authorization.php');
	require_once('../../admin/code/tce_page_header.php');
?>
<!--
	body 部分
-->
<div style="width: 994px; margin: 50px 0px 10px 80px;">
	<h1 style="margin: 30px;">管理组卷策略</h1>
	<hr/>
    <?php include "ajax_set_ques_content.php"; ?>
</div>

<?php 
	require_once('../../admin/code/tce_page_footer.php');
?>