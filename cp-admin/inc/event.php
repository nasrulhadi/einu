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

		$event_title = mysql_real_escape_string($_POST['event_title']);

		$event_desc = mysql_real_escape_string($_POST['event_desc']);

		$event_date = mysql_real_escape_string($_POST['event_date']);

		$sqladd = "INSERT INTO `event` (`event_id`, `event_title`, `event_desc`, `event_date`) VALUES (NULL, '$event_title', '$event_desc', '$event_date');";		

		if (!$resultup=mysql_query($sqladd)){

			echo "error :".mysql_error();

			exit;

		} else {

			echo "<font color=\"green\">Event berhasil di tambahkan!</font><br />";

		}

	}

	?>

	<?php

	// prosesi update user

	if (ISSET($_POST['tblupdate']))

	{

		$pid = mysql_real_escape_string($_POST['nomer']);

		$event_title = mysql_real_escape_string($_POST['event_title']);

		$event_desc = mysql_real_escape_string($_POST['event_desc']);

		$event_date = mysql_real_escape_string($_POST['event_date']);

		$sqlupd = "UPDATE `event` SET `event_title` = '$event_title', `event_desc` = '$event_desc', `event_date` = '$event_date' WHERE `event`.`event_id` = $pid;";		

		if (!$resultup=mysql_query($sqlupd)){

			echo "error :".mysql_error();

			exit;

		} else {

			echo "<font color=\"green\">Event yang terpilih berhasil di update</font><br />";

		}

	}

	?>

	<?php

	// menghapus barang

	if ($act=="hapus")

	{

		$sql = "DELETE FROM `event` WHERE `event_id` = $prodid";

		if (!$res=mysql_query($sql)){

			echo "error :".mysql_error();

			exit;

		} else {

			echo "<font color=\"green\">Event yang dipilih berhasil di hapus</font><br />";

		}

	}

	?>

	<h2>

	<a href="admin.php?page=event">Manajemen Data Event</a>

	</h2>

	<button id="" name="tblkirim" type="submit" style="padding-bottom: 10px;" class="jqTransformButton" OnClick="window.location.href='admin.php?page=event&act=add';"><span><span>Tambah Event</span></span></button><br>

<br>

    <table id="report" width="500">

        <thead>

		<tr>

            <th>Event Title</th>

            <th>Event Date</th>

			<th></th>

		</tr>

        </thead>

		<tbody>

			<?php

			$sql="select * from event";

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

            <td><?php echo $item['event_title']; ?></td>

            <td><?php echo $item['event_date']; ?></td>

            <td><div class="arrow"></div></td>

        </tr>

        <tr>

            <td colspan="3">

			Description :<br>

			<?php echo $item['event_desc']; ?>

			<div class="action">

			<a href="admin.php?page=event&id=<?php echo $item['event_id'];?>&act=hapus">hapus</a> | 

			<a href="admin.php?page=event&id=<?php echo $item['event_id'];?>&act=update">update</a></div>

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

	if($act == "add"){

	// add

	?>

	<form name="updateproduk" id="adminform" action="" method="post">

	<fieldset style="width: 300px;float: right;position: absolute;top: 190px;left: 525px;">

		<legend><h2>Tambah data event</h2></legend>

		Judul event<br />

		<div class="jqTransformInputWrapper jqTransformSafari jqTransformInputWrapper_hover" style="width: 210px; "><div class="jqTransformInputInner"><div><input class="jqTransformInput jqtranformdone" type="text" name="event_title" value="" style="width: 226px; " id="num"></div></div></div><br /><br /><br />

		

		Tanggal event<br />

		<div class="jqTransformInputWrapper jqTransformSafari jqTransformInputWrapper_hover" style="width: 210px; "><div class="jqTransformInputInner"><div><input class="jqTransformInput jqtranformdone" type="text" id="date" name="event_date" value="" style="width: 226px; " id="num"></div></div></div><br /><br /><br />

		

		Description<br />

		<textarea name="event_desc" style="margin: 2px; height: 115px; width: 210px;"></textarea><br /><br /><br />



	<button id="" name="tbladd" type="submit" class="jqTransformButton"><span><span>Tambahkan Event</span></span></button>

	</fieldset>

	</form>

	<?php } ?>

	

	<?php

	// update

	if($act == "update"){

	$sql = "select * from event where event_id ='$prodid'";

		if (!$res=mysql_query($sql)){

			echo mysql_error();

			exit;

		}

		$itemupdate=mysql_fetch_assoc($res)

	?>

<form name="updateproduk" id="adminform" action="" method="post">

	<fieldset style="width: 300px;float: right;position: absolute;top: 174px;left: 670px;">

		<legend><h2>update data event</h2></legend>

		<input name="nomer" type="hidden" value="<? echo $prodid;?>"><br />

		Judul event<br />

		<div class="jqTransformInputWrapper jqTransformSafari jqTransformInputWrapper_hover" style="width: 210px; "><div class="jqTransformInputInner"><div><input class="jqTransformInput jqtranformdone" type="text" name="event_title" value="<?php echo $itemupdate['event_title']; ?>" style="width: 226px; " id="num"></div></div></div><br /><br /><br />

		

		Tanggal event<br />

		<div class="jqTransformInputWrapper jqTransformSafari jqTransformInputWrapper_hover" style="width: 210px; "><div class="jqTransformInputInner"><div><input class="jqTransformInput jqtranformdone" type="text" id="date" name="event_date" value="<?php echo $itemupdate['event_date']; ?>" style="width: 226px; " id="num"></div></div></div><br /><br /><br />

		

		Description<br />

		<textarea name="event_desc" style="margin: 2px; height: 115px; width: 210px;"><?php echo $itemupdate['event_desc']; ?></textarea><br /><br /><br />



	<button id="" name="tblupdate" type="submit" class="jqTransformButton"><span><span>Update Event</span></span></button>

	</fieldset>

	</form>

	<?php } ?>

	

<?php

} else {

	echo "silahkan login kembali";

}

?>

