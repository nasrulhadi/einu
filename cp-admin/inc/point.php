<?php
session_start();
$act = $_GET['act'];
if (ISSET($_SESSION['username']) && ISSET($_SESSION['useragent'])){
	$prodid = $_GET['id'];
	// important conf
	$months = array(
    'january',
    'february',
    'march',
    'april',
    'may',
    'june',
    'july ',
    'august',
    'september',
    'october',
    'november',
    'december',
	);
	$current = strtolower(date('F'));
	$selmonth = $_GET['month'];
	$thisyear = date("Y"); // '2013';
?>
	<?php
	// prosesi update barang
	if (ISSET($_POST['tbladd']))
	{
		$distributor_id = mysql_real_escape_string($_POST['distributor_id']);
		$month = mysql_real_escape_string($_POST['month']);
		$year = mysql_real_escape_string($_POST['year']);
		$nd_point = mysql_real_escape_string($_POST['nd_point']);
		$vol_point = mysql_real_escape_string($_POST['vol_point']);
		$mps_point = mysql_real_escape_string($_POST['mps_point']);
		$average_point = mysql_real_escape_string($_POST['average_point']);
		$tot_point = round(round($nd_point, 1)+round($vol_point, 1)+round($mps_point, 1), 1);
		$sqladd = "INSERT INTO `points` (`point_id`, `distributor_id`, `month`, `year`, `prev_position`, `nd_point`, `vol_point`, `mps_point`, `tot_point`, `average_point`, `input_date`) VALUES (NULL, '$distributor_id', '$month', '$year', '0', '$nd_point', '$vol_point', '$mps_point', '$tot_point', '$average_point', CURRENT_TIMESTAMP);";		
		if (!$resultup=mysql_query($sqladd)){
			echo "error :".mysql_error();
			exit;
		} else {
			echo "<font color=\"green\">Data Point Distributor berhasil di tambahkan!</font><br />";
		}
	}
	?>
	<?php
	// prosesi update barang
	if (ISSET($_POST['tblupdate']))
	{
		$pid = mysql_real_escape_string($_POST['nomer']);
		$month = mysql_real_escape_string($_POST['month']);
		$year = mysql_real_escape_string($_POST['year']);
		$nd_point = mysql_real_escape_string($_POST['nd_point']);
		$vol_point = mysql_real_escape_string($_POST['vol_point']);
		$mps_point = mysql_real_escape_string($_POST['mps_point']);
		$average_point = mysql_real_escape_string($_POST['average_point']);
		$tot_point = round(round($nd_point, 1)+round($vol_point, 1)+round($mps_point, 1), 1);
		$sqlupd = "UPDATE `points` SET  `month`='$month',  `year`='$year',  `nd_point`='$nd_point',  `vol_point`='$vol_point',  `mps_point`='$mps_point',  `tot_point`='$tot_point', `average_point`='$average_point' WHERE `point_id` = '$pid'";		
		if (!$resultup=mysql_query($sqlupd)){
			echo "error :".mysql_error();
			exit;
		} else {
			echo "<font color=\"green\">Data Point Distributor yang terpilih berhasil di update</font><br />";
		}
	}
	?>
	<?php
	// menghapus barang
	if ($act=="hapus")
	{
		$sql = "DELETE FROM `points` WHERE `point_id` = $prodid";
		if (!$res=mysql_query($sql)){
			echo "error :".mysql_error();
			exit;
		} else {
			echo "<font color=\"green\">Data Point Distributor yang dipilih berhasil di hapus</font><br />";
		}
	}
	?>
	<h2>
	<a href="admin.php?page=points">Manajemen Data Poin Distributor</a>
	</h2>
	<button id="" name="tblkirim" type="submit" style="padding-bottom: 10px;" class="jqTransformButton" OnClick="window.location.href='admin.php?page=points&act=add';"><span><span>Tambah Poin Distributor</span></span></button><br>
<br>

	Tampilkan data di bulan : 
	<select id="selmonth">
	<option value="">semua bulan</option>
	<?php
	for ($i=0;$i<=11;$i++){
	?>
		<option value="<?php echo $months[$i]; ?>" <?php if($selmonth == $months[$i]){ echo "selected=\"selected\""; }?>><?php echo $months[$i]; ?></option>
	<?php } ?>
	</select>
	<script>
	$(document).ready(function(){
		$("#selmonth").change(function() {
			var val = $(this).val();
			if (!val){window.location.href='admin.php?page=points';}
			else {window.location.href='admin.php?page=points&month='+val;}
		});
	});
	</script>
    <table id="report">
        <thead>
		<tr>
            <th>Nama distributor</th>
            <th>Bulan</th>
			<th>ND</th>
			<th>VOL</th>
			<th>MPS</th>
			<th>Total</th>
			<th></th>
		</tr>
        </thead>
		<tbody>
			<?php
			if (isset($selmonth)){
				$sql="select * from points inner join distributor on points.distributor_id=distributor.id_distributor where month='$selmonth' and year='$thisyear'";
			} else {
			$sql="select * from points inner join distributor on points.distributor_id=distributor.id_distributor where year='$thisyear'";
			}
			if (!$res=mysql_query($sql)){
				echo mysql_error();
				exit;
			}
			$cnr = mysql_num_rows($res);
			if ($cnr == 0) echo '<tr><td colspan="7">Belum ada data di bulan ini</td></tr>';
			while ($item=mysql_fetch_assoc($res))
			{
			?>
        <tr class="toggle">
            <td><?php echo $item['name_distributor']; ?></td>
            <td><?php echo $item['month']; ?></td>
			<td><?php echo $item['nd_point']; ?></td>
            <td><?php echo $item['vol_point']; ?></td>
			<td><?php echo $item['mps_point']; ?></td>
			<td><?php echo $item['tot_point']; ?></td>
            <td><div class="arrow"></div></td>
        </tr>
        <tr>
            <td colspan="7">
			<div class="action">
			<a href="admin.php?page=points&id=<?php echo $item['point_id'];?>&act=hapus&month=<?= $selmonth; ?>">hapus</a> | 
			<a href="admin.php?page=points&id=<?php echo $item['point_id'];?>&act=update&month=<?= $selmonth; ?>">update</a></div>
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
            },
			6: { 
                // disable it by setting the property sorter to false 
                sorter: false 
            },
			7: { 
                // disable it by setting the property sorter to false 
                sorter: false 
            },
		}).tablesorterPager({container: $("#pager"), size:20});
	});
	</script>
	<?php
	if($act == "add"){
	// add
	?>
	<form name="updateproduk" id="adminform" action="" method="post">
	<fieldset style="width: 300px;float: right;position: absolute;top: 174px;left: 700px;">
		<legend><h2>Tambah data point</h2></legend>
		Distributor <br />
		<select name="distributor_id">
		<?php
		// mulai fetch kategori
		if ($hasil=mysql_query("select * from `distributor`"))
		{
			while ($datakat=mysql_fetch_assoc($hasil))
			{
		?>
		<option value="<? echo $datakat['id_distributor']; ?>"><? echo $datakat['name_distributor']; ?></option>
		<?php	
			}
		}
		// eof fetch kategori
		?>
	</select><br /><br>
	
		Bulan <br />
		<select name="month">
		<?php
		for ($i=0;$i<=11;$i++){
		?>
			<option value="<?php echo $months[$i]; ?>"><?php echo $months[$i]; ?></option>
		<?php } ?>
		</select><br /><br>
		
		Tahun <br />
		<select name="year">
		<?php
		for ($i=2013;$i<=2020;$i++){
		?>
			<option value="<?php echo $i; ?>"><?php echo $i; ?></option>
		<?php } ?>
		</select><br /><br>
		<h2>Poin</h2>
		<span>Angka desimal menggunakan titik</span>
		<hr>
	ND point<br />
		<div class="jqTransformInputWrapper jqTransformSafari jqTransformInputWrapper_hover" style="width: 210px; "><div class="jqTransformInputInner"><div><input class="jqTransformInput jqtranformdone" type="text" name="nd_point" value="<? echo $itemupdate['nama_rusun'];?>" style="width: 226px; " id="num"></div></div></div><br /><br /><br />
		
	VOL point <br />
		<div class="jqTransformInputWrapper jqTransformSafari jqTransformInputWrapper_hover" style="width: 210px; "><div class="jqTransformInputInner"><div><input class="jqTransformInput jqtranformdone" type="text" name="vol_point" value="<? echo $itemupdate['nama_rusun'];?>" style="width: 226px; " id="num"></div></div></div><br /><br /><br />
		
	MPS point <br />
		<div class="jqTransformInputWrapper jqTransformSafari jqTransformInputWrapper_hover" style="width: 210px; "><div class="jqTransformInputInner"><div><input class="jqTransformInput jqtranformdone" type="text" name="mps_point" value="<? echo $itemupdate['nama_rusun'];?>" style="width: 226px;" id="num"></div></div></div><br /><br /><br />

Average point <br />
		<div class="jqTransformInputWrapper jqTransformSafari jqTransformInputWrapper_hover" style="width: 210px; "><div class="jqTransformInputInner"><div><input class="jqTransformInput jqtranformdone" type="text" name="average_point" value="<? echo $itemupdate['nama_rusun'];?>" style="width: 226px;" id="num"></div></div></div><br /><br /><br />

	<button id="" name="tbladd" type="submit" class="jqTransformButton"><span><span>Tambahkan point</span></span></button>
	</fieldset>
	</form>
	<?php } ?>
	
	<?php
	// update
	if($act == "update"){
	$sql = "select * from points where point_id ='$prodid'";
		if (!$res=mysql_query($sql)){
			echo mysql_error();
			exit;
		}
		$itemupdate=mysql_fetch_assoc($res)
	?>
	<form name="updateproduk" id="adminform" action="" method="post">
	<fieldset style="width: 300px;float: right;position: absolute;top: 174px;left: 700px;">
		<legend><h2>Update data point</h2></legend>
		<input name="nomer" type="hidden" value="<? echo $prodid;?>"><br />
		Distributor <br />
		<select name="distributor_id">
		<?php
		// mulai fetch kategori
		if ($hasil=mysql_query("select * from `distributor`"))
		{
			while ($datakat=mysql_fetch_assoc($hasil))
			{
		?>
		<option value="<? echo $datakat['distributor_id']; ?>" <?php if ($datakat['id_distributor'] == $itemupdate['distributor_id']){ echo "selected=\"true\""; } ?>><? echo $datakat['name_distributor']; ?></option>
		<?php	
			}
		}
		// eof fetch kategori
		?>
	</select><br /><br>
	
		Bulan <br />
		<select name="month">
		<?php
		for ($i=0;$i<=11;$i++){
		?>
			<option value="<?php echo $months[$i]; ?>" <?php if ($months[$i] == $itemupdate['month']){ echo "selected=\"true\""; } ?>><?php echo $months[$i]; ?></option>
		<?php } ?>
		</select><br /><br>
		
		Tahun <br />
		<select name="year">
		<?php
		for ($i=2013;$i<=2020;$i++){
		?>
			<option value="<?php echo $i; ?>" <?php if ($i == $itemupdate['years']){ echo "selected=\"true\""; } ?>><?php echo $i; ?></option>
		<?php } ?>
		</select><br /><br>
		<h2>Poin</h2>
		<span>Angka desimal menggunakan titik</span>
		<hr>
	ND point<br />
		<div class="jqTransformInputWrapper jqTransformSafari jqTransformInputWrapper_hover" style="width: 210px; "><div class="jqTransformInputInner"><div><input class="jqTransformInput jqtranformdone" type="text" name="nd_point" value="<? echo $itemupdate['nd_point']?>" style="width: 226px; " id="num"></div></div></div><br /><br /><br />
		
	VOL point <br />
		<div class="jqTransformInputWrapper jqTransformSafari jqTransformInputWrapper_hover" style="width: 210px; "><div class="jqTransformInputInner"><div><input class="jqTransformInput jqtranformdone" type="text" name="vol_point" value="<? echo $itemupdate['vol_point'];?>" style="width: 226px; " id="num"></div></div></div><br /><br /><br />
		
	MPS point <br />
		<div class="jqTransformInputWrapper jqTransformSafari jqTransformInputWrapper_hover" style="width: 210px; "><div class="jqTransformInputInner"><div><input class="jqTransformInput jqtranformdone" type="text" name="mps_point" value="<? echo $itemupdate['mps_point'];?>" style="width: 226px;" id="num"></div></div></div><br /><br /><br />
		
	Average point <br />
		<div class="jqTransformInputWrapper jqTransformSafari jqTransformInputWrapper_hover" style="width: 210px; "><div class="jqTransformInputInner"><div><input class="jqTransformInput jqtranformdone" type="text" name="average_point" value="<? echo $itemupdate['average_point'];?>" style="width: 226px;" id="num"></div></div></div><br /><br /><br />

	<button id="" name="tblupdate" type="submit" class="jqTransformButton"><span><span>Update data point</span></span></button>
	</fieldset>
	</form>
	<?php } ?>
	
<?php
} else {
	echo "silahkan login kembali";
}
?>