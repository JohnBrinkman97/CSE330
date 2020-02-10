<!DOCTYPE html>
<html>

<body style="background-color:lightsteelblue;">
<?php
	include 'nwsSite.css';
	//destroy session and unset session variables
	session_start();
	session_unset();
	session_destroy();
	echo "<h3>Logged Out</h3><br>";
	echo '<a href="storyPage.php">Return to site</a>';
	?>
</body>
</html>