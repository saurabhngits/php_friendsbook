<?php
session_start();  
	if(!isset($_SESSION["email"])){  
		header("location:../index.php?action=login");  
	}

include('../includes/database_connection.php');
//upload.php

$email = $_SESSION["email"];
if(isset($_POST["temp_friends_email"])){
	$friend_id = $_POST["temp_friends_email"];
	$query  = "INSERT INTO friends (friend1_id, friend2_id, status ) VALUES ('$email', '$friend_id', '1')";
	if (mysqli_query($connect, $query)) {
		echo '
			<script>
				alert("Request has been sent successfully");
			</script>
		';
	} 
	else {
		echo "Error: " . $query . "<br>" . mysqli_error($connect);
	}
}

if(isset($_POST["temp_delete_id"])){
	$request_id = $_POST["temp_delete_id"];
	$query  = "delete from friends where request_id='$request_id'";
	if (mysqli_query($connect, $query)) {
		echo '
			<script>
				alert("Request has been deleted successfully");
			</script>
		';
	} 
	else {
		echo "Error: " . $query . "<br>" . mysqli_error($connect);
	}
}

if(isset($_POST["temp_accept_id"])){
	$request_id = $_POST["temp_accept_id"];
	$query  = "update friends set status=2 where request_id='$request_id'";
	if (mysqli_query($connect, $query)) {
		echo '
			<script>
				alert("Request has been accepted successfully");
			</script>
		';
	} 
	else {
		echo "Error: " . $query . "<br>" . mysqli_error($connect);
	}
}
