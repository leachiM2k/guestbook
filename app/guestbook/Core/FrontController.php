<?php
/**
 * User: rotmanov
 * Date: 12/13/13
 * Time: 11:10 AM
 */

namespace guestbook\Core;

use guestbook\Core\Router\RouteNotFoundException;
use guestbook\Core\Router\Router;
use guestbook\Core\Router\RouteResource;

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
		/**
		 * @var RouteResource
		 */
		try {
			$resource = $this->configuration->getRouter()->route($url);
		} catch (RouteNotFoundException $e) {
			$this->httpCode = 404;
			$this->httpMessage = "Not Found";
			$resource = new RouteResource('guestbook\Core\Resource\NotFoundResource');
		}

		$resourceInstance = $resource->getInstance();
		$resourceInstance->setConfiguration($this->configuration);
		$resourceResponse = $resourceInstance->$method();

		return $resourceResponse;
	}

} 