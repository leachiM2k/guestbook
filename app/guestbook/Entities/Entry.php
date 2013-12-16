<?php
/**
 * User: Michael
 * Date: 15.12.13
 * Time: 15:22
 */
namespace guestbook\Entities;

class Entry
{
	private $id;
	private $userId;
	private $text;
	private $state;
	private $date;

	/**
	 * @var UserService
	 */
	private $userService;

	public function __construct($userService = null)
	{
		$this->userService = $userService;
	}

	/**
	 * @param date $date
	 */
	public function setDate($date)
	{
		$this->date = $date;
	}

	/**
	 * @return mixed
	 */
	public function getDate()
	{
		return $this->date;
	}

	/**
	 * @param mixed $id
	 */
	public function setId($id)
	{
		$this->id = $id;
	}

	/**
	 * @return mixed
	 */
	public function getId()
	{
		return $this->id;
	}

	/**
	 * @param mixed $text
	 */
	public function setText($text)
	{
		$this->text = $text;
	}

	/**
	 * @return mixed
	 */
	public function getText()
	{
		return $this->text;
	}

	/**
	 * @param mixed $state
	 */
	public function setState($state)
	{
		$this->state = $state;
	}

	/**
	 * @return mixed
	 */
	public function getState()
	{
		return $this->state;
	}

	public function isActive()
	{
		return $this->state == "active";
	}

	/**
	 * @param mixed $userId
	 */
	public function setUserId($userId)
	{
		$this->userId = $userId;
	}

	/**
	 * @return mixed
	 */
	public function getUserId()
	{
		return $this->userId;
	}

	public function getUser()
	{
		if (isset($this->userService))
		{
			return $this->userService->fetchById($this->userId);
		}
	}

	public function getPersistableFields()
	{
		return array(
			'id',
			'userId',
			'text',
			'state',
			'date',
		);
	}

}