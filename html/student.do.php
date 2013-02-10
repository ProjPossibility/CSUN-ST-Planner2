<?
$prefix = ".";

require_once($prefix."/includes/vars.php");

/*----------------------------------
	GET POST VARIABLES
----------------------------------*/
$data['event_id'] = $_POST['event_id'];
$data['submit_task'] = $_POST['submit_task'];


if(isset($errors)) {
	include('student.php');
	die();
}


/*----------------------------------
	GOOGLE STUFF
----------------------------------*/
$client = new Google_Client();
$client->setUseObjects(true); 
$client = new Google_Client();
$service = new Google_CalendarService($client);

//-- Create Calendar Service Object
$cal = new Google_CalendarService($client);

//-- Set Access Token for access
if (isset($_SESSION['token'])) {
  $client->setAccessToken($_SESSION['token']);
}

/*----------------------------------
	PROCESS PAGE
----------------------------------*/
//-- Pretend everything went well 
$success = true;

//-- All Systems's Go
if ($client->getAccessToken()) {

	//-- Get Event data by ID
	$event = $service->events->get(getClassCalendarID(), $data['event_id']);
	
	switch($data['submit_task']) {

		case 'complete':
			//-- Add "Complete" to the title of the event. 
			$event->setSummary($event->getSummary() . ' - COMPLETE');
			break;

		case 'reset':
			//-- Remove "Complete" to the title of the event. 
			$event->setSummary(str_replace(' - COMPLETE','',$event->getSummary()));
			break;

		default:
		$errors[][] = "No task action set";

	}
	
	//-- Update 
	$updatedEvent = $service->events->update(getClassCalendarID(), $event->getId(), $event);


} else {
	$errors[][] = "Google Auth Error.";
}



/*----------------------------------
	FINALIZE
----------------------------------*/
if ($success == true) {
     header( "Location:student.php?event_id=".$data['event_id']."&success_msg={$success_msg}"); 
     die();
} else {
	$errors['form'][] = "Error on form";
	include('student.php');
	die();
}

?>