<?php
//访问考试，考生已作答的题目，考生答案
//session  返回已经定义的session的元素
$load_addition_page_now = isset($_POST["load_addition_page_now"]) ? $_POST["load_addition_page_now"] : null;
if ($load_addition_page_now !== null) {
	session_start();
	if (isset($_SESSION["addition"])) {
		for ($i = 0; $i < count($_SESSION["addition"]); $i++) {
			if ($_SESSION["addition"][$i]["page_now"] == $load_addition_page_now) {
				echo json_encode($_SESSION["addition"][$i]);
			}
		}
	}
}

//session  返回已经定义的session的元素
/*返回附加题答案
 */
$load_user_page_now = isset($_POST["load_user_page_now"]) ? $_POST["load_user_page_now"] : null;
$load_user_ques_num = isset($_POST["load_user_ques_num"]) ? json_decode($_POST["load_user_ques_num"]): null;
if ($load_user_page_now !== null && $load_user_ques_num !== null) {
	session_start();
	$arr=array();
//	print_r($_SESSION["addition_user_answ"]);
	if (isset($_SESSION["addition_user_answ"])) {
		for ($i = 0; $i < count($_SESSION["addition_user_answ"]); $i++) {
			if ($_SESSION["addition_user_answ"][$i][0] == $load_user_page_now) {
				for ($j = 0; $j < count($_SESSION["addition_user_answ"][$i][1]); $j++) {
					for($q=0;$q<count($load_user_ques_num);$q++){
						if($_SESSION["addition_user_answ"][$i][1][$j][0]==$load_user_ques_num[$q]){
							$_SESSION["addition_user_answ"][$i][1][$j];
							array_push($arr,$_SESSION["addition_user_answ"][$i][1][$j]);
						}
					}
				}
			}
		}
		echo json_encode($arr);
	}
}
