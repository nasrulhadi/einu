<?php
if (ISSET($_SESSION['username']) && ISSET($_SESSION['useragent'])){
$prodid = $_GET['id'];
?>
	<?php
	// prosesi update
	if (ISSET($_POST['tblkirim']))
	{
		$pid = mysql_real_escape_string($_POST['nomer']);
		$cat = mysql_real_escape_string($_POST['cat']);
		$sqlupd = "UPDATE gallery SET cat = '$cat' WHERE id='$pid'";		
		if (!$resultup=mysql_query($sqlupd)){
			echo "error :".mysql_error();
			exit;
		} else {
			echo "<font color=\"green\">Kategori gambar berhasil di update</font><br />";
		}
	}
	?>
	<?php
	// menghapus barang
	if ($aksi=="hapus")
	{
		$sql = "DELETE FROM `gallery` WHERE `id` = $prodid";
		if (!$res=mysql_query($sql)){
			echo "error :".mysql_error();
			exit;
		} else {
			echo "<font color=\"green\">Gallery yang dipilih berhasil di hapus</font><br />";
		}
	}
	?>
	<?php
	if (ISSET($_POST['aboutus']))
	{
		$logabout = $_POST['aboutus'];
		$logabout2 = $_POST['aboutus2'];
		$sql = "UPDATE `_main_content` SET `_gallery` = '$logabout', `_gallery_en` = '$logabout2';";
		$result	= mysql_query($sql);
		if ($result)
		{
			echo "<b><h><font color=\"green\">Artikel telah di update</font></h></b><br><br>";
		} else
		{
			echo "<h><b><font color=\"green\">Artikel gagal disimpan</font></h></b><br><br>";
		}
	}
	?>
<form class="updateform" name="aboutform" action="admin.php?page=galeri" method="post">								
<h2>
	<a href="admin.php?page=galeri">Halaman Galeri</a>
</h2>
Anda bisa mengupdate halaman galeri di sini.
<br><br />
<h2>Bahasa Indonesia</h2>
<textarea class="text_editor" name="aboutus" style="width:900px;height:400px;">
<?php
$sql1 = "SELECT * FROM `_main_content`";
$result1 = mysql_query($sql1);
$hasil = mysql_fetch_assoc($result1);
echo $hasil['_gallery'];
?>
</textarea><br />
<br />
<h2>Bahasa Inggris</h2>
<textarea class="text_editor" name="aboutus2" style="width:900px;height:400px;">
<?php
$sql1 = "SELECT * FROM `_main_content`";
$result1 = mysql_query($sql1);
$hasil = mysql_fetch_assoc($result1);
echo $hasil['_gallery_en'];
?>
</textarea>
<button id="" name="update" type="submit" class="jqTransformButton"><span><span>update</span></span></button>
</form>

<h2>Manajemen Gambar</h2>
	Silahkan tambahkan terlebih dahulu gambar gallery untuk menambahkan gallery. kemudian update data kategori di table.<br /><div id="tambah_gallery">Mohon untuk aktifkan javascript di browser anda.</div><br /><br />
	<script type="text/javascript">
		$(document).ready(function() {
			$("#tambah_gallery").fileUpload({
				'uploader': 'uploadify/uploader.swf',
				'cancelImg': 'uploadify/cancel.png',
				'script': 'send/add_gallery.php',
				'folder': '../upload/images/',
				'multi': false,
				'auto': true,
				'displayData': 'percentage',
				onComplete: function (evt, queueID, fileObj, response, data) {
					alert("Berhasil di tambahkan: "+response+" Silahkan update data gallery setelah ini.");
					window.location.replace("admin.php?page=galeri");
				}
			});
            //$("#report").jExpand();
        });
    </script>
    <table id="report">
        <tr>
			<th>Id</th>
            <th>Kategori</th>
			<th></th>
        </tr>
			<?php
			$sql="select gallery.id as id, image, cat, cat_gallery.id as cat_id, cat_gallery.cat_name from gallery inner join cat_gallery on gallery.cat=cat_gallery.id";
			if (!$res=mysql_query($sql)){
				echo mysql_error();
				exit;
			}
			while ($item=mysql_fetch_assoc($res))
			{
			?>
			<?php 
			// basis dasar gambar akan terupload
			$folderupload = "../upload/images/";
			?>
        <tr>
            <td><?php echo $item['id']; ?></td>
            <td><?php echo $item['cat_name']; ?></td>
            <td><div class="arrow"></div></td>
        </tr>
        <tr>
            <td colspan="5">
			<div class="action">
			<img src="<?php echo $folderupload.$item['image']; ?>" style="width:200px; height:150px;" /><br />
			<a href="admin.php?page=galeri&id=<?php echo $item['id'];?>&aksi=hapus">hapus</a> | 
			<a href="admin.php?page=galeri&id=<?php echo $item['id'];?>&aksi=update">update</a></div>
            </td>
        </tr>
			<?php
			}
			?>
    </table>
	<?php
	// form update barang
	$aksi = $_GET['aksi'];
	if ($aksi=="update"){
		$sql = "select * from gallery where id ='$prodid'";
		if (!$res=mysql_query($sql)){
			echo mysql_error();
			exit;
		}
		$itemupdate=mysql_fetch_assoc($res)
		?>
	<form name="updateproduk" id="adminform" action="" method="post">
		<fieldset>
    	<legend><h2>Edit Gambar</h2></legend>
		Upload Gambar (biarkan jika tidak ingin mengganti gambar sebelumnya)<br>
		<div id="gallery_upload">You have a problem with your javascript</div>
				<!-- <a href="javascript:startUpload('rusunawa_upload')">Start Upload</a> |  <a href="javascript:$('#rusunawa_upload').fileUploadClearQueue()">Clear Queue</a> -->
		<input name="nomer" type="hidden" value="<? echo $prodid;?>"><br />
		Kategori<br />
		<select name="cat">
		<?php
		// mulai fetch kategori
		if ($hasil=mysql_query("select c.id as cat_id, cat_name, g.id as gallery_id, image, cat  from cat_gallery c join gallery g where g.id='$prodid'"))
		{
			while ($datakat=mysql_fetch_assoc($hasil))
			{
		?>
		<option value="<? echo $datakat['cat_id']; ?>" <?php if($datakat['cat_id'] == $datakat['cat']) echo "selected=\"selected\""; ?>><? echo $datakat['cat_name']; ?></option>
		<?php	
			}
			
		}
		// eof fetch kategori
		?>
		</select>
		<br />
<br />
		<button id="" name="tblkirim" type="submit" class="jqTransformButton"><span><span>update</span></span></button>
		<div style="clear:both; margin-bottom: 15px;"></div>
		</fieldset>
		</form>
		<br />
		<br />
		<script type="text/javascript">
		$(document).ready(function() {
			$("#gallery_upload").fileUpload({
				'uploader': 'uploadify/uploader.swf',
				'cancelImg': 'uploadify/cancel.png',
				'script': 'send/update_gallery.php',
				'folder': '../upload/images/',
				'multi': false,
				'auto': true,
				'displayData': 'percentage',
				'scriptData': {'id':'<?php echo $prodid; ?>'}, 
				onComplete: function (evt, queueID, fileObj, response, data) {
					alert("Successfully uploaded: "+response);
				}
			});
            //$("#report").jExpand();
        });
    </script>  
	<?php
	}	
	?>
<?php
}
else
{
	echo "Oppsss seems you've got wrong page !!<br>";
}
?>