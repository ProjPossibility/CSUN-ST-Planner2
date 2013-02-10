<?php 
	$prefix = ".";
	$section = "root";
	$page = "student_task";
	$subtitle = "Student Task View";
	
	require_once($prefix."/includes/vars.php");	
	require_once($prefix."/includes/head.php");


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
					'singleEvents' => "true"
					);

		$event_id = (isset($_GET['event_id']))?$_GET['event_id']:0;
		$event_id = (isset($_POST['event_id']))?$_POST['event_id']:$event_id ;

		if ($event_id) {
			//-- Get Data on a specific Event

			$event = $cal->events->get($class_calendar_id, $event_id);

		} else {
			//-- Get data of event due soonest --//

			//-- Get all the events for the selected class calendar
			$eventsObj = $cal->events->listEvents($class_calendar_id, $optParams);
			
			//-- Get an array of Event
			$events = $eventsObj->getItems();
			$event = $events[0];

		}

		//-- Set Page Data
		$event_id = $event->getId();
		$summary = $event->getSummary();
		$eTag =  $event->getEtag();
		$description = $event->getDescription();
		$due_date = new DateTime($event->getStart()->getDateTime());	
		$htmlLink =  $event->getHtmlLink();

		//-- Get difference between due date and today's date 
		$timeLeft = $due_date->diff(new DateTime(date("Y-m-d H:i:s")));

		?>	

		<?php if(isset($errors)) {?>
		<div class="alert alert-error">
			<p><b>Alert:</b> Please address the following issues:</p>
			<?php if(isset($errors)) {displayAllErrors($errors);}?>
		</div>
		<?php } ?>


		<h2>Task: <?php echo $summary; ?></h2>
	 	
	
		<div class="task">
			<p>
				 <strong>Due date:</strong> <?php echo $due_date->format("l F m, Y"); ?>
			</p>
			<p class="text-muted">
				 <strong>Time left:</strong> <?php echo  $timeLeft->d." days  and " . $timeLeft->h." hours ";  ?>
			</p>
			<p class="lead">
				 <strong>Description:</strong> <?php echo str_replace("\n","<br/>",$description); ?>
			</p>
		</div>
		
		<form name="input" action="student.do.php" method="post">
			
			<input type="hidden" name="event_id" value="<?php echo isset($event_id)?htmlspecialchars($event_id):'';?>">
			<input type="hidden" name="eTag" value="<?php echo isset($eTag)?htmlspecialchars($eTag):'';?>">

			<div class="form-actions">
				<button type="submit" id="submit_task" name="submit_task" value="complete" class="btn btn-large btn-success">Complete Task</button>
				<button type="submit" id="submit_task" name="submit_task" value="reset" class="btn btn-large btn-danger">Reset Task</button>
			</div>
			
		</form>
<?php } else {
	$_SESSION['entry_page'] = 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['PHP_SELF'];
}?>	


<?php
	require($prefix."/includes/foot.php");
?>
