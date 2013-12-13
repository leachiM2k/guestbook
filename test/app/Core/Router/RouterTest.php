<?php
/**
 * User: rotmanov
 * Date: 12/13/13
 * Time: 11:59 AM
 */

namespace guestbook\Core\Router;

class RouterTest extends \PHPUnit_Framework_TestCase {

	private $router;

	public function setUp()
	{
		$this->router = new Router();
	}

	/**
	 * @expectedException guestbook\Core\Router\RouteNotFoundException
	 */
	public function testRouteNotFound()
	{
		$this->router->route("fakeurl");
	}

	public function testRouteFromList()
	{
		$testResource = new RouteResource();

		$routeList = array(
			new Route("testRoute", "/test/page", $testResource)
		);
		$this->router->setRoutes($routeList);
		$result = $this->router->route("/test/page");
		$this->assertSame($testResource, $result);
	}

}
 