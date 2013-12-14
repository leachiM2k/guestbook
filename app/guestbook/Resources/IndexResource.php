<?php
/**
 * User: rotmanov
 * Date: 12/13/13
 * Time: 2:00 PM
 */

namespace guestbook\Resources;

use guestbook\Core\Renderer\ViewRenderer;
use guestbook\Core\Resource\AbstractResource;

class IndexResource extends AbstractResource
{
	public $viewName;

	public function __construct()
	{
		$this->viewName = strtolower(preg_replace('/.*\\\\([a-z0-9]*)resource$/i', '\1', __CLASS__)) . '.phtml';
	}

	public function get()
    {
		$renderer = new ViewRenderer();
		$renderer->setTemplateFileName($this->viewName);
		return $renderer;
    }

} 