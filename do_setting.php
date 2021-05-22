<?php
$connect = mysqli_connect("localhost", "root", "", "my_facebook_data");
// Check connection
if (!$connect) {
    die("Connection failed: " . mysqli_connect_error());
}

// If user is already logged in then start session 
session_start();  

$email = $_SESSION["email"];

if(isset($_POST["introduction"])){  
	$iinstitute = mysqli_real_escape_string($connect, $_POST["iinstitute"]);
	$icity = mysqli_real_escape_string($connect, $_POST["icity"]);
	$idistrict = mysqli_real_escape_string($connect, $_POST["idistrict"]);
	$istate = mysqli_real_escape_string($connect, $_POST["istate"]);
	$icountry = mysqli_real_escape_string($connect, $_POST["icountry"]);
	$istatus = mysqli_real_escape_string($connect, $_POST["istatus"]);
	
	$count=0;
	$query = "SELECT * FROM introduction WHERE email = '$email'";  
	$result = mysqli_query($connect, $query);
	if(mysqli_num_rows($result) > 0) {  
		while($row = mysqli_fetch_array($result)){
			$count=$count+1;
		}
	}
	
	if($count == 0){
		$query = "INSERT INTO introduction (email, institute, city, district, state, country, status) 
	VALUES ('$email', '$iinstitute', '$icity', '$idistrict', '$istate', '$icountry', '$istatus')";
	}
	else{  
		$query = "Update introduction set email='$email', institude='$iinstitude', city='$icity', district='idistrict', state='$istate', country='$icountry', status='$istatus'";
	}  
	
	if(mysqli_query($connect, $query)){  
		echo '
			<script>
				alert("Intro has been save Successfully");
				window.location="profile.php";
			</script>
		';
	}  
	else {
		echo "Error: " . $query . "<br>" . mysqli_error($connect);
	}
	
}