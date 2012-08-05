<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<title><?php echo trans('Submit') . TITLE_SUFFIX;?></title>
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
							<li class="active"><a href="./submit.php"><?php echo trans('Submit');?></a></li>
							<li><a href="./status.php"><?php echo trans('Status');?></a></li>
						</ul>
					</div>
				</div>
			</div>
		</div>
		<div class="container">
			<section id="submission">
				<div class="page-header">
					<h1><?php echo trans('Submit Solutions');?></h1>
				</div>
				<form name="submit" class="well form-horizontal" action="submit.php" method="post">
					<fieldset>
						<?php
							if (!empty($e)) {
								echo '<div class="alert alert-error fade in">';
								echo '<button type="button" class="close" data-dismiss="alert">×</button>';
								echo $e->getMessage().'</div>';
							}
						?>
						<div class="control-group">
							<label class="control-label" for="problem_id"><b><?php echo trans('Problem');?></b></label>
							<div class="controls">
								<select name="problem_id">
									<?php
										$data=fetch_names($db);
										foreach ($data as $row) {
											if ($row['id'] == $problem_id) $st=' selected="selected"';
											else $st="";
											echo '<option value='. $row['id']. $st .'>'. $row['name'] .' - '. $row['title'] . '</option>';
										}
									?>
								</select>
							</div>
						</div>
						<div class="control-group">
							<label class="control-label" for="lang"><b><?php echo trans('Language');?></b></label>
							<div class="controls">
								<select name="lang">
									<option value="C++">C++</option>
									<!--<option value="C">C</option>-->
									<!--<option value="JAVA">Java</option>-->
								</select>
							</div>
						</div>
						<div class="control-group">
							<label class="control-label" for="code"><b><?php echo trans('Code');?></b></label>
							<div class="controls">
								<textarea class="span8" name="code" cols=80 rows=20></textarea>
							</div>
						</div>
						<div class="form-actions">
							<button type="submit" class="btn btn-primary"><?php echo trans('Submit');?></button>
						</div>
					</fieldset>
				</form>
			</section>
			<hr>
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