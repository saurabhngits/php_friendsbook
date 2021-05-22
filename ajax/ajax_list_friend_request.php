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

	$output = '';  
	$query = "SELECT r.*, f.* FROM registration r, friends f where (CASE WHEN f.friend1_id = r.email THEN f.friend2_id = '$email' END) and f.status=1 ORDER BY r.firstname ";
	$result = mysqli_query($connect, $query);  
	$output = '<ul class="list-unstyled">'; 
	$output .= '<li>
					<span class="bold">Friend Requests</span>
					<span style="float:right;"><a href="search_list.php">Find Friends</a></span></li>';
	if(mysqli_num_rows($result) > 0){  
		while($row = mysqli_fetch_array($result)){  
			if($row["email"] != $email) {
				$fullname = $row["firstname"].' '.$row["lastname"];
				$output .= '<li class="show_friend_search_li"><a href="others_profile.php?temp='.$row["email"].'">'.$fullname.'</a></li>';  
			}
		}  
	}  
	else {  
		$output .= '<li>No new requests found.</li>';  
	}  
	$output .= '</ul>';  
	echo $output;  
?>