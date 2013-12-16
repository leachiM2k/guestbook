<?php
/**
 * User: rotmanov
 * Date: 12/13/13
 * Time: 2:00 PM
 */

namespace guestbook\Resources;

use guestbook\Core\Auth\AuthException;
use guestbook\Core\Renderer\RedirectRenderer;
use guestbook\Core\Renderer\ViewRenderer;
use guestbook\Core\Resource\AbstractResource;

class LoginResource extends AbstractResource
{
	public function get()
	{
		if ($this->getConfiguration()->getAuth()->isAuthenticated()) {
			return new RedirectRenderer(array("route" => "home"));
		}
		$data = array();

		$renderer = new ViewRenderer($data);
		$renderer->setTemplateFileName($this->viewName);
		return $renderer;
	}

	public function post()
	{
		if (!isset($_POST['username'], $_POST['password'])) {
			return new RedirectRenderer(array("route" => "login"));
		}

		$auth = $this->getConfiguration()->getAuth();
		$auth->setUsername($_POST['username']);
		$auth->setPassword($_POST['password']);

		try {
			$auth->authenticate();
		} catch (AuthException $e) {
			$data = array(
				'authError' => true,
				'username' => $_POST['username']
			);
			$renderer = new ViewRenderer();
			$renderer->setData($data);
			$renderer->setTemplateFileName($this->viewName);
			return $renderer;
		}

		return new RedirectRenderer(array("route" => "home"));
	}
} 