<?php
/**
 *      @version 1.0
 *      @package Media Website Plus Website Development PHP Class
 *      @copyright (c) 2011 www.mediawebsiteplus.com
 *      @author Yudha Gunslinger <yudha.gunslinger@gmail.com>
 * 
 *      mwp.class.php
 *      
 *      Copyright 2011 gunslinger_ <yudha.gunslinger@gmail.com>
 *      
 *      This program is free software; you can redistribute it and/or modify
 *      it under the terms of the GNU General Public License as published by
 *      the Free Software Foundation; either version 2 of the License, or
 *      (at your option) any later version.
 *      This program is free software; you can redistribute it and/or modify
 *      it under the terms of the GNU General Public License as published by
 *      the Free Software Foundation; either version 2 of the License, or
 *      (at your option) any later version.
 *      
 *      This program is distributed in the hope that it will be useful,
 *      but WITHOUT ANY WARRANTY; without even the implied warranty of
 *      MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *      GNU General Public License for more details.
 *      
 *      You should have received a copy of the GNU General Public License
 *      along with this program; if not, write to the Free Software
 *      Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston,
 *      MA 02110-1301, USA.
 */
class mwpclass {
	protected $debug;
	public function mwpclass($debug=false) {
		// TO DO
		$this->debug = $debug;
	}
	
	/** 
	 * @name : debug_mysql_error 
	 * @desc : debug mysql error information function
	 * @param : none
	 * @return : none
	 */
	private function debug_mysql_error(){
		if ($this->debug) die("<div style=\"background-color: #cecece; position: absolute; top: 0; left: 0; width: 100%;\">
								<span style=\"color: #ff0000;\">Mysql error.</span>
								<ul style=\"list-style: none; color: #0000ff;\">
									<li>Error Detail : ".mysql_error()."</li>
									<li>Error number : ".mysql_errno()."</li>
								</ul>
								</div>");
	}
	
	/**
	 * @name : open_database
	 * @desc : function that connect to mysql and open database
	 * @param : $username, $password, $host, $database
	 * @return : 
	 */
	public function open_database($username='root', $password='', $host='localhost', $database='') {
		$conn = mysql_connect($host, $username, $password) or $this->debug_mysql_error();
		$select_db = mysql_select_db($database) or $this->debug_mysql_error();
	}
	
	/**
	 * @name : run_query
	 * @desc : function that run queries through mysql_query
	 * @param : $query
	 * @return : $resource
	*/
	public function run_query($query=''){
		$this -> resource = mysql_query($query) or $this->debug_mysql_error();
		return $resource = $this -> resource;
	}
	
	/**
	 * @name : makerand_str
	 * @desc : function for making random string
	 * @param : $minlength, $maxlength, $useuppper, $usespecial, $usenumbers
	 * @return : $key
	 */
	public function makerand_str($minlength=3, $maxlength=5, $useupper=true, $usespecial=true, $usenumbers=true){
		$charset = "abcdefghijklmnopqrstuvwxyz";
		if ($useupper) $charset .= "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
		if ($usenumbers) $charset .= "0123456789";
		if ($usespecial) $charset .= "~@#$%^*()_+-={}|]["; // Note: using all special characters this reads: "~!@#$%^&*()_+`-={}|\\]?[\":;'><,./";
		if ($minlength > $maxlength) $length = mt_rand ($maxlength, $minlength);
		else $length = mt_rand ($minlength, $maxlength);
		for ($i=0; $i<$length; $i++) $key .= $charset[(mt_rand(0,(strlen($charset)-1)))];
		return $key;
	}
	
	/**
	 * @name : easytime_id
	 * @desc : indonesian past time calculator. example : 10 menit yang lalu
	 * @param : $date
	 * @return : $value
	 */
	public function easytime_ID($date=0){
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
	
	/**
	 * @name : sanitize_sql
	 * @desc : sanitize sql command from outside. (mysql injection hacking attack prevention)
	 * @param : $query
	 * @return : $query
	 */
	public function sanitize_sql($query='') {
		if (function_exists("mysql_real_escape_string")){
			$query = mysql_real_escape_string($query); // Escape the MySQL string.
		} else { // If PHP version < 4.3.0
			$query = addslashes($query); // Precede sensitive characters with a backslash \
		}
		return $query; // Return the sanitized code
	}
	
	/**
	 * @name : sanitize_html
	 * @desc : sanitize html tags from outside. (html injection hacking attack prevention)
	 * @param : $query
	 * @return : $query
	 */
	public function sanitize_html($data=''){
		$data = htmlspecialchars(stripslashes(strip_tags($data)));
		return $data;
	}

	/**
	 * @name : get_int_only
	 * @desc : validate integer only data. or die !
	 * @param : $num
	 * @return : true / false (boolean)
	 */
	public function get_int_only($num=1){
		if(strlen($num) > 0 and !is_numeric($num) || $num<0)
			return false;
		else
			return true;
	}
	
	/**
	 * @name : create_preview
	 * @desc : create preview like blog does. without breaking the word.
	 * @param : $data, $min, $max, $wh_space_pos
	 * @return : $preview
	 */
	public function create_preview($data='', $min=0, $max=250, $wh_space_pos=230){
		if ((strlen($data) > $max) && (strlen($data) > $min)){
			$whitespaceposition = strpos($data," ",$wh_space_pos);
			$preview = substr($data, 0, $whitespaceposition);
		}
		return $preview;
	}
	
	/**
	 * @name : send_html_email
	 * @desc : sending html email through php mail() function.
	 * @param : $name, $email, $to_email, $subject, $msg
	 * @return : true / false (boolean)
	 */
	public function send_html_email($name='', $email='', $to_mail='', $subject='', $msg='Hello') {
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
	
	/**
	 * @name : validate_email
	 * @desc : email validation on server side through php function.
	 * @param : $email, $mx_validation
	 * @return : $result = true / false (boolean)
	 */
	public function validate_email($email, $mx_validation=false){
		$result = true;
		if(!eregi("^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,4})$", $email)) $result = false;
		// challenge more
		if ($mx_validation && $result){
			list($Username, $Domain) = split("@",$email);
			if(getmxrr($Domain, $MXHost)) $result = true;
			else {
				try {
					if ($this-> debug) if(fsockopen($Domain, 25, $errno, $errstr, 30)) $result = true;
					else if(@fsockopen($Domain, 25, $errno, $errstr, 30)) $result = true;
					else throw new Exception("Email mx record isn't valid");
				} catch(Exception $e) { 
					// echo 'Message: ' .$e->getMessage();
					$result = false;
				}
			}
		}
		return $result;
	}
	
	/**
	 * @name : global_var
	 * @desc : made old php4 var data manipulation with php5 var same respectively at one shot. and once used, variable globally. (helpful for new comm. webserver)
	 * @param : 
	 * @return : 
	 */
	public function global_var(){
		// global var for php4
		$raw = phpversion();
		list($v_Upper,$v_Major,$v_Minor) = explode(".",$raw);
		if (($v_Upper == 4 && $v_Major <1) || $v_Upper <4) {
			$_FILES = $HTTP_POST_FILES;
			$_ENV = $HTTP_ENV_VARS;
			$_GET = $HTTP_GET_VARS;
			$_POST = $HTTP_POST_VARS;
			$_COOKIE = $HTTP_COOKIE_VARS;
			$_SERVER = $HTTP_SERVER_VARS;
			$_SESSION = $HTTP_SESSION_VARS;
			$_FILES = $HTTP_POST_FILES;
		}

		if (!ini_get('register_globals')) {
			while(list($key,$value)=each($_FILES)) $GLOBALS[$key]=$value;
			while(list($key,$value)=each($_ENV)) $GLOBALS[$key]=$value;
			while(list($key,$value)=each($_GET)) $GLOBALS[$key]=$value;
			while(list($key,$value)=each($_POST)) $GLOBALS[$key]=$value;
			while(list($key,$value)=each($_COOKIE)) $GLOBALS[$key]=$value;
			while(list($key,$value)=each($_SERVER)) $GLOBALS[$key]=$value;
			while(list($key,$value)=@each($_SESSION)) $GLOBALS[$key]=$value;
			foreach($_FILES as $key => $value){
				$GLOBALS[$key]=$_FILES[$key]['tmp_name'];
				foreach($value as $ext => $value2){
					$key2 = $key . '_' . $ext;
					$GLOBALS[$key2] = $value2;
				}
			}
		}
	}
	
	/**
	 * @name : getdomain
	 * @desc : get current domain on given url.
	 * @param : $url
	 * @return : $domain
	 */
	public function getdomain($url){
		$nowww = ereg_replace('www\.','',$url);
		$domain = parse_url($nowww);
		if(!empty($domain["host"])) return $domain["host"];
		else return $domain["path"];
	}
	
	public function Slug($string){
    return strtolower(trim(preg_replace('~[^0-9a-z]+~i', '-', html_entity_decode(preg_replace(			'~&([a-z]{1,2})(?:acute|cedil|circ|grave|lig|orn|ring|slash|th|tilde|uml);~i', '$1', htmlentities($string, ENT_QUOTES, 'UTF-8')), ENT_QUOTES, 'UTF-8')), '-'));
	}
	
} // eof mwpclass php class
?>

<?php

?>

<?php
// testing class working or wether not
$mwpclass = new mwpclass($debug=true);
$mwpclass->open_database($username='root', $password='passme', $host='localhost', $database='mwpcms');
$resource = $mwpclass->run_query("select * from _administrator");
// echo $w;
$data = mysql_fetch_assoc($resource) or die(mysql_error());
echo $data['_username'];
echo $mwpclass->makerand_str();
if ($mwpclass->get_int_only(1)) echo "wew";
// error
if ($mwpclass->validate_email("yudha.gunslinger@fb.com")) echo "mail valid !";
/*
<script type="text/javascript">
function numberonly(evt) {
    evt = (evt) ? evt : window.event
    var charCode = (evt.which) ? evt.which : evt.keyCode
    if (charCode > 31 && (charCode < 48 || charCode > 57)) {
        status = "This field accepts numbers only."
        return false
    }
    status = ""
    return true
}
</script>     */ 
?>
