<?php

/**
 *  Category class
 **/

class Category
{

    private $id;
    private $cat;

    public static function all()
    {
        $sql = "SELECT * FROM `categories`";
        $result = self::find($sql);
        return $result;
    }
    public static function find($sql, $bindVal=null)
    {
        global $dbc;
        $categories = $dbc->fetchArray($sql, $bindVal);
        if (!$categories) 
        {
            return [];
        }
        foreach ($categories as $category) 
        {
            $categoryObjArray[] = new self($category['id'], $category['cat']);
        }
            return $categoryObjArray;

    }
    public function __construct($id, $cat)
    {
        $this->id = $id;
        $this->cat = $cat;
    }
    public function create()
    {
        global $dbc;
        $sql = "INSERT INTO `categories` (cat) VALUES(:cat)";
        $bindVal = ['cat' => $this->cat];
        return $dbc->sqlQuery($sql,$bindVal);
    }
/**
 * @return mixed
 */
    public function getId()
    {
        return $this->id;
    }
    public function getCat()
    {
        return $this->cat;
    }
/**
 * @param $id
 * @return $this
 */
    public function setId($id){
        $this->id = $id;
        return $this;
    }
    public function setCat($cat){
        $this->cat = $cat;
        return $this;
    }

    
}//End of Category Class
?>