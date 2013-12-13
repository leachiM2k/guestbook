<?php
/**
 * User: rotmanov
 * Date: 12/13/13
 * Time: 11:10 AM
 */

namespace guestbook\Core;

use guestbook\Core\Router\Router;

class FrontController
{
	public $router;

	public $httpCode = 200;

	public function __construct(Router $router)
	{
		$this->router = $router;
	}

	public function dispatch($url)
	{
		$route = $this->router->route($url);

		if(!isset($route)) {
			$this->httpCode = 404;
		}

	}

} 