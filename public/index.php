<?php
ini_set('display_errors', 'on');

use guestbook\Core\Router\Route;
use guestbook\Core\Router\Router;
use guestbook\Core\Application;
use \guestbook\Core\Router\RouteResource;

$applicationPath = __DIR__ . '/../app';
require_once $applicationPath . '/autoload.php';

$config = parse_ini_file($applicationPath . '/config.ini', true);

$knownRoutes = array(
	new Route('home', '/', new RouteResource('guestbook\Resources\IndexResource'))
);

$router = new Router();
$router->setRoutes($knownRoutes);

$application = new Application($router, $config);
$application->run();
