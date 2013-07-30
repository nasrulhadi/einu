<?
if (ISSET($_SESSION['username']) && ISSET($_SESSION['useragent'])){
if (ISSET($_POST['depan']))
{
	$logaboutindex = $_POST['depan'];
	$sql = "UPDATE `_main_content` SET `cara_pembayaran` = '$logaboutindex';";
	$result	= mysql_query($sql);
	if ($result)
	{
		echo "<b><h><font color=\"green\">artikel telah di update</font></h></b><br><br>";
	} else
	{
		echo "<h><b><font color=\"green\">artikel gagal disimpan</font></h></b><br><br>";
	}
}
?>
<form name="text_editor" action="admin.php?page=carapembayaran" method="post">								
<h2>
	<a href="admin.php?page=carapembayaran">Halaman cara pembayaran</a>
</h2>
Anda bisa mengupdate halaman cara pembayaran di sini.
<br>
<textarea class="text_editor" name="depan" style="width:900px;height:400px;">
<?
$sql1 = "SELECT * FROM `_main_content` LIMIT 0, 30 ";
$result1 = mysql_query($sql1);
$hasil = mysql_fetch_row($result1);
echo $hasil[2];
?>
</textarea>
<button id="" name="update" type="submit" class="jqTransformButton"><span><span>update</span></span></button>
</form>
<?
}
else
{
	echo "Oppsss seems you've got wrong page !!<br>";
	echo "Click <a href=\"index.php\">here</a> for back ";
}
