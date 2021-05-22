<?php  
	session_start();  
	if(!isset($_SESSION["email"])){  
		header("location:index.php?action=login");  
	}
		
	include('includes/database_connection.php');
	$email = $_SESSION["email"];
	$name = "";
	$cover_photo = "";
	$profile_photo = "";
	$query = "SELECT * FROM registration WHERE email = '$email'"; 
	$result = mysqli_query($connect, $query);  
	if(mysqli_num_rows($result) > 0) {  
		while($row = mysqli_fetch_array($result)){  
			$name .= $row["firstname"].' '.$row["lastname"];
			$cover_photo = $row["cover_photo"]; 
			if($cover_photo == ""){
				$cover_photo = "images/default_cover.png";
			}
			$profile_photo = $row["profile_photo"]; 
			if($profile_photo == ""){
				$profile_photo = "images/default_profile.jpg";
			}
		}
	}
	
	$total_friends=0;
	$query = "SELECT * FROM friends WHERE (friend1_id = '$email' and status=2) or (friend2_id = '$email' and status=2)"; 
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
	<title>Friendsbook - Profile</title>
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
				<a href="<?php echo $cover_photo; ?>">
					<img src="<?php echo $cover_photo; ?>" alt="Cover photo is not uploaded!" >
				</a>
				<div class="dropdown my_cover_pic_button">
					<button type="button" class="btn btn-default btn-sm  dropdown-toggle" data-toggle="dropdown">
						<span class="glyphicon glyphicon-camera"></span> <span class="text">Update Cover Photo</span> 
					</button>
					<ul class="dropdown-menu">
						<li>
							<a href="#">
								<label for="my_cover_file">Upload Photo...</label>
								<input type="file" id="my_cover_file" accept=".jpg, .png, .gif" />	 
							</a>
						</li>
						<li><a href="#" id="remove_my_cover_file">Remove Photo... </a></li>
					</ul>
				</div>
				<div class="caption row">
					<div class="col-md-2">
						<div class="my-profile-pic">
							<div class="dropdown my_profile_pic_button">
								<div class="dropdown-toggle" data-toggle="dropdown">
									<span class="glyphicon glyphicon-camera"></span> <span class="text">Update Profile Photo</span>
								</div>
								<ul class="dropdown-menu">
									<li>
										<a href="#">
											<label for="my_profile_file">Upload Photo...</label>
											<input type="file" id="my_profile_file" accept=".jpg, .png, .gif" />	 
										</a>
									</li>
									<li><a href="#" id="remove_my_profile_file">Remove Photo... </a></li>
								</ul>
							</div>
							<a href="<?php echo $profile_photo; ?>">
								<img src="<?php echo $profile_photo; ?>" class="img-thumbnail" alt="Profile photo is not uploaded!"> 
							</a>
						</div>
					</div>
					<div class="col-md-10">
						<ul class="my-profile-name">
							<li><?php echo $name; ?></li>
						</ul>
					</div>
					<div class="col-md-2">
						&nbsp;
					</div>
					<div class="col-md-10">
						<ul class="my-profile-menu">
							<li><a href="about.php">About</a></li>
							<li><a href="show_friends.php">Friends <span class="total"><?php echo $total_friends; ?></span></a></li>
							<li><a href="messenger.php">Messenger</a></li>
							<li><a href="settings.php">Settings</a></li>
							<!--
							<li><a href="#">Groups <span class="total">12</span></a></li>
							<li><a href="#">Events</a></li>
							<li><a href="#">Settings</a></li>
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
							$query = "SELECT * FROM registration WHERE email = '$email'"; 
							$result = mysqli_query($connect, $query);  
							if(mysqli_num_rows($result) > 0) {  
								while($row = mysqli_fetch_array($result)){  
									echo '
										<table class="" style="">
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

<!-- Modal box for posting  -->
<div id="my_cover_file_modal" class="modal" role="dialog">
	<div class="modal-dialog my-cover-file-modal modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">Crop & Upload Cover Photo</h4>
			</div>
			<div class="modal-body">
				<div class="row">
					<div class="col-md-12 text-center">
						<div id="my_cover_file_image_demo" style="margin-top:30px"></div>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button class="btn btn-default btn-sm crop_image" id="my_crop_image">Upload</button>
			</div>
		</div>
    </div>
</div>

<!-- Modal box for posting  -->
<div id="my_profile_file_modal" class="modal" role="dialog">
	<div class="modal-dialog my-profile-file-modal">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">Crop & Upload Cover Photo</h4>
			</div>
			<div class="modal-body">
				<div class="row">
					<div class="col-md-12 text-center">
						<div id="my_profile_file_image_demo" style="margin-top:30px"></div>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button class="btn btn-default btn-sm crop_image" id="my_crop_image2">Upload</button>
			</div>
		</div>
    </div>
</div>


<!-- script -->
	<script src="js/jquery.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="https://cdn.rawgit.com/mervick/emojionearea/master/dist/emojionearea.min.js"></script>
	<script src="js/croppie.js"></script>
	<script src="js/script.js"></script>
	<script></script> 
<!-- //script -->
</body>
</html>