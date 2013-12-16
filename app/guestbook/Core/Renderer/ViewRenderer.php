<?php
/**
 * Created by PhpStorm.
 * User: Michael
 * Date: 14.12.13
 * Time: 13:19
 */

namespace guestbook\Core\Renderer;


/**
 * Class ViewRenderer renders view files (mostly phtml)
 *
 * @package guestbook\Core\Renderer
 */
class ViewRenderer extends AbstractRenderer
{
	/**
	 * renders view and returns HTML
	 *
	 * @return string rendered HTML
	 * @throws ViewNotFoundException is thrown when a view was not found in templateBasePath
	 */
	public function render()
	{
		$templateFileName = $this->templateBasePath . '/' . $this->templateFileName;

		if (!is_readable($templateFileName))
		{
			throw new ViewNotFoundException();
		}

		ob_start();
		include $templateFileName;
		return ob_get_clean();
	}
}