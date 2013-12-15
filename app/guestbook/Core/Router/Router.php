<?php
/**
 * User: rotmanov
 * Date: 12/13/13
 * Time: 11:28 AM
 */

namespace guestbook\Core\Router;

class Router
{
	private $routes = array();

	public function __construct($routes = null)
	{
		if (isset($routes)) {
			$this->setRoutes($routes);
		}
	}

	public function route($url)
	{
		foreach ($this->getRoutes() as $route) {
			if ($route->matches($url)) {
				return $route->getRouteResource();
			}
		}

		throw new RouteNotFoundException();
	}

	/**
	 * @return array
	 */
	public function getRoutes()
	{
		return $this->routes;
	}

	/**
	 * @param array $routes
	 */
	public function setRoutes($routes)
	{
		$this->routes = $routes;
	}

} 