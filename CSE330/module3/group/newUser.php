<!DOCTYPE html> 
<?php 
session_start();
require 'database.php' ;
include 'newsSite.css';
?>	
<html> 
<body>  
<h2> Create a New User: </h2>
<!--  new user from -->
	<form method="post" action="registration.php"> 
		Enter a Username: <br/>
		<input type="text" name = "username"><br/>
		Enter a Password: <br/>
		<input type="password" name = "password"><br/>
		<input type = "submit" name="login">
	</form>	


</body> 
</html> 