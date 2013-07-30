<?php

session_start();

$act = $_GET['act'];

if (ISSET($_SESSION['username']) && ISSET($_SESSION['useragent'])){

	$prodid = $_GET['id'];

?>

	<?php

	// prosesi tambah user

	if (ISSET($_POST['tbladd']))

	{

		$asm_default_region = mysql_real_escape_string($_POST['asm_default_region']);

		$username = mysql_real_escape_string($_POST['username']);

		$password = mysql_real_escape_string($_POST['password']);

		$toemail = mysql_real_escape_string($_POST['email']);

		$sendemail = mysql_real_escape_string($_POST['sendemail']);

		if (isset($sendemail)){

		$email_message = "<p>

			Halo, ".$username."!</p>

			<p>

			Akun anda telah di buat untuk login ke JuaraLiga.com :<br>

			Username : ".$username."<br />

			Password : ".$password."<br /><br />

			

			Salam hangat,<br><br>

			

			JuaraLiga.com";

			$mwpclass->send_html_email($name='Akun baru anda di juaraliga.com', $email='no-reply@juaraliga.com', 

			$to_mail=$toemail, $subject='Akun baru anda di juaraliga.com', $msg=$email_message);

			$add_succ_mess = "dan detail login telah di email ke user asm";

		}

		$sqladd = "INSERT INTO `user` (`user_id`, `distributor_id`, `username`, `password`, `email`, `user_type`, `asm_default_region`, `forget_pass_char`, `created_date`) VALUES (NULL, '', '$username', '$password', '$toemail', 'asm', '$asm_default_region', '', CURRENT_TIMESTAMP);";		

		if (!$resultup=mysql_query($sqladd)){

			echo "error :".mysql_error();

			exit;

		} else {

			echo "<font color=\"green\">Data User berhasil di tambahkan ".$add_succ_mess."!</font><br />";

		}

	}

	?>

	<?php

	// prosesi update user

	if (ISSET($_POST['tblupdate']))

	{

		$pid = mysql_real_escape_string($_POST['nomer']);

		$asm_default_region = mysql_real_escape_string($_POST['asm_default_region']);

		$username = mysql_real_escape_string($_POST['username']);

		$password = mysql_real_escape_string($_POST['password']);

		$toemail = mysql_real_escape_string($_POST['email']);

		$sendemail = mysql_real_escape_string($_POST['sendemail']);

		if (isset($sendemail)){

		$email_message = "<p>

			Halo, ".$username."!</p>

			<p>

			Akun anda telah di buat untuk login ke JuaraLiga.com :<br>

			Username : ".$username."<br />

			Password : ".$password."<br /><br />

			

			Salam hangat,<br><br>

			

			JuaraLiga.com";

			$mwpclass->send_html_email($name='Akun baru anda di juaraliga.com', $email='no-reply@juaraliga.com', 

			$to_mail=$toemail, $subject='Akun baru anda di juaraliga.com', $msg=$email_message);

			$add_succ_mess = "dan detail login telah di email ke user asm";

		}

		$sqlupd = "UPDATE `user` SET `asm_default_region`='$asm_default_region', `username`='$username', `password`='$password',  `email`='$toemail' WHERE `user`.`user_id` = '$pid' LIMIT 1";		

		if (!$resultup=mysql_query($sqlupd)){

			echo "error :".mysql_error();

			exit;

		} else {

			echo "<font color=\"green\">Data User yang terpilih berhasil di update</font><br />";

		}

	}

	?>

	<?php

	// menghapus barang

	if ($act=="hapus")

	{

		$sql = "DELETE FROM `user` WHERE `user_id` = $prodid";

		if (!$res=mysql_query($sql)){

			echo "error :".mysql_error();

			exit;

		} else {

			echo "<font color=\"green\">Data User yang dipilih berhasil di hapus</font><br />";

		}

	}

	?>

	<h2>

	<a href="admin.php?page=asm">Manajemen Data User ASM</a>

	</h2>

	<button id="" name="tblkirim" type="submit" style="padding-bottom: 10px;" class="jqTransformButton" OnClick="window.location.href='admin.php?page=asm&act=add';"><span><span>Tambah User Asm</span></span></button><br>

<br>

    <table id="report">

        <thead>

		<tr>

            <th>Username</th>

            <th>Password</th>

			<th>Email</th>

			<th>Default Region setelah login</th>

			<th></th>

		</tr>

        </thead>

		<tbody>

			<?php

			$sql="select * from user inner join `region` on user.asm_default_region=region.id_region where user_type='asm'";

			if (!$res=mysql_query($sql)){

				echo mysql_error();

				exit;

			}

			$cnr = mysql_num_rows($res);

			if ($cnr == 0) echo '<tr><td colspan="5">Belum ada data di bulan ini</td></tr>';

			while ($item=mysql_fetch_assoc($res))

			{

			?>

        <tr class="toggle">

            <td><?php echo $item['username']; ?></td>

            <td><?php echo $item['password']; ?></td>

			<td><?php echo $item['email']; ?></td>

            <td><?php echo $item['name_region']; ?></td>

            <td><div class="arrow"></div></td>

        </tr>

        <tr>

            <td colspan="5">

			<div class="action">

			<a href="admin.php?page=asm&id=<?php echo $item['user_id'];?>&act=hapus">hapus</a> | 

			<a href="admin.php?page=asm&id=<?php echo $item['user_id'];?>&act=update">update</a></div>

            </td>

        </tr>

			<?php

			}

			?>

		</tbody>

    </table>

	<div id="pager" class="pager">

	<form>

		<img src="../__jquery.tablesorter/addons/pager/icons/first.png" class="first"/>

		<img src="../__jquery.tablesorter/addons/pager/icons/prev.png" class="prev"/>

		<input type="text" class="pagedisplay"/>

		<img src="../__jquery.tablesorter/addons/pager/icons/next.png" class="next"/>

		<img src="../__jquery.tablesorter/addons/pager/icons/last.png" class="last"/>

		<select class="pagesize">

			<option selected="selected" value="20">10</option>

			<option value="40">20</option>

		</select>

	</form>

	</div>

	<script>

	$(function() {

		$("table#report").tablesorter({													       

        headers: { 

            // assign the secound column (we start counting zero) 

            0: { 

                // disable it by setting the property sorter to false 

                sorter: false 

            }, 

            1: { 

                // disable it by setting the property sorter to false 

                sorter: false 

            }, 

            2: { 

                // disable it by setting the property sorter to false 

                sorter: false 

            }, 

            3: { 

                // disable it by setting the property sorter to false 

                sorter: false 

            }, 

            4: { 

                // disable it by setting the property sorter to false 

                sorter: false 

            },

			5: { 

                // disable it by setting the property sorter to false 

                sorter: false 

            }

		})

			.tablesorterPager({container: $("#pager")});

	});

	</script>

	<?php

	if($act == "add"){

	// add

	?>

	<form name="updateproduk" id="adminform" action="" method="post">

	<fieldset style="width: 300px;float: right;position: absolute;top: 174px;left: 670px;">

		<legend><h2>Tambah data user</h2></legend>

		Usename<br />

		<div class="jqTransformInputWrapper jqTransformSafari jqTransformInputWrapper_hover" style="width: 210px; "><div class="jqTransformInputInner"><div><input class="jqTransformInput jqtranformdone" type="text" name="username" value="" style="width: 226px; " id="num"></div></div></div><br /><br /><br />

		

		Password<br />

		<div class="jqTransformInputWrapper jqTransformSafari jqTransformInputWrapper_hover" style="width: 210px; "><div class="jqTransformInputInner"><div><input class="jqTransformInput jqtranformdone" type="text" name="password" value="" style="width: 226px; " id="num"></div></div></div><br /><br /><br />

		

		Email<br />

		<div class="jqTransformInputWrapper jqTransformSafari jqTransformInputWrapper_hover" style="width: 210px; "><div class="jqTransformInputInner"><div><input class="jqTransformInput jqtranformdone" type="text" name="email" value="" style="width: 226px; " id="num"></div></div></div><br /><br /><br />

		

		Default region yang tampil setelah login <br />

		<select name="asm_default_region">

		<?php

		// mulai fetch kategori

		if ($hasil=mysql_query("select * from `region`"))

		{

			while ($datakat=mysql_fetch_assoc($hasil))

			{

		?>

		<option value="<? echo $datakat['id_region']; ?>"><? echo $datakat['name_region']; ?></option>

		<?php	

			}

		}

		// eof fetch kategori

		?>

	</select><br /><br>

	

	Email data ke user asm setelah data di buat ?

	<input type="checkbox" name="sendemail" id="sendemail" checked="checked" value="1" /><br><br>



	<button id="" name="tbladd" type="submit" class="jqTransformButton"><span><span>Tambahkan user asm</span></span></button>

	</fieldset>

	</form>

	<?php } ?>

	

	<?php

	// update

	if($act == "update"){

	$sql = "select * from user where user_id ='$prodid'";

		if (!$res=mysql_query($sql)){

			echo mysql_error();

			exit;

		}

		$itemupdate=mysql_fetch_assoc($res)

	?>

<form name="updateproduk" id="adminform" action="" method="post">

	<fieldset style="width: 300px;float: right;position: absolute;top: 174px;left: 670px;">

		<legend><h2>Tambah data user</h2></legend>

		<input name="nomer" type="hidden" value="<? echo $prodid;?>"><br />

		Usename<br />

		<div class="jqTransformInputWrapper jqTransformSafari jqTransformInputWrapper_hover" style="width: 210px; "><div class="jqTransformInputInner"><div><input class="jqTransformInput jqtranformdone" type="text" name="username" value="<?php echo $itemupdate['username']; ?>" style="width: 226px; " id="num"></div></div></div><br /><br /><br />

		

		Password<br />

		<div class="jqTransformInputWrapper jqTransformSafari jqTransformInputWrapper_hover" style="width: 210px; "><div class="jqTransformInputInner"><div><input class="jqTransformInput jqtranformdone" type="text" name="password" value="<?php echo $itemupdate['password']; ?>" style="width: 226px; " id="num"></div></div></div><br /><br /><br />

		

		Email<br />

		<div class="jqTransformInputWrapper jqTransformSafari jqTransformInputWrapper_hover" style="width: 210px; "><div class="jqTransformInputInner"><div><input class="jqTransformInput jqtranformdone" type="text" name="email" value="<?php echo $itemupdate['email']; ?>" style="width: 226px; " id="num"></div></div></div><br /><br /><br />

		

		Default region yang tampil setelah login <br />

		<select name="asm_default_region">

		<?php

		// mulai fetch kategori

		if ($hasil=mysql_query("select * from `region`"))

		{

			while ($datakat=mysql_fetch_assoc($hasil))

			{

		?>

		<option value="<? echo $datakat['id_region']; ?>" <?php if ($datakat['id_region'] == $itemupdate['asm_default_region']){ echo "selected=\"true\""; } ?>><? echo $datakat['name_region']; ?></option>

		<?php	

			}

		}

		// eof fetch kategori

		?>

	</select><br /><br>

	

	Email data ke user asm setelah data update ?

	<input type="checkbox" name="sendemail" id="sendemail" checked="checked" value="1" /><br><br>



	<button id="" name="tblupdate" type="submit" class="jqTransformButton"><span><span>Update user asm</span></span></button>

	</fieldset>

	</form>

	<?php } ?>

	

<?php

} else {

	echo "silahkan login kembali";

}

?>

