<?php
/**
 * User: rotmanov
 * Date: 12/13/13
 * Time: 1:35 PM
 */

namespace guestbook\Core\Resource;


abstract class AbstractResource
{
	public function get()
	{
		throw new \RuntimeException("GET is not implemented in " .  __CLASS__);
	}

	public function post()
	{
		throw new \RuntimeException("POST is not implemented in " .  __CLASS__);
	}

} 