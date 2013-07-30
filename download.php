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



// get group data

$group_query = mysql_query("select * from `group` inner join region on `group`.group_zone=`region`.id_region where `group`.group_id='$dist_group'") or die(mysql_error());

$data_group = mysql_fetch_array($group_query);

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<head>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<title>Juaraliga.com | Download</title>

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

          <div class="title">Download</div>

            <table width="100%" border="0" cellspacing="10" cellpadding="5">

			  <?php

			  $q = mysql_query("select * from download");

			  while ($data_file = mysql_fetch_array($q)){

			  ?>

			  <tr>

                <td class="downloadtd">

				<p><a rel="nofollow"  href="files/<?php echo $data_file['filename']; ?>" title="<?php echo $data_file['title_download']; ?>"><?php echo $data_file['title_download']; ?></a> - <span><?php echo $data_file['release_date']; ?></span> <br />

				Description : <?php echo $data_file['description']; ?></p></td></tr>

			  <?php } ?>

            </table>

            <p>&nbsp;</p>

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