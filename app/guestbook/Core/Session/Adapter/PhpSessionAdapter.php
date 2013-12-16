<?php
/**
 * User: Michael
 * Date: 16.12.13
 * Time: 00:03
 */

namespace guestbook\Core\Session\Adapter;


class PhpSessionAdapter implements SessionAdapterInterface
{
	public function start()
	{
		session_name('guestbook');
		session_start();
		$_SESSION["lastseen"] = time();
	}

	public function get($key)
	{
		if (isset($_SESSION[$key]))
		{
			return $_SESSION[$key];
		}
		return null;
	}

	public function set($key, $value)
	{
		$_SESSION[$key] = $value;
	}

	public function stop()
	{
		unset($_SESSION);
		setcookie(session_name(), "", time() - 3600, "/");
		session_destroy();
		session_write_close();
	}

} 