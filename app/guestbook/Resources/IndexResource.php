<?php
/**
 * User: rotmanov
 * Date: 12/13/13
 * Time: 2:00 PM
 */

namespace guestbook\Resources;

use guestbook\Core\Renderer\ViewRenderer;
use guestbook\Core\Resource\AbstractResource;
use guestbook\Entities\EntryService;

class IndexResource extends AbstractResource
{
	public $viewName;

	public function __construct()
	{
		$this->viewName = strtolower(preg_replace('/.*\\\\([a-z0-9]*)resource$/i', '\1', __CLASS__)) . '.phtml';
	}

	public function get()
    {
		$entryService = new EntryService($this->getConfiguration()->getDatabase()->getConnector());

		$data = array(
			'entries' => $entryService->fetchAll()
		);

		$renderer = new ViewRenderer();
		$renderer->setData($data);
		$renderer->setTemplateFileName($this->viewName);
		return $renderer;
    }

} 