<?php
/**
 * User: rotmanov
 * Date: 12/13/13
 * Time: 2:00 PM
 */

namespace guestbook\Resources\Entry;

use guestbook\Core\Renderer\RedirectRenderer;
use guestbook\Core\Resource\AbstractResource;
use guestbook\Entities\EntryService;

class PublishResource extends AbstractResource
{
	public function get()
	{
		if ($this->getConfiguration()->getAuth()->isAuthenticated()
			&& $this->getConfiguration()->getAuth()->getUserData()->isAdmin()
			&& isset($_GET['id'])
		)
		{
			$entryService = new EntryService($this->getConfiguration()->getDatabase()->getConnector());
			$entry = $entryService->fetchById($_GET['id']);
			$entry->setState("active");
			$entryService->persistEntity($entry);
		}

		return new RedirectRenderer(array("route" => "home"));
	}

} 