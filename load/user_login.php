<?php

session_start();

//0813-870-18-711

include "../inc/config.php";

$username = mysql_real_escape_string(htmlspecialchars(stripslashes(strip_tags($_POST['username']))));

$password = mysql_real_escape_string(htmlspecialchars(stripslashes(strip_tags($_POST['password']))));

$login = $_POST['login'];



if (ISSET($username)){

	$query_login = mysql_query("select * from user where username='$username' and password='$password'") or die(mysql_error());

	$cek_user = mysql_num_rows($query_login);

	$fd = mysql_fetch_array($query_login);

	if ($cek_user >= 1){
		$_SESSION['username_user'] = $username;
		$_SESSION['user_type'] = $fd['user_type'];
		if($fd['user_type'] == 'user'){
			$qr = mysql_query("select * from user inner join distributor on user.distributor_id=distributor.id_distributor where username='$username' and password='$password'");
			$gr = mysql_fetch_array($qr);
			$_SESSION['default_region'] = $gr['group'];
		} else {
			$_SESSION['default_region'] = $fd['asm_default_region'];
		}
		$succ_mess =  "<div class=\"success\">Login berhasil...<script type='text/javascript'>window.location='index.php'</script></div>";

	} else {

		$succ_mess = "<div class=\"error\">login gagal...</div>";

	}

}

echo $succ_mess;

?>

