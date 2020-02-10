<!DOCTYPE html> 
<body>
<?php 
session_start();
require 'database.php' ;
include 'newsSite.css';
$user_id = $_SESSION['user_id'];

?>	

<?php
$story_id=$_POST['story_id'];
$comment_id=$_POST['comment_id'];
//check token
if(!hash_equals($_SESSION['token'], $_POST['token'])){
	die("Request forgery detected");
}
//check whether a comment edit was made, else say no change made
if(!(empty($_POST['comment']))){
$comment = $mysqli->real_escape_string($_POST['comment']);
//update comment
$stmt = $mysqli->prepare("UPDATE comments SET comment='".$comment."' WHERE comments.comment_id='".$comment_id."'");
if(!$stmt){
	printf("Query Prep Failed: %s\n", $mysqli->error);
	exit;
}
if(!$stmt->execute()){
echo "oh no";
}
else{ echo "<h2>Comment Updated</h2>";

}
$stmt->close();
}else{ 
echo "No changes made<br>";
}

echo "<br><a href ='storyPage.php'>Story Page</a>";
//echo $link.$summary.$title.$user_id; 
echo '<form action="commentPage.php" method = "POST">
			<input type="submit" value = "Back">
			<input type="hidden" name="token" value="'.$_SESSION['token'].'" />
			<input type="hidden" name = "story_id" value="'.$story_id.'"/>
			</form>';

?>
</body>
</Html
