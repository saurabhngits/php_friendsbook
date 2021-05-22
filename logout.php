<?php 
session_start(); 

	include('includes/database_connection.php');
	$email = $_SESSION["email"];
	$query = "update registration set online_status=0 WHERE email = '$email'";  
	if(mysqli_query($connect, $query)){ 
	}  
	else {
		echo "Error: " . $query . "<br>" . mysqli_error($connect);
	}
 
session_destroy();  
header("location:index.php?action=login");  
?> 