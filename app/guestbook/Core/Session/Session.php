<?php
/**
 * User: Michael
 * Date: 15.12.13
 * Time: 16:50
 */

namespace guestbook\Core\Session;

use guestbook\Core\Session\Adapter\SessionAdapterInterface;

/**
 * Class Session talks to the given session adapter
 *
 * @package guestbook\Core\Session
 */
class Session
{
	/**
	 * @var Adapter\SessionAdapterInterface
	 */
	public $sessionAdapter;

	/**
	 * @param SessionAdapterInterface $sessionAdapter
	 */
	public function __construct(SessionAdapterInterface $sessionAdapter)
	{
		$this->sessionAdapter = $sessionAdapter;
		$this->sessionAdapter->start();
	}

	/**
	 * gets data for a key store in the active session
	 *
	 * @param string $key
	 * @return mixed
	 */
	public function getData($key)
	{
		return $this->sessionAdapter->get($key);
	}

	/**
	 * sets value for key in the active session
	 *
	 * @param string $key
	 * @param mixed $value
	 * @return null
	 */
	public function setData($key, $value)
	{
		return $this->sessionAdapter->set($key, $value);
	}

	/**
	 * completely destroys the session
	 * 
	 */
	public function destroy()
	{
		$this->sessionAdapter->stop();
	}

} 