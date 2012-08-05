<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta http-equiv="refresh" content="5">
		<title><?php echo trans('Status') . TITLE_SUFFIX;?></title>
		<link href="./themes/default/css/bootstrap.min.css" rel="stylesheet">
		<style type="text/css">
			body {
				padding-top: 60px;
				padding-bottom: 40px;
			}
			.sidebar-nav {
				padding: 9px 0;
			}
			tr.stt {
				text-align: center;
			}
		</style>
		<link href="./themes/default/css/bootstrap-responsive.min.css" rel="stylesheet">
		<link href="./themes/default/css/record.css" rel="stylesheet">
	</head>

	<body>
		<div class="navbar navbar-fixed-top">
			<div class="navbar-inner">
				<div class="container">
					<a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
						<!--<span class="icon-bar"></span>-->
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</a>

					<a class="brand" href="./index.php">Mini-OJ</a>

					<div class="nav-collapse">
						<ul class="nav">
							<li><a href="./problem.php"><?php echo trans('Problems');?></a></li>
							<li><a href="./submit.php"><?php echo trans('Submit');?></a></li>
							<li class="active"><a href="./status.php"><?php echo trans('Status');?></a></li>
						</ul>
					</div>
				</div>
			</div>
		</div>

		<div class="container">
			<section id="status">
				<div class="page-header">
					<h1><?php echo trans('Status List');?></h1>
				</div>
				<table class="table table-bordered table-striped" id="status-list">
					<thead>
						<tr>
							<th width="8%"><?php echo trans('Run ID');?></th>
							<th width="13%"><?php echo trans('Problem');?></th>
							<th width="20%"><?php echo trans('Result');?></th>
							<th width="7%"><?php echo trans('Score');?></th>
							<th width="10%"><?php echo trans('Time');?></th>
							<th width="10%"><?php echo trans('Memory');?></th>
							<th width="30%"><?php echo trans('Submit Time');?></th>
						</tr>
					</thead>
					<tbody id="status">
						<?php
							$data=fetch_record($page, $db);
							$result=$data[0]; $pages=$data[1];
							if (count($result) > 0) {
								foreach ($result as $record) {
									$name = '<a href="./problem.php?problem_id='. $record['problem_id'] .'">'. $record['name']. '</a>';
									$status = make_status($record['status']);
									if ($record['score'] == -1) $score='-';
									else $score=$record['score'];
									echo '<tr>';
									echo '<td>'. $record['id'] .'</td>';
									echo '<td>'. $name . '</td>';
									echo $status;
									echo '<td>'. $score .'</td>';
									echo '<td>'. $record['time_used'] .'MS</td>';
									echo '<td>'. $record['memory_used'] .'KB</td>';
									echo '<td>'. $record['submit_time'] .'</td>';
									echo '</tr>';
								}
							}
							echo "</tbody></table>";
							$previous=$page - 1; $next=$page + 1;
							echo '<div class="pagination pagination-centered"><ul>';
							if ($previous>0) echo '<li><a href="./status.php?page='. $previous .'">&laquo;</a></li>';
							else echo '<li class="disabled"><a href="#">&laquo;</a></li>';
							for ($i = 1; $i <= $pages; $i++)
								if ($i == $page) {
									echo '<li class="active"><a href="#">' . $i . '</a></li>';
								}
								else {echo '<li><a href="./status.php?page='. $i .'">' . $i .'</a></li>'; }
							if ($next<=$pages) echo '<li><a href="./status.php?page='. $next .'">&raquo;</a></li>';
							else echo '<li class="disabled"><a href="#">&raquo;</a></li>';
							echo '</ul></div>';
						?>
			</section>
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