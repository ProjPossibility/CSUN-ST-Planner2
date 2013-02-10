<?php 
	$prefix = ".";
	$section = "root";
	$page = "student_task";
	$subtitle = "Student View";
	
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
		$optParams = array(
					'maxResults' => "1",
					'orderBy' => 'startTime',
					'singleEvents' => "true",
					);

		//-- Get all the events for the selected class calendar
		$eventsOjb = $cal->events->listEvents($class_calendar_id,$optParams);

		//-- Get an array of Event
		$event = $eventsOjb->getItems();
		
		//-- Set Page Data
		$id = $event[0]->getId();
		$summary = $event[0]->getSummary();
		$eTag =  $event[0]->getEtag();
		$description = $event[0]->getDescription();
		$startDateObj = $event[0]->getStart();
		$dueDate = $startDateObj->getDateTime();
		$timeLeft = $event[0]->getStart();
		$htmlLink =  $event[0]->getHtmlLink();

		/*
		print_r("<pre>");
		print_r($event);
		print_r("</pre>");
		*/

		?>	

		<?php if(isset($errors)) {?>
		<div class="alert alert-error">
			<p><b>Alert:</b> Please address the following issues:</p>
			<?php if(isset($errors)) {displayAllErrors($errors);}?>
		</div>
		<?php } ?>


		<h1>Task: <?php echo $summary; ?></h1>
	 	
	
		<div class="task">
			<p>
				 <strong>Due date:</strong> <?php echo $dueDate; ?>
			</p>
			<p class="text-muted">
				 <strong>Time left:</strong> [timeleft]
			</p>
			<p class="lead">
				 <strong>Description:</strong> <?php echo str_replace("\n","<br/>",$description); ?>
			</p>
		</div>
		
		<form name="input" action="student.do.php" method="post">
			
			<input type="hidden" name="event_id" value="<?php echo isset($id)?htmlspecialchars($id):'';?>">
			<input type="hidden" name="eTag" value="<?php echo isset($eTag)?htmlspecialchars($eTag):'';?>">

			<div class="form-actions">
				<button type="submit" id="submit_task" name="submit_task" value="complete" class="btn btn-large btn-success">Complete Task</button>
				<button type="submit" id="submit_task" name="submit_task" value="reset" class="btn btn-large btn-danger">Reset Task</button>
			</div>
			
		</form>

	
<?php 	
} else {
  $authUrl = $client->createAuthUrl();
  print "<a class='login' href='$authUrl'>Connect Me!</a>";
}

?>	


<?php
	require($prefix."/includes/foot.php");
?>
