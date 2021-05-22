<?php
session_start();  
	if(!isset($_SESSION["email"])){  
		header("location:../index.php?action=login");  
	}
include('../includes/database_connection.php');

$email = $_SESSION["email"];
$liker_name = "";

$query = "SELECT * FROM registration WHERE email = '$email'"; 
$result = mysqli_query($connect, $query);  
if(mysqli_num_rows($result) > 0) {  
	while($row = mysqli_fetch_array($result)){  
		$liker_name .= $row["firstname"].' '.$row["lastname"];
	}
}

date_default_timezone_set('Asia/Kolkata');
$date = date("d M");
$time = date("h:i");

if(isset($_POST["temp2"])){
	$total_likes_count=0;
	$like_for_post_id = mysqli_real_escape_string($connect, $_POST["temp1"]);

	$query  = "select * from my_post_like where post_id='$like_for_post_id'";
	$result = mysqli_query($connect, $query);  
	if(mysqli_num_rows($result) > 0) {  
		while($row = mysqli_fetch_array($result)){ 
			$total_likes_count = $total_likes_count+1;
		}
	}
	else {
		$total_likes_count = 0;
	}

	$new_query="";
	$query  = "select * from my_post_like where email='$email' and post_id='$like_for_post_id'";
	$result = mysqli_query($connect, $query);  
	if(mysqli_num_rows($result) > 0) {  
		$new_query = "delete from my_post_like where email='$email' and post_id='$like_for_post_id'";
		if (mysqli_query($connect, $new_query)) {
			$total_likes_count = $total_likes_count-1;
		} 
		else {
			echo "Error: " . $new_query . "<br>" . mysqli_error($connect);
		}
	}
	else {
		$new_query = "insert into my_post_like (post_id, email, date, time, liker_name) values ('$like_for_post_id', '$email', '$date', '$time', '$liker_name')";
		if (mysqli_query($connect, $new_query)) {
			$total_likes_count = $total_likes_count+1;
		} 
		else {
			echo "Error: " . $new_query . "<br>" . mysqli_error($connect);
		}
	}
	
	if($total_likes_count<=0){
		echo "0 likes";
	}
	else if($total_likes_count==1){
		echo "1 like";
	}
	else {
		echo $total_likes_count." likes";
	}
}

if(isset($_POST["temp4"])){
	$check_email = $row["email"];
	$posters_profile;
	
	$like_for_post_id = $_POST["temp3"];
	$query  = "select * from my_post_like where post_id='$like_for_post_id'";
	$result = mysqli_query($connect, $query);  
	if(mysqli_num_rows($result) > 0) {  
		while($row = mysqli_fetch_array($result)){ 
			if($check_email == $row["email"]){
				$posters_profile = "profile.php";
			}
			else {
				$posters_profile = "others_profile.php?temp=".$row["email"];
			}
			echo '
				<li>
					<a href="'.$posters_profile.'">'.$row["liker_name"].'</a>
				</li>
			';
		}
	}
}

?>