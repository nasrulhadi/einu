<?php
session_start();
if (ISSET($_SESSION['username']) && ISSET($_SESSION['useragent'])){
	$prodid = $_GET['id'];
	// prosesi update admin
	if (ISSET($_POST['settingbutton']))
	{
	$keyword = $_POST['keyword'];
	$contact_email = $_POST['contact_email'];
	$description = $_POST['description'];
	$snow_effect = $_POST['snow_effect'];
	$waktu_point = $_POST['waktu_point'];
	
	$q = mysql_query("UPDATE `website_setting` SET  `keyword`='$keyword',  `contact_email`='$contact_email', `contact_email_2`='$contact_email_2',  `description`='$description',  `snow_effect`='$snow_effect', `waktu_point`='$waktu_point' LIMIT 1") or die(mysql_error());
	echo "<font color=\"green\">Website setting berhasil di update!</font><br />";
	}
	?>
	
	<h2>
	<a href="admin.php?page=website-setting">Manajemen Website Setting</a>
	</h2><br>

	<form action="" method="post" name="admin">
	<fieldset style="width: 300px;">
		<legend>Website setting</legend>
	<?php
	$q = mysql_query("select * from website_setting");
	$data = mysql_fetch_array($q);
	?>
	Keyword Website : <br /><div class="jqTransformInputWrapper jqTransformSafari jqTransformInputWrapper_hover" style="width: 210px; "><div class="jqTransformInputInner"><div><input class="jqTransformInput jqtranformdone" type="text" name="keyword" value="<? echo $data['keyword'];?>" style="width: 226px; "></div></div></div><br /><br /><br>

	Pesan masuk ke email : <br><div class="jqTransformInputWrapper jqTransformSafari jqTransformInputWrapper_hover" style="width: 210px; "><div class="jqTransformInputInner"><div><input class="jqTransformInput jqtranformdone" type="text" name="contact_email" value="<? echo $data['contact_email'];?>" style="width: 226px; "></div></div></div><br /><br /><br />
	
	Pesan masuk ke email kedua : <br><div class="jqTransformInputWrapper jqTransformSafari jqTransformInputWrapper_hover" style="width: 210px; "><div class="jqTransformInputInner"><div><input class="jqTransformInput jqtranformdone" type="text" name="contact_email_2" value="<? echo $data['contact_email_2'];?>" style="width: 226px; "></div></div></div><br /><br /><br />

	
	Description website :<br />
	<textarea name="description" style="margin: 2px; width: 208px; height: 88px;"><? echo $data['description'];?></textarea><br /><br />
	
	Effect salju di homepage ?<br />
	<select name="snow_effect">
		<option value="ya" <?php if ($data['snow_effect'] == 'ya') echo "selected=\"true\""; ?>>ya</option>
		<option value="tidak" <?php if ($data['snow_effect'] == 'tidak') echo "selected=\"true\""; ?>>tidak</option>
	</select><br /><br />
    
    Tampilkan data point pada bulan / 1 bulan sebelumnya dari bulan realtime (sekarang)<br />
	<select name="waktu_point">
		<option value="0" <?php if ($data['waktu_point'] == '0') echo "selected=\"true\""; ?>>Bulan Realtime</option>
		<option value="1" <?php if ($data['waktu_point'] == '1') echo "selected=\"true\""; ?>>Januari</option>
        <option value="2" <?php if ($data['waktu_point'] == '2') echo "selected=\"true\""; ?>>Februari</option>
        <option value="3" <?php if ($data['waktu_point'] == '3') echo "selected=\"true\""; ?>>Maret</option>
        <option value="4" <?php if ($data['waktu_point'] == '4') echo "selected=\"true\""; ?>>April</option>
        <option value="5" <?php if ($data['waktu_point'] == '5') echo "selected=\"true\""; ?>>Mei</option>
        <option value="6" <?php if ($data['waktu_point'] == '6') echo "selected=\"true\""; ?>>Juni</option>
        <option value="7" <?php if ($data['waktu_point'] == '7') echo "selected=\"true\""; ?>>Juli</option>
        <option value="8" <?php if ($data['waktu_point'] == '8') echo "selected=\"true\""; ?>>Agustus</option>
        <option value="9" <?php if ($data['waktu_point'] == '9') echo "selected=\"true\""; ?>>September</option>
        <option value="10" <?php if ($data['waktu_point'] == '10') echo "selected=\"true\""; ?>>Oktober</option>
        <option value="11" <?php if ($data['waktu_point'] == '11') echo "selected=\"true\""; ?>>November</option>
        <option value="12" <?php if ($data['waktu_point'] == '12') echo "selected=\"true\""; ?>>Desember</option>
	</select><br /><br />

	<button id="" name="settingbutton" type="submit" class="jqTransformButton"><span><span>Update</span></span></button>
	</fieldset>
	</form><br>

<?php
} else {
	echo "silahkan login kembali";
}
?>