<?php
namespace guestbook\Resources;

use guestbook\Core\Configuration;
use guestbook\Core\Storage\Database\DatabaseFactory;

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
			->willReturn(array());

		$database = $this->getMockBuilder('guestbook\Core\Storage\Database\DatabaseFactory')->disableOriginalConstructor()->getMock();
		$database->expects($this->once())
			->method('getConnector')
			->will($this->returnValue($connector));

		$configuration = new Configuration();
		$configuration->setDatabase($database);
        $this->resource = new IndexResource();
		$this->resource->setConfiguration($configuration);
    }

    public function testGetImplemented()
    {
        $result = $this->resource->get();
		$this->assertInstanceOf('guestbook\Core\Renderer\AbstractRenderer', $result);
    }

}
