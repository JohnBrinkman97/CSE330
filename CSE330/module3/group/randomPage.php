<!DOCTYPE html>
<html> 
<?php
Session_start();

$user=$_SESSION['user_id'];
$link=$_POST["link"];
$title=$_POST["title"];
echo $link;
echo $user;
echo $title;
?>
</html>
