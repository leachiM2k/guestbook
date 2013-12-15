<?php
/**
 * User: Michael
 * Date: 15.12.13
 * Time: 16:29
 */

namespace guestbook\Core\Storage\Database;

class DatabaseFactoryTest extends \PHPUnit_Framework_TestCase
{
	public function testReturnsMySQLConnector()
	{
		$config = array('type' => 'MySQL', 'host' => '', 'user' => '', 'password' => '', 'db' => '');
		$factory = new DatabaseFactory($config);
		$connector = $factory->getConnector();
		$this->assertInstanceOf('guestbook\Core\Storage\Database\Connector\MySQL', $connector);
	}

	/**
	 * @expectedException \RuntimeException
	 */
	public function testMissingType()
	{
		$config = array();
		$factory = new DatabaseFactory($config);
		$factory->getConnector();
	}

	/**
	 * @expectedException guestbook\Core\Storage\Database\DatabaseFactoryUnsupportedException
	 */
	public function testUnknownType()
	{
		$config = array('type' => 'unknownTestType');
		$factory = new DatabaseFactory($config);
		$factory->getConnector();
	}

}
 