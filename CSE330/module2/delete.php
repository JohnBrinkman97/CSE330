<?php 
session_start();
$username = $_SESSION['username'];
$filename = htmlentities($_POST['filetodelete']);
$file_path = "/srv/uploads/".$username."/".$filename;

if(unlink($file_path)){
header("Location: deletion_success.php");
}
else{ 
header("Location: deletion_fail.php");
}
?>