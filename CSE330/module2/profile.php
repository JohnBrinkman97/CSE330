<!DOCTYPE html> 
<?php

session_start();
$username = $_SESSION["username"];
?>
<html>


	<body>
		<?php
		echo "<Strong>"."Welcome " . $username ."!"."</strong>";
		?>
	
		<form enctype="multipart/form-data" action="uploader.php" method="POST">
		<p>
		<input type="hidden" name="MAX_FILE_SIZE" value="20000000" />
		<label for="uploadfile_input">Choose a file to upload:</label> <input name="uploadedfile" type="file" id="uploadfile_input" />
		</p>
			<p>
				<input type="submit" value="Upload File" />
				
			</p>
		</form>
		<form action="viewing.php">
			<input type="submit" value="View uploaded files"/>
		</form> <br> 
		
		<form method="POST" action="delete.php">
		Delete <br/>
		<input type="text" name ="filetodelete"><br/>
		<input type = "submit" name="delete" value="Delete">
	</form>	
	<br>
	<form method="POST" action="friendshare.php">
		Share with a friend: <br/>
		File: <input type="text" name ="filetosend"><br/>
		Friend:<input type ="text" name ="friend" ><br/>
		<input type = "submit" name="share" value="Share">
	</form>	
	<br> 
	Logout:
		<form action="logout.php">
			<input type="submit" value="logout"/>
		</form>
</body>
</html> 