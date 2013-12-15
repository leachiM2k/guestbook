<?php
/**
 * User: Michael
 * Date: 15.12.13
 * Time: 15:22
 */
namespace guestbook\Entities;

class User
{
	private $id;
	private $login;
	private $passwordHash;
	private $role;
	private $name;
	private $email;

	/**
	 * @param mixed $email
	 */
	public function setEmail($email)
	{
		$this->email = $email;
	}

	/**
	 * @return mixed
	 */
	public function getEmail()
	{
		return $this->email;
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
	 * @param mixed $login
	 */
	public function setLogin($login)
	{
		$this->login = $login;
	}

	/**
	 * @return mixed
	 */
	public function getLogin()
	{
		return $this->login;
	}

	/**
	 * @param mixed $name
	 */
	public function setName($name)
	{
		$this->name = $name;
	}

	/**
	 * @return mixed
	 */
	public function getName()
	{
		return $this->name;
	}

	/**
	 * @param mixed $passwordHash
	 */
	public function setPasswordHash($passwordHash)
	{
		$this->passwordHash = $passwordHash;
	}

	/**
	 * @return mixed
	 */
	public function getPasswordHash()
	{
		return $this->passwordHash;
	}

	/**
	 * @param mixed $role
	 */
	public function setRole($role)
	{
		$this->role = $role;
	}

	/**
	 * @return mixed
	 */
	public function getRole()
	{
		return $this->role;
	}
}