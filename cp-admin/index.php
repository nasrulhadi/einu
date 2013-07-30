<!DOCTYPE HTML PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><head>
<meta http-equiv="content-type" content="text/html; charset=ISO-8859-1">
<title>Login administator | Juaraliga.com</title>
<link rel="stylesheet" type="text/css" href="styles/login-box.css">
</head><body background="images/bg.jpg">

<form method="POST" action="cek.php">
<div style="padding: 100px 0pt 0pt 400px;">
<div id="login-box">

<h2>Login</h2>
<br />
<?
if(($_GET['login'])=="failed"){?>
	Login gagal <br /> mohon periksa username dan password dan coba lagi...
<? }
if(isset($_GET['logout'])){?>
	Terima kasih untuk menggunakan halaman administrasi.
<? }
?>
<?
if(($_GET['masuk'])=="belum"){?>
	Silahkan masukan username dan password untuk melanjutkan
<? }
?><br><br>
Silakan masukkan Username dan Password Anda!
<br>
<br>
<div id="login-box-name" style="margin-top: 20px;">Username :</div><div id="login-box-field" style="margin-top: 20px;"><input name="username" class="form-login" title="Username" size="30" maxlength="2048" id="uname"></div>
<div id="login-box-name">Password :</div><div id="login-box-field"><input name="password" class="form-login" title="Password" value="" size="30" maxlength="2048" id="pass" type="password"></div>
<br>
<br>
<br>
<input name="login" value="Login" id="submit" src="images/login-btn.png" type="image">
</div>
</div>
</form>

</body></html>
