<!DOCTYPE html> 
<?php 
session_start();
require 'database.php' ;
include 'newsSite.css';
$user_id = $_SESSION['user_id'];
$story_id=$_POST["story_id"];

?>	
<html>
 <?php

 echo "<body>  
<h2> Submit Comment: </h2>
";

//adding comment form 
	echo '<form method="post" action="addCommentAction.php" > 
		Enter comment: <br/>
		<textarea name="comment" ></textarea><br>
		<input type="hidden" name="story_id" value="'.$story_id.'">
		<input type="hidden" name="token" value="'.$_SESSION['token'].'" />
		<input type = "submit" name="submit">
			
	</form>	';
	

?>
</body> 
</html> 