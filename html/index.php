<?php 
	$prefix = ".";
	$section = "root";
	$page = "home";
	$subtitle = "Teacher Student Planner App";
	
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
	$_SESSION['token'] = $client->getAccessToken();


?>	
		<h2>Select Role:</h2>
		<ul class="thumbnails">
			<li class="span3 text-center">
			<a href="student.php">
			<div class="thumbnail">
				<object data="img/student.svg" width="128" height="150" type="image/svg+xml">
					<img src="img/student.png" width="128" height="150" alt="Student"/>
				</object>
				<h3>Student</h3>
			</div>
			</a>
			</li>
			<li class="span3 text-center">
			<a href="teacher.php">
			<div class="thumbnail">
				<object data="img/teacher.svg" width="" height="150"  type="image/svg+xml">
					<img src="img/teacher.png" width="128" height="119" alt="Teacher"/>
				</object>
				<h3>Teacher</h3>
			</div>
			</a>
			</li>
		</ul>

	<?php 	} else {
  $authUrl = $client->createAuthUrl();
  print "<a class=\"btn btn-info\" href=\"{$authUrl}\">Connect To Google</a>";
  echo "<br><br>";
} ?>
		
<?php
	require($prefix."/includes/foot.php");
?>
