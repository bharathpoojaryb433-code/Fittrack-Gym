<?php

session_start();

define('BASE_PATH', dirname(__DIR__));

define('DATA_PATH', BASE_PATH . '/data/');
define('UPLOAD_PATH', BASE_PATH . '/uploads/');

date_default_timezone_set('Asia/Kolkata');
?>