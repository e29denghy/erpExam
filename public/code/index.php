<?php

/**
 */

require_once('../config/tce_config.php');

$pagelevel = K_AUTH_PUBLIC_INDEX;
$thispage_title = $l['t_test_list'];
$thispage_description = $l['hp_public_index'];

require_once('../../shared/code/tce_authorization.php');


require_once('tce_page_header.php');

echo '<div class="container">'.K_NEWLINE;

echo '<div class="tcecontentbox">'.K_NEWLINE;
require_once('../../shared/code/tce_functions_test.php');

echo F_getUserTests();
echo '</div>'.K_NEWLINE;

echo '<div class="pagehelp">'.$thispage_description.'</div>'.K_NEWLINE;

echo '</div>'.K_NEWLINE;

require_once('tce_page_footer.php');

//============================================================+
// END OF FILE
//============================================================+
