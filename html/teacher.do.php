<?php
$prefix = ".";

require_once($prefix."/includes/vars.php");

/*----------------------------------
	GET POST VARIABLES
----------------------------------*/
$data['student_name'] = (isset($_POST['student_name']))?$_POST['student_name']:"";
$data['student_email'] = (isset($_POST['student_email']))?$_POST['student_email']:"";

//-- Validate Required Fields
if(empty($data['student_name'])) {
	$errors[][] = "Student name is required";
}
if(empty($data['student_email'])) {
	$errors[][] = "Student email is required";
}

if(isset($errors)) {
	include('teacher.php');
	die();
}

/*----------------------------------
	GOOGLE STUFF
----------------------------------*/
$client = new Google_Client();
$client->setUseObjects(true); 
$client = new Google_Client();
$service = new Google_CalendarService($client);

//-- Create Calendar Service Object
$cal = new Google_CalendarService($client);

//-- Set Access Token for access
if (isset($_SESSION['token'])) {
  $client->setAccessToken($_SESSION['token']);
}

/*----------------------------------
	PROCESS PAGE
----------------------------------*/
//-- Pretend everything went well 
$success = true;

//-- All Systems's Go
if ($client->getAccessToken()) {
	$calendar = new Google_Calendar();

	//-- Set new Calendar Data
  	$calendar->setSummary("CSUN-ST-Planner2 - ".$data['student_name']);
  	$calendar->setTimeZone('America/Los_Angeles');
  	$calendar->setDescription("CSUN-ST-Planner2 Project");

  	//-- Insert into Google
  	$createdCalendar = $cal->calendars->insert($calendar);

  	$calendar_id = $createdCalendar->getId();

  	//-- Add ACL permission for student to review calendar
  	try {
  		$rule = new Google_AclRule();
		$scope = new Google_AclRuleScope();

  		$scope->setType("user");
		$scope->setValue($data['student_email']);
		$rule->setScope($scope);
		$rule->setRole("reader");

		$createdRule = $cal->acl->insert($calendar_id, $rule);

  	} catch (Exception $e) {
  		$errors[][] = "Error Giving Read permissions to student.";
  	}
  		

	//-- Clear Data
	$data['student_name'] = "";
	$data['student_email'] = "";
} else {
	$errors[][] = "Google Auth Error.";
}


$success_msg = "New Student Added";
/*----------------------------------
	FINALIZE
----------------------------------*/
if ($success == true) {
     header( "Location:teacher.php?success_msg={$success_msg}"); 
     die();
} else {
	$errors['form'][] = "Error on form";
	include('student.php');
	die();
}

?>