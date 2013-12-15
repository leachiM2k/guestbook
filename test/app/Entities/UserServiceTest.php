<?php
/**
 * User: Michael
 * Date: 15.12.13
 * Time: 16:18
 */

namespace guestbook\Entities;


class UserServiceTest extends \PHPUnit_Framework_TestCase
{
	/**
	 * @var UserService
	 */
	private $userService;

	/**
	 * @var \PHPUnit_Framework_MockObject_MockObject
	 */
	private $connector;

	public function setUp()
	{
		$this->connector = $this->getMockBuilder('guestbook\Core\Storage\Database\Connector\ConnectorInterface')
			->disableOriginalConstructor()
			->getMock();
		$this->userService = new UserService($this->connector);
	}

	public function testFetchById()
	{
		$this->connector->expects($this->once())
			->method('fetch')
			->with('users', array('id' => '1337'))
			->willReturn(array(array()));
		$result = $this->userService->fetchById(1337);
		$this->assertInstanceOf('guestbook\Entities\User',$result);
	}

	public function testFetchAll()
	{
		$this->connector->expects($this->once())
			->method('fetch')
			->with('users')
			->willReturn(array(array(), array()));
		$result = $this->userService->fetchAll();
		$this->assertEquals(2, count($result));
	}

}
 