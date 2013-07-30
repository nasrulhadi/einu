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
// some conf of functional
$month = 'february'; //strtolower(date("F"));
$bigmonth = strtoupper($month);
$year = '2013'; //date("Y");
$dist_group = mysql_real_escape_string($_GET['gid']);
$prev_month = strtolower(date('F',strtotime($month.' - 1 month')));

// get group data
$group_query = mysql_query("select * from `group` inner join region on `group`.group_zone=`region`.id_region where `group`.group_id='$dist_group'") or die(mysql_error());
$data_group = mysql_fetch_array($group_query);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Juaraliga.com</title>
<link rel="stylesheet" type="text/css" href="style.css"/>
<script type="text/javascript" src="js/jquery-1.8.1.min.js"></script>
<script src="js/jquery.countdown.min.js" type="text/javascript" charset="utf-8"></script>
<script src="js/cufon-yui.js" type="text/javascript"></script>
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
        	Region <?php echo $data_group['name_region']; ?>
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
							?>
							<option value="<?php echo $dg['id_region']; ?>"><?php echo $dg['name_region']; ?></option>
							<?php } ?>
                          </select></td>
                          <td id="grouplbl" style="display:none;">GROUP</td>
                          <td id="loadgroup"></td>
                        </tr>
              </table>
          </div>
          <div id="left-col" class="left">
            <div class="title">RAIHAN POIN DISTRIBUTOR <?php echo strtoupper($data_group['name_region']); ?> - <?php echo strtoupper($data_group['group_name']); ?></div><br />
			<div class="ranktable">
                    <table width="100%" border="0" cellspacing="1" cellpadding="5" class="center" id="report">
					<thead>
                      <tr>
                        <th width="32" rowspan="2" bgcolor="#8b95a5" class="nosort">POS</th>
                        <th width="42" rowspan="2" bgcolor="#8b95a5" class="nosort">LP</th>
                        <th width="216" rowspan="2" bgcolor="#8b95a5" class="nosort">DISTRIBUTOR</th>
                        <th colspan="4" bgcolor="#8b95a5" class="nosort">POINT ACHIEVEMENT <?php echo $bigmonth." ".$year; ?> </th>
                        <th width="90" rowspan="2" bgcolor="#8b95a5" class="nosort">OVERALL PTS </th>
                      </tr>
                      <tr>
                        <th width="60" bgcolor="#8b95a5" class="nosort">ND</th>
                        <th width="60" bgcolor="#8b95a5" class="nosort">VOL</th>
                        <th width="60" bgcolor="#8b95a5" class="nosort">MPS</th>
                        <th width="60" bgcolor="#8b95a5" class="nosort">PTS</th>
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
					 // get all distributor
					 $q = mysql_query("SELECT  *, ( select sum( nd_point )+sum( vol_point )+sum( mps_point ) from points pts where pts.distributor_id = distributor.id_distributor ) overall_points FROM distributor INNER JOIN points on distributor.id_distributor = points.distributor_id inner join `group` on distributor.group=group_id where distributor.group='$dist_group' group by id_distributor order by ABS(overall_points) DESC") or die(mysql_error());
					 $nr = mysql_num_rows($q);
					 if ($nr == 0){
					 ?>
					 <tr onclick="hiLight(this,'#8cbde4')" class="toggle">
                		<td colspan="9" class="full"><center>maaf, belum ada data di grup ini.</center></td>
                     </tr>
					 <?
					 }
					 while ($data = mysql_fetch_array($q)){
					 
					 // get point data for each distributor for this month
					 $dist_id = $data['distributor_id'];
					 $oq = mysql_query("select * from points inner join distributor on points.distributor_id=distributor.id_distributor inner join `group` on distributor.group=group_id where distributor.group='$dist_group' and points.month='$month' and year='$year' and distributor.id_distributor='$dist_id'");
					 $pnt = mysql_fetch_array($oq);
					 
					 // get rank of previous month
					 mysql_query("set @rank:=0;");
					 $qpm = mysql_query("SELECT @rank:=@rank+1 AS rank, p.*  FROM points p where p.month='$prev_month' ORDER BY p.tot_point DESC") or die(mysql_error());
					 while ($dpm = mysql_fetch_array($qpm)){
					 	if ($dpm['distributor_id'] == $dist_id){
							$last_month_pos = $dpm['rank'];
						}
					 }
					 
					 mysql_query("set @rank:=0;");
					 // get rank of this month
					 $qtm = mysql_query("SELECT @rank:=@rank+1 AS rank, p.*  FROM points p where p.month='$month' ORDER BY p.tot_point DESC") or die(mysql_error());
					 while ($dtm = mysql_fetch_array($qtm)){
					 	if ($dtm['distributor_id'] == $dist_id){
							$this_month_pos = $dtm['rank'];
						}
					 }
					 // create image rank
					 if ((int)$this_month_pos > (int)$last_month_pos) $img_pos = 'up.png';
					 else if ((int)$this_month_pos < (int)$last_month_pos) $img_pos = 'down.png';
					 else if ((int)$this_month_pos == (int)$last_month_pos) $img_pos = 'right.gif';
					 ?>
                	 <tr onclick="hiLight(this,'#8cbde4')" class="toggle">
                		<td><?php echo $cnt; ?></td>
                        <td><img src="images/<?php echo $img_pos; ?>" width="10" height="10" /><?php echo $this_month_pos; ?></td>
                        <td><?php echo $data['name_distributor']; ?></td>
                        <td><?php echo round($pnt['nd_point'], 1); ?></td>
                        <td><?php echo round($pnt['vol_point'], 1); ?></td>
                        <td><?php echo round($pnt['mps_point'], 1); ?></td>
                        <td><?php echo round($pnt['tot_point'], 1); ?></td>
                        <td><?php echo round($data['overall_points'], 2); ?></td>
                     </tr>
					 <tr style="display:none;">
						 <td colspan="9" class="full">
						 <div class="rdetail">
							<div class="ava"><img src="images/ava.gif" width="82" height="82" /></div>
							<div class="rcontent left"><span class="rname"><?php echo $data['name_distributor']; ?></span><br />
							No Distributor	: <?php echo $data['no_distributor']; ?><br />
							Area			: <?php echo $data['area']; ?><br />
							Alamat			: <?php echo $data['address']; ?><br />
							Telephone		: <?php echo $data['telephone']; ?><br />
							Order			: <?php echo $data['order']; ?>						 
						</div>
						 <div class="clear"></div>
						 <div id="container<?php echo $data['id_distributor']; ?>" style="min-width: 668px; height: 400px; margin: 0 auto">
						 </div>
						 <script>
							var chart;
							$(document).ready(function() {
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
					<tfoot>
                      <tr>
                        <th width="32" rowspan="2" bgcolor="#8b95a5" class="nosort">POS</th>
                        <th width="42" rowspan="2" bgcolor="#8b95a5" class="nosort">LP</th>
                        <th width="216" rowspan="2" bgcolor="#8b95a5" class="nosort">DISTRIBUTOR</th>
                        <th colspan="4" bgcolor="#8b95a5" class="nosort">POINT ACHIEVEMENT JANUARY 2013  </th>
                        <th width="90" rowspan="2" bgcolor="#8b95a5" class="nosort">OVERALL PTS </th>
                      </tr>
                      <tr>
                        <th width="60" bgcolor="#8b95a5" class="nosort">ND</th>
                        <th width="60" bgcolor="#8b95a5" class="nosort">VOL</th>
                        <th width="60" bgcolor="#8b95a5" class="nosort">MPS</th>
                        <th width="60" bgcolor="#8b95a5" class="nosort">PTS</th>
                      </tr>
					</tfoot>
              </table>
			</div>
					<div class="clear"></div>
					<div id="pager" class="pager">
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
					</div>
          </div>
        <div id="right-col" class="right">
	         <div class="title">Event</div>
			<div id="eventCalendarLocale" style="width: 180px"></div>
			<script>
				$(document).ready(function() {
					$("#eventCalendarLocale").eventCalendar({
						eventsjson: 'eventCalendar_v042/json/events.json.php',
						monthNames: [ "Januari", "Februari", "Maret", "April", "Mei", "Juni","Juli", "Agustus", "September", "October", "November", "Desember" ],
						dayNames: [ 'Minggu','Senin','Selasa','Rabu','Kamis','Jum\'at','Sabtu' ],
						dayNamesShort: [ 'Mgu','Sen','Sel','Rab','Kam','Jum','Sab' ],
						txt_noEvents: "Tidak ada event pada hari itu",
						txt_SpecificEvents_prev: "",
						txt_SpecificEvents_after: "Event:",
						txt_next: "Selanjutnya",
						txt_prev: "Sebelumnya",
						txt_NextEvents: "Event Selanjutnya:",
						txt_GoToEventUrl: "Pergi ke laman",
						openEventInNewWindow: false,
  						showDescription: true
					});
				});
			</script>

        </div>
        <div class="clear"></div>
        </div>
    </div>
</div>
</body>
</html>