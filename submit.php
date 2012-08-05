<?php
include_once(__DIR__ . '/inc/init.php');

fAuthorization::requireLoggedIn();
if (strtotime(now()) < strtotime($start_time)) {
	include(__DIR__ . '/themes/' . SITE_THEME . '/tpl/error.php');
} elseif (strtotime(now()) > strtotime($end_time)) {
	include(__DIR__ . '/themes/' . SITE_THEME . '/tpl/error2.php');
} elseif (fRequest::isPost()) {
	try {
		$problem_id = fRequest::get('problem_id');
		$lang = fRequest::get('lang');
		$code = fRequest::get('code');
		if (empty($problem_id)) {
			throw new fValidationException(trans('Problem ID is Empty'));
		} else if (!valid($lang)) {
			throw new fValidationException(trans('Empty or invalid Language'));
		} else if (empty($code)) {
			throw new fValidationException(trans('Source code is empty'));
		} else if (strlen() > MAX_CODE_LENGTH) {
			throw new fValidationException(tran('Submitted code is too long'));
		}
		$record = new Record();
		$record->setProblemId($problem_id);
		$record->setLanguage($lang);
		$record->setSourceCode($code);
		$record->setUserId(get_current_user_id());
		$record->setSubmitTime(now());
		$record->store();
		fURL::redirect("status.php");
	}  catch (fException $e) {
		include(__DIR__ . '/themes/' . SITE_THEME . '/tpl/submit.php');
	}
} elseif (fRequest::isGet()){
	$problem_id = fRequest::get("problem_id");
	include(__DIR__ . '/themes/' . SITE_THEME . '/tpl/submit.php');
} else {
	exit('Method Denied!');
}