<?
if (ISSET($_SESSION['username']) && ISSET($_SESSION['useragent'])){
?>						
<h2>
	<a href="admin.php">WELCOME</a>
</h2>
<br>
<div align="center">
<b>
<p><font color="green"><? echo "selamat datang ".$username; ?></font></p>
</b>
Silahkan pilih administrasi panel di sebelah kanan atas
<br />
</div>
<?
}
else
{
	echo "Oppsss seems you've got wrong page !!<br>";
	echo "Click <a href=\"index.php\">here</a> for back ";
}
