<?php
include_once(__DIR__ . '/inc/init.php');

if (fAuthorization::checkLoggedIn()) {
	fURL::redirect(fAuthorization::getRequestedURL(false, SITE_BASE));
} else {
	$errmsg = '';
	$student_no = '';

  	if (fRequest::isPost()) {
    	$student_no = fRequest::get('student_no');
    	$password = fRequest::get('password');
    	if (empty($student_no)) {
    		$errmsg = trans('Please input your student No.');
    	} else if (empty($password)) {
    		$errmsg = trans('Please input your password.');
    	} else if (!login_authenticate($db, $student_no, $password)) {
    		$errmsg = trans('Authorization failed.');
    	} else {
    		//fURL::redirect(SITE_BASE);
    		fURL::redirect(fAuthorization::getRequestedURL(TRUE, './'));
    	}
  	}

 	include(__DIR__ . '/themes/' . SITE_THEME . '/tpl/login.php');
}