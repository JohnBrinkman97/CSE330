<DOCTYPE! html>
<html>
<?php 
require 'calDatabase.php';
ini_set("session.cookie_httponly", 1);
session_start();
$username = htmlentities($_POST['username']);	//get username and password from form
$password = $mysqli->real_escape_string($_POST['password']);
$crypted_pass = password_hash($password, PASSWORD_BCRYPT); //encrypt password
$safe_username = $mysqli->real_escape_string($_POST['username']);
// sql command to insert username and password into database
$stmt = $mysqli->prepare("insert into users (username, crypted_password) values (?, ?)");
if(!$stmt){ //if command is invalid, return fail message
	printf("Query Prep Failed: %s\n", $mysqli->error);
	exit;
}

$stmt->bind_param('ss', $safe_username, $crypted_pass); // bind parameters to variables 

//if statement does not execute, this means the username was in the database already
//so now you must enter a different one
//if the statement executes, the user is successfully registered
if (!$stmt->execute()) {

    echo "<h2>Username taken or invalid</h2>";
    echo "Back to login:" ;
    echo '<form action="loggingIn.php">
	
		<input type = "submit" value= "back" name="login">
	</form>';
    exit;
}else{

$_SESSION['user_id'] = $safe_username;
 echo "<h2>Registration successful :) <br></h2>" ; 
 echo "Return to login page to enter site <br>";
 echo "	<form action='homePage.php'>
			<input type='submit' value='Login'/>
		</form>";
}
$stmt->close();
?>
</body>
</html>