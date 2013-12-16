<?php
/**
 * User: Michael
 * Date: 15.12.13
 * Time: 16:50
 */

namespace guestbook\Core\Session;

use guestbook\Core\Session\Adapter\SessionAdapterInterface;

class Session
{
	public $sessionAdapter;

	public function __construct(SessionAdapterInterface $sessionAdapter)
	{
		$this->sessionAdapter = $sessionAdapter;
		$this->sessionAdapter->start();
	}

	public function getData($key)
	{
		return $this->sessionAdapter->get($key);
	}

	public function setData($key, $value)
	{
		return $this->sessionAdapter->set($key, $value);
	}

	public function destroy()
	{
		$this->sessionAdapter->stop();
	}

} 