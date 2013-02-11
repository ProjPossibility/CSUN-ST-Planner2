<?php 
	$prefix = ".";
	$section = "root";
	$page = "teacher_student_view";
	$subtitle = "Teacher-Student View";
	
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

		
?>			<h2>Add New Project</h2>
			<form class="form-inline" name="teacher_student_view" action="teacher_add_task.php" method="post">
	        <fieldset>
		        <div class="control-group">
	            <div class="controls">
	              <select id="milestones" name="milestones">
	              	<option value="0">-- Number of Milestones --</option>
	                <option>1</option>
	                <option>2</option>
	                <option>3</option>
	                <option>4</option>
	                <option>5</option>
	                <option>6</option>
	                <option>7</option>
	                <option>8</option>
	                <option>9</option>
	              </select>
	     
	            <button type="submit" class="btn btn-primary">Start New Project</button>
	  
	         
	            </div>
	          </div>
	          
	          
	        </fieldset>
	      </form>

			<h2>Student Overview</h2>
	        <table class="table table-bordered table-striped table-hover">
	            <thead>
	                <tr>
		                <th>Title</th>
		                <th>Start Date</th>
		                <th>Time Left</th>
		                <th>Link</th>
						<th>Status</th>
	                </tr>
	            </thead>
	            <tbody>
<?php
				if ($eventsObj->getItems()) {

					foreach($eventsObj->getItems() as $event) {
						//-- Set Page Data
						$id = $event->getId();
						$summary = $event->getSummary();
						if(strlen($summary) > 13 && strstr($summary, "::: COMPLETED"))
						{
							$completedTag = substr($summary, 0, strlen($summary)-strlen("::: COMPLETED"));
							$completed = true;
						} else
						{
							$completedTag = $summary;
							$completed = false;
						}
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
			
				
	                	<tr <?php if($completed) 
							echo "class=\"success\""; else echo ($PassedDue)?"class=\"error\"":""; 
							?> 
						>
		                <td><?php echo $completedTag; ?></td>
		                <td><?php echo $dueDate->format("Y-m-d H:i:s"); ?></td>
		                <td><?php
							echo  $timeLeft->d." days  and " . $timeLeft->h." hours "; ?>
						</td>
		                <td><a href="<?php echo $htmlLink; ?>">View Event</a></td>
						<td><?php 
							echo ($completed)?"Complete":"Incomplete"; 
							?>
						</td>
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
