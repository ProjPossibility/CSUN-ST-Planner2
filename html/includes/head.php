<!DOCTYPE html>
<html>
    
    <head>
        <title>Add tasks and milestones</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!-- Bootstrap -->
        <link href="css/bootstrap.css" rel="stylesheet" media="screen">
		
        <link rel="stylesheet" href="http://code.jquery.com/ui/1.10.0/themes/base/jquery-ui.css" />
		<link rel="stylesheet" href="css/jquery.timepicker.css" />
		
        <script src="http://code.jquery.com/jquery.js"></script>
  		<script src="js/bootstrap.min.js"></script>
		
    </head>
    
    <body>
   	
		<div class="page" style="max-width:750px;">

			<nav role="naviation">
				<div class="navbar">
					<div class="navbar-inner">
						<div class="container" style="width: auto;">
							<a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
							</a>
							<a class="brand" href="/CSUN-ST-Planner2/">CSUN-ST-Planner2</a>
							<div class="nav-collapse">
								<ul class="nav">
									<li><a href="teacher.php">Teacher</a></li>
									<li><a href="student.php">Student</a></li>
								</ul>
								<ul class="nav pull-right">
									<li class="divider-vertical"></li>
									<li><a href="http://projectpossibility.org/" target="_blank">Project:Possibility</a></li>
								</ul>
							</div><!-- /.nav-collapse -->
						</div>
					</div><!-- /navbar-inner -->
				</div>
			</nav>

			<h1><?php echo $subtitle; ?></h1>
