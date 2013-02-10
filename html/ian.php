<?php
$prefix = ".";
require_once '../src/Google_Client.php';
require_once '../src/contrib/Google_CalendarService.php';
//require($prefix."/includes/vars.php");	
//require($prefix."/includes/head.php");

session_start();

$client = new Google_Client();
$client->setUseObjects(true);
$client->setApplicationName("Google Calendar PHP Starter Application");
$service = new Google_CalendarService($client);

// Visit https://code.google.com/apis/console?api=calendar to generate your
// client id, client secret, and to register your redirect uri.
// $client->setClientId('insert_your_oauth2_client_id');
// $client->setClientSecret('insert_your_oauth2_client_secret');
// $client->setRedirectUri('insert_your_oauth2_redirect_uri');
// $client->setDeveloperKey('insert_your_developer_key');
$cal = new Google_CalendarService($client);
if (isset($_GET['logout'])) {
  unset($_SESSION['token']);
}

if (isset($_GET['code'])) {
  $client->authenticate($_GET['code']);
  $_SESSION['token'] = $client->getAccessToken();
  header('Location: http://' . $_SERVER['HTTP_HOST'] . $_SERVER['PHP_SELF']);
}

if (isset($_SESSION['token'])) {
  $client->setAccessToken($_SESSION['token']);
}

if ($client->getAccessToken()) {
  $calList = $cal->calendarList->listCalendarList();
  print "<h1>Calendar List</h1><pre>" . print_r($calList, true) . "</pre>";

	$event = new Google_Event();
	$event->setSummary('Ians Event');
	$event->setLocation('Here');
	$start = new Google_EventDateTime();
	$start->setDateTime('2013-02-10T10:00:00.000-07:00');
	$event->setStart($start);
	$end = new Google_EventDateTime();
	$end->setDateTime('2013-02-10T10:25:00.000-07:00');
	$event->setEnd($end);
	//$attendee1 = new Google_EventAttendee();
	//$attendee1->setEmail('attendeeEmail');
	// ...
	/*$attendees = array($attendee1,
					   // ...
					  );
	$event->attendees = $attendees;*/
	$createdEvent = $service->events->insert('uhqfb67gk3di9696tht4rrshug@group.calendar.google.com', $event);

	echo $createdEvent->getId();
	
	$cal.events().delete($cal->getClassCalendarID(), $createdEvent->getID()).execute();
	
$_SESSION['token'] = $client->getAccessToken();
} else {
  $authUrl = $client->createAuthUrl();
  print "<a class='login' href='$authUrl'>Connect Me!</a>";
}