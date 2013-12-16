<?php
/**
 * User: Michael
 * Date: 16.12.13
 * Time: 00:06
 */

namespace guestbook\Core\Session\Adapter;


class MemorySessionAdapter implements SessionAdapterInterface
{
	public $sessionStorage;

	public function start()
	{
		$this->sessionStorage = array();
	}

	public function get($key)
	{
		if (isset($this->sessionStorage[$key]))
		{
			return $this->sessionStorage[$key];
		}
		return null;
	}

	public function set($key, $value)
	{
		$this->sessionStorage[$key] = $value;
	}

	public function stop()
	{
		$this->sessionStorage = null;
	}

} 