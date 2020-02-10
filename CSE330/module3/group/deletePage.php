<!DOCTYPE html>
<html> 
<?php 
session_start(); 
require 'database.php'; 
include 'newsSite.css';
// var_dump($_POST);
 $story_id = $_POST['story_id'];
 //check token 
 if(!hash_equals($_SESSION['token'], $_POST['token'])){
	die("Request forgery detected");
}

//delete story where story id matches the one that is intended to be deleted
$stmt = $mysqli->prepare("delete from stories where stories.story_index= '".$story_id."'");
if(!$stmt){
	printf("Query Prep Failed: %s\n", $mysqli->error);
	exit;
}

if(!$stmt->execute()){
echo "oh no";
}
else{ 
echo "<h2>Story deleted</h2>";
echo "<a href ='storyPage.php'>Story Page</a>";
}

$stmt->close();


?>
</html> 