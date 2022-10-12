<?php
/**
 * session class
 */
class Session{

    /**
     * Session constructor.
     */
    private $user;
    public function __construct(){
        session_start();
        if(isset($_SESSION['user'])){
            $this->user = $_SESSION['user'];
        }
    }

    /**
     * Returns the status of the current session
     * @return bool|User
     */

    public function isLoggedIn()
    {
        if ($this->user) {
            return $this->user;
        } else {
            return false;
        }
    }

        public function getUser(){
            return $this->user;
        }

        /**
         * Registers a logged in user object
         * @param $userObj
         */

            public function login($userObj){
                $this->user = $userObj;
                $_SESSION['user']= $userObj;
            }
            public function logout(){
                $user = false;
                $SESSION = array();
                session_destroy();
            }

        }  // End of the Session Class

 ?>

