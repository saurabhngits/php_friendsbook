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
	<?php 
		echo '
			<div class="row">
				<div class="col-md-9">
					<div class="panel panel-default">
						<div class="panel-body">
		';
							$count_appearance = 0;
							$query = "SELECT * FROM friends"; 
							$result = mysqli_query($connect, $query);  
							if(mysqli_num_rows($result) > 0) {  
								while($row = mysqli_fetch_array($result)){
									if($row["friend1_id"] == "$email" && $row["friend2_id"] == "$others_email") {
										$count_appearance = $count_appearance + 1;
										if($row["status"] == 1){ // request has been sent
											echo 'Request sent';
											echo '
												<div style="float:right !important;">
													<button type="button" request_id="'.$row["request_id"].'"  friends_email="'.$others_email.'" class="delete_request_btn btn btn-default btn-xs">
														<span class="glyphicon glyphicon-remove"> </span> 
														cancel request
													</button>
													<button type="button" class="btn btn-success btn-xs" >
														<span class="glyphicon glyphicon-plus"> </span> 
														Friend request sent
													</button>
												</div>
											';
										}
										if($row["status"] == 2){ // request accepted
											echo $others_name.' and you are now friends.';
											echo '
												<div style="float:right !important;">
													<button type="button" 
													request_id="'.$row["request_id"].'"  friends_email="'.$others_email.'" class="delete_request_btn btn btn-default btn-xs">
														<span class="glyphicon glyphicon-remove"> </span> 
														Un Friends
													</button>
													<button type="button" class="btn btn-success btn-xs">
														<span class="glyphicon glyphicon-plus"> </span> 
														Friends
													</button>
												</div>
											';
										}
									}
									else if($row["friend1_id"] == "$others_email" && $row["friend2_id"] == "$email") {
										$count_appearance = $count_appearance + 1;
										if($row["status"] == 1){ // friend request is pending
											echo $others_name.' sent you a friend request.';
											echo '
												<div style="float:right !important;">
													<button type="button" request_id="'.$row["request_id"].'"  friends_email="'.$others_email.'" class="delete_request_btn btn btn-default btn-xs">
														<span class="glyphicon glyphicon-remove"> </span> 
														Not now
													</button>
													<button type="button" request_id="'.$row["request_id"].'"  friends_email="'.$others_email.'" class="accept_request_btn btn btn-success btn-xs">
														<span class="glyphicon glyphicon-plus"> </span> 
														Confirm friend request
													</button>
												</div>
											';
										}
										if($row["status"] == 2){ // confirmed pending friend request
											echo $others_name.' and you are now friends.';
											echo '
												<div style="float:right !important;">
													<button type="button" 
													request_id="'.$row["request_id"].'"  friends_email="'.$others_email.'" class="delete_request_btn btn btn-default btn-xs">
														<span class="glyphicon glyphicon-remove"> </span> 
														Un Friends
													</button>
													<button type="button" class="btn btn-success btn-xs">
														<span class="glyphicon glyphicon-plus"> </span> 
														Friends
													</button>
												</div>
											';
										}
									}
								}
							}
							
							if($count_appearance == 0) {
								if($others_gender == "male"){
									echo 'To see what he shares with friends, send him a friend request.';
									
								}
								else{
									echo 'To see what she shares with friends, send her a friend request.';
								}
								echo '
									<div style="float:right !important;">
										<button type="button" friends_email="'.$others_email.'" class="request_sender_btn btn btn-success btn-xs">
											<span class="glyphicon glyphicon-plus"> </span> 
											Add friend
										</button>
									</div>
								';
							}
		echo '
						</div>
					</div>
				</div>
				<div class="col-md-3">
					&nbsp;
				</div>
			</div>	
		';										
	?>
	<div class="row">
		<div class="col-md-3  sticky">
			<div class="panel panel-default">
				<div class="panel-body my-intro-panel">
					<ul>
									<li>
										<span class="glyphicon glyphicon-globe my-icon"></span>
										<a href="#">Intro</a>
									</li>
					<?php
						$query = "SELECT * FROM introduction WHERE email = '$others_email'"; 
						$result = mysqli_query($connect, $query);  
						if(mysqli_num_rows($result) > 0) {  
							while($row = mysqli_fetch_array($result)){
								echo'
									<li>
										<span class="glyphicon glyphicon-education my-icon"></span>
										<a href="#">Studing in '.$row['institute'].'</a>
									</li>
									<li>
										<span class="glyphicon glyphicon-home my-icon"></span>
										<a href="#">Lives in '.$row['city'].', '.$row['district'].' </a>
									</li>
									<li>
										<span class="glyphicon glyphicon-map-marker my-icon"></span>
										<a href="#">From '.$row['state'].', '.$row['country'].'</a>
									</li>
									<li>
										<span class="glyphicon glyphicon-heart-empty my-icon"></span>
										<a href="#">'.$row['status'].'</a>
									</li>
								';
								
							}
						}
					?>
					</ul>
				</div>
			</div>
		</div>
		<div class="col-md-6">
			<?php  
				/*$email = $_SESSION["email"];
				$name = "";*/
				$query = "SELECT * FROM my_post where email='$others_email' ORDER BY post_id DESC"; 
				$post_id="";
				$result = mysqli_query($connect, $query);  
				if(mysqli_num_rows($result) > 0) {  
					while($row = mysqli_fetch_array($result)){ 
						$path = $row["path"];
						$post_id=""+$row["post_id"]+"";
						
						$email2 = $row["email"];
						$query2 = "SELECT * FROM registration where email='$email2'";
						$result2 = mysqli_query($connect, $query2);
						if(mysqli_num_rows($result2) > 0) {  
							while($row2 = mysqli_fetch_array($result2)){ 
								$uploader_name = $row2["firstname"].' '.$row2["lastname"];
								$uploader_img = $row2["profile_photo"];
								if($uploader_img == ""){
									$uploader_img = "images/dummy_profile_pic.jpg";
								}
							}
						}
						$ext = strtolower(pathinfo($path,PATHINFO_EXTENSION));
						if($row["security_status"] == "public"){
							echo '
								<div class="panel panel-default my-posts">
									<div class="panel-heading">
										<div class="row">
											<div class="col-md-1">
												<div class="img-div">
													<img src="'.$uploader_img.'" alt="Cinque Terre">
												</div>
											</div>
											<div class="col-md-11">
												<div class="text-div">
													<span><a href="#"><strong>'.$uploader_name.'</strong></a> shared <a href="#">'.$row["name"].'</a></span>
													<br />
													<span>'.$row["date"].' at</span> <span>'.$row["time"].'</span>
												</div>
											</div>
										</div>
									</div>
									<div class="panel-body">
							';
										if($ext == 'jpg' || $ext == 'png' || $ext == 'gif'){
											echo '
												<div class="thumbnail">
													<div class="caption">
														<p>'.$row["description"].'</p>
													</div>
													<a href="'.$row["path"].'">
														<img src="'.$row["path"].'" alt="Lights" style="width:100%">
													</a>
												</div>
											';
										}
										if($ext == 'mp4'){
											echo '
												<div class="thumbnail">
													<div class="caption">
														<p>'.$row["description"].'</p>
													</div>
													<video width="100%" controls>
														<source src="'.$row["path"].'" type="video/mp4">
														Your browser does not support the video tag.
													</video> 
												</div>
											';
										}
										if($path==NULL){
											echo '
												<div class="thumbnail">
													<div class="caption">
														<p>'.$row["description"].'</p>
													</div> 
												</div>
											';
										}
							echo '
									</div>
									<div class="panel-footer">
										<div class="row">
											<div class="col-md-6">
												<ul class="my-vertical-bar">
							';
													$total_likes_count=0;
													$query2 = "SELECT * FROM my_post_like where post_id='$post_id'";
													$result2 = mysqli_query($connect, $query2);  
													if(mysqli_num_rows($result2) > 0) {  
														echo '
															<!-- Modal -->
															<div id="my_modal_show_liker_name" class="modal fade my_modal_show_liker_name" role="dialog">
																<div class="modal-dialog modal-sm">
																	<!-- Modal content-->
																	<div class="modal-content">
																		<div class="modal-header">
																			<button type="button" class="close" data-dismiss="modal">&times;</button>
																			<h4 class="modal-title">Names</h4>
																		</div>
																		<div class="modal-body">
																			<ul id="show_liker_names">
																				
																			</ul>
																		</div>
																	</div>
																</div>
															</div>
														';
													
														while($row2 = mysqli_fetch_array($result2)){ 
															$total_likes_count = $total_likes_count+1;
														}
													}
													if($total_likes_count<=0){
														echo '
																<li>
																	<i class="like"></i>
																</li>
																<li id="show_liker_id_'.$post_id.'" class="show_liker_id" data-toggle="modal" data-target="#my_modal_show_liker_name">
																	<span id="like_for_postid_'.$post_id.'">0 likes</span>
																</li>
														';
													}
													else if($total_likes_count==1){
														echo '
																<li>
																	<i class="like"></i>
																</li>
																<li id="show_liker_id_'.$post_id.'" class="show_liker_id" data-toggle="modal" data-target="#my_modal_show_liker_name">
																	<span id="like_for_postid_'.$post_id.'">1 like</span>
																</li>
														';
													}
													else {
														echo '
																<li>
																	<i class="like"></i>
																</li>
																<li id="show_liker_id_'.$post_id.'" class="show_liker_id" data-toggle="modal" data-target="#my_modal_show_liker_name">
																	<span id="like_for_postid_'.$post_id.'"> '.$total_likes_count.' likes </span>
																</li>
														';
													}
							echo '
												</ul>
											</div>
							';
							$query2 = "SELECT * from friends where (friend1_id='$email' and friend2_id='$others_email' and status=2) or (friend2_id='$email' and friend1_id='$others_email' and status=2)";
							$result2 = mysqli_query($connect, $query2);
							if(mysqli_num_rows($result2) > 0){
								while($row2 = mysqli_fetch_array($result2)){
							echo '
											<div class="col-md-6">
												<ul class="my-vertical-bar" style="text-align:right;">
							';
													$query3 = "SELECT * FROM my_post_like where post_id='$post_id' and email='$email'";
													$result3 = mysqli_query($connect, $query3);  
													if(mysqli_num_rows($result3) > 0) {  
														while($row3 = mysqli_fetch_array($result3)){ 
															echo'
																<li id="post'.$post_id.'" class="active_element show_like_details" >
																	<i class="fa fa-thumbs-o-up"></i>
																	<span>Like</span>
																</li>
															';
														}
													}
													else {
															echo'
																<li id="post'.$post_id.'" class="show_like_details" >
																	<i class="fa fa-thumbs-o-up"></i>
																	<span>Like</span>
																</li>
															';
													}
							echo '
												</ul>
											</div>
							';
								}
							}
							echo '
										</div>
									</div>
								</div>
							';
						}
					}
				}
				else {
					echo '
						<div class="alert alert-danger alert-dismissible">
							<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
							<strong>Sorry!</strong> No post is available to watch on this wall.
						</div>
					';
				}
			?> 
		</div>
		<div class="col-md-4">
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