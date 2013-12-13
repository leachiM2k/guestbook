<?php
/**
 * User: rotmanov
 * Date: 12/13/13
 * Time: 11:14 AM
 */

namespace guestbook\Core;

class FrontControllerTest extends \PHPUnit_Framework_TestCase
{
	private $frontController;
	private $router;

	public function setUp()
	{
		$this->router = $this->getMock('\guestbook\Core\Router\Router');

		$this->frontController = new FrontController($this->router);
	}

	public function testDispatch404CodeOnNoRoute()
	{
		$testUrl = '/not/found';
		$this->frontController->dispatch($testUrl);

		$this->assertAttributeEquals(404, 'httpCode', $this->frontController);
	}

	public function testDispatch200CodeOnFoundRoute()
	{
		$testUrl = '/existing/page';

		$this->router->expects($this->once())
			->method('route')
			->with('/existing/page')
			->will($this->returnValue("foo"));

		$this->frontController->dispatch($testUrl);

		$this->assertAttributeEquals(200, 'httpCode', $this->frontController);
	}

}
 