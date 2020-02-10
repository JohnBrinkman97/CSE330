<!DOCTYPE html>
<html> 
<?php 
ini_set("session.cookie_httponly", 1);
require 'calDatabase.php'; 
session_start(); 
 $event_id = $_POST['event_id'];

$stmt = $mysqli->prepare("delete from Event where Event.event_id= '".$event_id."'");
if(!$stmt){
	printf("Query Prep Failed: %s\n", $mysqli->error);
	exit;
}

$stmt->execute();

$stmt->close();


?>
</html> 