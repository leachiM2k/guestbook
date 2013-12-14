<?php
/**
 * User: Michael
 * Date: 14.12.13
 * Time: 13:31
 */

namespace guestbook\Core\Renderer;

use org\bovigo\vfs\vfsStream;

class ViewRendererTest extends \PHPUnit_Framework_TestCase
{
	/**
	 * @var ViewRenderer
	 */
	private $renderer;

	public function setUp()
	{
		$directory = vfsStream::setup('test');
		$file = vfsStream::newFile('foo.phtml');
		$file->setContent('My name is <?php echo $this->name; ?>');
		$directory->addChild($file);

		$this->renderer = new ViewRenderer();
	}

	public function testReturnsRenderedTemplate()
	{
		$this->renderer->setTemplateBasePath(vfsStream::url('test'));
		$this->renderer->setTemplateFileName('foo.phtml');
		$this->renderer->setData(array('name' => 'Computer'));
		$output = $this->renderer->render();
		$this->assertEquals("My name is Computer", $output);
	}

	/**
	 * @expectedException guestbook\Core\Renderer\ViewNotFoundException
	 */
	public function testThrowsExceptionIfTemplateIsNotReadable()
	{
		$this->renderer->setTemplateFileName('doesnotexist');
		$this->renderer->render();
	}


}
 