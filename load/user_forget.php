<?php
session_start();
include "../inc/config.php";
$uoe = mysql_real_escape_string(htmlspecialchars(stripslashes(strip_tags($_POST['uoe']))));
if (ISSET($uoe)){
	$query_login = mysql_query("select * from user where username='$uoe' or email='$uoe'") or die(mysql_error());
	$cek_user = mysql_num_rows($query_login);
	$fd = mysql_fetch_array($query_login);
	if ($cek_user >= 1){
			$qr = mysql_query("select * from user where username='$uoe' or email='$uoe'");
			$gr = mysql_fetch_array($qr);
			$email_message = "<p>
			Halo, ".$gr['username']."!</p>
			<p>
			Berikut detail akun login anda di JuaraLiga.com :<br>
			Username : ".$gr['username']."<br />
			Password : ".$gr['password']."<br /><br />
			
			Jangan lupa untuk mengganti password anda dengan yang baru<br />
			Salam hangat,<br><br>
			
			JuaraLiga.com";
			$mwpclass->send_html_email($name='Password anda di juaraliga.com', $email='no-reply@juaraliga.com', 
			$to_mail=$gr['email'], $subject='Password anda di juaraliga.com', $msg=$email_message);
			$succ_mess =  "<div class=\"success\">Password telah dikirimkan ke email anda.</div>";
	} else {
		$succ_mess = "<div class=\"error\">Username atau Email tersebut tidak terdaftar di database kami.</div>";
	}
}
echo $succ_mess;
?>
