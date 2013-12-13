<?php
/**
 * User: rotmanov
 * Date: 12/13/13
 * Time: 10:19 AM
 */

namespace guestbook\Core;

use guestbook\Core\FrontController;

class Application {

	public function run()
	{
		$frontController = new FrontController();
		$frontController->dispatch();
	}

} 