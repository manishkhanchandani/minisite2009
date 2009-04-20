<?php

/*========================*\

 * s_TS
 * Written by: AS
 * Mialto: as@twoja-strona.net
 * Date: 2007-09-07

\*========================*/

header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
header('Last-Modified: ' . date('r'));
header('Cache-Control: no-store, no-cache, must-revalidate');
header('Cache-Control: post-check=0, pre-check=0', FALSE);
header('Pragma: no-cache');

header("Content-type: audio/mpeg");
header("Content-Disposition: attachment; filename=\"test2.mp3\"");

include('class.sts.php');

/*========================*\

max length 390 signs
 
You can change it by adding: 
s_TS ($text, $language="eng", $limit=390, $max_str_limit=false)
s_TS ($text, "eng", 1000, false)
Inquiries will be sent in a loop. Received data from the speech will be merged into a single whole.

$language = 'pl_jacek', 'pl_ewa', 'eng', 'rum';

\*========================*/

$text = strip_tags($_GET[txt]);

$s_ts = &new s_TS($text, 'eng');
echo $s_ts->print_bufor();

?>