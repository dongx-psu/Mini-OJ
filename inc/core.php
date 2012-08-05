<?php
function now() {
  return date('Y-m-d H:i:s');
}

function pre_conflit($text) {
	$text = preg_replace("/\\\\\\\\\(/", "<imath>", $text);
	$text = preg_replace("/\\\\\\\\\)/", "</imath>", $text);
	$text = preg_replace("/\\\\\\\\\[/", "<dmath>", $text);
	$text = preg_replace("/\\\\\\\\\]/", "</dmath>", $text);
	return $text;
}

function solve_conflit($text) {
	$text = preg_replace("/<imath>/", "\\\\\\\\(", $text);
	$text = preg_replace("/<\/imath>/", "\\\\\\\\)", $text);
	$text = preg_replace("/<dmath>/", "\\\\\\\\[", $text);
	$text = preg_replace("/<\/dmath>/", "\\\\\\\\]", $text);
	return $text;
}

function get_ip() {
	if (!empty($_SERVER["HTTP_CLIENT_IP"]))
		$cip = $_SERVER["HTTP_CLIENT_IP"];
	elseif (!empty($_SERVER["HTTP_X_FORWARDED_FOR"]))
		$cip = $_SERVER["HTTP_X_FORWARDED_FOR"];
	elseif (!empty($_SERVER["REMOTE_ADDR"])) {
		$cip = $_SERVER["REMOTE_ADDR"];
		if ($cip == '::1') $cip='127.0.0.1';
	}
	return sprintf("%u", ip2long($cip));;
}

function login_authenticate($db, $student_no, $password) {
	$result = $db->translatedQuery(
		'SELECT id,student_no,pass,salt,iter,ip_address,display_name FROM users WHERE student_no=%s', $student_no);
	$num_of_rows = $result->countReturnedRows();
	if ($num_of_rows > 0) {
		$row = $result->fetchRow();
		if (acm_userpass_check($row, $password) && $row['ip_address'] == get_ip()) {
			fAuthorization::setUserToken(array(
				'user_id' => $row['id'],
				'name' => $row['display_name']
				));
			$result = $db->translatedQuery('INSERT INTO logins VALUES (NULL, %s, %s, %s)', $row['id'], get_ip(), now());
			return true;
		} else {
			return false;
		}
	}
	return false;
}

function valid($language) {
	return (!empty($language) && ($language == "C++" || $language == "C" || $language == "JAVA"));
}

function get_current_user_id() {
	$token = fAuthorization::getUserToken();
	return $token['user_id'];
}

function get_current_student_name() {
	$token = fAuthorization::getUserToken();
	return $token['name'];
}

function return_success() {
	return fJSON::encode(array('success' => true));
}

function return_error($e) {
	return fJSON::encode(array(
		'success' => false,
		'message' => $e->getMessage()
	));
}

function fetch_record($page, $db) {
	$data = fRecordSet::build(
		'Record', array('user_id=' => get_current_user_id()),
		array('id' => 'desc'), 20, $page);
	$pages = $data->getPages();
	foreach($data as $row) {
		$problem_id=$row->getProblemId();
		$tmp = $db->translatedQuery('SELECT name FROM problems WHERE id=%s', $problem_id);
		$tt = $tmp->fetchRow();
		$name = $tt['name'];
		$result[] = array(
			'id' => $row->getId(),
			'user_id' => $row->getUserId(),
			'name' => $name,
			'problem_id' => $problem_id,
			'status' => $row->getStatus(),
			'score' => $row->getScore(),
			'time_used' => $row->getTimeUsed(),
			'memory_used' => $row->getMemoryUsed(),
			'submit_time' => $row->getSubmitTime()
		);
	}
	return array($result, $pages);
}

function fetch_problem() {
	$data = fRecordSet::build('Problem');
	foreach($data as $row) {
		$result[] = array(
			'id' => $row->getId(),
			'name' => $row->getName(),
			'title' => $row->getTitle(),
			'description' => $row->getDescription()
		);
	}
	return $result;
}

function fetch_names($db){
	$data = $db->translatedQuery('SELECT id, name, title FROM problems');
	$result = $data->fetchAllRows();

	return $result;
}

function make_status($status) {
	$ans = '<td style="text-align:center" class="';
	if ($status == 'Waiting') $ans = $ans . 'recordWaiting';
	elseif ($status == 'Running') $ans = $ans . 'recordRunning';
	elseif ($status == 'Accepted') $ans = $ans . 'recordAccepted';
	elseif ($status == 'Time Limit Exceeded') $ans = $ans . 'recordTimeLimitExceeded';
	elseif ($status == 'Memory Limit Exceeded') $ans = $ans . 'recordMemoryLimitExceeded';
	elseif ($status == 'Runtime Error') $ans = $ans . 'recordRuntimeError';
	elseif ($status == 'Compile Error') $ans = $ans . 'recordCompileError';
	elseif ($status == 'Wrong Answer') $ans = $ans . 'recordWrongAnswer';
	else $ans = $ans . 'recordUnknownError';
	$ans = $ans . '">'. trans($status) . '</td>';
	return $ans;
}