<?php
/**
 * User: Michael
 * Date: 15.12.13
 * Time: 13:22
 */

namespace guestbook\Core\Storage\Database\Connector;


class MySQL implements ConnectorInterface
{
	protected $host;
	protected $db;
	protected $user;
	protected $password;

	/**
	 * @var \mysqli
	 */
	protected $connection;

	public function __construct($host, $db, $user, $password)
	{
		$this->host = $host;
		$this->db = $db;
		$this->user = $user;
		$this->password = $password;
	}

	public function connect()
	{
		$this->connection = new \mysqli($this->host, $this->user, $this->password, $this->db);
		if ($this->connection->connect_error) {
			throw new \RuntimeException("Error during connection: " . $this->connection->connect_error);
		}
	}

	public function disconnect()
	{
		if (isset($this->connection)) {
			$this->connection->close();
		}
	}

	public function fetch($table, $fieldsAndValues = null, $orderBy = null)
	{
		$table = $this->connection->real_escape_string($table);
		$query = "SELECT * FROM $table";
		if (isset($fieldsAndValues)) {
			$query .= " WHERE " . join(" AND ", $this->generateValueStatementPart($fieldsAndValues));
		}
		if (isset($orderBy)) {
			$query .= " ORDER BY " . $this->connection->real_escape_string($orderBy);
		}
		$resultObject = $this->connection->query($query);

		if($this->connection->error)
		{
			throw new \RuntimeException($this->connection->error);
		}

		$allResults = array();
		while ($row = $resultObject->fetch_assoc()) {
			$allResults[] = $row;
		}

		$resultObject->free();

		return $allResults;
	}

	public function insert($table, $fieldsAndValues)
	{
		$table = $this->connection->real_escape_string($table);
		$query = "INSERT INTO $table SET " . join(", ", $this->generateValueStatementPart($fieldsAndValues));

		$result = $this->connection->query($query);

		return $result !== false;
	}

	public function update($table, $fieldsAndValues)
	{
		$table = $this->connection->real_escape_string($table);
		$query = "UPDATE $table SET " . join(", ", $this->generateValueStatementPart($fieldsAndValues));

		$result = $this->connection->query($query);

		return $result !== false;
	}

	public function delete($table, $fieldsAndValues)
	{
		$table = $this->connection->real_escape_string($table);
		$query = "DROP $table WHERE " . join(" AND ", $this->generateValueStatementPart($fieldsAndValues));

		$result = $this->connection->query($query);

		return $result !== false;
	}

	protected function generateValueStatementPart($fieldsAndValues)
	{
		$whereParts = array();
		foreach ($fieldsAndValues as $field => $value) {
			$field = $this->connection->real_escape_string($field);
			$value = $this->connection->real_escape_string($value);
			$whereParts[] = "$field = '$value'";
		}
		return $whereParts;
	}
}