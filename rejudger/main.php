<?php
include_once(__DIR__ . '/../inc/init.php');

chdir(__DIR__);
exec('del/q ' . TEMP_DIR . '*.*');

$status = array('Accepted',
				'Time Limit Exceeded',
				'Memory Limit Exceeded',
				'Runtime Error',
				'Compile Error',
				'Wrong Answer',
				'Unknown Error');

while (true) {
	$result = $db->translatedQuery(
		'SELECT id, problem_id, source_code, language FROM records WHERE status = 1 ORDER BY submit_time LIMIT 1');
	if ($result->countReturnedRows() == 0) {
		sleep(WAITING_TIME);
		continue;
	}
	$row = $result->fetchRow();
	$db->translatedExecute('UPDATE records SET status = 2 WHERE id = %i', $row['id']);
	
	$record_id = $row['id'];
	$problem_id = $row['problem_id'];
	$code = $row['source_code'];
	$language = $row['language'];
	$total_score = 0;
	$total_time = 0;
	$total_memory = 0;
	$total_ts = 0;

	$file = fFile::create(TEMP_DIR . 'a.cpp', $code);
	$cmd = 'compiler '. $language . ' a.cpp ' . COMPILE_TIME_OUT;

	if (exec($cmd) != '0') {
		$total_ts = 4;
	} else {
		$result = $db->translatedQuery(
			'SELECT time_limit, memory_limit, case_score, file_name FROM testcases WHERE problem_id = %i', $problem_id);
		if (!$result) {
			echo 'no info about testcases!';
			exec('del/q ' . TEMP_DIR . '*.*');
			exit();
		}
		foreach ($result as $row) {
			$time_limit = $row['time_limit'];
			$memory_limit = $row['memory_limit'];
			$case_score = $row['case_score'];
			$infile = $row['file_name'] . '.in';
			$ansfile = $row['file_name'] . '.ans';
			
			$cmd = 'copy ' . DATA_DIR . $infile . ' ' . TEMP_DIR . $infile;
			exec($cmd, $res, $var);
			if ($var != 0) {
				echo 'file copy failed!';
				exec('del/q ' . TEMP_DIR . '*.*');
				exit();
			}
			
			$cmd = 'copy ' . DATA_DIR . $ansfile . ' ' . TEMP_DIR . $ansfile;
			exec($cmd, $res, $var);
			if ($var != 0) {
				echo 'file copy failed!';
				exec('del/q ' . TEMP_DIR . '*.*');
				exit();
			}

			if (($language == 'C++') || ($language == 'C'))
				$cmd = 'a.exe';
			else if ($language == 'JAVA')
				$cmd = 'java';
			else if ($language == 'PYTHON') {
				echo '^_^';
				exec('del/q ' . TEMP_DIR . '*.*');
				exit();
			}
			$cmd = RUNNER_NAME . ' ' . TEMP_DIR . $cmd . ' ' . TEMP_DIR . $infile . 
				' ' . TEMP_DIR . 'a.out ' . TEMP_DIR . $ansfile . ' ' . $time_limit .
				' ' . $memory_limit . ' ';

			exec($cmd, $res, $var);
			if ($var != 0) {
				echo 'system(runner) failed!';
				exec('del/q ' . TEMP_DIR . '*.*');
				exit();
			}
		
			$file1 = new fFile('result.txt');
			$result = explode(' ', $file1->read());
			$total_time = $total_time + $result[2];
			$total_memory = $total_memory + $result[3];
			$total_score = $total_score + $result[1] * $case_score;
			if (($total_ts == 0) && ($result[0] != '0'))
				$total_ts = $result[0];
			exec('del/q ' . TEMP_DIR . '*.in');
			exec('del/q ' . TEMP_DIR . '*.ans');
		}

	}

	exec('del/q ' . TEMP_DIR . '*.*');
	
	$db->translatedExecute(
		'UPDATE records SET time_used = %i, memory_used = %i, status = %s, score = %i WHERE id = %i',
		$total_time, $total_memory, $status[$total_ts], $total_score, $record_id);
}