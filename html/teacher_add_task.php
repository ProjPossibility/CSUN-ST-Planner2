<?php 
	$prefix = ".";
	$section = "root";
	$page = "teacher";
	$subtitle = "Teacher Add Task";
	
	require_once($prefix."/includes/vars.php");	
	require_once($prefix."/includes/head.php");
	
	$milestonenum = $_POST['milestones'];
	
?>	

		
			<form class="form-horizontal" name="teacher_add_task" action="teacher_add_task.do.php" method="post">
				<?php if(isset($errors)) {?>
				<div class="alert alert-error">
				<p><b>Alert:</b> Please address the following issues:</p>
				<?php if(isset($errors)) {displayAllErrors($errors);}?>
				</div>
				<?php } ?>

            <h1>Main Task</h1>
	
            <form class="form-horizontal" name="teacher_add_task" action="teacher_add_task.do.php" method="post">
                <label class="control-label"><?php echo (empty($main_title)) ? "*": "";  ?>Title:</label>
                <div class="controls">
                    <input type="text" name="tsummary" id="tsummary" placeholder="What is the main project?" value="<?php echo (isset($main_title))?$main_title:"t"; ?>" >
                </div>
                <label class="control-label">Description:</label>
                <div class="controls">
                    <textarea rows="3" id="tdescription" name="tdescription"><?php echo (isset($main_objective))?$main_objective:""; ?></textarea>
                </div>
				
				
<?php			for($i = 0; $i < $milestonenum; $i++)
				{?>
                <div class="task">
                    <div class="form-horizontal">
                        	<h2>Milestone <?php echo ($i+1)?></h2>

                        <label class="control-label">Title:</label>
                        <div class="controls">
                            <input type="text" name="msummary<?php echo ($i+1); ?>" id="msummary<?php echo ($i+1); ?>" placeholder="What would you like to call this?" value="<?php echo (isset($datamilestones[$i]['msummary']))? $datamilestones[$i]['msummary']:""; ?>">
                        </div>
                        <label class="control-label">Due Date:</label>
                        <div class="controls">
                            <input type="text" class="date" name="datepicker<?php echo ($i+1); ?>" value="<?php echo (isset($datamilestones[$i]['datepicker']))? $datamilestones[$i]['datepicker']:""; ?>" ><span class="help-inline">(Format 05/22/2013)</span>
						</div>	
						<label class="control-label">Time:</label>
						<div class="controls">
							<input type="text" class="time" name="timepicker<?php echo ($i+1); ?>" value="<?php echo (isset($datamilestones[$i]['timepicker']))? $datamilestones[$i]['timepicker']:""; ?>"><span class="help-inline">(Format 08:29am)</span>
                        </div>
                        <label class="control-label">Description:</label>
                        <div class="controls">
                            <textarea rows="3" id="mdescription<?php echo ($i+1); ?>" name="mdescription<?php echo ($i+1); ?>"><?php echo (isset($datamilestones[$i]['mdescription']))? $datamilestones[$i]['mdescription']:""; ?></textarea>
                        </div>
                    </div>
                </div>
<?php			}?>
				<div align=center>
					<input type="hidden" id="milestones" name="milestones" value="<?php echo $milestonenum ?>">
					<input type="submit" id="create" name="create" class="btn btn-large btn-success" value="Create">
                </div>
			</form>
        </div>
        <script src="http://code.jquery.com/ui/1.10.0/jquery-ui.js"></script>
        <script src="js/jquery.timepicker.js"></script>
        <script src="js/jquery-ui-timepicker.addon.js"></script>
        
		<script>
            $(function () {
                $(".date").datepicker();
            });
        </script>
		<script>
            $(function () {
                $(".time").timepicker();
            });
        </script>
		
<?php
	require($prefix."/includes/foot.php");
?>
