<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<title><?php echo trans('Problem') . TITLE_SUFFIX;?></title>
		<link href="./themes/default/css/markdown.css" rel="stylesheet">
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
							<li class="active"><a href="./problem.php"><?php echo trans('Problems');?></a></li>
							<li><a href="./submit.php"><?php echo trans('Submit');?></a></li>
							<li><a href="./status.php"><?php echo trans('Status');?></a></li>
						</ul>
					</div>
				</div>
			</div>
		</div>

		<div class="container">
			<div class="row"><div class="span3" style="margin-left:0">
				<div class="navtab-fixed-left tabbable tabs-left">
					<ul class="nav nav-tabs span3">
						<li class="nav-header"><h4><?php echo trans('Problem List');?></h4><br/></li>
						<?php
					 		$data=fetch_problem();
					 		for ($i=0; $i<count($data); $i++) {
					 			$record=$data[$i];
					 			$name=$record['name'];
					 			$display_name=$record['title'] . ' (' . $record['name'] . ')';
					 			if ($i + 1 == $problem_id) $active=' class="active"';
					 			else $active="";
					 			echo '<li'. $active .'><a href="#'. $name .'" data-toggle="tab">' . $display_name . '</a></li>';
					 		}
						?>
					</ul>
				</div></div>
				<div class="span9 offset3 tab-content">
						<?php
							for ($i=0; $i<count($data); $i++) {
								$record=$data[$i];
								$name=$record['name'];
								$title=$record['title'];
								$description=$record['description'];
								if ($i + 1 == $problem_id) $active=' active';
					 			else $active="";
								echo '<div class="tab-pane'. $active .'" id="'. $name .'">';
								echo '<section class="md" id="'. $name .'">';
								echo '<div class="page-header"><h1>'. $title . ' ('  . $name . ')' .'</h1></div>';
								echo solve_conflit(Markdown(pre_conflit($description)));
								echo '</section>';
								echo '<hr><a class="btn btn-primary" href="./submit.php?problem_id='. $record['id'] .'">'. trans('Submit') . '</a></div>';
							}
						?>
				</div>
			</div>
			<hr>
			<footer>
				<p>&copy; Company 2012</p>
			</footer>
		</div>

		<script type="text/x-mathjax-config">
			MathJax.Hub.Config({
				extensions: ["tex2jax.js"],
				jax: ["input/TeX", "output/HTML-CSS"],
				tex2jax: {
					inlineMath: [ ["\\\\(","\\\\)"] ],
					displayMath: [ ["\\\\[","\\\\]"] ],
					processEscapes: true
				},
				"HTML-CSS": { availableFonts: ["TeX"] }
			});
		</script>
		<script src="./themes/default/js/jquery.js"></script>
		<script src="./themes/default/js/sugar.js"></script>
		<script src="./themes/default/js/bootstrap.min.js"></script>
		<script src="./themes/default/js/bootstrap-tab.js"></script>
		<script src="./themes/default/js/MathJax.js?config=TeX-AMS_HTML"></script>
	</body>
</html>