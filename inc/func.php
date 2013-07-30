<?php
function redirect_to_admin(){
	if (ISSET($_SESSION['username_admin'])) header("location: admin.php");
}

function check_admin_session(){
	if (!ISSET($_SESSION['username_admin']) && !ISSET($_SESSION['useragent'])) header("location: index.php");
}

function sendEmail($name, $email, $to_mail, $subject, $msg) {
    $sending = false;
    $eol = "\n";
    $tosend = array();

    if (!empty($name) && !empty($email) && !empty($to_mail) && !empty($subject) && !empty($msg)) {
        $from_name = $name;
        $from_mail = $email;
        $sending = true;
    }

    if ($sending) {
        $tosend['email'] = $to_mail;
        $tosend['subject'] = $subject;

        $tosend['headers'] = "From: \"".$from_name."\" <".$from_mail.">".$eol;
        $tosend['headers'] .= "Content-type: text/html; charset=iso-8859-1".$eol;
        $tosend['message'] = $msg;

        if (mail($tosend['email'], $tosend['subject'], $tosend['message'] , $tosend['headers']))
            return true;
        else
            return false;
        }//-- if ($sending)
    return false;
}

function str_makerand($minlength, $maxlength, $useupper, $usespecial, $usenumbers){
	/*
	Author: Peter Mugane Kionga-Kamau
	http://www.pmkmedia.com
	
	Description: string str_makerand(int $minlength, int $maxlength, bool $useupper, bool $usespecial, bool $usenumbers)
	returns a randomly generated string of length between $minlength and $maxlength inclusively.
	
	Notes:
	- If $useupper is true uppercase characters will be used; if false they will be excluded.
	- If $usespecial is true special characters will be used; if false they will be excluded.
	- If $usenumbers is true numerical characters will be used; if false they will be excluded.
	- If $minlength is equal to $maxlength a string of length $maxlength will be returned.
	- Not all special characters are included since they could cause parse errors with queries.
	
	Modify at will.
	*/
	$charset = "abcdefghijklmnopqrstuvwxyz";
	if ($useupper) $charset .= "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
	if ($usenumbers) $charset .= "0123456789";
	if ($usespecial) $charset .= "~@#$%^*()_+-={}|]["; // Note: using all special characters this reads: "~!@#$%^&*()_+`-={}|\\]?[\":;'><,./";
	if ($minlength > $maxlength) $length = mt_rand ($maxlength, $minlength);
	else $length = mt_rand ($minlength, $maxlength);
	for ($i=0; $i<$length; $i++) $key .= $charset[(mt_rand(0,(strlen($charset)-1)))];
	return $key;
}

function GetDomain($url){
$nowww = ereg_replace('www\.','',$url);
$domain = parse_url($nowww);
if(!empty($domain["host"]))
    {
     return $domain["host"];
     } else
     {
     return $domain["path"];
     }
 
}

function easytime_ID($date){
	$stf = 0;
	$cur_time = time();
	$diff = $cur_time - $date;
	$phrase = array('detik','menit','jam','hari','minggu','bulan','tahun','dekade');
	$length = array(1,60,3600,86400,604800,2630880,31570560,315705600);
	for($i =sizeof($length)-1; ($i >=0)&&(($no = $diff/$length[$i])<=1); $i--); if($i < 0) $i=0; $_time = $cur_time -($diff%$length[$i]);
	$no = floor($no); if($no <> 1) $phrase[$i] .=''; $value=sprintf("%d %s ",$no,$phrase[$i]);
	if(($stf == 1)&&($i >= 1)&&(($cur_tm-$_time) > 0)) $value .= time_ago($_time);
	return $value.' yang lalu';
}
?>
