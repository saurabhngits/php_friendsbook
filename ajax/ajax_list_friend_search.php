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


if(isset($_POST["query"])) {  
	$data = $_POST["query"];
	$temp_array = explode(" ", $data);
	$temp_array_size = count($temp_array);
	if($temp_array_size == 1){
		$firstname = $temp_array[0];
		$lastname = $temp_array[0];
	}
	else if($temp_array_size == 2){
		$firstname = $temp_array[0];
		$lastname = $temp_array[1];
	}

	$output = '';  
	$query = "SELECT * FROM registration WHERE firstname LIKE '%".$firstname."%' OR lastname LIKE '%".$lastname."%'";  
	$result = mysqli_query($connect, $query);  
	$output = '<ul class="list-unstyled">';  
	if(mysqli_num_rows($result) > 0){  
		while($row = mysqli_fetch_array($result)){  
			if($row["email"] != $email) {
				$fullname = $row["firstname"].' '.$row["lastname"];
				$output .= '<li class="show_friend_search_li">'.$fullname.'</li>';  
			}
		}  
	}  
	else {  
		$output .= '<li>Name Not Match</li>';  
	}  
	$output .= '</ul>';  
	echo $output;  
}  
 ?>  