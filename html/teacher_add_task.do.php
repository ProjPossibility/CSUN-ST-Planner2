<?php
	$prefix = ".";

	require_once($prefix."/includes/vars.php");

	/*----------------------------------
	Calendar API initializations 
	----------------------------------*/
	$client = new Google_Client();
	$client->setUseObjects(true);
	$client->setApplicationName("Application");
	$cal = new Google_CalendarService($client);

	if (isset($_SESSION['token'])) {
		$client->setAccessToken($_SESSION['token']);
	}

	if ($client->getAccessToken()) {
		$success = true;
		
		//-- Get main task post data
		$main_title = (isset($_POST['tsummary'])) ? $_POST['tsummary']:""; 
		$main_objective = (isset($_POST['tdescription'])) ? $_POST['tdescription']:""; 
		$milestones = (isset($_POST['milestones'])) ? $_POST['milestones']:""; 
		
		//Errors on page
		$errors = array();
		
		//milestone data
		$datamilestones = array();
		
		//-- Check main task data
		if(empty($main_title)){
			$errors['tsummary'][] = "Main task title required";
			$success = false;
		}
		if(empty($main_objective)){
			$errors['tdescription'][] = "Main objective required";
			$success = false;
		}

		//-- Get post data for milestones
		for ($i = 0; $i < $milestones; $i++)
		{
			//-- Get individual milestone post data
			$milestone_title = (isset($_POST['msummary' . ($i+1)])) ? $_POST['msummary' . ($i+1)]:""; 
			$time = (isset($_POST['timepicker' . ($i+1)])) ? $_POST['timepicker' . ($i+1)]:"";
			$date = (isset($_POST['datepicker' . ($i+1)])) ? $_POST['datepicker' . ($i+1)]: "";
			$milestone_objective = (isset($_POST['mdescription'. ($i+1)])) ? $_POST['mdescription' . ($i+1)]: "";
			
			$datamilestones[$i]['msummary'] = $milestone_title;
			$datamilestones[$i]['timepicker'] = $time;
			$datamilestones[$i]['datepicker'] = $date;
			$datamilestones[$i]['mdescription'] = $milestone_objective;
			
			//-- Check for milestone data
			if(empty($milestone_title)){
				$success = false;
				$errors[][] = "Milestone title required";
			}
			if(! validateDate($date)){
				$success = false;
				$errors[][] = "Invalid due date";
			}
			if(empty($time)){
				$success = false;
				$errors[][] = "Time due required";
			}
			if(empty($milestone_objective)){
				$success = false;
				$errors[][] = "Milestone objective required";
			}
		}
		
		//-- If no errors are detected insert milestones
		if($success){
			for ($i = 0; $i < $milestones; $i++){
			
				$milestone_title = $datamilestones[$i]['msummary'];
				$time = $datamilestones[$i]['timepicker'];
				$date = $datamilestones[$i]['datepicker'];
				$milestone_objective = $datamilestones[$i]['mdescription'];
				
				$due_date = new DateTime("$date $time");
				$full_title = "$main_title-$milestone_title";
				$start_time = $due_date->format("Y-m-d")  . 'T' . $due_date->format("H:i:s") . "-08:00";
				$due_date->modify("+10 minutes");
				$end_time =  $due_date->format("Y-m-d")  . 'T' . $due_date->format("H:i:s") . "-08:00";
				
				//-- Create event and add to calendar
				$event = new Google_Event();
				$event->setSummary($full_title);
				$event->setDescription($main_objective . ":\n" . $milestone_objective);
				$start = new Google_EventDateTime();
				$start->setDateTime($start_time);
				$end = new Google_EventDateTime();
				$end->setDateTime($end_time);
				$event->setStart($start);
				$event->setEnd($end);
				$cal->events->insert(getClassCalendarID(), $event);
			}
		}
		$_SESSION['token'] = $client->getAccessToken();
	}
	else{
		$authUrl = $client->createAuthUrl();
		print "<a class='login' href='$authUrl'>Connect Me!</a>";
	}
	$success_msg = "project added";

	//-- Check if event successfully inserted
	if ($success == true) {
		 header("Location:teacher_student_view.php?&success_msg={$success_msg}"); 
		 die();
	} else {
        include('teacher_add_task.php');
		die();
}

	function validateDate($date)
	{
		$year = substr($date, 6, 4);
		$month = substr($date, 0,2);
		$day = substr($date, 3, 2);
		
		return checkdate($month, $day, $year);
	}
?>