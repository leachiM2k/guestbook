<?php
/**
 * User: Michael
 * Date: 15.12.13
 * Time: 15:49
 */
namespace guestbook\Entities;

class AbstractServiceTest extends \PHPUnit_Framework_TestCase
{
	/**
	 * @var TestService
	 */
	private $testService;

	public function setUp()
	{
		$connector = $this->getMockBuilder('guestbook\Core\Storage\Database\Connector\ConnectorInterface')
			->disableOriginalConstructor()
			->getMock();
		$this->testService = new TestService($connector);
	}

	public function testCreateEntity()
	{
		$values = array('test' => 'testValue');
		$result = $this->testService->mapArrayToEntity($values);
		$this->assertEquals('testValue', $result->getTest());
	}


}

class TestService extends AbstractService
{
	public function mapArrayToEntity($arrayValue)
	{
		return parent::mapArrayToEntity($arrayValue);
	}

	protected function createEntity()
	{
		return new TestEntity();
	}

	public function fetchAll()
	{
	}
}

class TestEntity
{
	private $test;

	public function setTest($test)
	{
		$this->test = $test;
	}

	public function getTest()
	{
		return $this->test;
	}

}