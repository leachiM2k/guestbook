<?php
/**
 * User: Michael
 * Date: 15.12.13
 * Time: 13:19
 */

namespace guestbook\Core\Storage\Database;

class DatabaseFactoryUnsupportedException extends \RuntimeException
{
	protected $message = "Database type is not supported";
} 