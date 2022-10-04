<?php

/**
 *  Database class
 **/

class Database{
    private $connection;
    public function __construct(){
        // Create a new conenction using PDO method and store it
        // into the property $connection
        $this->connection = new PDO("mysql:host=".DB_HOST.";dbname=".DB_NAME,DB_USER,DB_PASSWORD);

    }
    public function __destruct(){

    }
    /**
     * Execute an SQL statement and return its results
     * @param $sql
     * @param null $bindVal
     * @return bool|PDOStatement
     */
    public function sqlQuery($sql, $bindVal = null){
        $statement = $this->connection->prepare($sql);
        if(is_array($bindVal)){
            $statement->execute($bindVal);
        }else{
            $statement->execute();
        }
        return $statement;
    }
    /**
     * Execute an SQL Statement and return an assoc. array
     * @param $sql
     * @param null $bindVal
     * @return array|bool
     */
    public function fetchArray($sql, $bindVal = null){
        $result = $this->sqlQuery($sql, $bindVal);
        if($result->rowCount() == 0){
            return false;
        } else{
            return $result->fetchAll(PDO::FETCH_ASSOC);
        }
    }

}//End of Database Class
$dbc = new Database();