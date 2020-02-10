<!DOCTYPE html> 
<body>
<?php 
session_start();
require 'database.php' ;
include 'newsSite.css';
$user_id = $_SESSION['user_id'];

?>	

<?php
//check token 
if(!hash_equals($_SESSION['token'], $_POST['token'])){
	die("Request forgery detected");
}
$story_id=$_POST['story_id'];
$username= $mysqli->real_escape_string($_POST['newUser']);
$password = $mysqli->real_escape_string($_POST['newPass']);
$crypted_pass = password_hash($password, PASSWORD_BCRYPT);
//check whether each variable is intended to be changed
if(!empty($password)){
//update password
$stmt = $mysqli->prepare("UPDATE users SET crypted_password='".$crypted_pass."' WHERE users.username='".$user_id."'");
if(!$stmt){
	printf("Query Prep Failed: %s\n", $mysqli->error);
	exit;
}
if(!$stmt->execute()){
echo "oh no";
}
else{ echo "<h2>Password Updated</h2>";

}
$stmt->close();
}

if(!empty($username)){
//update username
$stmt = $mysqli->prepare("UPDATE users SET username='".$username."' WHERE users.username='".$user_id."'");
if(!$stmt){
	printf("Query Prep Failed: %s\n", $mysqli->error);
	exit;
}
if(!$stmt->execute()){
echo "oh no ".$mysqli->error;
}else{ echo "<h2>Username Updated</h2>";

}
$stmt->close();
}


echo "To complete process, Logout<br>";
echo "<a href ='loggingOut.php'>Logout</a>";
//echo $link.$summary.$title.$user_id; 


?>
</body>
</Html