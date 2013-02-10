<?php 
	$prefix = ".";
	$section = "root";
	$page = "teacher";
	$subtitle = "Teacher";
	
	require($prefix."/includes/vars.php");	
	require($prefix."/includes/head.php");


		
	
} else {
  $authUrl = $client->createAuthUrl();
  print "<a class='login' href='$authUrl'>Connect Me!</a>";
}

?>	


<?php
	require($prefix."/includes/foot.php");
?>
