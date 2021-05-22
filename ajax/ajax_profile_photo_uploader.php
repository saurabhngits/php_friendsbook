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

if(isset($_POST["image"]))
{
	$data = $_POST["image"];
	$image_array_1 = explode(";", $data);
	$image_array_2 = explode(",", $image_array_1[1]);
	$data = base64_decode($image_array_2[1]);
	$imageName = time() . '.png';
	$target_dir = "../database/".$email."/cover_photo";
	if(!file_exists($target_dir)){
		mkdir($target_dir);
	}
	$target_dir = $target_dir."/".$imageName;
	
	if(file_put_contents($target_dir, $data)){
		$target_dir = "database/".$email."/cover_photo/".$imageName;
		$query = "update registration set cover_photo='$target_dir' where email='$email' ";
		if (mysqli_query($connect, $query)) {
			if($cover_photo != ""){
				unlink($_SERVER['DOCUMENT_ROOT']."/summer_project/".$cover_photo);
			}
			echo '
				<script>
					alert("Cover Photo Has Been Set Successfully");
					window.location="profile.php";
				</script>
			';
		} 
		else {
			echo "Error: " . $query . "<br>" . mysqli_error($connect);
		}
	}
	
}

if(isset($_POST["image2"]))
{
	$data = $_POST["image2"];
	$image_array_1 = explode(";", $data);
	$image_array_2 = explode(",", $image_array_1[1]);
	$data = base64_decode($image_array_2[1]);
	$imageName = time() . '.png';
	$target_dir = "../database/".$email."/profile_photo";
	if(!file_exists($target_dir)){
		mkdir($target_dir);
	}
	$target_dir = $target_dir."/".$imageName;
	
	if(file_put_contents($target_dir, $data)){
		$target_dir = "database/".$email."/profile_photo/".$imageName;
		$query = "update registration set profile_photo='$target_dir' where email='$email' ";
		if (mysqli_query($connect, $query)) {
			if($profile_photo != ""){
				unlink($_SERVER['DOCUMENT_ROOT']."/summer_project/".$profile_photo);
			}
			echo '
				<script>
					alert("Profile Photo Has Been Set Successfully");
					window.location="profile.php";
				</script>
			';
		} 
		else {
			echo "Error: " . $query . "<br>" . mysqli_error($connect);
		}
	}
	
}

?>