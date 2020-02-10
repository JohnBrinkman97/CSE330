<DOCTYPE! html>
<html>
<?php 
ini_set("session.cookie_httponly", 1);
require 'calDatabase.php';
session_start();
// same basic code from getEvents2.php (not sure if this needs citing, but it comes from the same code)
$event_id=$_POST['event_id'];

$query="SELECT * FROM Event where event_id='".$event_id."'"; 
$result=$mysqli->query($query)
	or die ($mysqli->error);
//store the entire response
//the array that will hold the titles and links

while($row=$result->fetch_assoc()) //mysql_fetch_array($sql)
{ 

$title=htmlentities($row['title']); 
$date=htmlentities($row['date']); 
$time=htmlentities($row['time']);
$event_id=htmlentities($row['event_id']);
$tag=htmlentities($row['tagged']);
 

} 

$username = htmlentities($_SESSION['user_id']);	
$sharedUser = $mysqli->real_escape_string($_POST['shareUser']);

$shared = 1;
// sql command to insert event info into database

$stmt = $mysqli->prepare("insert into Event (username, title, date, time, tagged, shared) values (?, ?, ?, ?,?,?)");
if(!$stmt){ //if command is invalid, return fail message
	printf("Query Prep Failed: %s\n", $mysqli->error);
	exit;
}

$stmt->bind_param('sssssi', $sharedUser, $title, $date, $time,$tag,$shared); // bind parameters to variables 


$stmt->execute();

$stmt->close();
?>
</body>
</html>