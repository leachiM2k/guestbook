<?php
namespace guestbook\Resources;

class AbstractResourceTest extends \PHPUnit_Framework_TestCase
{
	/**
	 * @var IndexResource
	 */
	private $resource;

    public function setUp()
    {
        $this->resource = new IndexResource();
    }

    public function testGetImplemented()
    {
        $result = $this->resource->get();
		$this->assertInstanceOf('guestbook\Core\Renderer\AbstractRenderer', $result);
    }

}
