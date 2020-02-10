<!DOCTYPE html>
<html> 
<?php 
session_start(); 
require 'database.php'; 
include 'newsSite.css';
//check for session token --> web security
if(!hash_equals($_SESSION['token'], $_POST['token'])){
	die("Request forgery detected");
}
$user_id=$_SESSION['user_id'];
// var_dump($_POST);
 $story_id = $_POST['story_id'];
// echo $story_id;
// delete user using the session variable created upon login
$stmt = $mysqli->prepare("delete from users where users.username= '".$user_id."'");
if(!$stmt){
	printf("Query Prep Failed: %s\n", $mysqli->error);
	exit;
}

if(!$stmt->execute()){
echo "Deletion Failed, please try again";
}
else{ 
echo "<h2>User deleted</h2>";
echo "<a href ='loggingOut.php'>Exit</a>";
}

$stmt->close();


?>
</html> 