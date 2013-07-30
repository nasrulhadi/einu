<?php

session_start();

$act = $_GET['act'];

if (ISSET($_SESSION['username']) && ISSET($_SESSION['useragent'])){

	$prodid = $_GET['id'];

?>

	<?php

	// prosesi update user

	if (ISSET($_POST['tblupdate']))

	{

		$pid = mysql_real_escape_string($_POST['nomer']);

		$title_download = mysql_real_escape_string($_POST['title_download']);

		$description = mysql_real_escape_string($_POST['description']);

		$sqlupd = "UPDATE `download` SET `title_download` = '$title_download', `description` = '$description' WHERE `download`.`id_download` = '$pid';";		

		if (!$resultup=mysql_query($sqlupd)){

			echo "error :".mysql_error();

			exit;

		} else {

			echo "<font color=\"green\">Download yang terpilih berhasil di update</font><br />";

		}

	}

	?>

	<?php

	// menghapus barang

	if ($act=="hapus")

	{

		$sql = "DELETE FROM `download` WHERE `id_download` = $prodid";

		if (!$res=mysql_query($sql)){

			echo "error :".mysql_error();

			exit;

		} else {

			echo "<font color=\"green\">Download yang dipilih berhasil di hapus</font><br />";

		}

	}

	?>

	<h2>

	<a href="admin.php?page=download">Manajemen Data Download</a>

	</h2>

	Silahkan upload terlebih dahulu file download untuk menambahkan, kemudian update data di table.<br /><div id="tambah_file">Mohon untuk aktifkan javascript di browser anda.</div><br /><br />

	<script type="text/javascript">

		$(document).ready(function() {

			$("#tambah_file").fileUpload({

				'uploader': 'uploadify/uploader.swf',

				'cancelImg': 'uploadify/cancel.png',

				'script': 'send/add_download.php',

				'folder': '../files/',

				'multi': false,

				'auto': true,

				'displayData': 'percentage',

				onComplete: function (evt, queueID, fileObj, response, data) {

					alert("Berhasil di tambahkan: "+response+" Silahkan update data download setelah ini.");

					window.location.replace("admin.php?page=download");

				}

			});

            //$("#report").jExpand();

        });

    </script>

    <table id="report" width="500">

        <thead>

		<tr>

            <th>Download title</th>

            <th>Filename</th>

			<th></th>

		</tr>

        </thead>

		<tbody>

			<?php

			$sql="select * from download";

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

            <td><?php echo $item['title_download']; ?></td>

            <td><?php echo $item['filename']; ?></td>

            <td><div class="arrow"></div></td>

        </tr>

        <tr>

            <td colspan="3">

			Description :<br>

			<?php echo $item['description']; ?>

			<div class="action">

			<a href="admin.php?page=download&id=<?php echo $item['id_download'];?>&act=hapus">hapus</a> | 

			<a href="admin.php?page=download&id=<?php echo $item['id_download'];?>&act=update">update</a></div>

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

			<option selected="selected" value="10">5</option>

			<option value="20">10</option>

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

	// update

	if($act == "update"){

	$sql = "select * from download where id_download ='$prodid'";

		if (!$res=mysql_query($sql)){

			echo mysql_error();

			exit;

		}

		$itemupdate=mysql_fetch_assoc($res)

	?>

<form name="updateproduk" id="adminform" action="" method="post">

	<fieldset style="width: 300px;float: right;position: absolute;top: 174px;left: 670px;">

		<legend><h2>Update data download</h2></legend>

		<input name="nomer" type="hidden" value="<? echo $prodid;?>"><br />

		Judul download<br />

		<div class="jqTransformInputWrapper jqTransformSafari jqTransformInputWrapper_hover" style="width: 210px; "><div class="jqTransformInputInner"><div><input class="jqTransformInput jqtranformdone" type="text" name="title_download" value="<?php echo $itemupdate['title_download']; ?>" style="width: 226px; " id="num"></div></div></div><br /><br /><br />

		

		update file, biarkan jika tidak ingin mengupdate file sebelumnya. tunggu sampai upload selesai.<br /><div id="update_file">Mohon untuk aktifkan javascript di browser anda.</div>

	<script type="text/javascript">

		$(document).ready(function() {

			$("#update_file").fileUpload({

				'uploader': 'uploadify/uploader.swf',

				'cancelImg': 'uploadify/cancel.png',

				'script': 'send/update_download.php',

				'folder': '../files/',

				'multi': false,

				'auto': true,

				'displayData': 'percentage',

				'scriptData': {'id':'<?php echo $prodid; ?>'},

				onComplete: function (evt, queueID, fileObj, response, data) {

					alert("File berhasil di update: "+response+".");

				}

			});

            //$("#report").jExpand();

        });

    </script><br />

		

		Description<br />

		<textarea name="description" style="margin: 2px; height: 115px; width: 210px;"><?php echo $itemupdate['description']; ?></textarea><br /><br /><br />



	<button id="" name="tblupdate" type="submit" class="jqTransformButton"><span><span>Update Download Data</span></span></button>

	</fieldset>

	</form>

	<?php } ?>

	

<?php

} else {

	echo "silahkan login kembali";

}

?>

