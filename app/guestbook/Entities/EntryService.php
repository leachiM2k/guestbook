<?php
/**
 * User: Michael
 * Date: 15.12.13
 * Time: 15:24
 */
namespace guestbook\Entities;

class EntryService extends AbstractService
{
	public function fetchAll()
	{
		$result = array();
		$allEntries = $this->dbConnector->fetch('entries', null, 'date');
		foreach($allEntries as $entry)
		{
			$result[] = $this->mapArrayToEntity($entry);
		}
		return $result;
	}

	protected function createEntity()
	{
		return new Entry(new UserService($this->dbConnector));
	}
} 