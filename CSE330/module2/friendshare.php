<?php
session_start();
$username = $_SESSION["username"];
$filename = htmlentities($_POST['filetosend']);
$friend = htmlentities($_POST['friend']);
//old path 
$old_path = sprintf("/srv/uploads/%s/%s", $username, $filename);
$new_path = sprintf("/srv/uploads/%s/%s", $friend,$filename);
chmod($old_path,777);
chmod($new_path,777);

if( copy($old_path, $new_path) ){
	header("Location: share_success.php");
	exit;
}else{
	header("Location: share_fail.php");
	
	exit;
	
}

?>