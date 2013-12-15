<?php
/**
 * User: Michael
 * Date: 15.12.13
 * Time: 15:38
 */

namespace guestbook\Entities;

use guestbook\Core\Storage\Database\Connector\ConnectorInterface;

abstract class AbstractService
{
	protected $dbConnector;

	public function __construct(ConnectorInterface $dbConnector)
	{
		$this->dbConnector = $dbConnector;
		$this->dbConnector->connect();
	}

	abstract public function fetchAll();

	protected function mapArrayToEntity($arrayValues)
	{
		$entity = $this->createEntity();
		foreach ($arrayValues as $key => $value) {
			$setter = 'set' . ucfirst($key);
			if (method_exists($entity, $setter)) {
				$entity->$setter($value);
			}
		}
		return $entity;
	}

	protected function createEntity()
	{
		return new \stdClass();
	}
} 