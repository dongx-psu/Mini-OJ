<?php
//======= DataBase Config =========
define('DB_NAME', 'testbase');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_HOST', 'localhost');

//========= Site Config ===========
define('SITE_THEME', 'default');
define('SITE_TITLE', 'Mini-OJ');
define('HOST_URL', 'http://localhost');
define('SITE_BASE', '/mini-oj');
define('DEFAULT_THEME', 'default');
define('TITLE_SUFFIX', ' | Mini-OJ');
define('LOGIN_PAGE', '/login.php');
date_default_timezone_set('Asia/Shanghai');
define('SESSION_LENGTH', '1 day');

//======== Rejudger Config =========
define('DATA_DIR', 'data\\');
define('TEMP_DIR', 'temp\\');
define('RUNNER_NAME', 'runner.exe');
define('WAITING_TIME', 1);
define('COMPILE_TIME_OUT', 30000);

//========= Exam Config ============
$start_time = '2012-7-1 16:17:00';
$end_time = '2012-9-1 16:20:00';