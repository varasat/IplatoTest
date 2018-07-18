<?php

namespace newIplatoCodingTest\Models;
use newIplatoCodingTest\Engine\Db;

class Admin extends Post
{
    /**
     * Comment constructor.
     */
    public function __construct()
    {
        $this->db = new Db();

    }
    public function login($username)
    {
        $oStmt = $this->db->prepare('SELECT username, password FROM Admins WHERE username = :username LIMIT 1');
        $oStmt->bindValue(':username', $username, \PDO::PARAM_STR);
        $oStmt->execute();
        $oRow = $oStmt->fetch(\PDO::FETCH_OBJ);
        return $oRow->password;
    }
}
