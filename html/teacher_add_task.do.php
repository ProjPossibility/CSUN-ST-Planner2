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
	
		//-- Get main task data
		$main_title = $_POST['tsummary'];
		$main_objective = $_POST['tdescription'];
		$milestones = $_POST['milestones'];
		echo $milestones;
		for ($i = 0; $i < $milestones; $i++)
		{
			//-- Get individual milestone data
			$milestone_title = $_POST['msummary' . ($i+1)];
			$time = $_POST['timepicker' . ($i+1)];
		
			// $due_date = new DateTime($_POST['datepicker'.($i+1)]);
			// $milestone_objective = $_POST['mdescription'];
				echo $time;
				echo $milestone_title;
			// $mtitle = "$main_title-$milestone_title";
			
			// echo $msummary;
			// echo '<br>';
			// echo $due_date->format("Y-m-d H:i:s");
			// echo '<br>';
			// echo $mtitle;
			// echo '<br>';
			
			// $starttime = $due_date->format("Y-m-d")  . 'T' . $due_date->format("H:i:s");
			// $due_date->modify("+10 minutes");
			// $end_time =  $due_date->format("Y-m-d")  . 'T' . $due_date->format("H:i:s");
			// echo $starttime;
			// echo "<br>";
			
			// echo $end_time;
			// echo "<br>";
			
			/*
			$event = new Google_Event();
			$event->setSummary($main_title . "-" . $milestone_title[$i]);
			$start = new Google_EventDateTime();
			$start->setDateTime($due_dates[$i]);
			$end = new Google_EventDateTime();
			$end->setDateTime($end_dates[$i]);
			$event->setStart($start);
			$event->setEnd($end);
			echo $event->getSummary();
			$cal->events->insert('uhqfb67gk3di9696tht4rrshug@group.calendar.google.com', $event);*/
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