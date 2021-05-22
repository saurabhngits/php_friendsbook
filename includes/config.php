<?php
$connect = mysqli_connect("localhost", "root", "", "my_facebook_data");
// Check connection
if (!$connect) {
    die("Connection failed: " . mysqli_connect_error());
}

// If user is already logged in then start session 
session_start();  
if(isset($_SESSION["email"])){  
    header("location:home.php");  
}  

if(isset($_POST["registration"])){  
	$firstname = mysqli_real_escape_string($connect, $_POST["firstname"]);
	$lastname = mysqli_real_escape_string($connect, $_POST["lastname"]);
	$email = mysqli_real_escape_string($connect, $_POST["email"]);
	$password = mysqli_real_escape_string($connect, $_POST["password"]);
	$question = mysqli_real_escape_string($connect, $_POST["question"]);
	$answer = mysqli_real_escape_string($connect, $_POST["answer"]);
	$day = mysqli_real_escape_string($connect, $_POST["day"]);
	$month = mysqli_real_escape_string($connect, $_POST["month"]);
	$year = mysqli_real_escape_string($connect, $_POST["year"]);
	$gender = mysqli_real_escape_string($connect, $_POST["gender"]);
	
	$password = password_hash($password, PASSWORD_DEFAULT); 
	$answer = password_hash($answer, PASSWORD_DEFAULT);	
	
	$count=0;
	$query = "SELECT * FROM registration WHERE email = '$email'";  
	$result = mysqli_query($connect, $query);
	if(mysqli_num_rows($result) > 0) {  
		while($row = mysqli_fetch_array($result)){
			$count=$count+1;
		}
	}
	
	$query = "INSERT INTO registration (firstname, lastname, email, password, question, answer, day, month, year, gender) 
	VALUES ('$firstname', '$lastname', '$email', '$password', '$question', '$answer', '$day', '$month', '$year', '$gender');"; 
	if($count>0){
		echo'
			<script>
				alert("Sorry! same Email Id is already registered with another user.");
				window.location="registration.php";
			</script>';
	}
	else if(mysqli_query($connect, $query)){  
		$target_dir = "database/".$email;
		if(!file_exists($target_dir)){
			mkdir($target_dir);
		}
		
		echo '
			<script>
				alert("Registration Done Successfully");
				window.location="index.php";
			</script>
		';
	}  
	else {
		echo "Error: " . $query . "<br>" . mysqli_error($connect);
	}
} 


if(isset($_POST["login"])){ 
	$email = mysqli_real_escape_string($connect, $_POST["email"]);  
	$password = mysqli_real_escape_string($connect, $_POST["password"]);  
	$query = "SELECT * FROM registration WHERE email = '$email'";  
	$result = mysqli_query($connect, $query);  
	if(mysqli_num_rows($result) > 0) {  
		while($row = mysqli_fetch_array($result)){  
			if(password_verify($password, $row["password"])){  
				if(!empty($_POST["remember"])){  
					setcookie ("member_email",$email,time()+ (10 * 365 * 24 * 60 * 60));  
					setcookie ("member_password",$password,time()+ (10 * 365 * 24 * 60 * 60));
				}  
				else{  
					if(isset($_COOKIE["member_email"])){  
						setcookie ("member_email","");  
					}  
					if(isset($_COOKIE["member_password"])) {  
						setcookie ("member_password","");  
					}  
				}  
				//return true;  
				$_SESSION["email"] = $email;
				header("location:home.php");
				
				$query2 = "update registration set online_status=1 WHERE email = '$email'";  
				if(mysqli_query($connect, $query2)){ 
				}  
				else {
					echo "Error: " . $query2 . "<br>" . mysqli_error($connect);
				}
			}  
			else{  
				//return false;  
				echo '<script>alert("Wrong User Details")</script>';  
			}  
		}  
	}  
	else{  
		echo "Error: " . $query . "<br>" . mysqli_error($connect);
		echo '<script>alert("Wrong User Details")</script>';  
	}  
}  

if(isset($_POST["forgot_password"])){
	$error_message = "";
	$email = mysqli_real_escape_string($connect, $_POST["email"]);
	$password = mysqli_real_escape_string($connect, $_POST["password"]);
	$question = mysqli_real_escape_string($connect, $_POST["question"]);
	$answer = mysqli_real_escape_string($connect, $_POST["answer"]);
	
	$query = "SELECT * FROM registration WHERE email = '$email'";
	$result = mysqli_query($connect, $query);  
	if(mysqli_num_rows($result) > 0) {  
		while($row = mysqli_fetch_array($result)){
			if($question != $row["question"]){
				$error_message .= "* Question must be match that you have inputed while registration. <br />";
			} 
			else if(!password_verify($answer, $row["answer"])){
				$error_message .= "* Incorrect answer has been inputed. <br />";
			}
			else {
				$error_message = "";
				$password = password_hash($password, PASSWORD_DEFAULT);
				$query = "UPDATE registration set password = '$password' where email = '$email' ;"; 
 
				if(mysqli_query($connect, $query)){  
					echo '
						<script>
							alert("Password has been changed successfully");
							window.location="index.php";
						</script>
					';
				}  
				else {
					echo "Error: " . $query . "<br>" . mysqli_error($connect);
				}
			}
		}
	}
}

mysqli_close($connect); 
?>  