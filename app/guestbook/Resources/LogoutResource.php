<?php
/**
 * User: rotmanov
 * Date: 12/13/13
 * Time: 2:00 PM
 */

namespace guestbook\Resources;

use guestbook\Core\Renderer\RedirectRenderer;
use guestbook\Core\Resource\AbstractResource;

class LogoutResource extends AbstractResource
{
	public function get()
	{
		$this->getConfiguration()->getAuth()->destroy();
		return new RedirectRenderer(array("route" => "home"));
	}

} 