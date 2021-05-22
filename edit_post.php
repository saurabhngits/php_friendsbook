<?php
session_start();  
	if(!isset($_SESSION["email"])){  
		header("location:index.php?action=login");  
	}

include('includes/database_connection.php');
//upload.php

$email = $_SESSION["email"];
if(isset($_GET["temp_status"]) && isset($_GET["temp_id"])){
	$security_status=$_GET["temp_status"];
	$post_id=$_GET["temp_id"];
	$query  = "update my_post set security_status = '$security_status' where post_id='$post_id'";
	if (mysqli_query($connect, $query)) {
		echo '
			<script>
				alert("Post status has been change successfully");
				history.go(-1);
			</script>
		';
	} 
	else {
		echo "Error: " . $query . "<br>" . mysqli_error($connect);
	}
}

if(isset($_GET["temp_id_delete"])){
	$post_id=$_GET["temp_id_delete"];
	$path = "";
	$query  = "select path from my_post where post_id='$post_id'";
	$result = mysqli_query($connect, $query);  
	if(mysqli_num_rows($result) > 0) {  
		while($row = mysqli_fetch_array($result)){  
			$path = $row["path"];
		}
	}
	
	$query  = "delete from my_post where post_id='$post_id'";
	if (mysqli_query($connect, $query)) {
		if($path != ""){
			unlink($path);
		}
		echo '
			<script>
				alert("Post has been deleted successfully");
				history.go(-1);
			</script>
		';
	} 
	else {
		echo "Error: " . $query . "<br>" . mysqli_error($connect);
	}
}

?>