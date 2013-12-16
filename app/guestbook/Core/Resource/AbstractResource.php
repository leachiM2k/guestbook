<?php
/**
 * User: rotmanov
 * Date: 12/13/13
 * Time: 1:35 PM
 */

namespace guestbook\Core\Resource;


use guestbook\Core\Configuration;

abstract class AbstractResource
{
	protected $viewName;

	/**
	 * @var Configuration
	 */
	protected $configuration;

	public function __construct()
	{
		$this->viewName = strtolower(preg_replace('/.*\\\\([a-z0-9]*)resource$/i', '\1', get_class($this))) . '.phtml';
	}

	public function get()
	{
		throw new \RuntimeException("GET is not implemented in " .  get_class($this));
	}

	public function post()
	{
		throw new \RuntimeException("POST is not implemented in " .  get_class($this));
	}

	public function setConfiguration(Configuration $configuration)
	{
		$this->configuration = $configuration;
	}

	public function getConfiguration()
	{
		return $this->configuration;
	}
}