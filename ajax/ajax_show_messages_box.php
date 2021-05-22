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
	$date = date("d/M/Y");
	$time = date("h:i");
	$msg = $_POST['msg'];
	$msg = nl2br($msg); /*this bcoz we are taking input from textarea and add <br />*/
	$msg = trim($msg);
	$msg = mysqli_real_escape_string($connect, $msg);
	
	$query = "insert into messages (friend1_id, friend2_id, message, date, time) values ('$email', '$friend_id', '$msg', '$date', '$time')";
	if (mysqli_query($connect, $query)) {
	} 
	else {
		echo "Error: " . $query . "<br>" . mysqli_error($connect);
	}
	
}

if(isset($_POST['friend_id'])){
	$query = "SELECT * FROM registration where email='$friend_id' ORDER BY firstname ";
	$result = mysqli_query($connect, $query);  	
	if(mysqli_num_rows($result) > 0){ 
		while($row = mysqli_fetch_array($result)){ 
			$online_status="";
			if($row["online_status"] == 1){
				$online_status="style=\"display:inline-block;\"";
			}
			$fullname = $row['firstname']." ".$row['lastname'];
			echo '	
				<div class="panel-heading">
					<div class="my-friend-online-status" '.$online_status.'></div>
					'.$fullname.'
				</div>
			';
		}  
	}
	
	$query = "SELECT * FROM messages where (friend1_id='$email' and friend2_id='$friend_id') or (friend2_id='$email' and friend1_id='$friend_id') order by date asc, time asc";
	$result = mysqli_query($connect, $query);  	
	if(mysqli_num_rows($result) > 0){ 
	$check_date = "";
	$temp = "";
			echo '
					<div class="panel-body">
			';
		while($row = mysqli_fetch_array($result)){ 
			$check_date=$row['date'];
			if($temp != $check_date){
				$temp = $check_date;
				echo '
						<div class="row">
							<div class="col-md-12">
								<div class="my-well-date">
								<span class="label label-warning">'.$check_date.'</span>
								</div>
							</div>
						</div>
				';
			}
			echo '
						<div class="row">
			';
			if($row['friend2_id'] == $friend_id && $row['friend1_id'] == $email){
				echo '
							<div class="col-md-12">
								<div class="well well-sm my-well right">'.$row['message'].' 
								<div class="my-time">'.$row['time'].'</div>
								</div>
							</div>
				';
			}
			if($row['friend1_id'] == $friend_id && $row['friend2_id'] == $email){
				echo '
							<div class="col-md-12">
								<div class="well well-sm my-well left">'.$row['message'].'
								<div class="my-time">'.$row['time'].'</div>
								</div>
							</div>
				';
			}
			echo '
						</div>
			';
		}	
			echo '
					</div>
			';
	}
	
}


if(isset($_POST['show_result'])){
							
}

?>