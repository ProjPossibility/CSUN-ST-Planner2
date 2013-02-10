<?php
	$prefix = ".";

	require_once($prefix."/includes/vars.php");

	/*----------------------------------
		GET POST VARIABLES
	----------------------------------*/
	// $data['id'] = "got from post";

	// $errors[][] = "errors";

	// if(isset($errors)) {
		// include('teacher.php');
		// die();
	// }
	
	/*----------------------------------
		PROCESS PAGE
	----------------------------------*/
	$client = new Google_Client();
	$client->setUseObjects(true);
	$client->setApplicationName("Application");
	$cal = new Google_CalendarService($client);
	
	$main_title = "Main Title";
	$milestone_title = array("milestone 1", "milestone 2");
	$due_dates = array('2013-02-11T10:00:00.000-07:00','2013-02-12T10:00:00.000-07:00');
	$end_dates = array('2013-02-11T10:30:00.000-07:00','2013-02-12T10:30:00.000-07:00');
	$number_of_milestones = 2;
	
	if (isset($_GET['logout'])) {
		unset($_SESSION['token']);
	}

	if (isset($_GET['code'])) {
		$client->authenticate($_GET['code']);
		$_SESSION['token'] = $client->getAccessToken();
		header('Location: http://' . $_SERVER['HTTP_HOST'] . $_SERVER['PHP_SELF']);
	}

	if (isset($_SESSION['token'])) {
		$client->setAccessToken($_SESSION['token']);
	}

	if ($client->getAccessToken()) {
	
		for ($i = 0; $i < $number_of_milestones; $i++)
		{
			$event = new Google_Event();
			$event->setSummary($main_title . "-" . $milestone_title[$i]);
			$start = new Google_EventDateTime();
			$start->setDateTime($due_dates[$i]);
			$end = new Google_EventDateTime();
			$end->setDateTime($end_dates[$i]);
			$event->setStart($start);
			$event->setEnd($end);
			echo $event->getSummary();
			$cal->events->insert('uhqfb67gk3di9696tht4rrshug@group.calendar.google.com', $event);
		}
		$_SESSION['token'] = $client->getAccessToken();
	}
	else{
		$authUrl = $client->createAuthUrl();
		print "<a class='login' href='$authUrl'>Connect Me!</a>";
	}


	//-- Pretend everything went well 
	$success = true;

	/*----------------------------------
		FINALIZE
	----------------------------------*/
	if ($success == true) {
		 //header( 'Location:teacher.php?id='.$data['id']."&success_msg={$success_msg}"); 
		 die();
	} else {
		$errors['form'][] = "Error on form";
		include('teacher.php');
		die();
}

?>