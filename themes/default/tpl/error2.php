<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title><?php echo trans('ERROR') . TITLE_SUFFIX;?></title>
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
			<div class="hero-unit">
				<h1 style="margin-bottom:10px"><?php echo trans('ERROR');?></h1>
				<p><?php echo trans('The test has ended!!');?><br/></p>
				<p>
					<a class="btn btn-primary btn-large" style="margin-top:5px" href="./index.php"><?php echo trans('Return To Index');?> &raquo;</a></p>
				</p>
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