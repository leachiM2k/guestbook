<?php
/**
 * User: Michael
 * Date: 15.12.13
 * Time: 23:29
 */

namespace guestbook\Core\Auth;

use guestbook\Core\Session\Adapter\MemorySessionAdapter;
use guestbook\Core\Session\Session;
use guestbook\Entities\User;

class AuthTest extends \PHPUnit_Framework_TestCase
{
	/**
	 * @var AuthUser
	 */
	protected $authUserObject;

	/**
	 * @var Auth
	 */
	protected $auth;

	const TESTUSER = 'testuser';
	const TESTPASSWORD = 'testpassword';

	public function setUp()
	{
		$this->authUserObject = new User();
		$this->authUserObject->setLogin(self::TESTUSER);
		// blowfish hash for password 'testpassword'
		$this->authUserObject->setPasswordHash("$2y$10$2QYPvGRVRjgf4J1lQe5m8uC4UOWJPxaxpKT0BTBcPYsMB8VCwT.T2");

		$authUserService = $this->getMockBuilder('guestbook\Entities\UserService')
			->disableOriginalConstructor()
			->getMock();
		$authUserService->expects($this->once())
			->method('fetchByUsername')
			->with(self::TESTUSER)
			->willReturn($this->authUserObject);

		$session = new Session(new MemorySessionAdapter());
		$this->auth = new Auth($session, $authUserService);
	}

	/**
	 * @expectedException guestbook\Core\Auth\AuthException
	 */
	public function testAuthenticationWithWrongPassword()
	{
		$this->auth->setUsername(self::TESTUSER);
		$this->auth->setPassword("bla");
		$this->auth->authenticate();
	}

	public function testAuthenticationWithRightPassword()
	{
		$this->auth->setUsername(self::TESTUSER);
		$this->auth->setPassword(self::TESTPASSWORD);
		$result = $this->auth->authenticate();

		$this->assertTrue($result);
	}

	public function testLoginState()
	{
		$this->auth->setUsername(self::TESTUSER);
		$this->auth->setPassword(self::TESTPASSWORD);
		$this->auth->authenticate();

		$this->assertTrue($this->auth->isAuthenticated());
	}


	public function testGetDataReturnsAuthUserObject()
	{
		$this->auth->setUsername(self::TESTUSER);
		$this->auth->setPassword(self::TESTPASSWORD);
		$this->auth->authenticate();

		$this->assertSame($this->authUserObject, $this->auth->getUserData());
	}


}
 