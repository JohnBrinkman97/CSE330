
<?php 

require 'calDatabase.php';
session_start();
//http://stackoverflow.com/a/6282007
 $return_arr = array();
// $fetch = mysql_query("SELECT * FROM Event"); 
// while ($row = mysql_fetch_array($fetch, MYSQL_ASSOC)) {
$stmt = $mysqli->prepare("select * from Event");
if(!$stmt){
	printf("Query Prep Failed: %s\n", $mysqli->error);
	exit;
}

$stmt->execute();

$result = $stmt->get_result();

//display stories/options
while($row = $result->fetch_assoc()){
    //if($row['username'] == $_SESSION['user_id']){
    $row_array['title'] = $row['title'];
    $row_array['date'] = $row['date'];
    $row_array['time'] = $row['time'];
    $row_array['event_id'] = $row['event_id'];
    $row_array['username'] = $row['event_id'];
    array_push($return_arr,$row_array);
   // }
}
echo json_encode($return_arr);
?>
