<?php
/**
 * User: rotmanov
 * Date: 12/13/13
 * Time: 2:00 PM
 */

namespace guestbook\Resources\Entry;

use guestbook\Core\Renderer\RedirectRenderer;
use guestbook\Core\Renderer\ViewRenderer;
use guestbook\Core\Resource\AbstractResource;
use guestbook\Entities\EntryService;

class EditResource extends AbstractResource
{
	public function get()
	{
		if (!$this->getConfiguration()->getAuth()->isAuthenticated()
			|| !$this->getConfiguration()->getAuth()->getUserData()->isAdmin()
			|| !isset($_GET['id'])
		)
		{
			return new RedirectRenderer(array("route" => "home"));
		}

		$entryService = new EntryService($this->getConfiguration()->getDatabase()->getConnector());
		$entry = $entryService->fetchById($_GET['id']);
		$entry->setState("inactive");
		$entryService->persistEntity($entry);

		$data = array(
			'entry'    => $entry,
			'userData' => $this->getConfiguration()->getAuth()->getUserData()
		);

		$renderer = new ViewRenderer($data);
		$renderer->setTemplateFileName($this->viewName);
		return $renderer;
	}

	public function post()
	{
		if ($this->getConfiguration()->getAuth()->isAuthenticated()
			&& $this->getConfiguration()->getAuth()->getUserData()->isAdmin()
			&& isset($_POST['id'], $_POST['date'], $_POST['text'])
		)
		{
			$entryService = new EntryService($this->getConfiguration()->getDatabase()->getConnector());
			$entry = $entryService->fetchById($_POST['id']);
			$entry->setDate($_POST['date']);
			$entry->setText($_POST['text']);
			$entryService->persistEntity($entry);
		}

		return new RedirectRenderer(array("route" => "home"));
	}

} 