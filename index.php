<?php 
include('includes/config.php');
?>
<!DOCTYPE html>  
<html>
<head>
	<link rel="icon" href="images/logo.png" type="image/png">
	<title>Sign in to friendsbook</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<link rel="stylesheet" href="css/style.css">
	
	<link href="https://fonts.googleapis.com/css?family=Roboto+Condensed:300,400" rel="stylesheet"> 
	
	<style>	

	</style>
</head>
<body id="myPage" data-spy="scroll" data-target=".navbar" data-offset="60" style="background:linear-gradient(white, #D3D8E8); background-size:contain;">
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
					<li><a href="registration.php">New to friendsbook Join Today!</a></li>
				</ul>
			</div>
		</div>
		<div class="col-md-1">
			&nbsp;
		</div>
	</div>
</nav>
<div class="container my-login-page" style="margin-top:120px;">
	<div class="row">
		<div class="col-md-6">
			<h4>friendsbook helps you connect and share with the people in your life.</h4>
			<img src="images/connectivity.png">
		</div>
		<div class="col-md-1">
			&nbsp;
		</div>
		<div class="col-md-4">
			<form method="POST">
				<h3 class="bold">Sign in to friendsbook</h3>
				<div class="form-group">
					<label>Email:</label>
					<input type="email" name="email" class="form-control" value="<?php if(isset($_COOKIE["member_email"])) { echo $_COOKIE["member_email"]; } ?>" required>
				</div>
				<div class="form-group">
					<label>Password:</label>
					<input type="password" name="password" class="form-control" value="<?php if(isset($_COOKIE["member_password"])) { echo $_COOKIE["member_password"]; } ?>" required>
				</div>
				<div class="checkbox">
					<label><input type="checkbox" name="remember" <?php if(isset($_COOKIE["member_email"])) { ?> checked <?php } ?>> Remember me</label>
					<button type="submit" name="login" class="btn btn-default">Sign in</button>
				</div>
			</form>
			<div class="my-forgot-pass">
				<span class="glyphicon glyphicon-question-sign"></span>
				Forgot your <a href="forgot_password.php">password</a> ?
			</div>
			<!--<div class="resigter-link">
				<a href="#">New to friendsbook?</a><span class="bold"> Join Today!</span>
			</div> -->
		</div>
		<div class="col-md-1">
			&nbsp;
		</div>
	</div>
	<div class="row my-footer">
		<div class="col-md-12">
			<hr/>
			<p>friendsbook helps you connect and share with the people in your life. It's free and always will be.</p>
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