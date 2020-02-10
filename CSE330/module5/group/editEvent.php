<!DOCTYPE html> 
<body>
<?php 
ini_set("session.cookie_httponly", 1);
session_start();
require 'calDatabase.php' ;

$user_id = $_SESSION['user_id'];
$title=$mysqli->real_escape_string($_POST['title']);
$date=$mysqli->real_escape_string($_POST['date']);
$time=$mysqli->real_escape_string($_POST['time']);
$event_id = $_POST['event_id'];

if(!(empty($_POST['title']))){

$stmt = $mysqli->prepare("UPDATE Event SET title='".$title."' WHERE event_id='".$event_id."'");
if(!$stmt){
	printf("Query Prep Failed: %s\n", $mysqli->error);
	exit;
}
$stmt->execute();
$stmt->close();
}
if(!(empty($_POST['date']))){

$stmt = $mysqli->prepare("UPDATE Event SET date='".$date."' WHERE event_id='".$event_id."'");
if(!$stmt){
	printf("Query Prep Failed: %s\n", $mysqli->error);
	exit;
}
$stmt->execute();
$stmt->close();
}
if(!(empty($_POST['time']))){


$stmt = $mysqli->prepare("UPDATE Event SET time='".$time."' WHERE event_id='".$event_id."'");
if(!$stmt){
	printf("Query Prep Failed: %s\n", $mysqli->error);
	exit;
}
$stmt->execute();
$stmt->close();
}
?>
</body>
</Html