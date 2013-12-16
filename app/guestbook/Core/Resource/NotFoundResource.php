<?php
/**
 * User: rotmanov
 * Date: 12/13/13
 * Time: 2:00 PM
 */

namespace guestbook\Core\Resource;

use guestbook\Core\Renderer\ViewRenderer;

/**
 * Class NotFoundResource is used for not found routes.
 * Renders a 404 page with more details
 *
 * @package guestbook\Core\Resource
 */
class NotFoundResource extends AbstractResource
{
	/**
	 * returns a simple 404 page with more details
	 *
	 * @return ViewRenderer
	 */
	public function get()
	{
		$exception = func_get_arg(0);
		$response = new ViewRenderer(array('exception' => $exception));
		$response->setTemplateFileName('default/404.phtml');
		return $response;
	}

} 