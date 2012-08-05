<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title><?php echo trans('Home') . TITLE_SUFFIX;?></title>
		<link href="./themes/default/css/bootstrap.min.css" rel="stylesheet">
		<style type="text/css">
			body {
				padding-top: 60px;
				padding-bottom: 40px;
			}
			.sidebar-nav {
				padding: 9px 0;
			}
		</style>
		<link href="./themes/default/css/bootstrap-responsive.min.css" rel="stylesheet">
	</head>

	<body>
		<div class="navbar navbar-fixed-top">
			<div class="navbar-inner">
				<div class="container">
					<a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</a>

					<a class="brand" href="#">Mini-OJ</a>

					<div class="nav-collapse">
						<ul class="nav">
							<li><a href="./problem.php"><?php echo trans('Problems');?></a></li>
							<li><a href="./submit.php"><?php echo trans('Submit');?></a></li>
							<li><a href="./status.php"><?php echo trans('Status');?></a></li>
						</ul>
					</div>
				</div>
			</div>
		</div>

		<div class="container">
			<div class="hero-unit">
				<h1 style="margin-bottom:10px"><?php echo trans('Welcome to Mini-OJ'); ?></h1>
				<p><?php echo trans('This is a Mini-OJ devloped by ACM IWG. Enjoy it!');?> <br/>
				<?php
					if (!fAuthorization::checkLoggedIn()) {
						echo trans('Sign in now to take the exam!') . '</p>';
						echo '<p><a class="btn btn-primary btn-large" style="margin-top:5px" href="./login.php">'. trans('Sign In Now') . '&raquo;</a></p>';
					} else {
						echo trans('Here will show some test rules for the students.') . '</p>';
					}
				?>
			</div>
			<div class="row-fluid">
				<div class="span4">
					<h2 style="margin-bottom:5px"><?php echo trans('View Problems');?></h2>
					<p><?php echo trans('Click the button below to view problems.');?></p>
					<p><a class="btn" style="margin-top:5px" href="./problem.php"><?php echo trans('View Problems');?> &raquo;</a></p>
				</div>
				<div class="span4">
					<h2 style="margin-bottom:5px"><?php echo trans('Submit Solutions');?></h2>
					<p><?php echo trans('Click the button below to submit solutions.');?></p>
					<p><a class="btn" style="margin-top:5px" href="./submit.php"><?php echo trans('Submit Solutions');?> &raquo;</a></p>
				</div>
				<div class="span4">
					<h2 style="margin-bottom:5px"><?php echo trans('Check Status');?></h2>
					<p><?php echo trans('Click the button below to check status.');?></p>
					<p><a class="btn" style="margin-top:5px" href="./status.php"><?php echo trans('Check Status');?> &raquo;</a></p>
				</div>
			</div>
			<hr>
			<footer>
				<p>&copy; Company 2012</p>
			</footer>
		</div>
		
		<script src="./themes/default/js/jquery.js"></script>
		<script src="./themes/default/js/sugar.js"></script>
		<script src="./themes/default/js/bootstrap.min.js"></script>
	</body>
</html>