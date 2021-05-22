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
$friend_id = $_POST['friend_id'];

if(isset($_POST['msg'])){
	date_default_timezone_set('Asia/Kolkata');
	$date = date("d M Y");
	$time = date("h:i");
	$msg = $_POST['msg'];
	$msg = nl2br($msg); /*this bcoz we are taking input from textarea and add <br />*/
	$msg = trim($msg);
	$msg = mysqli_real_escape_string($connect, $msg);
	
	$query = "insert into messages (friend1_id, friend2_id, message, date, time) values ('$email', '$friend_id', '$msg', '$date', '$time')";
	if (mysqli_query($connect, $query)) {
		echo "Error: scbshjdfsd";
	} 
	else {
		echo "Error: " . $query . "<br>" . mysqli_error($connect);
	}
	
}

?>