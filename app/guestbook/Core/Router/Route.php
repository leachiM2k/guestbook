<?php
/**
 * User: rotmanov
 * Date: 12/13/13
 * Time: 12:55 PM
 */

namespace guestbook\Core\Router;

/**
 * Class Route is a route information holder with no business logic
 *
 * @package guestbook\Core\Router
 */
class Route
{
	/**
	 * @var string Name of route
	 */
	private $name;
	/**
	 * @var string Relative URL of Route
	 */
	private $url;
	/**
	 * @var \guestbook\Core\Router\RouteResource Resource holder
	 */
	private $routeResource;

	/**
	 * Constructor with field setters
	 *
	 * @param string $name Name of route
	 * @param string $url URL pattern to match
	 * @param \guestbook\Core\Router\RouteResource $resource Definition of target resource
	 */
	function __construct($name, $url, RouteResource $resource)
	{
		$this->name = $name;
		$this->routeResource = $resource;
		$this->url = $url;
	}

	/**
	 * simple equal match URL pattern
	 *
	 * @param $pattern
	 * @return bool true if this route's URL matches with URL pattern
	 */
	public function matches($pattern)
	{
		if ($this->url == $pattern)
		{
			return true;
		}
		return false;
	}

	/**
	 * setter for name of route
	 *
	 * @param mixed $name
	 */
	public function setName($name)
	{
		$this->name = $name;
	}

	/**
	 * getter for name of route
	 *
	 * @return mixed
	 */
	public function getName()
	{
		return $this->name;
	}

	/**
	 * setter for route's resource
	 *
	 * @param mixed $resource
	 */
	public function setRouteResource($resource)
	{
		$this->routeResource = $resource;
	}

	/**
	 * setter for route's resource
	 *
	 * @return mixed
	 */
	public function getRouteResource()
	{
		return $this->routeResource;
	}

	/**
	 * setter for relative URL
	 *
	 * @param mixed $url
	 */
	public function setUrl($url)
	{
		$this->url = $url;
	}

	/**
	 * getter for relative URL
	 *
	 * @return mixed
	 */
	public function getUrl()
	{
		return $this->url;
	}
} 