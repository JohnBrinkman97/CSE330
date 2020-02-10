<!DOCTYPE html> 
<html> 
<?php
 echo isset($_SESSION['user_id']) && !empty($_SESSION['user_id']);
?>
</html>