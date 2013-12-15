<?php
/**
 * User: Michael
 * Date: 15.12.13
 * Time: 16:18
 */

namespace guestbook\Entities;


class EntryServiceTest extends \PHPUnit_Framework_TestCase
{
	/**
	 * @var EntryService
	 */
	private $entryService;

	/**
	 * @var \PHPUnit_Framework_MockObject_MockObject
	 */
	private $connector;

	public function setUp()
	{
		$this->connector = $this->getMockBuilder('guestbook\Core\Storage\Database\Connector\ConnectorInterface')
			->disableOriginalConstructor()
			->getMock();
		$this->entryService = new EntryService($this->connector);
	}

	public function testFetchAll()
	{
		$this->connector->expects($this->once())
			->method('fetch')
			->with('entries', null, 'date')
			->willReturn(array(array(), array()));
		$result = $this->entryService->fetchAll();
		$this->assertEquals(2, count($result));
	}

}
 