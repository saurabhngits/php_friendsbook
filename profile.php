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
							<!--
							<li><a href="#">Groups <span class="total">12</span></a></li>
							<li><a href="#">Events</a></li>
							-->
							<li><a href="settings.php">Settings</a></li>
							
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-md-3  sticky">
			<div class="panel panel-default">
				<div class="panel-body my-intro-panel">
					<ul>
					<?php
						$query = "SELECT * FROM introduction WHERE email = '$email'"; 
						$result = mysqli_query($connect, $query);  
						if(mysqli_num_rows($result) > 0) {  
							while($row = mysqli_fetch_array($result)){
								echo'
									<li>
										<span class="glyphicon glyphicon-globe my-icon"></span>
										<a href="#">Intro</a>
									</li>
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
			<div class="panel panel-default my-post-panel">
				<div class="panel-heading">
					<ul class="my-vertical-bar">
						<li>
							<span class="glyphicon glyphicon-pencil"></span>
							<span>Compose Post</span>
						</li>
						<li>
							<div class="my-file-uploader">
								<form id="my_file_upload_form" action="post_uploader.php" method="Post" runat="server" enctype="multipart/form-data">
									<span class="glyphicon glyphicon-picture"></span>
									<label for="my_upload_file">Photos/Video Album</label>
									<input type="file" name="my_upload_file" id="my_upload_file"  accept=".jpg, .png, .gif, .mp4" />
									<input type="hidden" name="my_upload_file_name" id="my_upload_file_name" />
									<input type="hidden" name="my_upload_file_desc" id="my_upload_file_desc" />
									<input type="hidden" name="my_upload_file_status" id="my_upload_file_status" />
								</form>
							</div>
						</li>
					</ul>
				</div>
				<form action="post_uploader.php" method="Post" class="my-status-uploader">
					<div class="panel-body row">
						<div class="col-md-1">
							<div class="img-div">
								<img src="<?php echo $profile_photo; ?>" alt="">
							</div>
						</div>
						<div class="col-md-11">
							<div class="form-group my-form-control">
									<textarea class="form-control" id="my_user_status" name="my_user_status" placeholder="What's on your mind?" rows="3"></textarea>
							</div> 
						</div>
					</div>
					<div class="panel-footer nav">
						<input type="submit" class="btn btn-sm navbar-right" name="my_upload_status_form" value="Share" />
					</div>
				</form>
			</div>
			
						
			<?php  
				/*$email = $_SESSION["email"];
				$name = "";*/
				$query = "SELECT * FROM my_post where email='$email' ORDER BY post_id DESC"; 
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
						echo '
							<div class="panel panel-default my-posts">
								<div class="panel-heading">
									<div class="row">
										<div class="col-md-1">
											<div class="img-div">
												<img src="'.$uploader_img.'" alt="">
											</div>
										</div>
										<div class="col-md-10">
											<div class="text-div">
												<span><a href="#"><strong>'.$uploader_name.'</strong></a> shared <a href="#">'.$row["name"].'</a></span>
												<br />
												<span>'.$row["date"].' at</span> <span>'.$row["time"].'</span>
											</div>
										</div>
										<div class="col-md-1">
											<div class="dropdown">
												<span class="glyphicon glyphicon-option-horizontal dropdown-toggle" data-toggle="dropdown"></span>
												<ul class="dropdown-menu">
							';							
														if($row["security_status"] == "public"){
															echo '<li><a href="#" class="change_post_status" my_post_status_data="private" my_post_id="'.$post_id.'">make private</a></li>';
														}
														else if($row["security_status"] == "private"){
															echo '<li><a href="#" class="change_post_status" my_post_status_data="public" my_post_id="'.$post_id.'">make public</a></li>';
														}
							echo '
													<li><a href="#" class="delete_post" my_post_id="'.$post_id.'">delete</a></li>
												</ul>
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
																		<h4 class="modal-title">Name</h4>
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
										<div class="col-md-6">
											<ul class="my-vertical-bar" style="text-align:right;">
						';
												$query2 = "SELECT * FROM my_post_like where post_id='$post_id' and email='$email'";
												$result2 = mysqli_query($connect, $query2);  
												if(mysqli_num_rows($result2) > 0) {  
													while($row2 = mysqli_fetch_array($result2)){ 
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
									</div>
								</div>
							</div>
						';
					}
				}
				else {
					echo '
						<div class="alert alert-danger alert-dismissible">
							<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
							<strong>Sorry!</strong> No post is available to watch on your wall.
						</div>
						<div class="alert alert-info alert-dismissible">
							<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
							<strong>Feeling Excited!</strong> Add your first post now.
						</div>
					';
				}
			?> 
		</div>
		<div class="col-md-3">
			&nbsp;
		</div>
		<div class="col-md-1">
			&nbsp;
		</div>
	</div>
</div>

<!-- Modal box for posting  -->
<div id="myModal_for_posting" class="modal fade" role="dialog">
	<div class="modal-dialog my-modal-poster modal-sm">
		<!-- Modal content-->
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<span class="bold">Photos/Video</span>
			</div>
			<form id="my_posting_form" action="" method="Post">
				<div class="modal-body">
					<div class="form-group row">
						<div class="col-md-12 my-padding">
							<input type="text" name="name" id="post_name" class="form-control" placeholder="Enter name of content ... " pattern="[A-Za-z]+"  title="Enter name of content ... " required>
						</div>
						<div class="col-md-12 my-padding">
							<img src="" id="my_posting_img_preview" alt="Lights" title="" style="width:100%">
							<video width="100%" id="my_posting_video_container"> <!-- controls -->
								  <source src="" id="my_posting_video_preview" type="video/mp4">
								Your browser does not support the video tag.
							</video> 
						</div>
						<div class="col-md-12 my-padding">
							<textarea class="form-control" id="post_desc" name="post_desc" placeholder="Write something about this post ... " rows="3"></textarea>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<ul class="my-vertical-bar">
						<li class="my-li">
							<select name="post_status" id="post_status"  required>
								<option value="" selected>Select</option>
								<option value="public" >Public</option>
								<option value="private" >Private</option>
							</select>
						</li>
						<li  class="my-li">
							<input type="button" id="my_post" class="btn btn-default btn-xs" value="Post" />
						</li>
					</ul>
				</div>
			</form>
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
	<!-- <script src="https://cdn.rawgit.com/mervick/emojionearea/master/dist/emojionearea.min.js"></script> -->
	<script type="text/javascript" src="js/emojionearea/dist/emojionearea.js"></script>
	<script src="js/croppie.js"></script>
	<script src="js/script.js"></script>
	<script></script> 
<!-- //script -->
</body>
</html>