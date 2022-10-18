<?php
require_once('includes/bootstrap.php');

require_once('header.php');
//require_once('config.php');

if(!isset($_GET['id']) || !is_numeric($_GET['id'])) {
	$validId = 0;
} else {
	$validId = $_GET['id'];
}

$categories = Category::all();

if(count($categories) ==0){
    echo "No Categories!";
}else{
    foreach ($categories as $category){
        if($validId =  $category->getId()){
            echo "<span style='font-weight:bold'>{$category->getCat()}</span><br>";
            echo "<ul>";

            $entries = Entry::find("SELECT * FROM `entries` WHERE cat_id = :validId ORDER BY date DESC", ['validId' => $validId]);

            if (count($entries) == 0){
                echo "<li>No enteries found in this category</li>";
            } else{
                foreach ($entries as $entry){
                    echo "<li>". date("D jS FY g.iA", strtotime($entry->getDate())) ." - <a href='viewentry.php?id=". $entry->getId() . "'>" . $entry->getSubject() . "</a></li>";
                }
            }
            echo "</ul>";
        } else {
            echo "<a href='viewcat.php?id=". $category->getId() . "'>" . $category->getCat() . "</a><br>";

        }
    }
}

require_once("footer.php");
?>