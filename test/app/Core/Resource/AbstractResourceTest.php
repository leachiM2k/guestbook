<?php
/**
 * User: rotmanov
 * Date: 12/13/13
 * Time: 1:42 PM
 */

namespace guestbook\Core\Resource;


class AbstractResourceTest extends \PHPUnit_Framework_TestCase {

	/**
	 * @var AbstractResource
	 */
	private $abstractResource;

	public function setUp()
	{
		$this->abstractResource = $this->getMockForAbstractClass('guestbook\Core\Resource\AbstractResource');
	}

	/**
	 * @expectedException \RuntimeException
	 */
	public function testGetNotImplemented()
	{
		$this->abstractResource->get();
	}

	/**
	 * @expectedException \RuntimeException
	 */
	public function testPostNotImplemented()
	{
		$this->abstractResource->post();
	}

}
 