<?php
//error_reporting(0);
// defining variable
$website_name 		= "juaraliga.com";
$website_base_url 	= "http://juaraliga.com/";
$name_powered_by 	= "Arekmedia Indonesia";
$url_powered_by 	= "http://www.arekmedia.com/";
$use_md5_enc        = false;
$username_db        = 'root';
$password_db		= 'root';
$host_db		    = 'localhost';
$database_name		= 'danone_db';
// use class
if (@file_exists("../core/mwp.class.php")){
	include_once "../core/mwp.class.php";
	$mwpclass = new mwpclass($debug=true);
	$mwpclass->open_database($username=$username_db, $password=$password_db, $host=$host_db, $database=$database_name);
	$mwpclass->global_var();
} else if (@file_exists("core/mwp.class.php")) {
	include_once "core/mwp.class.php";
	$mwpclass = new mwpclass($debug=true);
	$mwpclass->open_database($username=$username_db, $password=$password_db, $host=$host_db, $database=$database_name);
	$mwpclass->global_var();
}
if (@file_exists("../../core/mwp.class.php")){
	include_once "../../core/mwp.class.php";
	$mwpclass = new mwpclass($debug=true);
	$mwpclass->open_database($username=$username_db, $password=$password_db, $host=$host_db, $database=$database_name);
	$mwpclass->global_var();
}


// kcfinder configuration
$kcfinder_directory = "kcfinder-2.21/";
$_CONFIG = array(

    'disabled' => false, // if true, file browser won't show up
    'readonly' => false,
    'denyZipDownload' => false,

    'theme' => "oxygen",

    'uploadURL' => "../../upload/", // file upload directory
    'uploadDir' => "",

    'dirPerms' => 0755,
    'filePerms' => 0644,

    'deniedExts' => "exe com msi bat php cgi pl py php3 php4",

    'types' => array(

        // CKEditor & FCKEditor types
        'files'   =>  "",
        'flash'   =>  "swf",
        'images'  =>  "*img",

        // TinyMCE types
        'file'    =>  "",
        'media'   =>  "swf flv avi mpg mpeg qt mov wmv asf rm",
        'image'   =>  "*img",
    ),

    'mime_magic' => "",

    'maxImageWidth' => 0,
    'maxImageHeight' => 0,

    'thumbWidth' => 100,
    'thumbHeight' => 100,

    'thumbsDir' => ".thumbs",

    'jpegQuality' => 90,

    'cookieDomain' => "",
    'cookiePath' => "",
    'cookiePrefix' => 'KCFINDER_',

    // THE FOLLOWING SETTINGS CANNOT BE OVERRIDED WITH SESSION CONFIGURATION

    '_check4htaccess' => true,
    //'_tinyMCEPath' => "/tiny_mce",

    '_sessionVar' => &$_SESSION['KCFINDER'],
    //'_sessionLifetime' => 30,
    //'_sessionDir' => "/full/directory/path",

    //'_sessionDomain' => ".mysite.com",
    //'_sessionPath' => "/my/path",
);
date_default_timezone_set('Asia/Jakarta');
?>