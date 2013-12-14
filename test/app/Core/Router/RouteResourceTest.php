<?php
/**
 * User: Michael
 * Date: 14.12.13
 * Time: 14:30
 */

namespace guestbook\Core\Router;

use guestbook\Core\Resource\AbstractResource;

class RouteResourceTest extends \PHPUnit_Framework_TestCase
{
	public $routeResource;

	const DUMMY_RESOURCE = 'guestbook\Core\Router\DummyResource';

	public function setUp()
	{
		$this->routeResource = new RouteResource();
	}

	public function testSetClassViaConstructorAndGetAnInstance()
	{
		$routeResource = new RouteResource(self::DUMMY_RESOURCE);
		$instance = $routeResource->getInstance();
		$this->assertInstanceOf(self::DUMMY_RESOURCE, $instance);
		$this->assertSame($instance, $routeResource->getInstance());
	}

	public function testSetClassViaSetterAndGetAnInstance()
	{
		$routeResource = new RouteResource();
		$routeResource->setResource(self::DUMMY_RESOURCE);
		$instance = $routeResource->getInstance();
		$this->assertInstanceOf(self::DUMMY_RESOURCE, $instance);
	}

}

class DummyResource extends AbstractResource
{
}