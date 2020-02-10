<!DOCTYPE html> 
<?php 
session_start();
include 'newsSite.css';
//basically just the login page
?>
<html> 
<body> 
<h1> News Sharing Site </h1>  
<h2> Login: </h2>
	<form method="post" action="loggingIn.php"> 
		Username: <br/>
		<input type="text" name = "username"><br/>
		
		Password: <br/>
		<input type="password" name = "password"><br/>
		<input type = "submit" name="login">
	</form>	
	New user? 
	<a href="newUser.php">Click here </a> 

</body> 
</html> 