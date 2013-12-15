<?php
/**
 * User: rotmanov
 * Date: 12/13/13
 * Time: 10:19 AM
 */

namespace guestbook\Core;

use guestbook\Core\FrontController;
use guestbook\Core\Storage\Database\DatabaseFactory;

class Application
{

	/**
	 * @var Configuration
	 */
	private $configuration;

	private $config;

	function __construct(Configuration $configuration)
	{
		$this->configuration = $configuration;
		$this->config = $this->configuration->getConfig();
	}

	public function run()
	{
		$method = strtolower($_SERVER['REQUEST_METHOD']);
		$url = $this->getUrl();

		$frontController = new FrontController($this->configuration);
		$renderer = $frontController->dispatch($url, $method);

		if($frontController->httpCode != 200)
		{
			header('HTTP/1.0 '.$frontController->httpCode.' '.$frontController->httpMessage);
		}

		$renderer->setTemplateBasePath($this->config['general']['templatePath']);
		echo $renderer->render();
	}

	/**
	 * @return mixed|string
	 */
	protected function getUrl()
	{
		$url = $_SERVER['REQUEST_URI'];
		// strip GET variables from URL
		if (($pos = strpos($url, '?')) !== false) {
			$url = substr($url, 0, $pos);
		}

		if (isset($this->config['general']['basePath'])) {
			$regex = "/^" . preg_quote($this->config['general']['basePath'], "/") . "/";
			$url = preg_replace($regex, '', $url);
			return $url;
		}
		return $url;
	}

} 