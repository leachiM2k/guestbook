<?php
/**
 * User: Michael
 * Date: 15.12.13
 * Time: 14:23
 */

namespace guestbook\Core\Router\Parser;

use guestbook\Core\Router\Route;
use guestbook\Core\Router\RouteResource;

/**
 * Class IniRouteParser parses ini files to get routing informations from them
 *
 * @package guestbook\Core\Router\Parser
 */
class IniRouteParser
{

	/**
	 * @var array holder for loaded ini file
	 */
	protected $iniRoutes = array();

	/**
	 * @param string $configFile ini file to load
	 */
	public function __construct($configFile = null)
	{
		if (isset($configFile))
		{
			$this->loadIniRoutes($configFile);
		}
	}

	/**
	 * Loads file from file system and sets it
	 *
	 * @param string $fileName
	 */
	public function loadIniRoutes($fileName)
	{
		$this->setIniRoutes(parse_ini_file($fileName, true));
	}

	/**
	 * public setter for iniRoutes
	 *
	 * @param array $iniRoutes
	 */
	public function setIniRoutes(array $iniRoutes)
	{
		$this->iniRoutes = $iniRoutes;
	}

	/**
	 * parses route entry to multi-dimensional array and converts it to
	 * Route entries, that are suitable for Router
	 *
	 * @return array of guestbook\Core\Router\Route
	 */
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