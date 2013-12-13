<?php
ini_set('display_errors', 'on');
use guestbook\Core\Application;

$applicationPath = __DIR__ . '/../app';
require_once $applicationPath . '/autoload.php';

$application = new Application();
$application->run();
