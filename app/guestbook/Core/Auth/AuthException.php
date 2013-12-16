<?php
/**
 * User: Michael
 * Date: 15.12.13
 * Time: 23:46
 */

namespace guestbook\Core\Auth;


/**
 * Class AuthException will be thrown on wrong user credentials
 * @package guestbook\Core\Auth
 */
class AuthException extends \RuntimeException
{
	protected $message = "Combination of username and password is not correct";
} 