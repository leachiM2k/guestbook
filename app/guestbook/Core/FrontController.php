<?php
/**
 * User: rotmanov
 * Date: 12/13/13
 * Time: 11:10 AM
 */

namespace guestbook\Core;

use guestbook\Core\Router\Route;
use guestbook\Core\Router\RouteNotFoundException;
use guestbook\Core\Router\Router;
use guestbook\Core\Router\RouteResource;

class FrontController
{
	/**
	 * @var Router\Router
	 */
	public $router;

	public $httpCode = 200;
	public $httpMessage = 'OK';

	public function __construct(Router $router)
	{
		$this->router = $router;
	}

	public function dispatch($url, $method)
	{
		/**
		 * @var RouteResource
		 */
		try {
			$resource = $this->router->route($url);
		} catch (RouteNotFoundException $e) {
			$this->httpCode = 404;
			$this->httpMessage = "Not Found";
			$resource = new RouteResource('guestbook\Core\Resource\NotFoundResource');
		}

		$resourceResponse = $resource->getInstance()->$method();

		return $resourceResponse;
	}

} 