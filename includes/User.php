<?php
/**
 * user class
 */
class User
{
    public $username;
    /**
	 * Attempt user login. If success, return a user object.
	 * @param $username
     * @param $password
     * @return bool|User
     *
	 */

     public static function auth($username, $password)
     {
         global $dbc;
         $sql = "SELECT * FROM `logins` WHERE username = :username LIMIT 1;";
         $bindVal = ['username' => $username];
         $userRecord = $dbc->fetchArray($sql, $bindVal);


         if ($userRecord) 
         {
             $userRecord = array_shift($userRecord);
             if (password_verify($password, $userRecord['password'])) 
             {
                 return new self($userRecord['id'], $userRecord['username'], $userRecord['password']);

             }
         }
         return false;
     }

      /**
       * @return mixed
       */
      public function getId()
      {
        return $this->id;
      }
       /**
       * @param $id
       * @return $this
       */
      public function setId($id)
      {
        $this->id = $id;

        return $this;
      }


    /**
     * @return mixed
     */
    public function getUsername()
    {
        return $this->username;
    }
    /**
     * @param $id
     * @return $this
     */
    public function setUsername($username)
    {
        $this->username = $username;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getPassword()
    {
        return $this->password;
    }
    /**
     * @param $id
     * @return $this
     */
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }
}
?>