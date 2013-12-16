<?php
/**
 * User: Michael
 * Date: 16.12.13
 * Time: 00:01
 */

namespace guestbook\Core\Session\Adapter;

/**
 * Interface SessionAdapterInterface defines methods for all SessionAdapters
 * @package guestbook\Core\Session\Adapter
 */
interface SessionAdapterInterface
{
	/**
	 * Starts the session
	 *
	 * @return null
	 */
	public function start();

	/**
	 * Lookup for a key associated in the active session
	 *
	 * @param string $key
	 * @return mixed
	 */
	public function get($key);

	/**
	 * Sets a value for key in the active session
	 *
	 * @param string $key
	 * @param mixed $value
	 * @return null
	 */
	public function set($key, $value);

	/**
	 * Stops the session and destroys it completely
	 *
	 * @return null
	 */
	public function stop();
} 