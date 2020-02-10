<DOCTYPE! html>
<html>
<?php 
require 'calDatabase.php';
session_start();
$username = htmlentities($_SESSION['user_id']);	
$title = $mysqli->real_escape_string($_POST['eventTitle']);
$date = $mysqli->real_escape_string($_POST['eventDate']);
$time = $mysqli->real_escape_string($_POST['eventTime']);
$tag=$_POST['tagged'];
$shared = 0;
// sql command to insert event info into database

$stmt = $mysqli->prepare("insert into Event (username, title, date, time, tagged, shared) values (?, ?, ?, ?,?,?)");
if(!$stmt){ //if command is invalid, return fail message
	printf("Query Prep Failed: %s\n", $mysqli->error);
	exit;
}

$stmt->bind_param('sssssi', $username, $title, $date, $time,$tag,$shared); // bind parameters to variables 


$stmt->execute();

$stmt->close();
?>
</body>
</html>


