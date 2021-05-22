<?php  
	session_start();  
	if(!isset($_SESSION["email"])){  
		header("location:index.php?action=login");  
	}
		
	include('includes/database_connection.php');
	$email = $_SESSION["email"];
	$name = "";
	$query = "SELECT * FROM registration WHERE email = '$email'"; 
	$result = mysqli_query($connect, $query);  
	if(mysqli_num_rows($result) > 0) {  
		while($row = mysqli_fetch_array($result)){  
			$name .= $row["firstname"].' '.$row["lastname"];
		}
	}
?> 

<!DOCTYPE html>  
<html>
<head>
	<link rel="icon" href="images/logo.png" type="image/png">
	<title>Friends book - Search</title>
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

<span id="uploaded_image"></span> <!-- dummy div for update cover and profile picture -->
<div class="container" style="margin-top:60px;">
	<div class="row">
		<div class="col-md-9">
			<div class="panel panel-default my-search-panel">
				<div class="panel-heading">
						<h4><i class="glyphicon glyphicon-search"></i> Search Friends <h4>
						<a href="search_list.php"> List all the members </a>
				</div>
				<div class="panel-body">
					<?php
						$fullname = ""; 
						$firstname = "";
						$lastname = "";
						
						if(isset($_POST["show_friend_search"])) {
							$data = $_POST["show_friend_search"];
							$temp_array = explode(" ", $data);
							$temp_array_size = count($temp_array);
							if($temp_array_size == 1){
								$firstname = $temp_array[0];
								$lastname = $temp_array[0];
							}
							else if($temp_array_size == 2){
								$firstname = $temp_array[0];
								$lastname = $temp_array[1];
							}
							$query = "SELECT * FROM registration WHERE firstname LIKE '%".$firstname."%' OR lastname LIKE '%".$lastname."%' ORDER BY firstname " ;  
						} 
						else {
							$query = "SELECT * FROM registration ORDER BY firstname ";
						}
						
						echo '
							<div class="row">
						';
								
								$result = mysqli_query($connect, $query);  
								if(mysqli_num_rows($result) > 0){
									while($row = mysqli_fetch_array($result)){  
										if($row["email"] != $email) {
											$others_email = $row["email"];
											$fullname = $row["firstname"].' '.$row["lastname"]; 
											$profile_photo = "";
											if($row["profile_photo"] != ""){
												$profile_photo = $row["profile_photo"];
											}
											else {
												$profile_photo = "images/dummy_profile_pic.jpg";
											}
											
											echo '
													<div class="col-md-12">
														<ul>
															<li>
																<img src="'.$profile_photo.'" alt="">
															</li>
															<li>
																<a href="others_profile.php?temp='.$row["email"].'">'.$fullname.'</a>
															</li>
											';
											
															$count_appearance = 0;
															$query2 = "SELECT * FROM friends"; 
															$result2 = mysqli_query($connect, $query2);  
															if(mysqli_num_rows($result2) > 0) {  
																while($row2 = mysqli_fetch_array($result2)){
																	if($row2["friend1_id"] == "$email" && $row2["friend2_id"] == "$others_email") {
																		$count_appearance = $count_appearance + 1;
																		if($row2["status"] == 1){ // request has been sent
																			echo '
																				<li>
																					<button type="button" request_id="'.$row2["request_id"].'"  friends_email="'.$others_email.'" class="delete_request_btn btn btn-default btn-xs ">
																						<span class="glyphicon glyphicon-remove"> </span> 
																						cancel request
																					</button>
																					<button type="button" class="btn btn-success btn-xs" >
																						<span class="glyphicon glyphicon-plus"> </span> 
																						Friend request sent
																					</button>
																				</li>
																			';
																		}
																		if($row2["status"] == 2){ // request accepted
																			echo '
																				<li>
																					<button type="button" 
																					request_id="'.$row2["request_id"].'"  friends_email="'.$others_email.'" class="delete_request_btn btn btn-default btn-xs">
																						<span class="glyphicon glyphicon-remove"> </span> 
																						Un Friends
																					</button>
																					<button type="button" class="btn btn-success btn-xs">
																						<span class="glyphicon glyphicon-plus"> </span> 
																						Friends
																					</button>
																				</li>
																			';
																		}
																	}
																	else if($row2["friend1_id"] == "$others_email" && $row2["friend2_id"] == "$email") {
																		$count_appearance = $count_appearance + 1;
																		if($row2["status"] == 1){ // friend request is pending
																			echo '
																				<li>
																					<button type="button" request_id="'.$row2["request_id"].'"  friends_email="'.$others_email.'" class="delete_request_btn btn btn-default btn-xs">
																						<span class="glyphicon glyphicon-remove"> </span> 
																						Not now
																					</button>
																					<button type="button" request_id="'.$row2["request_id"].'"  friends_email="'.$others_email.'" class="accept_request_btn btn btn-success btn-xs">
																						<span class="glyphicon glyphicon-plus"> </span> 
																						Confirm friend request
																					</button>
																				</li>
																			';
																		}
																		if($row2["status"] == 2){ // confirmed pending friend request
																			echo '
																				<li>
																					<button type="button" 
																					request_id="'.$row2["request_id"].'"  friends_email="'.$others_email.'" class="delete_request_btn btn btn-default btn-xs">
																						<span class="glyphicon glyphicon-remove"> </span> 
																						Un Friends
																					</button>
																					<button type="button" class="btn btn-success btn-xs">
																						<span class="glyphicon glyphicon-plus"> </span> 
																						Friends
																					</button>
																				</li>
																			';
																		}
																	}
																}
															}
															
															if($count_appearance == 0) {
																echo '
																	<li>
																		<button type="button" friends_email="'.$others_email.'" class="request_sender_btn btn btn-success btn-xs">
																			<span class="glyphicon glyphicon-plus"> </span> 
																			Add friend
																		</button>
																	</li>
																';
															}
											echo '
														</ul>
													</div>
											';
										}
									}  
								}  
								else {  
									echo '
										<div class="col-md-6">
											Name Not Found.
										</div>
									';
								}  
						echo '
							</div>
						';
						 
						
					?>
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