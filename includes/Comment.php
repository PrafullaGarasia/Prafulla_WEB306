<?php
/**
 * Comment class
 */


class Comment{

    private $id;
    private $blog_id;
    private $date;
    private $name;
    private $comment;

    /**
     *  Find records and return an assc. array of comment objects.
     *  @param   $sql
     *  @param null $bindVal
     *  @return array
     */

    public static function find($sql, $bindVal = null) {
        global $dbc;
        $comments = $dbc->fetchArray($sql, $bindVal);
        if(!$comments){
            return [];
        }

        foreach($comments as $comment) {
            $commentObjArray[] = new self($comment['id'],
            $comment['blog_id'], $comment['date'],
            $comment['name'], $comment['comment']);
        }

        return $commentObjArray;

    }

    public function __construct($id, $blog_id, $date, $name, $comment)
    {
        $this->id = $id;
        $this->blog_id = $blog_id;
        $this->date = $date;
        $this->name = $name;
        $this->comment = $comment;
    }

     /**
     *  Insert a new comment into the table.
     *  @return bool|PDOStatement
     */
    public function create()
    {
        global $dbc;
        $sql = "INSERT INTO `comments` " .
            "(blog_id,date,name,comment) " .
            "VALUES(:blog_id, NOW(), :name, :comment);";
        $bindVal = ['blog_id' => $this->blog_id,
            'name' => $this->name,
            'comment' => $this->comment];
        return $dbc->sqlQuery($sql, $bindVal);
    }
    
    /**
     * @return mixed
     */
    public function getId(){
        return $this->id;
    }
    /**
     * @param $id
     *  @return $this
     */
    public function setId($id){
        $this->id = $id;

        return $this;
    }

    public  function getBlog_id(){
        return $this->blog_id;
    }
    public  function setBlog_id($blog_id)
    {
        $this->blog_id = $blog_id;
        return $this;
    }
    public  function getDate(){
        return $this->date;
    }
    public  function setDate($date)
    {
        $this->date = $date;
        return $this;
    }
    public  function getName(){
        return $this->name;
    }
    public  function setName($name)
    {
        $this->name = $name;
        return $this;
    }
    public  function getComment(){
        return $this->comment;
    }
    public  function setComment($comment)
    {
        $this->comment = $comment;
        return $this;
    }

}
?>