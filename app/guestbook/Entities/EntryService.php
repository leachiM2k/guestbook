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
		foreach ($allEntries as $entry) {
			$result[] = $this->mapArrayToEntity($entry);
		}
		return $result;
	}

	public function fetchById($id)
	{
		$entry = $this->dbConnector->fetch('entries', array('id' => $id));
		if (count($entry) == 0) {
			throw new EntityNotFoundException();
		}
		return $this->mapArrayToEntity($entry[0]);
	}

	public function deleteEntity($entity)
	{
		return $this->dbConnector->delete('entries', array('id' => $entity->getId()));
	}

	public function persistEntity($entity)
	{
		$values = $this->mapEntityToArray($entity);
		if ($entity->getId() !== null) {
			$this->dbConnector->update('entries', $values);
		} else {
			$this->dbConnector->insert('entries', $values);
		}
	}

	protected function createEntity()
	{
		return new Entry(new UserService($this->dbConnector));
	}
} 