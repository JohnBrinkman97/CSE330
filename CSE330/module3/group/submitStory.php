<!DOCTYPE html> 
<?php 
session_start();
require 'database.php' ;
include 'newsSite.css';
$user_id = $_SESSION['user_id'];

?>	
<html>
 <?php
 echo "<h2>Your Stories:</h2>";
 echo "<form action='storyPage.php'>
			<input type='submit' value='Back'/>
		</form>";
	//display only stories entered by user
$stmt = $mysqli->prepare("select summary, title,link,date,user_id,story_index from stories where stories.user_id= '".$user_id."' order by date");
if(!$stmt){
	printf("Query Prep Failed: %s\n", $mysqli->error);
	exit;
}

$stmt->execute();

$result = $stmt->get_result();

//display stories and give options
while($row = $result->fetch_assoc()){
	//printf("<br> %s <br> %s \t %s <br> <br> %s <br>",
			if(!empty($row["link"])){
		echo "<br><a href=".$row["link"]." class='class2'>".$row["title"]."</a><br><br>";
		}
		else{
		echo "<h5>".$row["title"]."</h5>";
			}
	
		echo "uploaded by: ".htmlspecialchars( $row["user_id"]);
		echo "<br> \t at ". htmlspecialchars( $row["date"]);
		echo "<br><br><tab>". htmlspecialchars( $row["summary"])."<br>";
		echo '<form action="commentPage.php" method = "POST">
			<input type="submit" value="comments">
			<input type="hidden" name="story_id" value="'.$row['story_index'].'"/>
			<input type="hidden" name="token" value="'.$_SESSION['token'].'" />
		</form>';
		echo '<form action="editPage.php" method="POST">
			<input type="hidden" name="story_id" value="'.$row['story_index'].'"/>
			<input type="hidden" name="token" value="'.$_SESSION['token'].'" />
			<input type="submit" value = "edit">
			</form>';
		//echo "<a href = 'reportPage.php'> Report </a>"; 
}

$stmt->close();
 echo 
"<body>  
<h2> Submit Story: </h2>
<!--  new story from -->
";

//submission form 
	echo '<form method="post" action="storySubmitAction.php" > 
		Enter a title: <br/>
		<input type="text" name = "title"><br/>
		Enter link to full story: <br/>
		<input type="url" name = "link"><br/>
		Summary/ Commentary:<br>
		<textarea name="summary" ></textarea><br>
		<input type="hidden" name="token" value="'.$_SESSION['token'].'" />
		<input type = "submit" name="submit">
	
		
	</form>	';
	

?>
</body> 
</html> 