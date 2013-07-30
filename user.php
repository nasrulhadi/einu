<?php

include "inc/head.php";

if ($_GET['act'] == "logout"){

	session_destroy();

	header("location: index.php");

}

if (!isset($_SESSION['username_user'])){

	session_destroy();

	header("location: index.php");

}

// some conf of functional

$month = 'february'; //strtolower(date("F"));

$bigmonth = strtoupper($month);

$year = '2013'; //date("Y");

$dist_group = mysql_real_escape_string($_GET['gid']);

$prev_month = strtolower(date('F',strtotime($month.' - 1 month')));



$kirim = $_POST['submit'];

if (ISSET($kirim)){

	require 'captcha/securimage.php';

	$img = new Securimage();

	$valid = $img->check($_POST['ct_captcha']);

	$nowpassword = mysql_real_escape_string($_POST['nowpassword']);

	$newpassword = mysql_real_escape_string($_POST['newpassword']);

	$retype_newpassword = mysql_real_escape_string($_POST['retype_newpassword']);

	if ($valid == true){

		$cq = mysql_query("select * from user where username='{$_SESSION['username_user']}' and password='$nowpassword'");

		$cr = mysql_num_rows($cq);

		if ($cr == 0){

			$succ_mess = "<div class='warning'>Password sekarang yang anda masukan tidak cocok dengan database kami.</div>";

		} else if ($newpassword != $retype_newpassword){

			$succ_mess = "<div class='warning'>Password baru anda tidak sama.</div>";

		} else {

			$qc = mysql_query("UPDATE  `user` SET  `password` =  '$newpassword' WHERE  `user`.`username` ='{$_SESSION['username_user']}' LIMIT 1");

		$succ_mess = "<div class='success'>Password anda telah berhasil di ganti.</div>";

		}

	} else if ($valid == false){

		$succ_mess = "<div class='warning'>Maaf, kode verifikasi salah</div>";

	}

}

if (ISSET($_GET['ref'])){

	$reff = mysql_real_escape_string($_GET['ref']);

	$comm_ref = mysql_query("select * from _member_network where _username = '$reff'") or die("error");

	$ceking = mysql_num_rows($comm_ref);

	if ($ceking == 1){

		$_SESSION['referer'] = $reff;

	}

}



?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<head>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<title>Juaraliga.com | Contact Us</title>

<link rel="stylesheet" type="text/css" href="style.css"/>

<script type="text/javascript" src="js/jquery-1.8.1.min.js"></script>

<script src="js/jquery.countdown.min.js" type="text/javascript" charset="utf-8"></script>

<script src="js/cufon-yui.js" type="text/javascript"></script>

<script src="js/cufon-replace.js" type="text/javascript"></script>
<script src="js/myriad-pro.cufonfonts.js" type="text/javascript"></script>
<script src="js/script.js" type="text/javascript"></script>

<script src="js/nasa_400.font.js" type="text/javascript"></script>

<script src="js/myriad_400.font.js" type="text/javascript"></script>

<link href="reset-min.css" rel="stylesheet" type="text/css" />

<link rel="stylesheet" type="text/css" href="styles/examples.css">

<link rel="stylesheet" type="text/css" href="styles/icon-style.css">

<!-- Core CSS File. The CSS code needed to make eventCalendar works -->

<link rel="stylesheet" href="eventCalendar_v042/css/eventCalendar.css">

<!-- Theme CSS file: it makes eventCalendar nicer -->

<link rel="stylesheet" href="eventCalendar_v042/css/eventCalendar_theme_responsive.css">

<script src="eventCalendar_v042/js/jquery.eventCalendar.js" type="text/javascript"></script>

<script src="eventCalendar_v042/js/jquery.eventCalendar.js" type="text/javascript"></script>

<script src="__jquery.tablesorter/addons/pager/jquery.tablesorter.pager.js" type="text/javascript"></script>

<script src="__jquery.tablesorter/jquery.tablesorter.js" type="text/javascript"></script>

</head>

<body>

<div id="container-wrapper">

	<div id="header-wrapper">

    </div>

    <div id="content-container">

    	<div id="menu">

        	<div class="menu">

<?php include "inc_page/menu_lst.php"; ?>

            </div>

        </div>

        <div id="content-wrapper">

			<div id="left-col" class="left">

						<div class="title">Ganti Password</div>

						<div id="success_message"><?php echo $succ_mess; ?></div>

			

			<form method="post" action="" id="contact_form">

			

			  <p style="padding-bottom: 10px;">

				<strong>Password sekarang :</strong><br />

				<input type="password" name="nowpassword" id="nowpassword" size="35" value="" /><br />

			  </p>

			

			  <p style="padding-bottom: 10px;">

				<strong>Password baru :</strong><br />

				<input type="password" name="newpassword" id="newpassword" size="35" value="" /><br />

			  </p>

			  

			  <p style="padding-bottom: 10px;">

				<strong>Ulangi password baru :</strong><br />

				<input type="password" name="retype_newpassword" size="35" value="" /><br />

			  </p>

			

			  <p style="padding-bottom: 10px;">

			  <strong>Kode verifikasi :</strong><br />



				<img id="image_captcha" style="border: 1px solid #000; margin-right: 15px" src="captcha/securimage_show.php?sid=<?php echo md5(uniqid(time())); ?>" alt="CAPTCHA Image" align="left" />

				<a href="javascript:void(0);" onclick="document.getElementById('image_captcha').src = 'captcha/securimage_show.php?' + Math.random(); return false" alt="refresh kode" alt="refresh code"><img src="./images/refresh.png" alt="Reload Image" height="32" width="32" onclick="this.blur()" align="bottom" border="0" /></a><br />

				<br />

				<input type="text" name="ct_captcha" size="12" maxlength="8" />

			  </p>

			

			  <p>

				<input type="submit" value="Kirim pesan" name="submit" class="nice_button" />

			  </p>

			

			</form>

			</fieldset><div class="clear"></div>

					  </div>

         

        <div id="right-col" class="right" style="
    padding-top: 51px;
">

<?php include "inc_page/sidebar.php"; ?>

        </div>

    </div>

</div>

</body>

</html>