<?php
/**
 * User: Michael
 * Date: 15.12.13
 * Time: 13:24
 */

namespace guestbook\Core\Storage\Database\Connector;

interface ConnectorInterface
{
	public function __construct($host, $db, $user, $password);

	public function connect();

	public function disconnect();

	public function fetch($table, $fieldsAndValues = null, $orderBy = null, $orderSortAscending = true);

	public function insert($table, $fieldsAndValues);

	public function update($table, $fieldsAndValues, $whereFieldsAndValues);

	public function delete($table, $fieldsAndValues);
}