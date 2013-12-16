<?php
/**
 * User: rotmanov
 * Date: 12/13/13
 * Time: 1:35 PM
 */

namespace guestbook\Core\Resource;


use guestbook\Core\Configuration;

/**
 * Class AbstractResource provides methods for resources
 * @package guestbook\Core\Resource
 */
abstract class AbstractResource
{
	/**
	 * @var string name of the view - is set in constructor, but may be overridden
	 */
	protected $viewName;

	/**
	 * @var Configuration
	 */
	protected $configuration;

	/**
	 * Constructor, calculates automatic view name by resource's name
	 * guestbook\Resource\IndexResource will be 'index'
	 */
	public function __construct()
	{
		$this->viewName = strtolower(preg_replace('/.*\\\\([a-z0-9]*)resource$/i', '\1', get_class($this))) . '.phtml';
	}

	/**
	 * stub for get request
	 *
	 * @throws \RuntimeException
	 */
	public function get()
	{
		throw new \RuntimeException("GET is not implemented in " . get_class($this));
	}

	/**
	 * stub for post request
	 *
	 * @throws \RuntimeException
	 */
	public function post()
	{
		throw new \RuntimeException("POST is not implemented in " . get_class($this));
	}

	/**
	 * @param Configuration $configuration
	 */
	public function setConfiguration(Configuration $configuration)
	{
		$this->configuration = $configuration;
	}

	/**
	 * @return Configuration
	 */
	public function getConfiguration()
	{
		return $this->configuration;
	}
}