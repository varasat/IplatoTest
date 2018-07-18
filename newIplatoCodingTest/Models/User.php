<?php

namespace newIplatoCodingTest\Models;

class User
{
    private $id;
    private $username;
    private $hashedPassword;

    /**
     * User constructor.
     * @param $username
     * @param $hashedPassword
     */
    public function __construct($username, $hashedPassword)
    {
        $this->username = $username;
        $this->hashedPassword = $hashedPassword;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
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
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * @param mixed $username
     */
    public function setUsername($username)
    {
        $this->username = $username;
    }

    /**
     * @return mixed
     */
    public function getHashedPassword()
    {
        return $this->hashedPassword;
    }

    /**
     * @param mixed $hashedPassword
     */
    public function setHashedPassword($hashedPassword)
    {
        $this->hashedPassword = $hashedPassword;
    }

}