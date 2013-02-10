<?php 
	$prefix = ".";
	$section = "root";
	$page = "teacher_student_view";
	$subtitle = "Teacher Student View";
	
	require($prefix."/includes/vars.php");	
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

		//-- Set the Params on the search
		$optParams = array();
					
		//-- Get all the events for the selected class calendar
		$eventsObj = $cal->events->listEvents($class_calendar_id,$optParams);
		
	?>
		<div class="page">
		<h1>Student Overview</h1>
		<input type="text" id="milestones" class="input-mini" name="milestones" placeholder="#">
		<button type="button" id="create" name="create" class="btn btn-large">Add new task</button>
        
<?php
		foreach($eventsObj->getItems() as $event) {
			//-- Set Page Data
			$id = $event->getId();
			$summary = $event->getSummary();
			$eTag =  $event->getEtag();
			$description = $event->getDescription();
			$startDateObj = $event->getStart();
			$dueDate = $startDateObj->getDateTime();
			$timeLeft = $event->getStart();
			$htmlLink =  $event->getHtmlLink();
			
			
			//display table
		?>
		
		
        </div>

<?php 	
} else {
  $authUrl = $client->createAuthUrl();
  print "<a class='login' href='$authUrl'>Connect Me!</a>";
}

?>	
<?php
	require($prefix."/includes/foot.php");
?>
