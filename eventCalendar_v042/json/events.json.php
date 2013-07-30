<?php
header('Content-type: text/json');
include "../../inc/config.php";
echo '[';
$separator = "";
$days = 16;
$q = mysql_query("select * from event");
$tot_row = mysql_num_rows($q);
$cnt = 0;
while ($data = mysql_fetch_array($q)){
	$cnt++;
	echo '{ "date": "'; echo strtotime($data['event_date'])*1000; echo '", "type": "meeting", "title": "'.$data['event_title'].'", "url": "#","description": "'.$data['event_desc'].'" }';
	if ($cnt != $tot_row){ echo ","; }
} 
echo ']';
?>