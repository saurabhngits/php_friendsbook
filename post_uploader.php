<?php
session_start();  
	if(!isset($_SESSION["email"])){  
		header("location:index.php?action=login");  
	}

include('includes/database_connection.php');
//upload.php

$email = $_SESSION["email"];


date_default_timezone_set('Asia/Kolkata');
$date = date("d M");
$time = date("h:i");


if(isset($_POST["my_upload_status_form"])){
	
	$status = $_POST["my_user_status"];
	$status = nl2br($status); /*this bcoz we are taking input from textarea and add <br />*/
	$status = trim($status);
	$status = mysqli_real_escape_string($connect, $status);
	$name = "Status";
	
	$query  = "INSERT INTO my_post (email, date, time, name, description, security_status ) VALUES ('$email',  '$date', '$time', '$name', '$status', 'public')";

	if (mysqli_query($connect, $query)) {
		echo '
			<script>
				alert("Your status has been post successfully");
				history.go(-1);
			</script>
		';
		if(isset($_SERVER['HTTP_REFERER'])) {
			$previous = $_SERVER['HTTP_REFERER'];
		}
	} 
	else {
		echo "Error: " . $query . "<br>" . mysqli_error($connect);
	}
	
}
else{
	
	$name = mysqli_real_escape_string($connect, $_POST["my_upload_file_name"]);

	$desc = $_POST["my_upload_file_desc"];
	$desc = nl2br($desc); /*this bcoz we are taking input from textarea and add <br />*/
	$desc = trim($desc);
	$desc = mysqli_real_escape_string($connect, $desc);
	
	$security_status = mysqli_real_escape_string($connect, $_POST["my_upload_file_status"]);

	/*-------------- image upload -------------*/

	$target_dir = "database/".$email."/";
	$target_file = $target_dir . basename($_FILES["my_upload_file"]["name"]);
	$uploadOk = 1;
	$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

	$target_dir2 = "database/".$email;
	if(!file_exists($target_dir2)){
		mkdir($target_dir2);
	}

	if (move_uploaded_file($_FILES["my_upload_file"]["tmp_name"], $target_file)) {
		echo "The file ". basename( $_FILES["my_upload_file"]["name"]). " has been uploaded.";
		$query  = "INSERT INTO my_post (email, date, time, path, name, description, security_status ) VALUES ('$email',  '$date', '$time', '$target_file', '$name', '$desc', '$security_status')";

		if (mysqli_query($connect, $query)) {
			echo '
				<script>
					alert("Your post has been successfully");
					history.go(-1);
				</script>
			';
		} 
		else {
			echo "Error: " . $query . "<br>" . mysqli_error($connect);
		}
	} 
	else {
		echo '
			<script>
				alert("Sorry, there is an error while uploading your file.");
				history.go(-1);
			</script>
		';
	}
}

?>