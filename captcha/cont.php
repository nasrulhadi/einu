<body>

	<div id="form_container">
		<form id="form_37505" class="appnitro"  method="post" action="">

<?
// prosesi kontak
error_reporting(0);
$ip = htmlspecialchars(stripslashes(strip_tags($_SERVER['REMOTE_ADDR'])));
$user_agent = htmlspecialchars(stripslashes(strip_tags($_SERVER['HTTP_USER_AGENT'])));
$nama = htmlspecialchars(stripslashes(strip_tags($_POST['nama'])));
$email = htmlspecialchars(stripslashes(strip_tags($_POST['email'])));
$phone = htmlspecialchars(stripslashes(strip_tags($_POST['phone'])));
$pesan = htmlspecialchars(stripslashes(strip_tags($_POST['pesan'])));
$send = htmlspecialchars(stripslashes(strip_tags($_POST['send'])));
require "securimage.php";
$img = new Securimage();
$valid = $img->check($_POST['kode_verifikasi']);
if (ISSET($_POST['email']) && eregi("^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$",$email)){
	if ($valid == true) {
		if (!$hasil=mysql_query("INSERT INTO `kontak` (`con_id`, `con_nama`, `con_email`, `con_phone`, `con_pesan`, `con_ip`, `con_user_agent`, `con_date`) VALUES (NULL, '$nama', '$email', '$phone', '$pesan', '$ip', '$user_agent', CURRENT_TIMESTAMP);")){
			echo "<font color=\"red\">Ada yang belum benar mohon ulangi kembali</font>";
			} else {
				echo "<font color=\"green\">Terima kasih untuk menghubungi kami, kami akan baca secepatnya</font>";
			}
		} else if (ISSET($_POST['kode_verifikasi']) && $valid == false) {
			echo "<font color=\"red\">Kode verifikasi salah !</font>";	
	}
} else if (ISSET($_POST['email']) && !eregi("^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$",$email)){
	echo "<font color=\"red\">Mohon periksa kembali email anda</font>";		
}
echo "<br />";
?>	
			
			<div class="form_description">
			<h2>Kontak kami</h2>
			<p>Silahkan isi form berikut ini dengan lengkap untuk menghubungi kami</p>
	</div>						
			<ul >
			
					<li id="li_1" >
		<label class="description" for="element_1">Nama </label>
		<div>
			<input id="element_1" name="nama" class="element text medium" type="text" maxlength="255" value=""/> 
		</div><p class="guidelines" id="guide_1"><small>Nama anda</small></p> 
		</li>		
		<li id="li_2" >
		<label class="description" for="email">Email </label>
		<div>
			<input id="element_2" name="email" class="element text medium" type="text" maxlength="255" value=""/> 
		</div><p class="guidelines" id="guide_2"><small>Email anda</small></p> 
		</li>		
		<li id="li_3" >
		<label class="description" for="phone">Phone </label>
		<div>
			<input id="element_3" name="phone" class="element text medium" type="text" maxlength="255" value=""/> 
		</div><p class="guidelines" id="guide_3"><small>Nomer Telepon / Handphone</small></p> 
		</li>		
		<li id="li_4" >
		<label class="description" for="pesan">Pesan </label>
		<div>
			<textarea id="element_4" name="pesan" class="element textarea medium"></textarea> 
		</div><p class="guidelines" id="guide_4"><small>Pesan anda</small></p> 
		</li>
				
		<li id="li_5" >
		<img src="form/securimage_show.php?sid=<?php echo md5(uniqid(time())); ?>" alt="captcha" align="top" />
		<label class="description" for="kode_verifikasi">Kode verifikasi </label>
		<div>
			<input id="element_5" name="kode_verifikasi" class="element text medium" type="text" maxlength="255" value=""/> 
		</div><p class="guidelines" id="guide_5"><small>Kode verifikasi anti spam</small></p> 
		</li>
		<li class="buttons">
			    <input type="hidden" name="form_id" value="37505" />		    
				<input id="saveForm" class="button_text" type="submit" name="send" value="Submit" />
		</li>
			</ul>
		</form>	
		<div id="footer"></div>
	</div>
	<img id="bottom" src="form/bottom.png" alt="">
