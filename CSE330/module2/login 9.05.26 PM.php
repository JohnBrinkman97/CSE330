<?php
session_start();
	
	$username = htmlentities($_POST["username"]);	
	$text = fopen("/srv/uploads/users.txt", "r");
	static $linenum=0;
	$names = array();
	$authorized = false;
	$whoAreYou = null;
	$user = trim($username);
	while(!feof($text)){
		global $linenum;
		$trimmed= fgetss($text);
		$names[$linenum] = $trimmed;
		$linenum++;
	}
	fclose($text);
	
	for($i=0; $i<count($names); $i++){
		
		global $username, $authorized, $whoAreYou, $names;
		
	if(strcmp($user, trim($names[$i]))==0 ){
		
		$authorized = true;
		$whoAreYou = trim($names[$i]);
		
		$_SESSION["username"]=$whoAreYou;
		
		header("Location: profile.php");
		
		
		}
		
	}
	
	

?>