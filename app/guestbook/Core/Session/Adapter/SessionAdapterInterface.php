<?php
/**
 * User: Michael
 * Date: 16.12.13
 * Time: 00:01
 */

namespace guestbook\Core\Session\Adapter;

interface SessionAdapterInterface
{
	public function start();

	public function get($key);

	public function set($key, $value);

	public function stop();
} 