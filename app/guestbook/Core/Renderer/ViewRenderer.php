<?php
/**
 * Created by PhpStorm.
 * User: Michael
 * Date: 14.12.13
 * Time: 13:19
 */

namespace guestbook\Core\Renderer;


class ViewRenderer extends AbstractRenderer
{
	public function render()
	{
		$templateFileName = $this->templateBasePath . '/' . $this->templateFileName;

		if(!is_readable($templateFileName))
		{
			throw new ViewNotFoundException();
		}

		ob_start();
		include $templateFileName;
		return ob_get_clean();
	}
}