<?php 
session_start(); 
$username=$_SESSION['username'];
$filename = $_GET['file']; 
$file_path = "/srv/uploads/".$username."/".$filename;
$type = new finfo(FILEINFO_MIME_TYPE);
$mime= $type->file($file_path); 
header('Content-Disposition: attachment; filename="'.$filename.'";');  
header('Content-type:"'.$mime.'";'); 
header('Content-Length: ' . filesize($file_path).';');            
readfile($file_path);
exit;

?>  