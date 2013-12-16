<?php
ini_set('display_errors', 'on');

use guestbook\Core\Application;
use guestbook\Core\Configuration;
use guestbook\Core\Router\Router;
use guestbook\Core\Session\Adapter\PhpSessionAdapter;
use guestbook\Core\Session\Session;
use guestbook\Core\Storage\Database\DatabaseFactory;
use guestbook\Core\Router\Parser\IniRouteParser;
use guestbook\Core\Auth\Auth;
use guestbook\Entities\UserService;

$applicationPath = __DIR__ . '/../app';
require_once $applicationPath . '/autoload.php';

$config = parse_ini_file($applicationPath . '/config.ini', true);
$routeParser = new IniRouteParser($applicationPath . '/routes.ini');

$configuration = new Configuration();
$configuration->setConfig($config);
$configuration->setDatabase(new DatabaseFactory($configuration->getConfig()['database']));
$configuration->setRouter(new Router($routeParser->parse()));
$configuration->setSession(new Session(new PhpSessionAdapter()));
$authService = new UserService($configuration->getDatabase()->getConnector());
$configuration->setAuth(new Auth($configuration->getSession(), $authService));

$application = new Application($configuration);
$application->run();
