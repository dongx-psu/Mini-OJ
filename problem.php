<?php
include_once(__DIR__ . '/inc/init.php');

fAuthorization::requireLoggedIn();
if (strtotime(now()) < strtotime($start_time)) {
	include(__DIR__ . '/themes/' . SITE_THEME . '/tpl/error.php');
} elseif (fRequest::isGet()) {
	$problem_id = fRequest::get("problem_id");
	if(empty($problem_id)) $problem_id=1;
	include(__DIR__ . '/themes/' . SITE_THEME . '/tpl/problem.php');
} else {
	exit("Method Denied!");
}