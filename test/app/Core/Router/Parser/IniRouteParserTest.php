<?php
/**
 * User: Michael
 * Date: 15.12.13
 * Time: 14:26
 */

namespace guestbook\Core\Router\Parser;


use guestbook\Core\Router\Route;
use guestbook\Core\Router\RouteResource;
use org\bovigo\vfs\vfsStream;

class IniRouteParserTest extends \PHPUnit_Framework_TestCase
{
	public $expectedRoutes;

	public function setUp()
	{
		$directory = vfsStream::setup('test');
		$file = vfsStream::newFile('routes.ini');
		$iniContent = "home_first_url=/\n";
		$iniContent .= "home_first_resource=testapp\\Resource\\HomeResource\n";
		$iniContent .= "about_url=/about\n";
		$iniContent .= "about_resource=testapp\\Resource\\AboutResource\n";
		$file->setContent($iniContent);
		$directory->addChild($file);

		$this->expectedRoutes = array(
			new Route('home_first', '/', new RouteResource('testapp\Resource\HomeResource')),
			new Route('about', '/about', new RouteResource('testapp\Resource\AboutResource'))
		);
	}

	public function testParseFromArray()
	{
		$iniEntries = array(
			'home_first_url' => '/',
			'home_first_resource' => 'testapp\Resource\HomeResource',
			'about_url' => '/about',
			'about_resource' => 'testapp\Resource\AboutResource',
		);

		$parser = new IniRouteParser();
		$parser->setIniRoutes($iniEntries);
		$result = $parser->parse();
		$this->assertEquals($this->expectedRoutes, $result);
	}

	public function testParseFromFile()
	{
		$parser = new IniRouteParser();
		$parser->loadIniRoutes(vfsStream::url('test/routes.ini'));
		$result = $parser->parse();
		$this->assertEquals($this->expectedRoutes, $result);
	}


}
 