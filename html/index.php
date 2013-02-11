<?php 
	$prefix = ".";
	$section = "root";
	$page = "teacher";
	$subtitle = "Teacher's Dashboard";
	
	require_once($prefix."/includes/vars.php");	
	require_once($prefix."/includes/head.php");
	
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
		
<?php
	require($prefix."/includes/foot.php");
?>
