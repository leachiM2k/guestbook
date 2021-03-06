<?php
namespace guestbook\Resources;

use guestbook\Core\Configuration;

class AbstractResourceTest extends \PHPUnit_Framework_TestCase
{
	/**
	 * @var IndexResource
	 */
	private $resource;

	public function setUp()
	{
		$connector = $this->getMockBuilder('guestbook\Core\Storage\Database\Connector\ConnectorInterface')
			->disableOriginalConstructor()
			->getMock();
		$connector->expects($this->once())
			->method('fetch')
			->will($this->returnValue(array()));

		$database = $this->getMockBuilder('guestbook\Core\Storage\Database\DatabaseFactory')->disableOriginalConstructor()->getMock();
		$database->expects($this->once())
			->method('getConnector')
			->will($this->returnValue($connector));

		$auth = $this->getMockBuilder('guestbook\Core\Auth\Auth')
			->disableOriginalConstructor()
			->getMock();

		$configuration = new Configuration();
		$configuration->setDatabase($database);
		$configuration->setAuth($auth);
		$this->resource = new IndexResource();
		$this->resource->setConfiguration($configuration);
	}

	public function testGetImplemented()
	{
		$result = $this->resource->get();
		$this->assertInstanceOf('guestbook\Core\Renderer\AbstractRenderer', $result);
	}

}
