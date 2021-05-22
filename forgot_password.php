<?php 
include('includes/config.php');
?>
<!DOCTYPE html>  
<html>
<head>
	<link rel="icon" href="images/logo.png" type="image/png">
	<title>friendsbook | Forgot Password</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<link rel="stylesheet" href="css/style.css">
	
	<link href="https://fonts.googleapis.com/css?family=Roboto+Condensed:300,400" rel="stylesheet"> 
	
	<style>	

	</style>
</head>
<body id="myPage" data-spy="scroll" data-target=".navbar" data-offset="60" style="background:#e9ebee;">
<nav class="navbar navbar-default navbar-fixed-top my-navbar">
	<div class="container">
		<div class="col-md-7">
			<div class="navbar-header my-navbar-header">
				<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>                        
				</button>
				<a class="navbar-brand my-navbar-brand" href="index.php">friendsbook</a>
			</div>
		</div>
		<div class="col-md-4">
			<div class="collapse navbar-collapse" id="myNavbar">
				<ul class="nav navbar-nav my-navbar-nav navbar-right">
					<li><a href="registration.php">New to Friendsbook Join Today!</a></li>
				</ul>
			</div>
		</div>
		<div class="col-md-1">
			&nbsp;
		</div>
	</div>
</nav>
<div class="container my-forgot-password my-registration-page" style="margin-top:60px;">
	<div class="row">
		<div class="col-md-4">
			&nbsp;
		</div>
		<div class="col-md-4">
			<form method="POST">
				<div class="form-group row">
					<div class="col-md-12 my-padding">
						<h2 class="bold">Password Recovery</h2>
						<h4>Get Your Password Here</h4>
					</div>
					<div class="col-md-12 my-padding">
							<input type="text" name="email" class="form-control" placeholder="Email address" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$" title="Eg. john121.dsouza@gmail.com. You'll use this when you log in and your ever need to reset your password" required>
						</div>
						<div class="col-md-12 my-padding">
							<select name="question" class="form-control" required>
									<option value="" selected>Select Security Question</option>
									<option value="What is your best friend name?" >What is your best friend name?</option>
									<option value="What is your favourite teacher name?" >What is your favourite teacher name?</option>
									<option value="Who is your favourite pet?" >Who is your favourite pet?</option>
									<option value="What is of your dream place where you want to visit?" >What is of your dream place where you want to visit?</option>
							</select>
						</div>
						<div class="col-md-12 my-padding">
							<input type="text" name="answer" class="form-control" placeholder="Enter your answer" pattern="[A-Za-z]+" title="Enter charcters only eg. John" required>
						</div>
						<div class="col-md-12 my-padding">
							<input type="password" name="password" class="form-control" placeholder="New password" pattern=".{6,}" title="Enter combination of least six numbers, letters and punctuation marks (like ! and &). Eg. Password@123" required>
						</div>
						<div class="col-md-4 my-padding">
							<input type="submit" class="btn" name="forgot_password" value="Change password">
						</div>
						<div class="col-md-12 my-padding">
							<span id="error_message" class="text-danger bold"><?php if(isset($error_message)) { echo $error_message; } ?></span>
						</div>
					</div>
				</div>
			</form>
		</div>
		<div class="col-md-4">
			&nbsp;
		</div>
	</div>
</div>

<!-- script -->
<script src="js/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>

<script>

</script>

<!-- //script -->
</body>
</html>