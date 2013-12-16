<?php
/**
 * User: rotmanov
 * Date: 12/13/13
 * Time: 11:28 AM
 */

namespace guestbook\Core\Router;

/**
 * Class Router find best possible route for given URL
 *
 * @package guestbook\Core\Router
 */
class Router
{
	/**
	 * @var array of Route
	 */
	private $routes = array();

	/**
	 * @param array|null $routes array of \guestbook\Core\Router\Route
	 */
	public function __construct($routes = null)
	{
		if (isset($routes))
		{
			$this->setRoutes($routes);
		}

	}

	/**
	 * tries to find the best route and returns it,
	 * otherwise throw an exception
	 *
	 * @param string $url
	 * @return Route
	 * @throws RouteNotFoundException
	 */
	public function route($url)
	{
		foreach ($this->getRoutes() as $route)
		{
			if ($route->matches($url))
			{
				return $route->getRouteResource();
			}
		}

		throw new RouteNotFoundException("No Route found for " . $url);
	}

	/**
	 * finds a route by name (e.g. for generation of absolute URLs)
	 *
	 * @param  string $name
	 * @return Route
	 * @throws RouteNotFoundException
	 */
	public function getRouteByName($name)
	{
		foreach ($this->getRoutes() as $route)
		{
			if ($route->getName() == $name)
			{
				return $route;
			}
		}

		throw new RouteNotFoundException("No Route found for name " . $name);
	}

	/**
	 * getter for all known routes
	 *
	 * @return array of Route
	 */
	public function getRoutes()
	{
		return $this->routes;
	}

	/**
	 * setter for known routes
	 *
	 * @param array $routes
	 */
	public function setRoutes($routes)
	{
		$this->routes = $routes;
	}

} 