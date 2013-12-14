<?php
/**
 * Created by PhpStorm.
 * User: Michael
 * Date: 14.12.13
 * Time: 13:06
 */

namespace guestbook\Core\Renderer;


class AbstractRendererTest extends \PHPUnit_Framework_TestCase
{
	/**
	 * @var AbstractRenderer
	 */
	private $abstractRenderer;

	public function setUp()
	{
		$this->abstractRenderer = $this->getMockForAbstractClass('guestbook\Core\Renderer\AbstractRenderer');
	}

	public function testSetDataAndMagicGetter()
	{
		$data = array("foo" => "bar");
		$this->abstractRenderer->setData($data);
		$this->assertEquals("bar", $this->abstractRenderer->foo);
	}


}
 