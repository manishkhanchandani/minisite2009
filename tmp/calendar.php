<?
$month = 07+1; //calendar for july, 06
$year = 2006;
$total_days = date("t",strtotime("{$month}/0/{$year}"));
$dates = array_fill(1, date("w", strtotime("{$month}/01/{$year}"))+1,"&");
$week_days = array( "<b>sun</b>",
"<b>mon</b>", "<b>tue</b>",
"<b>wed</b>",
"<b>thu</b>","<b>fri</b>",
"<b>sat</b>");
$days=array_merge($week_days, $dates);
$days = array_merge($days, range(1, $total_days));
$smarty->assign("dates", $days);
$smarty->display("tmp/calendar.html");
exit;
?>