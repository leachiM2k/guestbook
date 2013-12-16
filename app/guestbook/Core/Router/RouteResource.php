<?php
/**
 * User: rotmanov
 * Date: 12/13/13
 * Time: 12:58 PM
 */

namespace guestbook\Core\Router;

use guestbook\Core\Resource\AbstractResource;

/**
 * Class RouteResource holds and creates instances of resources
 * @package guestbook\Core\Router
 */
class RouteResource
{
	/**
	 * @var string resource name
	 */
	private $resource;
	/**
	 * @var AbstractResource instance of resource
	 */
	private $instance;

	/**
	 * @param string $resource
	 */
	public function __construct($resource = null)
	{
		if (isset($resource))
		{
			$this->setResource($resource);
		}
	}

	/**
	 * setter for resource's name
	 *
	 * @param string $resource
	 */
	public function setResource($resource)
	{
		$this->resource = $resource;
	}

	/**
	 * Tries to get an instance of resource and
	 * throws an exception if no resource was found
	 *
	 * @return AbstractResource
	 * @throws RouteNotFoundException
	 */
	public function getInstance()
	{
		if (!isset($this->instance))
		{
			if (!class_exists($this->resource))
			{
				throw new RouteNotFoundException("Resource " . $this->resource . " is not available.");
			}
			$this->instance = new $this->resource;
		}
		return $this->instance;
	}
}