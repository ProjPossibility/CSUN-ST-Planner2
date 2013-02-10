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
	
	//-- If calendar_id is passed set session
	if (isset($_GET['calendar_id'])) {
		$_SESSION['calendar_id'] = $_GET['calendar_id'];
	}



	//-- All Systems's Go
	if ($client->getAccessToken()) {
	
		//-- Get the current class calendar ID
		$class_calendar_id = getClassCalendarID();

		//-- Set the Params on the search
		$optParams = array(
					'orderBy' => 'starttime',
					'singleEvents' => 'true'
				);
					
		//-- Get all the events for the selected class calendar
		$eventsObj = $cal->events->listEvents($class_calendar_id, $optParams);

		
?>
			<h1>Student Overview</h1>
			<form class="form-horizontal" name="teacher_student_view" action="teacher_add_task.php" method="post">
			<label class="control-label">Milestones:</label>
			<input type="text" id="milestones" class="input-mini" name="milestones" placeholder="#">
			<input type="submit" id="create" name="create" class="btn btn-large" value="Add new task">
			</form>
	        <table class="table table-bordered table-striped table-hover">
	            <thead>
	                <tr>
		                <th>Title</th>
		                <th>Start Date</th>
		                <th>Time Left</th>
		                <th>Link</th>
	                </tr>
	            </thead>
	            <tbody>
<?php
				if ($eventsObj->getItems()) {

					foreach($eventsObj->getItems() as $event) {
						//-- Set Page Data
						$id = $event->getId();
						$summary = $event->getSummary();
						$eTag =  $event->getEtag();
						$description = $event->getDescription();
						$startDateObj = $event->getStart();
						$dueDate = new DateTime($event->getStart()->getDateTime());
						$timeLeft = new DateTime(date("Y-m-d H:i:s"));
						if($dueDate > $timeLeft)
						{
							$timeLeft = $dueDate->diff($timeLeft);
							$PassedDue = false;
						} else
						{
							$timeLeft = $timeLeft->diff($timeLeft);
							$PassedDue = true;
						}
						$htmlLink =  $event->getHtmlLink(); ?>
			
				
	                	<tr <?php echo ($PassedDue)?"class=\"error\"":""?> ">
		                <td><?php echo $summary; ?></td>
		                <td><?php echo $dueDate->format("Y-m-d H:i:s"); ?></td>
		                <td><?php
						echo  $timeLeft->d." days  and " . $timeLeft->h." hours "; ?>
						</td>
		                <td><a href="<?php echo $htmlLink; ?>">View Event</a></td>
	                	</tr>
					<?php } //-- end for loop
				} //-- end if blank ?>
				</tbody>
            </table>
<?php
}

?>	
<?php
	require($prefix."/includes/foot.php");
?>
