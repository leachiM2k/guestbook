<?php
/**
 * User: Michael
 * Date: 15.12.13
 * Time: 14:12
 */

namespace guestbook\Core;

use guestbook\Core\Auth\Auth;
use guestbook\Core\Router\Router;
use guestbook\Core\Session\Session;
use guestbook\Core\Storage\Database\DatabaseFactory;

class Configuration
{
	private $database;
	private $config;
	private $router;
	private $session;
	private $auth;

	/**
	 * @param array $config
	 */
	public function setConfig($config)
	{
		$this->config = $config;
	}

	/**
	 * @return array
	 */
	public function getConfig()
	{
		return $this->config;
	}

	/**
	 * @param DatabaseFactory $database
	 */
	public function setDatabase($database)
	{
		$this->database = $database;
	}

	/**
	 * @return DatabaseFactory
	 */
	public function getDatabase()
	{
		return $this->database;
	}

	/**
	 * @param Router $router
	 */
	public function setRouter($router)
	{
		$this->router = $router;
	}

	/**
	 * @return Router
	 */
	public function getRouter()
	{
		return $this->router;
	}

	/**
	 * @param Session $session
	 */
	public function setSession($session)
	{
		$this->session = $session;
	}

	/**
	 * @return Session
	 */
	public function getSession()
	{
		return $this->session;
	}

	/**
	 * @param Auth $auth
	 */
	public function setAuth($auth)
	{
		$this->auth = $auth;
	}

	/**
	 * @return Auth
	 */
	public function getAuth()
	{
		return $this->auth;
	}

} 