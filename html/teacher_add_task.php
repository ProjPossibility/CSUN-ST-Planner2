/<?php 
	$prefix = ".";
	$section = "root";
	$page = "teacher";
	$subtitle = "Teacher";
	
	require($prefix."/includes/vars.php");	
	require($prefix."/includes/head.php");
	
	$milestonenum = 2;

?>	



<h1>Main Task</h1>

            <form class="form-horizontal">
                <label class="control-label">Title:</label>
                <div class="controls">
                    <input type="text" name="Title" id="Title" placeholder="What would you like to call this?">
                </div>
				
                <label class="control-label">Description:</label>
                <div class="controls">
                    <textarea rows="3"></textarea>
                </div>
				
				
<?php			for($i = 0; $i < $milestonenum; $i++)
				{?>
                <div class="task">
                    <div class="form-horizontal">
                        	<h2>Milestone <?php echo ($i+1)?></h2>

                        <label class="control-label">Title:</label>
                        <div class="controls">
                            <input type="text" placeholder="What would you like to call this?">
                        </div>
                        <label class="control-label">Due Date:</label>
                        <div class="controls">
                            <input type="date" placeholder="What date will this be due?">
                        </div>
                        <label class="control-label">Description:</label>
                        <div class="controls">
                            <textarea rows="3"></textarea>
                        </div>
                    </div>
                </div>
<?php			}?>
                </form>
                <button type="button" class="btn btn-large btn-success">Create</button>
        </div>
        <script src="http://code.jquery.com/jquery.js"></script>
        <script src="js/bootstrap.min.js"></script>

<?php
	require($prefix."/includes/foot.php");
?>
