<?php

/**
 * user class
 **/

class User
{
    private $id;
    private $username;
    private $password;

    public static function auth($username, $password)
    {
        global $dbc;
        $sql = "SELECT * FROM `logins` WHERE username = :username LIMIT 1;";
        $bindVal = ['username' => $username];
        $userRecord = $dbc->fetchArray($sql, $bindVal);
        if ($userRecord) {
            $userRecord = array_shift($userRecord);
            if (password_verify($password, $userRecord['password'])) {
                return new self($userRecord['id'], $userRecord['username'],
                    $userRecord['password']);
            }
        }
        return false;
    }

    public function __construct($id, $username, $password)
    {
        $this->id = $id;
        $this->username = $username;
        $this->password = $password;

    }

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    public function getUsername()
    {
        return $this->username;
    }


    public function setUsername($username)
    {
        $this->username = $username;
        return $this;
    }

    public function getPassword()
    {
        return $this->password;
    }


    public function setPassword($password)
    {
        $this->password = $password;
        return $this;
    }
}
?>