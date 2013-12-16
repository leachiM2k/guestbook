<?php
/**
 * User: rotmanov
 * Date: 12/13/13
 * Time: 10:19 AM
 */

namespace guestbook\Core;

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
		$url = $this->getAfterBaseUrl();

		$frontController = new FrontController($this->configuration);
		$renderer = $frontController->dispatch($url, $method);

		if ($frontController->httpCode != 200)
		{
			header('HTTP/1.0 ' . $frontController->httpCode . ' ' . $frontController->httpMessage);
		}

		$renderer->setAppBasePath($this->getFullBaseUrl());
		$renderer->setConfiguration($this->configuration);
		$renderer->setTemplateBasePath($this->config['general']['templatePath']);
		echo $renderer->render();
	}

	/**
	 * @return mixed|string
	 */
	protected function getAfterBaseUrl()
	{
		$url = $_SERVER['REQUEST_URI'];
		$url = preg_replace('/\/?\?.*$/', '', $url);

		if (isset($this->config['general']['basePath']))
		{
			$regex = "/^" . preg_quote($this->config['general']['basePath'], "/") . "/";
			$url = preg_replace($regex, '', $url);
		}
		return $url;
	}

	protected function getFullBaseUrl()
	{
		if (isset($_SERVER['REQUEST_SCHEME']))
		{
			$schema = strtolower($_SERVER['REQUEST_SCHEME']);
		}
		elseif (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == "on")
		{
			$schema = "https";
		}
		else
		{
			$schema = "http";
		}

		if (isset($_SERVER['HTTP_X_FORWARDED_HOST']))
		{
			$host = $_SERVER['HTTP_X_FORWARDED_HOST'];
		}
		elseif (isset($_SERVER['HTTP_HOST']))
		{
			$host = $_SERVER['HTTP_HOST'];
		}
		else
		{
			$host = $_SERVER['SERVER_NAME'];
		}

		$url = $_SERVER['REQUEST_URI'];
		if (isset($this->config['general']['basePath']))
		{
			$regex = "/^(" . preg_quote($this->config['general']['basePath'], "/") . ").*/";
			$url = preg_replace($regex, '$1', $url);
		}

		return "$schema://$host$url";
	}

} 