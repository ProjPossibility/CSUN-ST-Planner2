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
		$goodmain = true;
		
		//-- Get main task post data
		$main_title = $_POST['tsummary'];
		$main_objective = $_POST['tdescription'];
		$milestones = $_POST['milestones'];
		
		//-- Check main task data
		if(empty($main_title)){
			$goodmain = false;
		}
		else if(empty($main_objective)){
			$goodmain = false;
		}

		//-- If main title and main objective are set, add milestones
		if($goodmain){
			for ($i = 0; $i < $milestones; $i++)
			{
				//-- Get individual milestone post data
				$milestone_title = $_POST['msummary' . ($i+1)];
				$time = $_POST['timepicker' . ($i+1)];
				$date = $_POST['datepicker' . ($i+1)];
				$milestone_objective = $_POST['mdescription'. ($i+1)];
				
				//-- Check for milestone data
				if(! validateDate($date)){
					$success = false;
					break;
				}
				else if(empty($milestone_title)){
					$success = false;
					break;
				}
				else if(empty($time)){
					$success = false;
					break;
				}
				else if(empty($milestone_objective)){
					$success = false;
					break;
				}
				
				
				
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

	/*----------------------------------
		FINALIZE
	----------------------------------*/
	if ($success == true) {
		// header( 'Location:teacher_student_view.php?id='.$data['id']."&success_msg={$success_msg}"); 
		 die();
	} else {
		$errors['form'][] = "Error on form";
		//header( 'Location:teacher_add_task.php?id='.$data['id']); 
		//include('teacher_add_task.php');
		die();
}

	function validateDate($date)
	{
		$year = substr($date, 0, 4);
		$month = substr($date, 5,2);
		$day = substr($date, 8, 2);
		
		return checkdate($month, $day, $year);
	}
?>