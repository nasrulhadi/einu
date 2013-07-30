<?php
session_start();
if(!isset($_SESSION['username'])){
	session_destroy();
	header("location: index.php");
}
include "../../inc/config.php";
if (!empty($_FILES)) {
	$tempFile = $_FILES['Filedata']['tmp_name'];
	$targetPath = $_SERVER['DOCUMENT_ROOT'] . $_GET['folder'] . '/';
	$newFileName = $_FILES['Filedata']['name'];
	$targetFile =  str_replace('//','/',$targetPath) . $newFileName;
	
	// Uncomment the following line if you want to make the directory if it doesn't exist
	// mkdir(str_replace('//','/',$targetPath), 0755, true);
	
	move_uploaded_file($tempFile,$targetFile);
	$q = mysql_query("INSERT INTO `rusunawa` (`id_rusunawa`, `nama_rusunawa`, `deskripsi`, `gambar_rusunawa`, `tanggal_buat`) VALUES (NULL, 'isi judul rusunawa', 'isi deskripsi rusunawa', '$newFileName', CURRENT_TIMESTAMP);") or die(mysql_error());
}

if ($newFileName)
	echo $newFileName;
else // Required to trigger onComplete function on Mac OSX
	echo '1';

?>