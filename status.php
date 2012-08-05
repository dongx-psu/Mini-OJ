<?php
include_once(__DIR__ . '/inc/init.php');

fAuthorization::requireLoggedIn();
if (fRequest::isGet()) {
	$page=fRequest::get('page');
	if(empty($page)) $page=1;
	include(__DIR__ . '/themes/' . SITE_THEME . '/tpl/status.php');
} else {
	exit("Method Denied!");
}