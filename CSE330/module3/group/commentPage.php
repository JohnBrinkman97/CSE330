<!DOCTYPE html>
<html> 
<?php 
session_start(); 
require 'database.php'; 
include 'newsSite.css';
//var_dump($_POST);
$story_id = $_POST['story_id'];

$username=$_SESSION['user_id'];
//get story that you want to see comments on
$stmt = $mysqli->prepare("select summary, title,link,date,user_id,story_index from stories where stories.story_index= '".$story_id."'");
if(!$stmt){
	printf("Query Prep Failed: %s\n", $mysqli->error);
	exit;
}

$stmt->execute();

$result = $stmt->get_result();


while($row = $result->fetch_assoc()){
	
		//if link is empty, dont display title as clickable link
		if(!empty($row["link"])){
		echo "<br><a href=".$row["link"]." class='class2'>".$row["title"]."</a><br><br>";
		}
		else{
		echo "<h5>".$row["title"]."</h5>";
			}
		//printf("<br> uploaded by:  %s at \t %s <br> <br> %s <br>",
		echo "uploaded by: ".htmlspecialchars( $row["user_id"]);
		echo "<br> \t at ". htmlspecialchars( $row["date"]);
		echo "<br><br><tab>". htmlspecialchars( $row["summary"])."<br>";
		
	
		//echo "<a href = 'reportPage.php'> Report </a>"; 
}

$stmt->close();
//get comments
$stmt = $mysqli->prepare("select comment,date,user_id,story_id,comment_id from comments where comments.story_id= '".$story_id."'");
if(!$stmt){
	printf("Query Prep Failed: %s\n", $mysqli->error);
	exit;
}

$stmt->execute();

$result = $stmt->get_result();

echo "<br><h2>Comments:</h2>";
//display comments and options
while($row = $result->fetch_assoc()){
	//printf("<br> %s <br> %s \t %s <br> <br> %s <br>",
		echo "<br>".htmlspecialchars($row["comment"])."<br>";
		echo "uploaded by: ".htmlspecialchars( $row["user_id"]);
		echo "<br> \t at ". htmlspecialchars( $row["date"])."<br>";
		//if comments are the logged-in users, let them delete or edit
		if(strcmp($username,$row["user_id"])==0){
		echo '<form action="deleteComment.php" method = "POST">
			<input type="submit" value = "delete">
			<input type="hidden" name = "story_id" value="'.$row['story_id'].'"/>
			<input type="hidden" name = "comment_id" value="'.$row['comment_id'].'"/>
			<input type="hidden" name="token" value="'.$_SESSION['token'].'" />
			</form>';
			
			echo '<form action="editComment.php" method = "POST">
			<input type="submit" value = "edit">
			<input type="hidden" name = "story_id" value="'.$row['story_id'].'"/>
			<input type="hidden" name = "comment_id" value="'.$row['comment_id'].'"/>
			<input type="hidden" name="token" value="'.$_SESSION['token'].'" />
			</form>';
			}
		}
		//echo "<a href = 'reportPage.php'> Report </a>"; 


$stmt->close();
//if registered user, let them add a comment
if(isset($_SESSION['user_id']) && !empty($_SESSION['user_id'])){
	echo '<br><form action="addComment.php" method = "POST">
			<input type="submit" value = "addComment">
			<input type="hidden" name = "story_id" value="'.$story_id.'"/>
			</form>';
			}
echo "<br><a href ='storyPage.php'>Story Page</a>";
?>
</html> 