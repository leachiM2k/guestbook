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
			->will($this->returnValue(array(array(), array())));
		$result = $this->entryService->fetchAll();
		$this->assertEquals(2, count($result));
	}

	public function testFetchById()
	{
		$this->connector->expects($this->once())
			->method('fetch')
			->with('entries', array('id' => '1337'))
			->will($this->returnValue(array(array())));
		$result = $this->entryService->fetchById(1337);
		$this->assertInstanceOf('guestbook\Entities\Entry', $result);
	}

	/**
	 * @expectedException guestbook\Entities\EntityNotFoundException
	 */
	public function testFetchByIdFindsNothing()
	{
		$this->connector->expects($this->once())
			->method('fetch')
			->with('entries', array('id' => '1337'))
			->will($this->returnValue(array()));
		$this->entryService->fetchById(1337);
	}

	public function testDeleteEntity()
	{
		$dbResult = "passthroughresult";
		$this->connector->expects($this->once())
			->method('delete')
			->with('entries', array('id' => '1337'))
			->will($this->returnValue($dbResult));
		$entity = new Entry();
		$entity->setId('1337');
		$result = $this->entryService->deleteEntity($entity);
		$this->assertEquals($dbResult, $result);
	}

	public function testPersistNewEntity()
	{
		$entity = new Entry();
		$entity->setText("test text");
		$this->connector->expects($this->once())->method('insert');
		$this->entryService->persistEntity($entity);
	}

	public function testPersistExistingEntity()
	{
		$entity = new Entry();
		$entity->setId(1337);
		$entity->setText("test text");
		$this->connector->expects($this->once())->method('update');
		$this->entryService->persistEntity($entity);
	}

}
 