<?php
/**
 * User: Michael
 * Date: 15.12.13
 * Time: 15:24
 */
namespace guestbook\Entities;


class EntryService extends AbstractService
{
	/**
	 * Fetch ALL entities (may be slow)
	 *
	 * @return array of Entry
	 */
	public function fetchAll()
	{
		$result = array();
		$allEntries = $this->dbConnector->fetch('entries', null, 'date');
		foreach ($allEntries as $entry)
		{
			$result[] = $this->mapArrayToEntity($entry);
		}
		return $result;
	}

	/**
	 * Fetch one entity from database by its id
	 *
	 * @param $id
	 * @return Entry
	 * @throws EntityNotFoundException
	 */
	public function fetchById($id)
	{
		$entry = $this->dbConnector->fetch('entries', array('id' => $id));
		if (count($entry) == 0)
		{
			throw new EntityNotFoundException();
		}
		return $this->mapArrayToEntity($entry[0]);
	}

	/**
	 * Deletes given entity from database
	 *
	 * @param Entry $entity
	 * @return bool success or failure
	 */
	public function deleteEntity($entity)
	{
		return $this->dbConnector->delete('entries', array('id' => $entity->getId()));
	}

	/**
	 * Persists entity in database
	 * Should decide itself if it is an update or insert
	 *
	 * @param Entry $entity
	 */
	public function persistEntity($entity)
	{
		$values = $this->mapEntityToArray($entity);
		if ($entity->getId() !== null)
		{
			$whereValues = array(
				'id' => $values['id']
			);
			unset($values['id']);
			$this->dbConnector->update('entries', $values, $whereValues);
		}
		else
		{
			$this->dbConnector->insert('entries', $values);
		}
	}

	/**
	 * Returns a fresh entity object
	 *
	 * @return Entry
	 */
	protected function createEntity()
	{
		return new Entry(new UserService($this->dbConnector));
	}
} 