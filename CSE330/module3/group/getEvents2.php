<?php 
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
$title=$row['title']; 
$date=$row['date']; 
$time=$row['time'];l
$event_id=$row['event_id'];
$username=$row['username'];
//each item from the rows go in their respective vars and into the posts array
$posts[] = array('title'=> $title, 'date'=> $date, 'time'=>$time,'event_id'=>$event_id,'username'=>$username); 
} 
//the posts array goes into the response
$response['posts'] = $posts;
echo json_encode($response);