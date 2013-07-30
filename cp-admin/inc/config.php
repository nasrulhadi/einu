<?php
error_reporting(0);
$hostsql = "localhost";
$usernamesql = "kinglife_king";
$passwordsql = "omgking";
$databasename = "kinglife_king";
$connection = mysql_connect($hostsql, $usernamesql, $passwordsql) or die("Kesalahan Koneksi ... !!");
mysql_select_db($databasename, $connection) or die("Databasenya Error");
?>
