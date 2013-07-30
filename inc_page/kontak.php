<?php 
	$text_content = mysql_query("select * from _main_content") or die(mysql_error());
	$data = mysql_fetch_array($text_content);
	if ($_SESSION['lang'] == "en"){
	echo $data['_contact_en'];
	} else {
	echo $data['_contact'];
	}
	?>