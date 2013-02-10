<?php 
	$prefix = ".";
	$section = "root";
	$page = "teacher_student_view";
	$subtitle = "Teacher Student View";
	
	require($prefix."/includes/vars.php");	
	require($prefix."/includes/head.php");

	$events = $cal->events->listEvents('primary');

	while(true) {
		foreach ($events->getItems() as $event) {
			echo $event->getSummary();
		}
		$pageToken = $events->getNextPageToken();
		if ($pageToken) {
			$optParams = array('pageToken' => $pageToken);
			$events = $service->events->listEvents('primary', $optParams);
		} else {
		break;
		}
	}
?>	

	<div class="page">
		<h1>Student-Teacher Overview</h2>
		<input type="text" id="milestones" class="input-mini" name="milestones" placeholder="#">
		<button type="button" id="create" name="create" class="btn btn-large">Add new task</button>
        </div>
<?php
	require($prefix."/includes/foot.php");
?>
