<?
$prefix = ".";

require_once($prefix."/includes/vars.php");

/*----------------------------------
	GET POST VARIABLES
----------------------------------*/
$data['event_id'] = $_POST['event_id'];
$data['submit_task'] = $_POST['submit_task'];


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
		

		$updatedEvent = $service->events->update(getClassCalendarID(), $event->getId(), $event);


	} else {
		$errors[][] = "Google Auth Error.";
	}



if(isset($errors)) {
	include('student.php');
	die();
}


/*----------------------------------
	PROCESS PAGE
----------------------------------*/
//-- Pretend everything went well 
$success = true;



/*----------------------------------
	FINALIZE
----------------------------------*/
if ($success == true) {
     header( "Location:student.php?id=&success_msg={$success_msg}"); 
     die();
} else {
	$errors['form'][] = "Error on form";
	include('student.php');
	die();
}

?>