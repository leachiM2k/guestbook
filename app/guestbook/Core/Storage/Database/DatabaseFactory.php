<?php
/**
 * User: Michael
 * Date: 15.12.13
 * Time: 13:15
 */

namespace guestbook\Core\Storage\Database;

use guestbook\Core\Storage\Database\Connector\MySQL;

class DatabaseFactory
{
	protected $databaseConfig;

	public function __construct($databaseConfig)
	{
		$this->databaseConfig = $databaseConfig;
	}

	public function getConnector()
	{
		if (!isset($this->databaseConfig['type'])) {
			throw new \RuntimeException("No type set for database");
		}

		switch ($this->databaseConfig['type']) {
			case 'MySQL':
				return new MySQL($this->databaseConfig['host'],
					$this->databaseConfig['db'],
					$this->databaseConfig['user'],
					$this->databaseConfig['password']);
				break;
		}

		throw new DatabaseFactoryUnsupportedException();
	}
} 