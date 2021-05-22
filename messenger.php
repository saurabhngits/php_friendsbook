<?php  
	session_start();  
	if(!isset($_SESSION["email"])){  
		header("location:index.php?action=login");  
	}
		
	include('includes/database_connection.php');
	$email = $_SESSION["email"];
	$name = "";
	$profile_photo = "";
	$query = "SELECT * FROM registration WHERE email = '$email'"; 
	$result = mysqli_query($connect, $query);  
	if(mysqli_num_rows($result) > 0) {  
		while($row = mysqli_fetch_array($result)){  
			$name .= $row["firstname"].' '.$row["lastname"];
			$profile_photo = "";
			if($row["profile_photo"] != ""){
				$profile_photo = $row["profile_photo"];
			}
			else {
				$profile_photo = "images/dummy_profile_pic.jpg";
			}
		}
	}
	
?> 

<!DOCTYPE html>  
<html>
<head>
	<link rel="icon" href="images/logo.png" type="image/png">
	<title>Friends book - Home</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<link rel="stylesheet" href="css/style.css">
	
	<!-- <link rel="stylesheet" href="https://cdn.rawgit.com/mervick/emojionearea/master/dist/emojionearea.min.css"> -->
	<link rel="stylesheet" href="js/emojionearea/dist/emojionearea.min.css">
	
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Roboto+Condensed:300,400" rel="stylesheet">
	
	<style></style>
</head>
<body id="myPage" data-spy="scroll" data-target=".navbar" data-offset="60">

<!-- Common navigation bar -->
	<?php include('includes/navigation_bar.php');?>
<!-- //Common navigation bar -->

<div class="container" style="margin-top:60px;">
	<div class="row">
		<div class="col-md-3 my-messenger-list">
			<div class="panel panel-default">
				<div class="panel-heading">
					<span class="bold">Messenger</span>
				</div>
				<div class="panel-body">
					<!--
					<div class="my-messenger-search-bar">
						<div class="input-group">
							<span class="input-group-addon"><i class="glyphicon glyphicon-search"></i></span>
							<input type="text" id="search_friend_for_message" class="form-control" placeholder="Search Messenger">
						</div>
					</div> 
					-->
					<ul id="show_friend_for_message">
						<?php
							$query = "SELECT r.*, f.* FROM registration r, friends f where (CASE WHEN f.friend1_id = r.email THEN f.friend2_id = '$email' WHEN f.friend1_id = '$email' THEN f.friend2_id = r.email END) and f.status=2 ORDER BY r.firstname" ;
							//echo $query; 
							$result = mysqli_query($connect, $query);  
							if(mysqli_num_rows($result) > 0) {  
								while($row = mysqli_fetch_array($result)){ 
									$fullname = "";
									$fullname .= $row["firstname"].' '.$row["lastname"];
									$profile_photo = "";
									if($row["profile_photo"] != ""){
										$profile_photo = $row["profile_photo"];
									}
									else {
										$profile_photo = "images/dummy_profile_pic.jpg";
									}
									
									$friend_id="";
									if($row["friend1_id"] == "$email"){
										$friend_id = $row["friend2_id"];
									}
									else{
										$friend_id = $row["friend1_id"];
									}
									$online_status="";
									if($row["online_status"] == 1){
										$online_status="style=\"display:inline-block;\"";
									}
									
									if(isset($_POST['temp'])){
										if($_POST['temp'] == $row['email']){
											echo '
												<li class="my-messeng-friend active" friend_id="'.$friend_id.'">
													<img src="'.$profile_photo.'" alt="Cinque Terre">
													<span>'.$fullname.'</span>
													<div class="my-friend-online-status" '.$online_status.'></div>
												</li>
											';
										}
									}
									else{
										echo '
											<li class="my-messeng-friend" friend_id="'.$friend_id.'">
												<img src="'.$profile_photo.'" alt="Cinque Terre">
												<span>'.$fullname.'</span>
												<div class="my-friend-online-status" '.$online_status.'></div>
											</li>
										';
									}
								}
							}
						?>
					</ul>
				</div>
			</div>
		</div>
		<div class="col-md-6 my-messenger-box">
			<div class="clear">	</div>
			<div class="panel panel-default">
				<div id="my_messenger_box" >
					<div class="panel-heading">
						Select your friend to whom you want to message
					</div>
				</div>
				<div class="panel-footer" id="msg_box_footer">
					<form id="msg_sender_form">
						<div class="form-group row">
							<div class="col-md-10">
								<textarea class="form-control" id="msg_writer" name="msg_writer" friend_id=""    placeholder="Type a message ... " rows="1" ></textarea>
							</div>
							<div class="col-md-2">
								<input type="button" id="msg_sender" class="btn btn-default btn-sm" value="Send" />
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
		<div class="col-md-3">
			&nbsp;
		</div>
	</div>
</div>

<!-- script -->
	<script src="js/jquery-3.3.1.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<!-- <script src="https://cdn.rawgit.com/mervick/emojionearea/master/dist/emojionearea.min.js"></script> -->
	<script type="text/javascript" src="js/emojionearea/dist/emojionearea.js"></script>
	<script src="js/script.js"></script>
	<script></script> 
<!-- //script -->
</body>
</html>