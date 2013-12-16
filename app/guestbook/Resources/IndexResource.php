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
	public function get()
	{
		$entryService = new EntryService($this->getConfiguration()->getDatabase()->getConnector());

		$userData = null;
		if ($this->getConfiguration()->getAuth()->isAuthenticated())
		{
			$userData = $this->getConfiguration()->getAuth()->getUserData();
		}

		$data = array(
			'entries'  => $entryService->fetchAll(),
			'userData' => $userData
		);

		$renderer = new ViewRenderer();
		$renderer->setData($data);
		$renderer->setTemplateFileName($this->viewName);
		return $renderer;
	}

} 