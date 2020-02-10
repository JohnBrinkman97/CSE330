<!DOCTYPE html>
<html> 
<?php 
session_start(); 
require 'database.php'; 
include 'newsSite.css';
// var_dump($_POST);
 $story_id = $_POST['story_id'];
 $comment_id= $_POST['comment_id'];
// echo $story_id;
//delete comment where the comment id matches the comment intended to be deleted
$stmt = $mysqli->prepare("delete from comments where comments.comment_id= '".$comment_id."'");
if(!$stmt){
	printf("Query Prep Failed: %s\n", $mysqli->error);
	exit;
}
//make sure statement executes
if(!$stmt->execute()){
echo "Deletion failed, please try again";
}
else{ 
echo "<h2>Comment deleted</h2>";
echo '<form action="commentPage.php" method = "POST">
			<input type="submit" value = "Back">
			<input type="hidden" name="token" value="'.$_SESSION['token'].'" />
			<input type="hidden" name = "story_id" value="'.$story_id.'"/>
			</form>';

echo "<a href ='storyPage.php'>Story Page</a>";
}

$stmt->close();


?>
</html> 