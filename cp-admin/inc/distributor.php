<?php

session_start();

$act = $_GET['act'];

if (ISSET($_SESSION['username']) && ISSET($_SESSION['useragent'])){

	$prodid = $_GET['id'];

?>

	<?php

	// prosesi update barang

	if (ISSET($_POST['tbladd']))

	{

		$distributor_name = mysql_real_escape_string($_POST['name_distributor']);

		$no_distributor = mysql_real_escape_string($_POST['no_distributor']);

		$area = mysql_real_escape_string($_POST['area']);

		$address = mysql_real_escape_string($_POST['address']);

		$telephone = mysql_real_escape_string($_POST['telephone']);

		$order = mysql_real_escape_string($_POST['order']);

		$groupid = mysql_real_escape_string($_POST['group']);

		$sqladd = "INSERT INTO `distributor` (`id_distributor`, `name_distributor`, `no_distributor`, `area`, `address`, `telephone`, `order`, `pic_profile`, `group`) VALUES (NULL, '$distributor_name', '$no_distributor', '$area', '$address', '$telephone', '$order', 'ava.gif', '$groupid');";		

		if (!$resultup=mysql_query($sqladd)){

			echo "error :".mysql_error();

			exit;

		} else {

			echo "<font color=\"green\">Distributor berhasil di tambahkan!</font><br />";

		}

	}

	?>

	<?php

	// prosesi update barang

	if (ISSET($_POST['tblupdate']))

	{

		$pid = mysql_real_escape_string($_POST['nomer']);

		$distributor_name = mysql_real_escape_string($_POST['name_distributor']);

		$no_distributor = mysql_real_escape_string($_POST['no_distributor']);

		$area = mysql_real_escape_string($_POST['area']);

		$address = mysql_real_escape_string($_POST['address']);

		$telephone = mysql_real_escape_string($_POST['telephone']);

		$order = mysql_real_escape_string($_POST['order']);

		$groupid = mysql_real_escape_string($_POST['group']);

		$sqlupd = "UPDATE `distributor` SET `name_distributor` = '$distributor_name', `no_distributor` = '$no_distributor', `area` = '$area', `address` = '$address', `telephone` = '$telephone', `order` = '$order', `group` = '$groupid' WHERE `distributor`.`id_distributor` = '$pid';";		

		if (!$resultup=mysql_query($sqlupd)){

			echo "error :".mysql_error();

			exit;

		} else {

			echo "<font color=\"green\">Data distributor yang terpilih berhasil di update</font><br />";

		}

	}

	?>

	<?php

	// menghapus barang

	if ($act=="hapus")

	{

		$sql = "DELETE FROM `distributor` WHERE `id_distributor` = $prodid";

		if (!$res=mysql_query($sql)){

			echo "error :".mysql_error();

			exit;

		} else {

			echo "<font color=\"green\">Distributor yang dipilih berhasil di hapus</font><br />";

		}

	}

	?>

	<h2>

	<a href="admin.php?page=distributor">Manajemen Data Distributor</a>

	</h2>

	<button id="" name="tblkirim" type="submit" style="padding-bottom: 10px;" class="jqTransformButton" OnClick="window.location.href='admin.php?page=distributor&act=add';"><span><span>Tambah Distributor</span></span></button>

    <table id="report">

        <thead>

		<tr>

            <th>Nama distributor</th>

            <th>Region</th>

			<th>Group</th>

			<th>Area</th>

			<th></th>

		</tr>

        </thead>

		<tbody>

			<?php

			$sql="select * from distributor inner join `group` on distributor.group=group.group_id inner join region on group.group_zone=region.id_region";

			if (!$res=mysql_query($sql)){

				echo mysql_error();

				exit;

			}

			while ($item=mysql_fetch_assoc($res))

			{

			?>

			<?php 

			// basis dasar gambar akan terupload

			$folderupload = "../images/profilepic/";

			?>

        <tr class="toggle">

            <td><?php echo $item['name_distributor']; ?></td>

			<td><?php echo $item['name_region']; ?></td>

            <td><?php echo $item['group_name']; ?></td>

			<td><?php echo $item['area']; ?></td>

            <td><div class="arrow"></div></td>

        </tr>

        <tr>

            <td colspan="5">

			<div class="action">

			<img src="<?php echo $folderupload.$item['pic_profile']; ?>" alt="<?php echo $item['name_distributor']; ?>" style="width:125px; height:125px;" /><br />

			<a href="admin.php?page=distributor&id=<?php echo $item['id_distributor'];?>&act=hapus">hapus</a> | 

			<a href="admin.php?page=distributor&id=<?php echo $item['id_distributor'];?>&act=update">update</a></div>

                <h4>Deskripsi</h4><br />



				No. telephone : <?php echo $item['telephone']; ?><br />

				Alamat : <?php echo $item['address']; ?><br />

				No. order : <?php echo $item['order']; ?><br />

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
		}).tablesorterPager({container: $("#pager")});
	});

	</script>

	<?php

	if($act == "add"){

	// add

	?>

	<form name="updateproduk" id="adminform" action="" method="post">

	<fieldset style="width: 300px;float: right;position: absolute;top: 174px;left: 595px;">

		<legend><h2>Tambah data distributor</h2></legend>

	Nama Distributor <br />

		<div class="jqTransformInputWrapper jqTransformSafari jqTransformInputWrapper_hover" style="width: 210px; "><div class="jqTransformInputInner"><div><input class="jqTransformInput jqtranformdone" type="text" name="name_distributor" value="<? echo $itemupdate['nama_rusun'];?>" style="width: 226px; "></div></div></div><br /><br /><br />

		

	No distributor <br />

		<div class="jqTransformInputWrapper jqTransformSafari jqTransformInputWrapper_hover" style="width: 210px; "><div class="jqTransformInputInner"><div><input class="jqTransformInput jqtranformdone" type="text" name="no_distributor" value="<? echo $itemupdate['nama_rusun'];?>" style="width: 226px; "></div></div></div><br /><br /><br />

		

	Area <br />

		<div class="jqTransformInputWrapper jqTransformSafari jqTransformInputWrapper_hover" style="width: 210px; "><div class="jqTransformInputInner"><div><input class="jqTransformInput jqtranformdone" type="text" name="area" value="<? echo $itemupdate['nama_rusun'];?>" style="width: 226px; "></div></div></div><br /><br /><br />

		

	Alamat <br />

		<textarea style="margin: 10px 2px 15px; width: 206px; height: 112px;" name="address" height="500"><? echo $itemupdate['deskripsi'];?></textarea><br />

	

	Telephone <br />

		<div class="jqTransformInputWrapper jqTransformSafari jqTransformInputWrapper_hover" style="width: 210px; "><div class="jqTransformInputInner"><div><input class="jqTransformInput jqtranformdone" type="text" name="telephone" value="<? echo $itemupdate['nama_rusun'];?>" style="width: 226px; "></div></div></div><br /><br /><br />

		

	No order <br />

		<div class="jqTransformInputWrapper jqTransformSafari jqTransformInputWrapper_hover" style="width: 210px; "><div class="jqTransformInputInner"><div><input class="jqTransformInput jqtranformdone" type="text" name="order" value="<? echo $itemupdate['nama_rusun'];?>" style="width: 226px; "></div></div></div><br /><br /><br />

		

	Group (Region akan terisi automatis)<br />

	<select name="group">

		<?php

		// mulai fetch kategori

		if ($hasil=mysql_query("select * from `group` inner join region on group.group_zone=region.id_region"))

		{

			while ($datakat=mysql_fetch_assoc($hasil))

			{

		?>

		<option value="<? echo $datakat['group_id']; ?>"><? echo $datakat['group_name']; ?></option>

		<?php	

			}

		}

		// eof fetch kategori

		?>

	</select><br />



	<button id="" name="tbladd" type="submit" class="jqTransformButton"><span><span>Tambahkan distributor</span></span></button>

	</fieldset>

	</form>

	<?php } ?>

	

	<?php

	// update

	if($act == "update"){

	$sql = "select * from distributor where id_distributor ='$prodid'";

		if (!$res=mysql_query($sql)){

			echo mysql_error();

			exit;

		}

		$itemupdate=mysql_fetch_assoc($res)

	?>

	<form name="updateproduk" id="adminform" action="" method="post">

	<fieldset style="width: 300px;float: right;position: absolute;top: 174px;left: 595px;">

		<legend><h2>Tambah data distributor</h2></legend>

		<input name="nomer" type="hidden" value="<? echo $prodid;?>"><br />

	Nama Distributor <br />

		<div class="jqTransformInputWrapper jqTransformSafari jqTransformInputWrapper_hover" style="width: 210px; "><div class="jqTransformInputInner"><div><input class="jqTransformInput jqtranformdone" type="text" name="name_distributor" value="<? echo $itemupdate['name_distributor'];?>" style="width: 226px; "></div></div></div><br /><br /><br />

		

	No distributor <br />

		<div class="jqTransformInputWrapper jqTransformSafari jqTransformInputWrapper_hover" style="width: 210px; "><div class="jqTransformInputInner"><div><input class="jqTransformInput jqtranformdone" type="text" name="no_distributor" value="<? echo $itemupdate['no_distributor'];?>" style="width: 226px; "></div></div></div><br /><br /><br />

		

	Area <br />

		<div class="jqTransformInputWrapper jqTransformSafari jqTransformInputWrapper_hover" style="width: 210px; "><div class="jqTransformInputInner"><div><input class="jqTransformInput jqtranformdone" type="text" name="area" value="<? echo $itemupdate['area'];?>" style="width: 226px; "></div></div></div><br /><br /><br />

		

	Alamat <br />

		<textarea style="margin: 10px 2px 15px; width: 206px; height: 112px;" name="address" height="500"><? echo $itemupdate['address'];?></textarea><br />

	

	Telephone <br />

		<div class="jqTransformInputWrapper jqTransformSafari jqTransformInputWrapper_hover" style="width: 210px; "><div class="jqTransformInputInner"><div><input class="jqTransformInput jqtranformdone" type="text" name="telephone" value="<? echo $itemupdate['telephone'];?>" style="width: 226px; "></div></div></div><br /><br /><br />

		

	No order <br />

		<div class="jqTransformInputWrapper jqTransformSafari jqTransformInputWrapper_hover" style="width: 210px; "><div class="jqTransformInputInner"><div><input class="jqTransformInput jqtranformdone" type="text" name="order" value="<? echo $itemupdate['order'];?>" style="width: 226px; "></div></div></div><br /><br /><br />

		

	Group (Region akan terisi automatis)<br />

	<select name="group">

		<?php

		// mulai fetch kategori

		if ($hasil=mysql_query("select * from `group` inner join region on group.group_zone=region.id_region"))

		{

			while ($datakat=mysql_fetch_assoc($hasil))

			{

		?>

		<option value="<? echo $datakat['group_id']; ?>" <?php if($datakat['group_id'] == $itemupdate['group']) echo "selected=\"selected\""; ?>><? echo $datakat['group_name']; ?></option>

		<?php	

			}

		}

		// eof fetch kategori

		?>

	</select><br /><br />

	Upload Gambar Distributor (biarkan jika tidak ingin mengganti gambar sebelumnya, atau menggunakan gambar default.)<br>

	<div id="dist_upload">You have a problem with your javascript</div><br />

	<script type="text/javascript">

		$(document).ready(function() {

			$("#dist_upload").fileUpload({

				'uploader': 'uploadify/uploader.swf',

				'cancelImg': 'uploadify/cancel.png',

				'script': 'send/update_distributor.php',

				'folder': '../images/profilepic/',

				'multi': false,

				'auto': true,

				'displayData': 'percentage',

				'scriptData': {'id_distributor':'<?php echo $prodid; ?>'}, 

				onComplete: function (evt, queueID, fileObj, response, data) {

					alert("Successfully uploaded: "+response);

				}

			});

            //$("#report").jExpand();

        });

    </script>  

	<button id="" name="tblupdate" type="submit" class="jqTransformButton"><span><span>Update distributor</span></span></button>

	</fieldset>

	</form>

	<?php } ?>

	

<?php

} else {

	echo "silahkan login kembali";

}

?>

