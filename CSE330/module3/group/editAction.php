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
//check token
if(!hash_equals($_SESSION['token'], $_POST['token'])){
	die("Request forgery detected");
}
$title = $mysqli->real_escape_string($_POST['title']);
$link = $mysqli->real_escape_string($_POST['link']);
$summary = $mysqli->real_escape_string($_POST['summary']);
//check which values are empty, then execute their update individually
if(!empty($title)){

$title = htmlentities($_POST['title']);
$stmt = $mysqli->prepare("UPDATE stories SET title='".$title."' WHERE stories.story_index='".$story_id."'");
if(!$stmt){
	printf("Query Prep Failed: %s\n", $mysqli->error);
	exit;
}
if(!$stmt->execute()){
echo "oh no";
}
else{ echo "<h2>Title Updated</h2>";

}
$stmt->close();
}

if(!empty($link)){
$link = htmlentities($_POST['link']);
$stmt = $mysqli->prepare("UPDATE stories SET link='".$link."' WHERE stories.story_index='".$story_id."'");
if(!$stmt){
	printf("Query Prep Failed: %s\n", $mysqli->error);
	exit;
}
if(!$stmt->execute()){
echo "oh no";
}else{ echo "<h2>Link Updated</h2>";

}
$stmt->close();
}
if(!empty($summary)){
$summary = htmlentities($_POST['summary']);
$stmt = $mysqli->prepare("UPDATE stories SET summary='".$summary."' WHERE stories.story_index='".$story_id."'");
if(!$stmt){
	printf("Query Prep Failed: %s\n", $mysqli->error);
	exit;
}
if(!$stmt->execute()){
echo "oh no";
}else{ echo "<h2>Summary Updated</h2>";

}
$stmt->close();
}
echo "<a href ='storyPage.php'>Story Page</a>";
//echo $link.$summary.$title.$user_id; 


?>
</body>
</Html
