<!DOCTYPE html>
<html> 
<?php 
session_start(); 
require 'database.php'; 
include 'newsSite.css';
//var_dump($_POST);
$story_id = $_POST['story_id'];
$comment_id = $_POST['comment_id'];

//get comment
$stmt = $mysqli->prepare("select comment,date,user_id,story_id from comments where comments.comment_id= '".$comment_id."'");
if(!$stmt){
	printf("Query Prep Failed: %s\n", $mysqli->error);
	exit;
}

$stmt->execute();

$result = $stmt->get_result();

echo "<br><h2>Comment:</h2>";
//display comment they want to edit
while($row = $result->fetch_assoc()){
	//printf("<br> %s <br> %s \t %s <br> <br> %s <br>",
		echo "<br>".htmlspecialchars($row["comment"])."<br>";
		echo "uploaded by: ".htmlspecialchars( $row["user_id"]);
		echo "<br> \t at ". htmlspecialchars( $row["date"])."<br>";
	//delete comment form 
		echo '<form action="deleteComment.php" method = "POST">
			<input type="submit" value = "delete">
			<input type="hidden" name = "story_id" value="'.$row['story_index'].'"/>
			<input type="hidden" name = "comment_id" value="'.$row['comment_id'].'"/>
			<input type="hidden" name="token" value="'.$_SESSION['token'].'" />
			</form>';
			}
		//echo "<a href = 'reportPage.php'> Report </a>"; 


$stmt->close();
//edit comment form 
	echo '<form method="post" action="editCommentAction.php" > 
		New/edited comment: <br/>
		<textarea name="comment" ></textarea><br>
		<input type="hidden" name = "story_id" value="'.$story_id.'"/>
		<input type="hidden" name = "comment_id" value="'.$comment_id.'"/>
		<input type="hidden" name="token" value="'.$_SESSION['token'].'" />
		<input type = "submit" name="submit">
	
		
	</form>	';
echo "<a href ='storyPage.php'>Story Page</a>";
?>
</html> 