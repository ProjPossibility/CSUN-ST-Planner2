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
	$client->setApplicationName("Google Calendar PHP Starter Application");

	$cal = new Google_CalendarService($client);


	if (isset($_SESSION['token'])) {
	  $client->setAccessToken($_SESSION['token']);
	}

	if ($client->getAccessToken()) {

		$calList = $cal->calendarList->listCalendarList();
		print "<h1>Calendar List</h1><pre>" . print_r($calList, true) . "</pre>";

	
} else {
  $authUrl = $client->createAuthUrl();
  print "<a class='login' href='$authUrl'>Connect Me!</a>";
}

?>	


<?php
	require($prefix."/includes/foot.php");
?>
