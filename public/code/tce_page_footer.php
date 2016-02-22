<?php

/**
 */

echo K_NEWLINE;
echo '</div>'.K_NEWLINE; //close div.body

include('../../shared/code/tce_page_userbar.php'); // display user bar

echo '<!-- '.base64_decode(K_KEY_SECURITY).' -->'.K_NEWLINE;
echo '</body>'.K_NEWLINE;
echo '</html>';

//============================================================+
// END OF FILE
//============================================================+
