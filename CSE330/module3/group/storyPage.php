<!DOCTYPE HTML>
<html>
<body>
<?php


require 'database.php';
include 'newsSite.css';
Session_start();

$username = $_SESSION['user_id'];

echo "<h1> News Sharing Site </h1> ";
// check if user is signed in and display options accordingly
if(isset($_SESSION['user_id']) && !empty($_SESSION['user_id'])){
echo "<h4>Welcome ".$username."!<br></h4>";
echo "<h3><a href='submitStory.php' class='class1'>  Your Stories  </a></h3>" ;
echo "<h3><a href='loggingOut.php' class='class1'>Logout</a></h3>";
echo "<h3><a href='editAccount.php' class='class1'>Edit Account</a></h3><br>";
}else{
echo "<h3><a href='loggingIn.php' class='class1'>Login</a></h3>";
}

echo "<h2>Stories</strong></font></h2>";
//get stories
$stmt = $mysqli->prepare("select summary, title,link,date,user_id,story_index from stories order by date");
if(!$stmt){
	printf("Query Prep Failed: %s\n", $mysqli->error);
	exit;
}

$stmt->execute();

$result = $stmt->get_result();

//display stories/options
while($row = $result->fetch_assoc()){
	//if link is empty, dont display as a link, but rather plain text	
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
		echo '<form action="commentPage.php" method = "POST">
			<input type="submit" value = "comments">
			<input type="hidden" name = "story_id" value="'.$row['story_index'].'"/>
		</form>';
		//echo "<a href = 'reportPage.php'> Report </a>"; 
}

$stmt->close();
?>
</body>
</html> 