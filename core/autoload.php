<?php

/** This file is part of Media Website Plus project
  *
  * @desc Autoload classes magic function
  * @package mwpclass
  * @version 1.0
  * @author Yudha gunslinger_ <yudha.gunslinger@gmail.com>
  * @copyright 2011 Media Website Plus project 
  * @license http://www.opensource.org/licenses/gpl-2.0.php GPLv2
  * @license http://www.opensource.org/licenses/lgpl-2.1.php LGPLv2
  * @link http://www.mediawebsiteplus.com
  */
  
function __autoload($class){
		if ($class = "mwpclass"){
			require "mwp.class.php";
		}
	}
?>
