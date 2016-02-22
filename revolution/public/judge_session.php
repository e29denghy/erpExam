<?php
/*
 * 获得判分后的session
 */
session_start();
$judge_page_now = isset($_REQUEST["judge_page_now"]) ? $_REQUEST["judge_page_now"] : null;
$judge_repeat_id = isset($_REQUEST["judge_repeat_id"]) ? $_REQUEST["judge_repeat_id"] : null;
if (isset($judge_page_now) && isset($_SESSION["judge"]) && isset($judge_repeat_id)) {
	for ($i = 0; $i < count($_SESSION["judge"]); $i++) {
		if ($_SESSION["judge"][$i][0] == $judge_page_now && $_SESSION["judge"][$i][1] == $judge_repeat_id) {
			echo json_encode($_SESSION["judge"][$i][2]);
		}
	}
}
