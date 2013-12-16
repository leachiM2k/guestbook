<?php
/**
 * User: Michael
 * Date: 15.12.13
 * Time: 14:23
 */

namespace guestbook\Core\Router\Parser;

use guestbook\Core\Router\Route;
use guestbook\Core\Router\RouteResource;

class IniRouteParser
{
	protected $iniRoutes = array();

	public function __construct($configFile = null)
	{
		if (isset($configFile))
		{
			$this->loadIniRoutes($configFile);
		}
	}

	public function loadIniRoutes($fileName)
	{
		$this->setIniRoutes(parse_ini_file($fileName, true));
	}

	public function setIniRoutes($iniRoutes)
	{
		$this->iniRoutes = $iniRoutes;
	}

	public function parse()
	{
		$splittedIniRoutes = array();
		foreach ($this->iniRoutes as $entryName => $entryValue)
		{
			$matches = array();
			$matchResult = preg_match('/(.*)_(.*)$/', $entryName, $matches);
			if ($matchResult !== false && $matchResult !== 0)
			{
				$splittedIniRoutes[$matches[1]][$matches[2]] = $entryValue;
			}
		}

		$routes = array();
		foreach ($splittedIniRoutes as $routeName => $routeValues)
		{
			$resource = new RouteResource($routeValues['resource']);
			$routes[] = new Route($routeName, $routeValues['url'], $resource);
		}

		return $routes;
	}
} 