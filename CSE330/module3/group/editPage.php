<!DOCTYPE html>
<html> 
<?php 
session_start(); 
require 'database.php'; 
include 'newsSite.css';
//var_dump($_POST);
$story_id = $_POST['story_id'];
//get intended story
$stmt = $mysqli->prepare("select summary, title,link,date,user_id,story_index from stories where stories.story_index= '".$story_id."'");
if(!$stmt){
	printf("Query Prep Failed: %s\n", $mysqli->error);
	exit;
}

$stmt->execute();

$result = $stmt->get_result();

//display story to be edited, then display form to edit
while($row = $result->fetch_assoc()){
	
			if(!empty($row["link"])){
		echo "<br><a href=".$row["link"]." class='class2'>".$row["title"]."</a><br><br>";
		}
		else{
		echo "<h5>".$row["title"]."</h5>";
			}
	
		echo "uploaded by: ".htmlspecialchars( $row["user_id"]);
		echo "<br> \t at ". htmlspecialchars( $row["date"]);
		echo "<br><br>". htmlspecialchars( $row["summary"])."<br>";
		
		
}

$stmt->close();
	echo '<form method="post" action="editAction.php" > 
		New title: <br/>
		<input type="text" name = "title"><br/>
		New link: <br/>
		<input type="url" name = "link"><br/>
		New Summary/ Commentary:<br>
		<textarea name="summary" ></textarea><br>
		<input type="hidden" name = "story_id" value='.$story_id.'/>
		<input type="hidden" name="token" value="'.$_SESSION['token'].'" />
		<input type = "submit" name="submit">
	
		
	</form>	';
	
	echo '<form action="deletePage.php" method = "POST">
			<input type="submit" value = "delete">
			<input type="hidden" name = "story_id" value='.$story_id.'/>
			<input type="hidden" name="token" value="'.$_SESSION['token'].'" />
			</form>';
echo "<a href ='storyPage.php'>Story Page</a>";
?>
</html> 