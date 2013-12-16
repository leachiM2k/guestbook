<?php
/**
 * User: rotmanov
 * Date: 12/13/13
 * Time: 2:00 PM
 */

namespace guestbook\Core\Resource;

use guestbook\Core\Renderer\ViewRenderer;

class NotFoundResource extends AbstractResource
{
	public function get()
	{
		$exception = func_get_arg(0);
		$response = new ViewRenderer(array('exception' => $exception));
		$response->setTemplateFileName('default/404.phtml');
		return $response;
	}

} 