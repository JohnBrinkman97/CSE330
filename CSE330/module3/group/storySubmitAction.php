<!DOCTYPE html> 
<body>
<?php 
session_start();
require 'database.php' ;
include 'newsSite.css';
$user_id = $_SESSION['user_id'];

?>	

<?php


$title = $mysqli->real_escape_string($_POST['title']);
$link = $mysqli->real_escape_string($_POST['link']);
$summary = $mysqli->real_escape_string($_POST['summary']);
//insert story into stories table
$stmt = $mysqli->prepare("insert into stories (link, summary, title, user_id) values (?, ?, ?, ?)");// need title of the table and the value names here
if(!$stmt){ //if command is invalid, return fail message
	echo "Query Prep Failed: " .$mysqli_stmt->errno;
	exit;
}

$stmt->bind_param('ssss',$link, $summary, $title, $user_id); //places to bind the variables

if(!$stmt->execute()){
printf("Query execute Failed: %s\n", $mysqli->error);
}else{
echo "<h2>Story Submitted</h2><br>";
echo "<a href ='storyPage.php'>Story Page</a>";
}
// echo ". $summary ." ;
// 
// echo "<h5>Are you sure you wish to submit this?</h5>";
// echo "<a href ='storyPage.php'>Yes</a><br>";// if yes, we return to the main page to view
// echo"<a href = 'submitStory.php'>No</a>";//no, we will drop the row in the database 
?>
</body>
</Html>
