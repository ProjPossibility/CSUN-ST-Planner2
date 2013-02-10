<?php 
	$prefix = ".";
	$section = "root";
	$page = "student_task";
	$subtitle = "Student View";
	
	require($prefix."/includes/vars.php");	
	

	
	$client = new Google_Client();
	$client->setUseObjects(true); 
	$client->setApplicationName("Google Calendar PHP Starter Application");

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



	require($prefix."/includes/head.php");


if (isset($_SESSION['token'])) {
  $client->setAccessToken($_SESSION['token']);
}

if ($client->getAccessToken()) {

	$calList = $cal->calendarList->listCalendarList();
	echo "Logged In";

	$_SESSION['token'] = $client->getAccessToken();
} else {
  $authUrl = $client->createAuthUrl();
  print "<a class='login' href='$authUrl'>Connect Me!</a>";
}

?>	


<?php
	require($prefix."/includes/foot.php");
?>
