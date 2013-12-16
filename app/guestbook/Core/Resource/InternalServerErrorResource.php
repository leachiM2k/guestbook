<?php
/**
 * User: rotmanov
 * Date: 12/13/13
 * Time: 2:00 PM
 */

namespace guestbook\Core\Resource;

use guestbook\Core\Renderer\ViewRenderer;

/**
 * Class InternalServerErrorResource is used for otherwise uncaught exceptions.
 * Renders a 500 error page with caught exception
 *
 * @package guestbook\Core\Resource
 */
class InternalServerErrorResource extends AbstractResource
{
	/**
	 * returns a simple HTML file with exception info
	 *
	 * @return ViewRenderer
	 */
	public function get()
	{
		$exception = func_get_arg(0);
		$response = new ViewRenderer(array('exception' => $exception));
		$response->setTemplateFileName('default/500.phtml');
		return $response;
	}

} 