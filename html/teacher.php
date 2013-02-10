<?php 
	$prefix = ".";
	$section = "root";
	$page = "teacher";
	$subtitle = "Teacher's Home";
	
	require_once($prefix."/includes/vars.php");	
	require_once($prefix."/includes/head.php");

	$success_msg = (isset($_GET["success_msg"]))?$_GET["success_msg"]:"";

	$client = new Google_Client();
	$client->setUseObjects(true); 

	//-- Create Calendar Service Object
	$cal = new Google_CalendarService($client);

	//-- Set Access Token for access
	if (isset($_SESSION['token'])) {
	  $client->setAccessToken($_SESSION['token']);
	}

	//-- All Systems's Go
	if ($client->getAccessToken()) { 
		$optParams = array(
					'minAccessRole' => "owner"
					);



		$calList = $cal->calendarList->listCalendarList($optParams);
		//print("<pre>");
		//print_r(get_class_methods("Google_CalendarListEntry"));
		//print("</pre>");

		/*
		foreach($calList["items"] as $calendar) {
			echo $calendar->getSummary();
		}

		print "<h1>Calendar List</h1><pre>" . print_r($calList, true) . "</pre>";?>
		*/
		?>
	
		<form name="input" action="teacher.do.php" method="post">
        <fieldset>
          <legend>Add New Student</legend>
          <?php 
		 	if(isset($success_msg) && !empty($success_msg)) {
				echo "<div class=\"alert alert-success\">";
				echo $success_msg;
				echo "</div>";
		 	} ?>
		 	<?php if(isset($errors)) {?>
			<div class="alert alert-error">
				<p><b>Alert:</b> Please address the following issues:</p>
				<?php if(isset($errors)) {displayAllErrors($errors);}?>
			</div>
			<?php } ?>
          <div class="control-group">
            <label class="control-label" for="student_name">Student's Name</label>
            <div class="controls">
              <input type="text" class="input-xlarge" id="student_name" name="student_name" value="<?php echo (isset($data['student_name']))?$data['student_name']:""; ?>" />
              <p class="help-block"></p>
            </div>
          </div>
           <div class="control-group">
            <label class="control-label" for="student_email">Student's Email</label>
            <div class="controls">
              <input type="text" class="input-xlarge" placeholder="examples@gmail.com" id="student_email" name="student_email" value="<?php echo (isset($data['student_email']))?$data['student_email']:""; ?>" />
            </div>
          </div>
          <div class="form-actions">
            <button type="submit" class="btn btn-primary">Add New Student</button>
            <button type="reset" class="btn">Cancel</button>
          </div>
        </fieldset>
      </form>

	<?php } ?>	

<?php
	require($prefix."/includes/foot.php");
?>
