<?php
session_start();
include_once "../inc/config.php";
$username   = mysql_real_escape_string($_POST['username']);
$password 	= mysql_real_escape_string($_POST['password']);
$sql_cek = "SELECT * FROM _admin_login WHERE _username='$username' AND _password='$password'";
$qry_cek = mysql_query($sql_cek) or die ("Gagal Cek".mysql_error());
$ada_cek = mysql_num_rows($qry_cek);
if ($ada_cek >=1){
	// secure session
	$_SESSION['username'] = $username ;
	$_SESSION['useragent'] = md5($_SERVER['HTTP_USER_AGENT']);
	header("location:admin.php");
}
else {
	header("location:index.php?login=failed");
}
?>
