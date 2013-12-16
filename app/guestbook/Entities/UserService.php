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
		foreach($allEntries as $entry)
		{
			$result[] = $this->mapArrayToEntity($entry);
		}
		return $result;
	}

	public function fetchById($id){
		$entry = $this->dbConnector->fetch('users', array('id' => $id));
		if (count($entry) == 0) {
			throw new EntityNotFoundException();
		}
		return $this->mapArrayToEntity($entry[0]);
	}

	public function fetchByUsername($username)
	{
		$entry = $this->dbConnector->fetch('users', array('login' => $username));
		if (count($entry) == 0) {
			throw new EntityNotFoundException();
		}
		return $this->mapArrayToEntity($entry[0]);
	}

	protected function createEntity()
	{
		return new User();
	}
} 