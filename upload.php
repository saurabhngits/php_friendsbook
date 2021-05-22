<?php
include('includes/database_connection.php');
//upload.php

$name = mysqli_real_escape_string($connect, $_POST["my_upload_file_name"]);
$message = mysqli_real_escape_string($connect, $_POST["my_upload_file_desc"]);
$target_dir = "upload/";
$target_file = $target_dir . basename($_FILES["my_upload_file"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

if (move_uploaded_file($_FILES["my_upload_file"]["tmp_name"], $target_file)) {
    echo '
		<script>
			alert("The file '. basename( $_FILES['my_upload_file']['name']). ' has been uploaded.");
			window.location = "home.php";
		</script>
	';
} 
else {
	echo '
		<script>
			alert("Sorry, there was an error uploading your file.");
			window.location = "home.php";
		</script>
	';
}

	$query = "INSERT INTO chat (message) VALUES ('$message');"; 
 
	if(mysqli_query($connect, $query)){  
		echo '
			<script>
				alert("Registration Done Successfully");
				window.location="home.php";
			</script>
		';
	}  
	else {
		echo "Error: " . $query . "<br>" . mysqli_error($connect);
	}



/*
if(!empty($_FILES))
{
	if(is_uploaded_file($_FILES['my_upload_file']['tmp_name']))
	{
		$_source_path = $_FILES['my_upload_file']['tmp_name'];
		$target_path = 'upload/' . $_FILES['my_upload_file']['name'];
		if(move_uploaded_file($_source_path, $target_path)){
			echo '<p><img src="'.$target_path.'" class="img-thumbnail" width="200" height="160" /></p><br />';
		}
	}
	
	$target_dir = "uploads/";
	$target_file = $target_dir . basename($_FILES["my_uploadfile"]["name"]);
	echo '<br />'.$target_file;
}
*/


?>