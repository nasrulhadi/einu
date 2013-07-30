<?php
session_start();
if(ISSET($_SESSION['username']) && ISSET($_SESSION['useragent']))
	{
		UNSET($_SESSION['username']);
		session_destroy();
		header("location:index.php?logout=berhasil");
	} else {
		header("location:index.php");
	}
?>
