<!DOCTYPE html> 
<?php 
session_start();
require 'database.php';


// course wiki code to check password / login 
$stmt = $mysqli->prepare("SELECT COUNT(*), username, crypted_password FROM users WHERE username=?");

// Bind the parameter
$stmt->bind_param('s', $user);
$user = $_POST['username'];
$stmt->execute();

// Bind the results
$stmt->bind_result($cnt, $user_id, $password_hash);
$stmt->fetch();

$password_guess = $_POST['password']; //password submitted by user
// Compare the submitted password to the actual password hash

if($cnt == 1 && password_verify($password_guess, $password_hash)){
	echo" Login succeeded! ";
	$_SESSION['user_id'] = $user_id;
	$_SESSION['token'] = bin2hex(openssl_random_pseudo_bytes(32)); //set token upon login success
	header("Location: storyPage.php"); 
	// Redirect to your target page
} else{
	// Login failed; redirect back to the login screen
	header("Location: homePage.php"); //return to login page
}
?>
<html> 
<body> 

</body> 
</html> 