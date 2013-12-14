<?php
/**
 * User: rotmanov
 * Date: 12/13/13
 * Time: 11:14 AM
 */

namespace guestbook\Core;

use guestbook\Core\Resource\AbstractResource;
use guestbook\Core\Router\RouteNotFoundException;
use guestbook\Core\Router\RouteResource;

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
		$this->router->expects($this->once())
			->method('route')
			->will($this->throwException(new RouteNotFoundException()));

		$testUrl = '/not/found';
		$this->frontController->dispatch($testUrl, 'get');

		$this->assertAttributeEquals(404, 'httpCode', $this->frontController);
	}

	public function testDispatch200CodeOnFoundRoute()
	{
		$testUrl = '/existing/page';

		$resource = new RouteResource('guestbook\Core\DummyResource');

		$this->router->expects($this->once())
			->method('route')
			->with('/existing/page')
			->will($this->returnValue($resource));

		$this->frontController->dispatch($testUrl, 'get');

		$this->assertAttributeEquals(200, 'httpCode', $this->frontController);
	}

}

class DummyResource extends AbstractResource
{
	public function get()
	{
	}
}