<?php  
session_start();  
	if(!isset($_SESSION["email"])){  
		header("location:../index.php?action=login");  
	}

include('../includes/database_connection.php');
//upload.php

$email = $_SESSION["email"];
$fullname = "";
$firstname = "";
$lastname = "";

	$count = 0;  
	$query = "SELECT * FROM friends where friend2_id = '$email' and status=1";
	$result = mysqli_query($connect, $query); 
	if(mysqli_num_rows($result) > 0){  
		while($row = mysqli_fetch_array($result)){  
			$count = $count +1;
		}  
	}    
	echo $count;  
?>