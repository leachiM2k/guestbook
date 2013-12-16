<?php
/**
 * User: rotmanov
 * Date: 12/13/13
 * Time: 2:00 PM
 */

namespace guestbook\Resources\Entry;

use guestbook\Core\Renderer\RedirectRenderer;
use guestbook\Core\Resource\AbstractResource;
use guestbook\Entities\Entry;
use guestbook\Entities\EntryService;

class SendResource extends AbstractResource
{
	public function post()
	{
		$auth = $this->getConfiguration()->getAuth();
		if ($auth->isAuthenticated() && isset($_POST['text']))
		{
			$entry = new Entry();
			$entry->setUserId($auth->getUserData()->getId());
			$entry->setText($_POST['text']);
			$datetime = new \DateTime();
			$entry->setDate($datetime->format(\DateTime::ISO8601));

			$entryService = new EntryService($this->getConfiguration()->getDatabase()->getConnector());
			$entryService->persistEntity($entry);
		}

		return new RedirectRenderer(array("route" => "home"));
	}

} 