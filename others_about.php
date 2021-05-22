<?php  
	session_start();  
	if(!isset($_SESSION["email"])){  
		header("location:index.php?action=login");  
	}
		
	include('includes/database_connection.php');
	$email = $_SESSION["email"]; // this value we are getting from url
	$name = "";
	$cover_photo = "";
	$profile_photo = "";
	$query = "SELECT * FROM registration WHERE email = '$email'"; 
	$result = mysqli_query($connect, $query);  
	if(mysqli_num_rows($result) > 0) {  
		while($row = mysqli_fetch_array($result)){  
			$name .= $row["firstname"].' '.$row["lastname"];
			$cover_photo = $row["cover_photo"]; 
			$profile_photo = $row["profile_photo"]; 
		}
	}
	
	
	$others_email = $_GET["temp"]; // this value we are getting from url
	$others_name = "";
	$others_cover_photo = "";
	$others_profile_photo = "";
	$others_gender = "";
	$query = "SELECT * FROM registration WHERE email = '$others_email'"; 
	$result = mysqli_query($connect, $query);  
	if(mysqli_num_rows($result) > 0) {  
		while($row = mysqli_fetch_array($result)){  
			$others_name .= $row["firstname"].' '.$row["lastname"];
			$others_cover_photo = $row["cover_photo"]; 
			if($others_cover_photo == ""){
				$others_cover_photo = "images/dummy_profile_bg.jpg";
			}
			$others_profile_photo = $row["profile_photo"]; 
			if($others_profile_photo == ""){
				$others_profile_photo = "images/dummy_profile_pic.jpg";
			}
			$others_gender = $row["gender"];
		}
	}
	
	$total_friends=0;
	$query = "SELECT * FROM friends WHERE (friend1_id = '$others_email' and status=2) or (friend2_id = '$others_email' and status=2)"; 
	$result = mysqli_query($connect, $query);  
	if(mysqli_num_rows($result) > 0) {  
		while($row = mysqli_fetch_array($result)){  
			$total_friends = $total_friends+1;
		}
	}
	
?> 


<!DOCTYPE html>  
<html>
<head>
	<link rel="icon" href="images/logo.png" type="image/png">
	<title>Friends book - Profile</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<link rel="stylesheet" href="css/style.css">
	<link rel="stylesheet" href="css/croppie.css">
	
	<!-- <link rel="stylesheet" href="https://cdn.rawgit.com/mervick/emojionearea/master/dist/emojionearea.min.css"> -->
	<link rel="stylesheet" href="js/emojionearea/dist/emojionearea.min.css">
	
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Roboto+Condensed:300,400" rel="stylesheet">
	
	<style>	


	</style>
</head>
<body id="myPage" data-spy="scroll" data-target=".navbar" data-offset="60">


<!-- Common navigation bar -->
	<?php include('includes/navigation_bar.php');?>
<!-- //Common navigation bar -->

<span id="uploaded_image"></span> <!-- dummy div for update cover and profile picture -->
<div class="container" style="margin-top:40px;">
	<div class="row my-banner-img">
		<div class="col-md-9">
			<div class="thumbnail">
				<a href="<?php echo $others_cover_photo; ?>">
					<img src="<?php echo $others_cover_photo; ?>" alt="Cover photo is not uploaded!" >
				</a>
				<div class="caption row">
					<div class="col-md-2">
						<div class="my-profile-pic">
							<a href="<?php echo $others_profile_photo; ?>">
								<img src="<?php echo $others_profile_photo; ?>" class="img-thumbnail" alt="Profile photo is not uploaded!"> 
							</a>
						</div>
					</div>
					<div class="col-md-10">
						<ul class="my-profile-name">
							<li><?php echo $others_name; ?></li>
						</ul>
					</div>
					<div class="col-md-2">
						&nbsp;
					</div>
					<div class="col-md-10">
						<ul class="my-profile-menu">
							<li><a href="others_about.php?temp=<?php echo $others_email; ?>">About</a></li>
							<li><a href="others_show_friends.php?temp=<?php echo $others_email; ?>">Friends <span class="total"><?php echo $total_friends; ?></span></a></li>
							<li><a href="messenger.php?temp=<?php echo $others_email; ?>">Messenger</a></li>
							<!--
							<li><a href="#">Groups <span class="total">12</span></a></li>
							<li><a href="#">Events</a></li>
							-->
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-md-9">
			<div class="panel panel-default">
				<div class="panel-heading">
					<h4><span class="glyphicon glyphicon-user" style="font-size:24px"></span> About<h4>
				</div>
				<div class="panel-body">
					<div class="row">
						<div class="col-md-12">
						<?php
							$query = "SELECT * FROM registration WHERE email = '$others_email'"; 
							$result = mysqli_query($connect, $query);  
							if(mysqli_num_rows($result) > 0) {  
								while($row = mysqli_fetch_array($result)){  
									echo '
										<table class="" style=";">
												<tr>
													<td width="10%">First Name</td>
													<td width="5%">:</td>
													<td width="30%">'.$row['firstname'].'</td>
												</tr>
												<tr>
													<td>Last Name</td>
													<td>:</td>
													<td>'.$row['lastname'].'</td>
												</tr>
												<tr>
													<td>Email Id</td>
													<td>:</td>
													<td>'.$row['email'].'</td>
												</tr>
												<tr>
													<td>Date of Birth</td>
													<td>:</td>
													<td>'.$row['day'].'/'.$row['month'].'/'.$row['year'].'</td>
												</tr>
										</table>
									  ';
								}
							}
						?>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="col-md-3">
			&nbsp;
		</div>
	</div>
</div>


<!-- script -->
	<script src="js/jquery.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<!-- <script src="https://cdn.rawgit.com/mervick/emojionearea/master/dist/emojionearea.min.js"></script> -->
	<script type="text/javascript" src="js/emojionearea/dist/emojionearea.js"></script>
	<script src="js/croppie.js"></script>
	<script src="js/script.js"></script>
	<script></script> 
<!-- //script -->
</body>
</html>