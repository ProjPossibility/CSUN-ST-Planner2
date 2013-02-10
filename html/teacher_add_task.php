<?php 
	$prefix = ".";
	$section = "root";
	$page = "teacher";
	$subtitle = "Teacher Add Task";
	
	require($prefix."/includes/vars.php");	
	require($prefix."/includes/head.php");
	
	$milestonenum = $_GET["milestones"];

	$client = new Google_Client();
	$client->setUseObjects(true); 
	$client->setApplicationName("Google Calendar PHP Starter Application");
	$service = new Google_CalendarService($client);
	
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
		$main_title = "Main Title";
		$main_due_date = new Google_EventDateTime();
		$main_desc = "Description";
		$m1_title;
		$m1_due_date = new Google_EventDateTime();
		$m1_desc;
		$m2_title;
		$m2_due_date = new Google_EventDateTime();
		$m2_desc =  "Milestone 2";
	
	}
?>	



            <h1>Main Task</h1>

            <form class="form-horizontal">
                <label class="control-label">Title:</label>
                <div class="controls">
                    <input type="text" name="tsummary" id="tsummary" placeholder="What would you like to call this?">
                </div>
                <label class="control-label">Description:</label>
                <div class="controls">
                    <textarea rows="3" id="tdescription" name="tdescription"></textarea>
                </div>
				
				
<?php			for($i = 0; $i < $milestonenum; $i++)
				{?>
                <div class="task">
                    <div class="form-horizontal">
                        	<h2>Milestone <?php echo ($i+1)?></h2>

                        <label class="control-label">Title:</label>
                        <div class="controls">
                            <input type="text" name="msummary<?php echo ($i+1); ?>" id="msummary<?php echo ($i+1); ?>" placeholder="What would you like to call this?">
                        </div>
                        <label class="control-label">Due date/time:</label>
                        <div class="controls">
                            <input type="text" id="datetimepicker<?php echo ($i+1); ?>" name="datetimepicker<?php echo ($i+1); ?>" placeholder="What date will this be due?">
                        </div>
                        <label class="control-label">Description:</label>
                        <div class="controls">
                            <textarea rows="3" id="mdescription<?php echo ($i+1); ?>" name="mdescription<?php echo ($i+1); ?>"></textarea>
                        </div>
                    </div>
                </div>
<?php			}?>
                </form>
                <button type="button" id="create" name="create" class="btn btn-large btn-success">Create</button>
        </div>
        <script src="http://code.jquery.com/jquery.js"></script>
        <script src="js/bootstrap.min.js"></script>

		
		
<?php
	require($prefix."/includes/foot.php");
?>
