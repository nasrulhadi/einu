<?php
session_start();
$page=$_GET['page'];
if (ISSET($_SESSION['username']) && ISSET($_SESSION['useragent'])){
	include "../inc/config.php";
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html>
	<head>
		<title>HALAMAN ADMINISTRASI | <?php echo $website_name; ?></title>
		<link rel="stylesheet" href="docs/style.css" type="text/css">
		<link rel="stylesheet" href="uploadify/uploadify.css" type="text/css" />
		<link rel="stylesheet" href="../js/jqtransform/jqtransformplugin/jqtransform.css" type="text/css">
		<script type="text/javascript" src="../js/jquery-1.8.1.min.js"></script>
		<script type="text/javascript" src="../js/jquery.uploadify.js"></script>
		<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.16/jquery-ui.min.js"></script>
		<script type="text/javascript" src="ckeditor/ckeditor.js"></script>
		<script type="text/javascript" src="ckeditor/adapters/jquery.js"></script>
		<link rel="stylesheet" type="text/css" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.14/themes/smoothness/jquery-ui.css" />
		<script type="text/javascript" src="../js/jqtransform/jqtransformplugin/jquery.jqtransform.js"></script>
		<script src="../__jquery.tablesorter/addons/pager/jquery.tablesorter.pager.js" type="text/javascript"></script>
		<script src="../__jquery.tablesorter/jquery.tablesorter.js" type="text/javascript"></script>
		<script type="text/javascript">
		$(document).ready(function() {
				$('.text_editor').ckeditor();
				$(function(){
					$(".adminform").jqTransform({imgPath:'../js/jqtransform/jqtransformplugin/img'});
					$("#date").datepicker();
				});
				$("#report tr:odd").addClass("odd");
				$("#report tr:not(.odd)").hide();
				$("#report tr:first-child").show();
				
				//$("#report tr.toggle").click(function(){
				//	$(this).next("tr").fadeIn();
				//});
				//$("#report").jExpand();
				$("#report tr.toggle").toggle(function(){
					//first click happened
					$(this).next("tr").fadeIn();
					},function(){
					//second click happened
					$(this).next("tr").fadeOut();
				});
				$("table#report").tablesorter().tablesorterPager({container: $("#pager")});
				$("#harga").keydown(function(event) {
					// Allow only backspace and delete
					if ( event.keyCode == 46 || event.keyCode == 8) {
							// let it happen, don't do anything
					}
					else {
							// Ensure that it is a number and stop the keypress
							if (event.keyCode < 48 || event.keyCode > 57 ) {
									event.preventDefault(); 
							}       
					}
				});
            //$("#report").jExpand();
        });
    </script>  
	<script type="text/javascript">
	function startUpload(id)
	{
			$('#'+id).fileUploadStart();
	}
	</script>
	</head>
	<body>
	<table border="0" cellpadding="2" cellspacing="0" style="width:100%;">
		<tbody>
			<tr style="vertical-align: top;">
				<td>
				</td>
				<td style="text-align: right;"> <strong>Administration Bar</strong>
					<font class="naviblock">				
						<a href="admin.php?page=distributor" class="navi" title="">Distributor</a>
						| <a href="admin.php?page=points" class="navi" title="">Points</a>	
						| <a href="admin.php?page=user" class="navi" title="">User</a>	
						| <a href="admin.php?page=asm" class="navi" title="">Asm</a>
						| <a href="admin.php?page=event" class="navi" title="">Event</a>
						| <a href="admin.php?page=download" class="navi" title="">Download</a>
						| <a href="admin.php?page=ganti-password" class="navi">Ganti Password</a>
						| <a href="admin.php?page=website-setting" class="navi">Website Settings</a>	
						| <a href="logout.php" class="navi" title="LOGOUT">Logout</a>
					</font>
				</td>
			</tr>
			<tr>
				<td colspan="2">
					<br>
					<table border="0" cellpadding="2" cellspacing="0" style="width:100%;">
					<tbody>
		<tbody>
			<tr>
				<td colspan="2">
					<br>
					<table border="0" cellpadding="2" cellspacing="0" style="width:100%;">
					<tbody>					
						<tr>
							<td class="headline">
								<h1><a href="admin.php" class="navi">Halaman administrasi | <?php echo $website_name; ?></a></h1>
							</td>
						</tr>
						<tr>
							<td class="info">
							Copyright <?php echo date("Y"); ?> <a href="../"><?php echo $website_name; ?></a>
							</td>
						</tr>
						<tr>
							<td>
								<br>
<?
switch($page)
 {
 case "distributor":
 require "inc/distributor.php";
 break;
 case "points":
 require "inc/point.php";
 break;
 case "user":
 require "inc/user.php";
 break;
 case "asm":
 require "inc/asm.php";
 break;
 case "event":
 require "inc/event.php";
 break; 
 case "download":
 require "inc/download.php";
 break;
 case "ganti-password":
 require "inc/ganti-password.php";
 break; 
 case "website-setting":
 require "inc/website-setting.php";
 break;  
 case "social":
 require "inc/social.php";
 break;
default:
 require "inc/depan.php";
?>			
							</td>
						</tr>	
					</tbody>
				</table>
			</td>
		</tr>
		</tbody>
	</table>
</body>
</html>
<?
}
}
else if($_SESSION['useragent'] != md5($_SERVER['HTTP_USER_AGENT'])) {
				header("location: index.php?login=belum");
				session_destroy();
				exit(0);
				}
	else {
	header("location: index.php?login=belum");
}
?>