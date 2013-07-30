<?php
session_start();
if (isset($_POST['submit'])) {
		include "inc/config.php";
		$username = addslashes($_POST['username']);
		$password = addslashes($_POST['password']);
		$passwordhash = md5($password);  // mengenkripsikannya untuk dicocokan dengan database
		$perintahnya = "select username, password from user where username = '$username' and password = '$passwordhash'";
		$jalankanperintahnya = mysql_query($perintahnya);
		$ada_apa_enggak = mysql_num_rows($jalankanperintahnya);
		if ($ada_apa_enggak >= 1 ){
			$_SESSION['username'] = $username ;
			$_SESSION['useragent'] = md5($_SERVER['HTTP_USER_AGENT']);
			header("location:admin.php");
			}  
			else {		
			header("location:?page=login&access=denied!");
		}
	}
?>
