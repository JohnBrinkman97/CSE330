<!DOCTYPE html> 
<?php
session_start();
$username = $_SESSION['username'];
//$generic_path = "/srv/uploads/".$username."/";

$files = scandir(sprintf("/srv/uploads/%s", $username));

echo "YOUR FILES" ."<br>";
for($j=2; $j< count($files);$j++){
echo "<a href=viewactions.php?file=".$files[$j]. ">";
echo $files[$j] ."</a><br>";
}
?>

<html>
<br>
 <form enctype="multipart/form-data" action="uploader.php" method="POST">
		
		<input type="hidden" name="MAX_FILE_SIZE" value="20000000" />
		<label for="uploadfile_input">Choose a file to upload:</label> <input name="uploadedfile" type="file" id="uploadfile_input" />
		
				<input type="submit" value="Upload File" />
				
		</form> 

				<form method="POST" action="delete.php">
		Delete <br/>
		<input type="text" name ="filetodelete"><br/>
		<input type = "submit" name="delete" value="Delete">
	</form>	
		<br>
	<form method="POST" action="friendshare.php">
		Share with a friend: <br/>
		File:<input type="text" name ="filetosend"><br/>
		Friend:<input type ="text" name ="friend" ><br/>
		<input type = "submit" name="share" value="Share">
	</form>	
	<br> 
	Back to Profile:
		<form action="profile.php">
			<input type="submit" value="profile"/>
		</form>
		<br>
		Logout: 
		<form action="logout.php">
			<input type="submit" value="logout"/>
		</form> 
	</html> 

