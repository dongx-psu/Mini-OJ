<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<title><?php echo trans('Sign In') . TITLE_SUFFIX;?></title>
		<link href="./themes/default/css/markdown.css" rel="stylesheet">
		<link href="./themes/default/css/bootstrap.min.css" rel="stylesheet">
		<link href="./themes/default/css/login.css" rel="stylesheet">
		<style type="text/css">
			body {
				padding-top: 100px;
				padding-bottom: 40px;
			}
			.sidebar-nav {
				padding: 9px 0;
			}
		</style>
		<link href="./themes/default/css/bootstrap-responsive.min.css" rel="stylesheet">
	</head>
	<body id="login">
		<div class="navbar navbar-fixed-top">
			<div class="navbar-inner">
				<div class="container">
					<a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</a>

					<a class="brand" href="./index.php">Mini-OJ</a>

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
			<div style="width:430px; margin:auto">
				<h2><?php echo trans('Sign In');?></h2>
				<form id="login-form" class="well" action="./login.php" method="post" style="background-color:#EEE">
					<fieldset>
						<?php
							if (!empty($errmsg)) {
								echo '<div class="alert alert-error fade in">';
								echo '<button type="button" class="close" data-dismiss="alert">×</button>';
								echo $errmsg .'</div>';
							}
						?>
						<div class="control-group">
							<label class="control-label" for="username"><?php echo trans('Student No.');?></label>
							<div class="controls">
								<input type="text" class="span4" name="student_no" id="student_no">
							</div>
						</div>
						<div class="control-group">
							<label class="control-label" for="password"><?php echo trans('Passsword');?></label>
							<div class="controls">
								<input type="password" class="span4" name="password" id="password">
							</div>
						</div>
						<hr class="mylogin">
						<button type="submit" class="btn btn-primary btn-large"><?php echo trans('Sign In');?> &raquo;</button>
					</fieldset>
				</form>
				<script type="text/javascript">
					document.getElementById('student_no').focus();
				</script>
			</div>
			<br/><br/><hr>
			<footer>
				<p>&copy; Company 2012</p>
			</footer>
		</div>

		<script src="./themes/default/js/jquery.js"></script>
		<script src="./themes/default/js/sugar.js"></script>
		<script src="./themes/default/js/bootstrap.min.js"></script>
		<script src="./themes/default/js/bootstrap-alert.js"></script>
	</body>
</html>
