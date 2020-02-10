<?php 
require 'calDatabase.php';
ini_set("session.cookie_httponly", 1);
session_start();
//http://stackoverflow.com/a/2467974
$query="SELECT * FROM Event"; 
$result=$mysqli->query($query)
	or die ($mysqli->error);
//store the entire response
$response = array();
//the array that will hold the titles and links
$posts = array();
while($row=$result->fetch_assoc()) //mysql_fetch_array($sql)
{ 
if($row['username'] == $_SESSION['user_id']){
$title=htmlentities($row['title']); 
$date=htmlentities($row['date']); 
$time=htmlentities($row['time']);
$event_id=htmlentities($row['event_id']);
$username=htmlentities($row['username']);
$tagged=htmlentities($row['tagged']);
$shared=$row['shared'];

//each item from the rows go in their respective vars and into the posts array
$posts[] = array('title'=> $title, 'date'=> $date, 'time'=>$time,'event_id'=>$event_id,'username'=>$username,'tagged'=>$tagged,'shared'=>$shared); 
}
} 
//the posts array goes into the response
//$response['posts'] = $posts;
echo json_encode($posts);
?>