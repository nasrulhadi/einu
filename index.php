<?php
include "inc/head.php";
if (isset($_SESSION['username_user'])){
	$username = $_SESSION['username_user'];
	$def_reg = $_SESSION['default_region'];
	header("location: home.php");
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Juaraliga.com | S &amp; D champions league</title>
<meta name="keywords" content="<?php echo $data_setting['keyword']; ?>" />
<meta name="classification" content="<?php echo $data_setting['description']; ?>"></meta>
<meta name="description" content="<?php echo $data_setting['description']; ?>" />
<meta name="robots" content="index,follow" /> 
<meta name="googlebot" content="index,follow" /> 
<meta name="language" content="ID_id" /> 
<meta name="author" content="www.mediawebsiteplus.com" /> 
<meta name="revisit-after" content="7 days" /> 
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
<link rel="stylesheet" type="text/css" href="style.css"/>
<script type="text/javascript" src="js/jquery-1.7.2.js"></script>
<script src="http://cdn.jquerytools.org/1.2.7/full/jquery.tools.min.js"></script>
<script src="js/jquery.countdown.min.js" type="text/javascript" charset="utf-8"></script>
<script src="js/cufon-yui.js" type="text/javascript"></script>
<script src="js/cufon-replace.js" type="text/javascript"></script>
<script src="js/script.js" type="text/javascript"></script>
<script src="js/nasa_400.font.js" type="text/javascript"></script>
<script src="js/myriad_400.font.js" type="text/javascript"></script>
<script src="__jquery.tablesorter/addons/pager/jquery.tablesorter.pager.js" type="text/javascript"></script>
<script src="__jquery.tablesorter/jquery.tablesorter.js" type="text/javascript"></script>
<?php if ($data_setting['snow_effect'] == "ya"){?>
<!-- required snowstorm JS, default behaviour -->
<script type="text/javascript" src="snowstormv141_20101113/snowstorm.js"></script>
<!-- now, we'll customize the snowStorm object -->
<script type="text/javascript">
snowStorm.snowColor = '#FFFFFF'; // blue-ish snow!?
snowStorm.flakesMaxActive = 96;  // show more snow on screen at once
snowStorm.useTwinkleEffect = true; // let the snow flicker in and out of view
</script>
<?php } ?>
<link href="reset-min.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css" href="styles/examples.css">
<style type="text/css">body,div {margin: 0;padding: 0;}body {overflow: hidden;width: 100%;height: 100%;background:url(images/bg_body.jpg) repeat-x;background-position: top center !important;}</style>
</head>
<body>
<div id="home-container-wrapper">
<?php
if( strtotime("2013-01-02") > time() ){
?>
	<div class="kickoff">
    	<h1>Kick off on 2 January 2013</h1>
    </div>
    <div id="clock">
	<p>
		<span id="weeks"></span>
		Week
	</p>
  <div class="space">:</div>
      <p>
        <span id="daysLeft"></span>
        DAYS
      </p>
      <div class="space">:</div>
      <p>
        <span id="hours"></span>
        HRS
      </p>
      <div class="space">:</div>
      <p>
        <span id="minutes"></span>
        MNT
      </p>
      <div class="space">:</div>
      <p>
        <span id="seconds"></span>
        SEC
      </p>
    </div>
    
    <div class="fill"></div>
    <?php } ?>
    <div class="loginform">
    <form action="load/user_login.php" id="user_login" name="user_login" method="post">
      <table width="100%" border="0" cellspacing="10" cellpadding="0" id="login">
        <tr>
          <td>Email</td>
          <td>
            <input type="text" name="username" id="username" />
		  </td>
        </tr>
        <tr>
          <td>Password</td>
          <td><input type="password" name="password" id="password" /></td>
        </tr>
        <tr>
          <td colspan="2">
          <a href="javascript:void(0);" id="forget_pass" style="padding-left: 93px;">forgot your password ?</a>
	  <label style="padding-left: 5px;">
            <input type="submit" name="btn" id="btn" value="" />
          </label>
		  </td>
        </tr>
		<tr>
		<td colspan="2" id="lr"></td>
		</tr>
      </table>
    </form>
    </div>
	
	<div class="forgetform" style="display:none;">
	<form action="load/user_forget.php" id="user_forget" name="forget_pass" method="post">
      <table width="100%" border="0" cellspacing="10" cellpadding="0" id="login">
        <tr>
          <td>Username or Email</td>
          <td>
            <input type="text" name="uoe" id="uoe" /></td>
        </tr>
        <tr>
          <td>	  
		  </td>
          <td>
		  <label>
            <input type="submit" name="forgetbtn" class="nice_button" value="get password" style="margin-bottom:10px;margin-left: -3px;" />
          </label><div class="clear"></div>
		  <a href="javascript:void(0);" id="backlogin"><< back to login</a>
		</td>
        </tr>
		<tr>
		<td colspan="2" id="lr2"></td>
		</tr>
      </table>
    </form>
	</div>
	
</div>
</body>
</html>