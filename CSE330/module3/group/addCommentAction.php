<!DOCTYPE html> 
<body>
<?php 
session_start();
require 'database.php' ;
include 'newsSite.css';
$user_id = $_SESSION['user_id'];
$story_id=$_POST["story_id"];
?>	

<?php
$comment = $mysqli->real_escape_string($_POST['comment']);
//check token
if(!hash_equals($_SESSION['token'], $_POST['token'])){
	die("Request forgery detected");
}
//echo $link.$summary.$title.$user_id; 
//insert comment values
$stmt = $mysqli->prepare("insert into comments (comment, story_id, user_id) values (?, ?, ?)");// need title of the table and the value names here
if(!$stmt){ //if command is invalid, return fail message
	echo "Query Prep Failed: " .$mysqli_stmt->errno;
	exit;
}

$stmt->bind_param('sss',$comment, $story_id, $user_id); //places to bind the variables
//make sure comment gets entered
if(!$stmt->execute()){
printf("Query execute Failed: %s\n", $mysqli->error);
}else{
echo "<h2>Comment Submitted</h2><br>";
//back to comment page
echo '<form action="commentPage.php" method = "POST">
			<input type="submit" value = "Back">
			<input type="hidden" name="token" value="'.$_SESSION['token'].'" />
			<input type="hidden" name = "story_id" value="'.$story_id.'"/>
			</form>';

echo "<a href ='storyPage.php'>Story Page</a>";
}

?>
</body>
</Html>