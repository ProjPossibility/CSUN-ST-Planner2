<?php 
	$prefix = ".";
	$section = "root";
	$page = "teacher";
	$subtitle = "Teacher Add Task";
	
	require($prefix."/includes/vars.php");	
	require($prefix."/includes/head.php");
	
	$milestonenum = $_GET["milestones"];

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
