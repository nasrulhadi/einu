<?php

session_start();

if (ISSET($_SESSION['username']) && ISSET($_SESSION['useragent'])){

	$prodid = $_GET['id'];

	// informasi dari get

	if ($_GET['act'] == "delete")

	{

		$pic_id = $_GET['id'];

		$q = mysql_query("delete from laporan_bulanan where id_laporan_bulanan='$pic_id'") or die(mysql_error());

		echo "<font color=\"green\">Menghapus gambar tersebut telah berhasil</font>";

	}

	?>

	<?php

	// prosesi update admin

	if (ISSET($_POST['adminbutton']))

	{

	$admin_username = $_POST['admin_username'];

	$admin_password = $_POST['admin_password'];

	$q = mysql_query("UPDATE `_admin_login` SET `_username` = '$admin_username', `_password` = '$admin_password' WHERE `_admin_login`.`_id` = 1;") or die(mysql_error());

	echo "<font color=\"green\">Account administrator berhasil di update!</font><br />";

	}

	?>

	

	<?php

	// prosesi update user

	if (ISSET($_POST['userbutton']))

	{

	$admin_username = $_POST['user_username'];

	$admin_password = $_POST['user_password'];

	$q = mysql_query("UPDATE `_user_login` SET `_username` = '$user_username', `_password` = '$user_password' WHERE `_user_login`.`_id` = 1;") or die(mysql_error());

	echo "<font color=\"green\">Account administrator berhasil di update!</font><br />";

	}

	?>

	

	<?php

	// prosesi tambah provinsi

	if (ISSET($_POST['send']))

	{

		$provinsi = mysql_real_escape_string($_POST['provinsi']);

		$nama_rusun = mysql_real_escape_string($_POST['rusun']);

		// check terlebih dahulu

		$sqlchk = mysql_query("select * from temp_province where parent_province='$provinsi' and parent_rusun='$nama_rusun'");

		$numy = mysql_fetch_row($sqlchk);

		if ($numy == 0 ){

			$sqlupd = "INSERT INTO `temp_province` (`id_temp_province`, `parent_province`, `parent_rusun`) VALUES (NULL, '$provinsi', '$nama_rusun');";		

			if (!$resultup=mysql_query($sqlupd)){

				echo "error :".mysql_error();

				exit;

			} else {

				echo "<font color=\"green\">Provinsi telah di tambahkan!</font><br />";

			}

		} else {

			echo "<font color=\"yellow\">Provinsi yang ingin anda tambahkan sudah ada!</font><br />";

		}

	}

	?>

	<script>

	function confirmDelete(delUrl) {

	  if (confirm("Anda yakin untuk menghapus gambar visual ini ?")) {

		document.location = delUrl;

	  }

	}

	</script>

	<h2>

	<a href="admin.php?page=ganti-password">Manajemen Password</a>

	</h2><br>



	<form action="" method="post" name="admin">

	<fieldset style="width: 300px;">

		<legend>Ganti password</legend>

	<?php

	$q = mysql_query("select * from _admin_login");

	$data = mysql_fetch_array($q);

	?>

	Username : <br /><div class="jqTransformInputWrapper jqTransformSafari jqTransformInputWrapper_hover" style="width: 210px; "><div class="jqTransformInputInner"><div><input class="jqTransformInput jqtranformdone" type="text" name="admin_username" value="<? echo $data['_username'];?>" style="width: 226px; "></div></div></div><br /><br /><br>



	Password : <br><div class="jqTransformInputWrapper jqTransformSafari jqTransformInputWrapper_hover" style="width: 210px; "><div class="jqTransformInputInner"><div><input class="jqTransformInput jqtranformdone" type="text" name="admin_password" value="<? echo $data['_password'];?>" style="width: 226px; "></div></div></div><br /><br /><br />

	

	<button id="" name="adminbutton" type="submit" class="jqTransformButton"><span><span>Update</span></span></button>

	</fieldset>

	</form><br>



<?php

} else {

	echo "silahkan login kembali";

}

?>

