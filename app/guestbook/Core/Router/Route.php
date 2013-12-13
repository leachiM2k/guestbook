<?php
/**
 * User: rotmanov
 * Date: 12/13/13
 * Time: 12:55 PM
 */

namespace guestbook\Core\Router;

class Route
{
	private $name;
	private $url;
	private $resource;

	/**
	 * @param string $name Name of Route
	 * @param string $url Pattern to match
	 * @param \RouteResource $resource Definition of target
	 */
	function __construct($name, $url, RouteResource $resource)
	{
		$this->name = $name;
		$this->resource = $resource;
		$this->url = $url;
	}

	public function matches($pattern)
	{
		if($this->url == $pattern)
		{
			return true;
		}
	}

	/**
	 * @param mixed $name
	 */
	public function setName($name)
	{
		$this->name = $name;
	}

	/**
	 * @return mixed
	 */
	public function getName()
	{
		return $this->name;
	}

	/**
	 * @param mixed $resource
	 */
	public function setResource($resource)
	{
		$this->resource = $resource;
	}

	/**
	 * @return mixed
	 */
	public function getResource()
	{
		return $this->resource;
	}

	/**
	 * @param mixed $url
	 */
	public function setUrl($url)
	{
		$this->url = $url;
	}

	/**
	 * @return mixed
	 */
	public function getUrl()
	{
		return $this->url;
	}
} 