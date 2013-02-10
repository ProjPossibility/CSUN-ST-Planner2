<?php 
	$prefix = ".";
	$section = "root";
	$page = "teacher";
	$subtitle = "Teacher";
	
	require($prefix."/includes/vars.php");	
	require($prefix."/includes/head.php");

?>	

<ol>
	<li><a href="teacher_add_task.php">Teacher Add Task</a></li>
	<li><a href="student.php">Student</a></li>
</ol>

<?php
	require($prefix."/includes/foot.php");
?>
