<?php
include "../inc/config.php";
?>
<label>
<select name="group" id="group">
	<option value="select">Select Group</option>
<?php
$region_id = mysql_real_escape_string($_GET['rid']);
$q = mysql_query("select * from `group` where group_zone='$region_id'");
while ($data = mysql_fetch_array($q)){
	echo "<option value='{$data['group_id']}'>{$data['group_name']}</option>";
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