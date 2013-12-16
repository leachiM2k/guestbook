<?php
/**
 * User: Michael
 * Date: 15.12.13
 * Time: 15:40
 */

namespace guestbook\Entities;


class UserService extends AbstractService
{
	public function fetchAll()
	{
		$result = array();
		$allEntries = $this->dbConnector->fetch('users');
		foreach ($allEntries as $entry)
		{
			$result[] = $this->mapArrayToEntity($entry);
		}
		return $result;
	}

	public function fetchById($id)
	{
		return $this->fetchOneEntry("id", $id);
	}

	public function fetchByUsername($username)
	{
		return $this->fetchOneEntry("login", $username);
	}

	protected function fetchOneEntry($field, $value)
	{
		$entry = $this->dbConnector->fetch('users', array($field => $value));
		if (count($entry) == 0)
		{
			throw new EntityNotFoundException();
		}
		return $this->mapArrayToEntity($entry[0]);
	}

	protected function createEntity()
	{
		return new User();
	}
} 