<?php 

/** BASIC SITE REQUIRED FILES **/ 
require_once(dirname(__FILE__)."/../../src/Google_Client.php");
require_once(dirname(__FILE__)."/../../src/contrib/Google_CalendarService.php");
require_once(dirname(__FILE__)."/lib/calendar.php");


//** PAGE TITLES **/
if (!isset($page)) {$page = '';}
if (!isset($section)) {$section = '';}
if (!isset($subpage)) {$subpage = '';}

?>