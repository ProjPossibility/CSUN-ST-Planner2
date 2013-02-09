<?php 
	$prefix = ".";
	$section = "root";
	$page = "student_task";
	$subtitle = "Student View";
	
	require($prefix."/includes/vars.php");	
	

	session_start();

	require($prefix."/includes/head.php");


	$client = new Google_Client();
	$client->setUseObjects(true); 

	//-- Create Calendar Service Object
	$cal = new Google_CalendarService($client);

	//-- Set Access Token for access
	if (isset($_SESSION['token'])) {
	  $client->setAccessToken($_SESSION['token']);
	}

	//-- All Systems's Go
	if ($client->getAccessToken()) {

		//-- Get the current class calendar ID
		$class_calendar_id = getClassCalendarID();

		$optParams = array(
					'maxResults' => "1",
					'orderBy' => 'startTime',
					'singleEvents' => "true",
					);

		//-- Get all the events for the selected class calendar
		$eventsOjb = $cal->events->listEvents($class_calendar_id,$optParams);

		//-- Get an array of all Events
		$current_event = $eventsOjb->getItems();

		
		print_r("<pre>");
		print_r($eventsOjb);
		print_r("</pre>");
		
		
	
} else {
  $authUrl = $client->createAuthUrl();
  print "<a class='login' href='$authUrl'>Connect Me!</a>";
}

?>	


<?php
	require($prefix."/includes/foot.php");
?>
