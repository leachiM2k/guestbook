<?php
/**
 * User: rotmanov
 * Date: 12/13/13
 * Time: 12:58 PM
 */

namespace guestbook\Core\Router;

use guestbook\Core\Resource\AbstractResource;

class RouteResource
{
	/**
	 * @var AbstractResource
	 */
	private $resource;
	/**
	 * @var AbstractResource
	 */
	private $instance;

	public function __construct($resource = null)
	{
		if(isset($resource))
		{
			$this->setResource($resource);
		}
	}

	public function setResource($resource)
	{
		$this->resource = $resource;
	}

	public function getInstance()
	{
		if (!isset($this->instance)) {
			$this->instance = new $this->resource;
		}
		return $this->instance;
	}
}