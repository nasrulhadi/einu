<?php
ob_start("ob_gzhandler");
include_once "inc/config.php";
session_start();
$q = mysql_query("select * from website_setting");
$data_setting = mysql_fetch_assoc($q);
$simulate_date = 'on';
?>
