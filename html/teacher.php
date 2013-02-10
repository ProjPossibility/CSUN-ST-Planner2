<?php 
	$prefix = ".";
	$section = "root";
	$page = "teacher";
	$subtitle = "Teacher's Home";
	
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
	if ($client->getAccessToken()) { ?>

		This is the test.

	<?php } ?>	

<?php
	require($prefix."/includes/foot.php");
?>
