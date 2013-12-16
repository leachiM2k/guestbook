<?php
/**
 * User: rotmanov
 * Date: 12/13/13
 * Time: 11:10 AM
 */

namespace guestbook\Core;

use guestbook\Core\Renderer\AbstractRenderer;
use guestbook\Core\Resource\InternalServerErrorResource;
use guestbook\Core\Resource\NotFoundResource;
use guestbook\Core\Router\RouteNotFoundException;

class FrontController
{
	/**
	 * @var Configuration
	 */
	public $configuration;

	public $httpCode = 200;
	public $httpMessage = 'OK';

	public function __construct(Configuration $configuration)
	{
		$this->configuration = $configuration;
	}

	public function dispatch($url, $method)
	{
		try
		{
			$resource = $this->configuration->getRouter()->route($url);
			$resourceResponse = $this->executeResourceMethod($method, $resource);
		} catch (RouteNotFoundException $e)
		{
			$this->httpCode = 404;
			$this->httpMessage = "Not Found";
			$resourceInstance = new NotFoundResource();
			$resourceResponse = $resourceInstance->get($e);
		} catch (\RuntimeException $e)
		{
			$this->httpCode = 500;
			$this->httpMessage = "Internal Server Error";
			$resourceInstance = new InternalServerErrorResource();
			$resourceResponse = $resourceInstance->get($e);
		}

		return $resourceResponse;
	}

	/**
	 * @param $method
	 * @param $resource
	 * @return AbstractRenderer
	 */
	protected function executeResourceMethod($method, $resource)
	{
		$resourceInstance = $resource->getInstance();
		$resourceInstance->setConfiguration($this->configuration);
		$resourceResponse = $resourceInstance->$method();
		return $resourceResponse;
	}

} 