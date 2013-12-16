<?php
/**
 * User: Michael
 * Date: 15.12.13
 * Time: 22:48
 */

namespace guestbook\Core\Auth;

use guestbook\Core\Session\Session;
use guestbook\Entities\EntityNotFoundException;
use guestbook\Entities\User;
use guestbook\Entities\UserService;

class Auth
{
	protected $session;
	protected $userService;

	protected $username;
	protected $password;

	public function __construct(Session $session, UserService $userService)
	{
		$this->session = $session;
		$this->userService = $userService;
	}

	/**
	 * @param mixed $password
	 */
	public function setPassword($password)
	{
		$this->password = $password;
	}

	/**
	 * @return mixed
	 */
	public function getPassword()
	{
		return $this->password;
	}

	/**
	 * @param mixed $username
	 */
	public function setUsername($username)
	{
		$this->username = $username;
	}

	/**
	 * @return mixed
	 */
	public function getUsername()
	{
		return $this->username;
	}

	public function authenticate()
	{
		try
		{
			$authUser = $this->userService->fetchByUsername($this->getUsername());
		} catch (EntityNotFoundException $e)
		{
			throw new AuthException;
		}
		if (crypt($this->getPassword(), $authUser->getPasswordHash()) !== $authUser->getPasswordHash())
		{
			throw new AuthException();
		}
		$this->session->setData("loggedin", true);
		$this->session->setData("userData", $authUser);
		return true;
	}

	public function isAuthenticated()
	{
		$loggedin = $this->session->getData("loggedin");
		return isset($loggedin) && $loggedin == true;
	}

	public function destroy()
	{
		return $this->session->destroy();
	}


	/**
	 * @return User
	 */
	public function getUserData()
	{
		return $this->session->getData("userData");
	}

} 