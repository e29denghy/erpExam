<?php

// IMPORTANT: DO NOT REMOVE OR ALTER THIS PAGE!

// skip links
echo '<div class="minibutton" dir="ltr">'.K_NEWLINE;
echo '<a href="#timersection" accesskey="3" title="[3] '.$l['w_jump_timer'].'" class="white">'.$l['w_jump_timer'].'</a> <span style="color:white;">|</span>'.K_NEWLINE;
echo '<a href="#menusection" accesskey="4" title="[4] '.$l['w_jump_menu'].'" class="white">'.$l['w_jump_menu'].'</a>'.K_NEWLINE;
echo '</div>'.K_NEWLINE;

echo '<div class="userbar">'.K_NEWLINE;
if ($_SESSION['session_user_level'] > 0) {
	// display user information
	echo '<span title="'.$l['h_user_info'].'">'.$l['w_user'].': '.$_SESSION['session_user_name'].'</span>';
	// display logout link
	echo ' <a href="../../admin/code/tce_logout.php" class="logoutbutton" title="'.$l['h_logout_link'].'">'.$l['w_logout'].'</a>'.K_NEWLINE;
} else {
	// display login link
	echo ' <a href="../../admin/code/tce_login.php" class="loginbutton" title="'.$l['h_login_button'].'">'.$l['w_login'].'</a>'.K_NEWLINE;
}
echo '</div>'.K_NEWLINE;
echo '<div class="minibutton" dir="ltr">';
echo '<span class="copyright"><a href="#">EXAMOL</a> ver.Fexam V0.1 - Copyright &copy; 2015-  - <a href="#">TEAM-全林聪  陶灿峰 林琳</a></span>';
echo '</div>'.K_NEWLINE;

//============================================================+
// END OF FILE
//============================================================+
