<?php
session_start();  
if(!isset($_SESSION["email"])){  
	header("location:../index.php?action=login");  
}
include('../includes/database_connection.php');

$email = $_SESSION["email"];
$cover_photo = "";
$profile_photo = "";
$query = "SELECT * FROM registration WHERE email = '$email'"; 
	$result = mysqli_query($connect, $query);  
	if(mysqli_num_rows($result) > 0) {
		while($row = mysqli_fetch_array($result)){ 
			$cover_photo = $row["cover_photo"];
			$profile_photo = $row["profile_photo"];
		}
	}

if($_POST["temp"] == "remove_my_cover_file"){
	$query = "update registration set cover_photo='' WHERE email = '$email'"; 
	if (mysqli_query($connect, $query)) {
		if($cover_photo != ""){
			unlink($_SERVER['DOCUMENT_ROOT']."/summer_project/".$cover_photo);
		}
		echo '
			<script>
				alert("Cover Photo Has Been Remove Successfully");
				window.location="profile.php";
			</script>
		';
	} 
	else {
		echo "Error deleting record: " . mysqli_error($conn);
	}
}

if($_POST["temp"] == "remove_my_profile_file"){
	$query = "update registration set profile_photo='' WHERE email = '$email'"; 
	if (mysqli_query($connect, $query)) {
		if($profile_photo != ""){
			unlink($_SERVER['DOCUMENT_ROOT']."/summer_project/".$profile_photo);
		}
		echo '
			<script>
				alert("Profile Photo Has Been Remove Successfully");
				window.location="profile.php";
			</script>
		';
	} 
	else {
		echo "Error deleting record: " . mysqli_error($conn);
	}
}

?>