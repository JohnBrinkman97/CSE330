<!DOCTYPE html>
<html> 
<?php 
session_start(); 
require 'database.php'; 
include 'newsSite.css';
//form for entering new username and password with option to delete
	echo '<form method="post" action="editAccountAction.php" > 
		Enter which you would like to change (or both)<br>
		<h4>New username: <br/>
		<input type="text" name = "newUser"><br/>
		New password: <br>
		<input type="password" name = "newPass"><br>
		<input type="hidden" name="token" value="'.$_SESSION['token'].'" />
		<input type = "submit" name="submit"></h4>	
	</form>	';
	echo '<form method="post" action="deleteAccount.php" > 
	<input type = "submit" name="delete" value="Delete Account">
	<input type="hidden" name="token" value="'.$_SESSION['token'].'" />';
echo "<br><a href ='storyPage.php'>Story Page</a>";
?>
</html> 