<?php
/**
 * Created by PhpStorm.
 * User: Michael
 * Date: 14.12.13
 * Time: 13:02
 */

namespace guestbook\Core\Renderer;


class RedirectRenderer extends AbstractRenderer
{
	public function render()
	{
		if(!isset($this->route))
		{
			throw new \RuntimeException("Only route is supported for redirect");
		}
		header("Location: " . $this->getUrl($this->route), true);
		return "";
	}


} 