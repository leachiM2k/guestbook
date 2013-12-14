<?php
/**
 * User: Michael
 * Date: 14.12.13
 * Time: 13:11
 */

namespace guestbook\Core\Renderer;


class JsonRendererTest extends \PHPUnit_Framework_TestCase
{
	/**
	 * @var JsonRenderer
	 */
	private $renderer;

	public function setUp()
	{
		$this->renderer = new JsonRenderer();
	}

	public function testRenderReturnsDataAsJson()
	{
		$data = array("foo" => "bar", "baz" => 99);
		$this->renderer->setData($data);
		$output = $this->renderer->render();
		$this->assertEquals('{"foo":"bar","baz":99}', $output);
	}


}
 