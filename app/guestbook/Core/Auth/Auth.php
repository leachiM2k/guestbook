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

/**
 * Class Auth authorizes user against an UserService and stores it in a session
 * TODO: This is not abstract enough
 *
 * @package guestbook\Core\Auth
 */
class Auth
{
	/**
	 * @var \guestbook\Core\Session\Session
	 */
	protected $session;
	/**
	 * @var \guestbook\Entities\UserService
	 */
	protected $userService;

	/**
	 * @var string Holder for username
	 */
	protected $username;
	/**
	 * @var string Holder for password
	 */
	protected $password;

	/**
	 * Constructor with dependency injection
	 *
	 * @param Session $session
	 * @param UserService $userService
	 */
	public function __construct(Session $session, UserService $userService)
	{
		$this->session = $session;
		$this->userService = $userService;
	}

	/**
	 * setter for password
	 *
	 * @param mixed $password
	 */
	public function setPassword($password)
	{
		$this->password = $password;
	}

	/**
	 * getter for password
	 *
	 * @return mixed
	 */
	public function getPassword()
	{
		return $this->password;
	}

	/**
	 * setter for username
	 *
	 * @param mixed $username
	 */
	public function setUsername($username)
	{
		$this->username = $username;
	}

	/**
	 * getter for username
	 *
	 * @return mixed
	 */
	public function getUsername()
	{
		return $this->username;
	}

	/**
	 * Authentication method, Uses blowfish crypt to check password hash.
	 *
	 * @return bool returns true for success otherwise throws AuthExceptions
	 * @throws AuthException
	 */
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

	/**
	 * Check for user authentication
	 *
	 * @return bool
	 */
	public function isAuthenticated()
	{
		$loggedin = $this->session->getData("loggedin");
		return isset($loggedin) && $loggedin == true;
	}

	/**
	 * Destorys session completely
	 */
	public function destroy()
	{
		return $this->session->destroy();
	}


	/**
	 * Returns data of authenticated user
	 *
	 * @return User
	 */
	public function getUserData()
	{
		return $this->session->getData("userData");
	}

} 