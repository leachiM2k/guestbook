<?php
/**
 * User: rotmanov
 * Date: 12/13/13
 * Time: 10:19 AM
 */

namespace guestbook\Core;

use guestbook\Core\FrontController;

class Application
{

	private $router;
	private $config;

	function __construct($router, $config)
	{
		$this->router = $router;
		$this->config = $config;
	}

	public function run()
	{
		$url = $_SERVER['REQUEST_URI'];
		// strip GET variables from URL
		if (($pos = strpos($url, '?')) !== false) {
			$url = substr($url, 0, $pos);
		}

		if (isset($this->config['general']['basePath'])) {
			$regex = "/^" . preg_quote($this->config['general']['basePath'], "/") . "/";
			$url = preg_replace($regex, '', $url);
		}

		$method = strtolower($_SERVER['REQUEST_METHOD']);

		$frontController = new FrontController($this->router);
		$renderer = $frontController->dispatch($url, $method);

		if($frontController->httpCode != 200)
		{
			header('HTTP/1.0 '.$frontController->httpCode.' '.$frontController->httpMessage);
		}

		$renderer->setTemplateBasePath($this->config['general']['templatePath']);
		echo $renderer->render();
	}

} 