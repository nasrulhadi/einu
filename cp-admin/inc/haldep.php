<?php
if (ISSET($_SESSION['username']) && ISSET($_SESSION['useragent'])){
if (ISSET($_POST['depan']))
{
	$logaboutindex = $_POST['depan'];
	$logaboutindex2 = $_POST['depan2'];
	$sql = "UPDATE `_main_content` SET `_front_content` = '$logaboutindex', `_front_content_en` = '$logaboutindex2';";
	$result	= mysql_query($sql) or die(mysql_error());
	if ($result)
	{
		echo "<b><h><font color=\"green\">artikel telah di update</font></h></b><br><br>";
	} else
	{
		echo "<h><b><font color=\"green\">artikel gagal disimpan</font></h></b><br><br>";
	}
}
?>						
<h2>
	<a href="admin.php?page=halaman_index">Halaman depan</a>
</h2>
Anda bisa mengupdate halaman depan di sini.
<br />
<br />
<h2>Bahasa indonesia</h2>
<form name="editor_form" action="admin.php?page=halaman_index" method="post">		
	<textarea class="text_editor" name="depan">
	<?php
	$sql1 = "SELECT * FROM `_main_content` LIMIT 0, 30 ";
	$result1 = mysql_query($sql1);
	$hasil = mysql_fetch_assoc($result1);
	echo $hasil['_front_content'];
	?>
	</textarea>
<br />
<br />	
<h2>Bahasa Inggris</h2>
	<textarea class="text_editor" name="depan2">
	<?php
	$sql1 = "SELECT * FROM `_main_content` LIMIT 0, 30 ";
	$result1 = mysql_query($sql1);
	$hasil = mysql_fetch_assoc($result1);
	echo $hasil['_front_content_en'];
	?>
	</textarea>
<button id="" name="update" type="submit" class="jqTransformButton"><span><span>update</span></span></button>
</form>
<?php
}
else
{
	echo "Oppsss seems you've got wrong page !!<br>";
	echo "Click <a href=\"index.php\">here</a> for back ";
}
?>