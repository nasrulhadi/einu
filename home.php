<?php
include "inc/head.php";
if ($_GET['act'] == "logout"){
	session_destroy();
	header("location: index.php");
}
if (!isset($_SESSION['username_user'])){
	session_destroy();
	header("location: index.php");
}
if (!isset($_GET['gid']) && !isset($_GET['rid'])){
	$user_type = $_SESSION['user_type'];
	if ($user_type == "user"){
		$landing = $_SESSION['default_region'];
		header("location: home.php?gid=".$landing);
	} 
	if ($user_type == "asm") {
		$landing = $_SESSION['default_region'];
		header("location: home.php?rid=".$landing);
	}
}
$q = mysql_query("select `waktu_point` from website_setting");
$data_waktu = mysql_fetch_array($q);
// some conf of functional
if ($data_waktu == 0) {
	$month = strtolower(date("F", strtotime("-1 month"))); //  //  strtolower('February'); //
} else {
	$month = strtolower(date("F", mktime(0, 0, 0, $data_waktu['waktu_point'], 10))); //  //  strtolower('February'); //
}
$year = date("Y"); //  '2013'; //
$bigmonth = strtoupper($month);
$dist_group = mysql_real_escape_string($_GET['gid']);
$dist_region = mysql_real_escape_string($_GET['rid']);
$prev_month = strtolower(Date(F, strtotime($month . " last month")));

echo $prev_month;
echo $dist_region;
echo $month;

if (!empty($dist_region)){
$group_query = mysql_query("select * from region where id_region='$dist_region'") or die(mysql_error());
$data_group = mysql_fetch_array($group_query);
}
if (!empty($dist_group)){
// get group data
$group_query = mysql_query("select * from `group` inner join region on `group`.group_zone=`region`.id_region where `group`.group_id='$dist_group'") or die(mysql_error());
$data_group = mysql_fetch_array($group_query);
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Juaraliga.com | Home</title>
<link rel="stylesheet" type="text/css" href="style.css"/>
<script type="text/javascript" src="js/jquery-1.8.1.min.js"></script>
<script src="js/jquery.countdown.min.js" type="text/javascript" charset="utf-8"></script>
<script src="js/cufon-yui.js" type="text/javascript"></script>
<script src="js/myriad-pro.cufonfonts.js" type="text/javascript"></script>
<script src="js/cufon-replace.js" type="text/javascript"></script>
<script src="js/script.js" type="text/javascript"></script>
<script src="js/nasa_400.font.js" type="text/javascript"></script>
<script src="js/myriad_400.font.js" type="text/javascript"></script>
<link href="reset-min.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css" href="styles/examples.css">
<!-- chart -->
<script src="js_graphic/js/highcharts.js"></script>
<script src="js_graphic/js/modules/exporting.js"></script>
<!-- Core CSS File. The CSS code needed to make eventCalendar works -->
<link rel="stylesheet" href="eventCalendar_v042/css/eventCalendar.css">
<!-- Theme CSS file: it makes eventCalendar nicer -->
<link rel="stylesheet" href="eventCalendar_v042/css/eventCalendar_theme_responsive.css">
<script src="eventCalendar_v042/js/jquery.eventCalendar.js" type="text/javascript"></script>
<script src="eventCalendar_v042/js/jquery.eventCalendar.js" type="text/javascript"></script>
<script src="__jquery.tablesorter/addons/pager/jquery.tablesorter.pager.js" type="text/javascript"></script>
<script src="__jquery.tablesorter/jquery.tablesorter.js" type="text/javascript"></script>
</head>
<body>
<div id="container-wrapper">
	<div id="header-wrapper">
    	<div class="region">
        	<div class="title">REGION <?php echo strtoupper($data_group['name_region']); ?> <?php if (!empty($gid))echo " - ".strtoupper($data_group['group_name']); ?></div><br />
        </div>
    </div>
    <div id="content-container">
    	<div id="menu">
        	<div class="menu">
<?php include "inc_page/menu_lst.php"; ?>
            </div>
        </div>
        <div id="content-wrapper">
        	<div class="filter">
            	<table border="0" cellspacing="10" cellpadding="5">
                        <tr>
                          <td>REGION</td>
                          <td>
						  <select name="region" id="region">
                            <option value="0">Select Region</option>
							<?php
							$q = mysql_query("select * from region");
							while($dg = mysql_fetch_assoc($q)){
							if ($dist_region == $dg['id_region']) {
							$selected = " selected=\"true\"";
							} else {
							$selected = "";
							}
							?>
							<option value="<?php echo $dg['id_region']; ?>"<?php echo $selected; ?>><?php echo $dg['name_region']; ?></option>
							<?php } ?>
                          </select></td>
						  <?php //if (!empty($dist_region)){?>
						  <td id="grouplbl">GROUP</td>
						  <td id="loadgroup">
						  <label>
							<select name="group" id="group">
								<option value="select">Select Group</option>
							<?php
							$region_id = $data_group['id_region'];
							$q = mysql_query("select * from `group` where group_zone='$region_id'");
							while ($data = mysql_fetch_array($q)){
								if ($data['group_id'] == $dist_group){ 
									$selecteds = " selected=\"true\""; 
								} else {
								$selecteds = "";
								}
								echo "<option value='{$data['group_id']}'$selecteds>{$data['group_name']}</option>";
							}
							?>
							</select>
							</label>
							<script>
							$(document).ready(function(){
								$("#group").change(function() {
									var val = $(this).val();
									window.location.href='home.php?gid='+val;
								});
							});
							</script>
						  </td>
						  <?php //} ?>
                        </tr>
              </table>
          </div>
          <div id="left-col" class="left">
            
			<div class="ranktable">
                    <table width="100%" border="0" cellspacing="1" cellpadding="5" class="center" id="report">
					<thead>
                      <tr>
                        <th width="32" rowspan="2" bgcolor="#a4b243" class="nosort">POS</th>
                        <th width="42" rowspan="2" bgcolor="#a4b243" class="nosort">LP</th>
                        <th width="216" rowspan="2" bgcolor="#a4b243" class="nosort">DISTRIBUTOR</th>
                        <th colspan="4" bgcolor="#a4b243" class="nosort">POINT ACHIEVEMENT <?php //echo $bigmonth." ".$year; ?> </th>
                        <th width="90" rowspan="2" bgcolor="#a4b243" class="nosort">AVERAGE PTS </th>
                      </tr>
                      <tr>
                        <th width="60" bgcolor="#a4b243" class="nosort">ND</th>
                        <th width="60" bgcolor="#a4b243" class="nosort">VOL</th>
                        <th width="60" bgcolor="#a4b243" class="nosort">MPS</th>
                        <th width="60" bgcolor="#a4b243" class="nosort">PTS</th>
                      </tr>
					 </thead>
					 <tbody>
					 <?php
					 $cnt = 1;
					 /* SELECT  *, ( select sum( nd_point )+sum( vol_point )+sum( mps_point ) from points pts where pts.distributor_id = distributor.id_distributor ) overall_point
FROM distributor INNER JOIN points on distributor.id_distributor = points.distributor_id group by id_distributor order by ABS(overall_point) DESC */
/* 
select *,nd_point+vol_point+mps_point as tot_point from points inner join distributor on points.distributor_id=distributor.id_distributor inner join `group` on distributor.group=group_id where distributor.group=1 and points.month='january' and year='2013'
*/
					
					 if (!empty($dist_region)){
					 // get all distributor by region
					 $q = mysql_query("SELECT  *, ( select sum( nd_point )+sum( vol_point )+sum( mps_point ) from points pts where pts.distributor_id = distributor.id_distributor ) overall_points FROM distributor INNER JOIN points on distributor.id_distributor = points.distributor_id inner join `group` on distributor.group=group_id where `group`.group_zone='$dist_region' group by id_distributor order by ABS(overall_points) DESC") or die(mysql_error());
					 } 
					 if (!empty($dist_group)){
					 // get all distributor by gruop
					 $q = mysql_query("SELECT  *, ( select sum( nd_point )+sum( vol_point )+sum( mps_point ) from points pts where pts.distributor_id = distributor.id_distributor ) overall_points FROM distributor INNER JOIN points on distributor.id_distributor = points.distributor_id inner join `group` on distributor.group=group_id where distributor.group='$dist_group' group by id_distributor order by ABS(overall_points) DESC") or die(mysql_error());
					 }
					 $nr = mysql_num_rows($q);
					 if ($nr == 0){
					 ?>
					 <tr onclick="hiLight(this,'#8cbde4')" class="toggle">
                		<td colspan="9" class="full"><center>maaf, belum ada data di grup ini.</center></td>
                     </tr>
					 <?
					 }
					 while ($data = mysql_fetch_array($q)){
					 
					 // get rank by region
					 if (!empty($dist_region)){
					 $dist_id = $data['distributor_id'];
					 $oq = mysql_query("select * from points inner join distributor on points.distributor_id=distributor.id_distributor inner join `group` on distributor.group=group_id where `group`.group_zone='$dist_region' and points.month='$month' and year='$year' and distributor.id_distributor='$dist_id'");
					 $pnt = mysql_fetch_array($oq);
					 
					 // get rank of previous month
					 $qpm = mysql_query("set @rank:=0;");
					 $qpm = mysql_query("SELECT @rank:=@rank+1 AS rank, p.* FROM points p inner join distributor d on p.distributor_id=d.id_distributor inner join `group` g on d.group=g.group_id where p.month='$prev_month' and g.group_zone='$dist_region' ORDER BY p.tot_point DESC") or die(mysql_error());
					 } 
					 if (!empty($dist_group)){
					 // get rank by group
					 // get point data for each distributor for this month
					 $dist_id = $data['distributor_id'];
					 $oq = mysql_query("select * from points inner join distributor on points.distributor_id=distributor.id_distributor inner join `group` on distributor.group=group_id where distributor.group='$dist_group' and points.month='$month' and year='$year' and distributor.id_distributor='$dist_id'");
					 $pnt = mysql_fetch_array($oq);
					 
					 // get rank of previous month
					 $qpm = mysql_query("set @rank:=0;");
					 $qpm = mysql_query("SELECT @rank:=@rank+1 AS rank, p.* FROM points p inner join distributor d on p.distributor_id=d.id_distributor where p.month='$prev_month' and d.group='$dist_group' ORDER BY p.tot_point DESC") or die(mysql_error());
					 }
					 
					 while ($dpm = mysql_fetch_array($qpm)){
					 	if ($dpm['distributor_id'] == $dist_id){
							$last_month_pos = $dpm['rank'];
						}
					 }
					 // create image rank
					 if ((int)$cnt > (int)$last_month_pos) $img_pos = 'down.png';
					 else if ((int)$cnt < (int)$last_month_pos) $img_pos = 'up.png';
					 else if ((int)$cnt == (int)$last_month_pos) $img_pos = 'netral.png';
					 ?>
                	 <tr onclick="hiLight(this,'#8cbde4')" class="toggle">
                		<td><?php echo $cnt; ?></td>
                        <td><img src="images/<?php echo $img_pos; ?>" width="10" height="10" /><?php echo (int)$last_month_pos; ?></td>
                        <td><?php echo $data['name_distributor']; ?></td>
                        <td><?php echo round($pnt['nd_point'], 1); ?></td>
                        <td><?php echo round($pnt['vol_point'], 1); ?></td>
                        <td><?php echo round($pnt['mps_point'], 1); ?></td>
                        <td><?php echo round($pnt['tot_point'], 1); ?></td>
                        <td><?php echo number_format($pnt['average_point'], 1, '.', '');; ?></td>
                     </tr>
					 <tr style="display:none;">
						 <td colspan="9" class="full">
						 <div class="rdetail">
							<div class="ava"><img src="images/profilepic/<?php echo $data['pic_profile']; ?>" width="82" height="82" /></div>
							<div class="rcontent left"><span class="rname"><?php echo $data['name_distributor']; ?></span><br />
							<!-- No Distributor	: <?php echo $data['no_distributor']; ?><br />
							Area			: <?php echo $data['area']; ?><br />
							Alamat			: <?php echo $data['address']; ?><br />
							Telephone		: <?php echo $data['telephone']; ?><br />
							Order			: <?php echo $data['order']; ?>	-->					 
						</div>
						 <div class="clear"></div>
						 <div id="container<?php echo $data['id_distributor']; ?>" style="min-width: 668px; height: 400px; margin: 0 auto;">
						 </div>
						 <script>
							var chart;
							$(function() {
								chart = new Highcharts.Chart({
									chart: {
										renderTo: 'container<?php echo $data['id_distributor']; ?>',
										type: 'line',
										marginRight: 0,
										marginBottom: 25
									},
									title: {
										text: 'Point Bulanan',
										x: 0 //center
									},
									subtitle: {
										text: '<?php echo $data['name_distributor']; ?>',
										x: 0
									},
									xAxis: {
										categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun',
											'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
									},
									yAxis: {
										title: {
											text: 'Point(s)'
										},
										plotLines: [{
											value: 0,
											width: 1,
											color: '#808080'
										}]
									},
									tooltip: {
										formatter: function() {
												return '<b>'+ this.series.name +'</b><br/>'+
												this.x +': '+ this.y +' point(s)';
										}
									},
									legend: {
										layout: 'vertical',
										align: 'right',
										verticalAlign: 'top',
										x: -10,
										y: 100,
										borderWidth: 0
									},
									series: [{
										name: '<?php echo $data['name_distributor']; ?>',
										data: [<?php $gq = mysql_query("select *, nd_point+vol_point+mps_point as tot_point from points where distributor_id='$dist_id'") or die(mysql_error()); while ($dchart= mysql_fetch_assoc($gq)){ echo round($dchart['tot_point'], 2).","; }?>]
									}]
								});
							});
						 </script>						
						 </td>
					</tr>
					<?php $cnt++; } ?>
					</tbody>
					<!-- <tfoot>
                      <tr>
                        <th width="32" rowspan="2" bgcolor="#8b95a5" class="nosort">POS</th>
                        <th width="42" rowspan="2" bgcolor="#8b95a5" class="nosort">LP</th>
                        <th width="216" rowspan="2" bgcolor="#8b95a5" class="nosort">DISTRIBUTOR</th>
                        <th colspan="4" bgcolor="#8b95a5" class="nosort">POINT ACHIEVEMENT <?php echo $bigmonth." ".$year; ?> </th>
                        <th width="90" rowspan="2" bgcolor="#8b95a5" class="nosort">AVERAGE PTS </th>
                      </tr>
                      <tr>
                        <th width="60" bgcolor="#8b95a5" class="nosort">ND</th>
                        <th width="60" bgcolor="#8b95a5" class="nosort">VOL</th>
                        <th width="60" bgcolor="#8b95a5" class="nosort">MPS</th>
                        <th width="60" bgcolor="#8b95a5" class="nosort">PTS</th>
                      </tr>
					</tfoot> -->
              </table>
			</div>
					<div class="clear"></div>
					<div id="keterangan" style="padding-top: 10px; color: #807E7E;padding-left: 20px;font-size: 11px;">
					<h3 style="font-weight: bold;">KETERANGAN</h3>
					<p style="padding-top: 10px;">
					<span style="padding-right: 60px;">POS</span> : Position<br />
					<span style="padding-right: 69px;">LP</span> : Last Position<br />
					<span style="padding-right: 15px;">DISTRIBUTOR</span> : Nama Distributor<br />
					<span style="padding-right: 67px;">ND</span> : Numeric Distributor<br />
					<span style="padding-right: 59px;">VOL</span> : Volume<br />
					<span style="padding-right: 60px;">MPS</span> : Mizone Prime Store<br />
					<span style="padding-right: 62px;">PTS</span> : Points<br />
					<span style="padding-right: 11px;">AVERAGE PTS</span>: Point Rata - Rata<br />
					</p>
					</div>
					<!-- <div id="pager" class="pager">
						<form>
							<img src="__jquery.tablesorter/addons/pager/icons/first.png" class="first"/>
							<img src="__jquery.tablesorter/addons/pager/icons/prev.png" class="prev"/>
							<input type="text" class="pagedisplay"/>
							<img src="__jquery.tablesorter/addons/pager/icons/next.png" class="next"/>
							<img src="__jquery.tablesorter/addons/pager/icons/last.png" class="last"/>
							<select class="pagesize">
								<option selected="selected" value="10">5</option>
								<option value="20">10</option>
							</select>
						</form>
					</div> -->
          </div>
        <div id="right-col" class="right">
<?php include "inc_page/sidebar.php"; ?>
        </div>
    </div>
</div>
</body>
</html>