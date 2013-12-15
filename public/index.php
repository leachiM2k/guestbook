<?php
ini_set('display_errors', 'on');

use guestbook\Core\Application;
use guestbook\Core\Configuration;
use guestbook\Core\Router\Router;
use guestbook\Core\Storage\Database\DatabaseFactory;
use \guestbook\Core\Router\Parser\IniRouteParser;

$applicationPath = __DIR__ . '/../app';
require_once $applicationPath . '/autoload.php';

$config = parse_ini_file($applicationPath . '/config.ini', true);
$routeParser = new IniRouteParser($applicationPath . '/routes.ini');

$configuration = new Configuration();
$configuration->setConfig($config);
$configuration->setDatabase(new DatabaseFactory($configuration->getConfig()['database']));
$configuration->setRouter(new Router($routeParser->parse()));

$application = new Application($configuration);
$application->run();
