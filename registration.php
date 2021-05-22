<?php 
include('includes/config.php');
?>
<!DOCTYPE html>  
<html>
<head>
	<link rel="icon" href="images/logo.png" type="image/png">
	<title>Sign up to friendsbook</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<link rel="stylesheet" href="css/style.css">
	
	<link href="https://fonts.googleapis.com/css?family=Roboto+Condensed:300,400" rel="stylesheet"> 
	
</head>
<body id="myPage" data-spy="scroll" data-target=".navbar" data-offset="60" style="background:linear-gradient(white, #D3D8E8);">
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
					<li><a href="index.php">Already have a account!</a></li>
				</ul>
			</div>
		</div>
		<div class="col-md-1">
			&nbsp;
		</div>
	</div>
</nav>
<div class="container my-registration-page" style="">
	<div class="row">
		<div class="col-md-6"  style="margin-top:100px;">
			<h4>Friendsbook helps you connect and share with the people in your life.</h4>
			<img src="images/connectivity.png">
		</div>
		<div class="col-md-1">
			&nbsp;
		</div>
		<div class="col-md-4"  style="margin-top:60px;">
			<form method="POST">
				<div class="form-group row">
					<div class="col-md-12 my-padding">
						<h2 class="bold">Create an account</h2>
						<h4>It's free and always will be.</h4>
					</div>
					<div class="col-md-6 my-padding">
						<input type="text" name="firstname" class="form-control" placeholder="First name" pattern="[A-Za-z]+" title="Enter charcters only eg. John" required>
					</div>
					<div class="col-md-6 my-padding">
						<input type="text" name="lastname" class="form-control" placeholder="Surname" pattern="[A-Za-z]+" title="Enter charcters only eg. Dsouza" required>
					</div>
					<div class="col-md-12 my-padding">
						<input type="text" name="email" class="form-control" placeholder="Email address" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$" title="Eg. john121.dsouza@gmail.com. You'll use this when you log in and your ever need to reset your password" required>
					</div>
					<div class="col-md-12 my-padding">
						<input type="password" name="password" class="form-control" placeholder="New password" pattern=".{6,}" title="Enter combination of least six numbers, letters and punctuation marks (like ! and &). Eg. Password@123" required>
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
						<label style="margin-bottom:0;">Birthday</label>
					</div>
					<div class="col-md-4 my-padding">
						<select name="day" class="form-control" id="day" required>
								<option value="" selected>Day</option>
						</select>
					</div>
					<div class="col-md-4 my-padding">
						<select name="month" class="form-control" id="month" required>
							<option value="" selected>Month</option>
							<option value="jan">Jan</option>
							<option value="feb">Feb</option>
							<option value="mar">Mar</option>
							<option value="april">April</option>
							<option value="may">May</option>
							<option value="june">June</option>
							<option value="july">July</option>
							<option value="aug">Aug</option>
							<option value="sept">Sept</option>
							<option value="oct">Oct</option>
							<option value="nov">Nov</option>
							<option value="dec">Dec</option>
						</select>
					</div>
					<div class="col-md-4 my-padding">
						<select name="year" class="form-control" id="year">
							<option value="" selected>Year</option>
						</select>
					</div>
					<div class="col-md-4 my-padding">
						<label class="radio-inline"><input type="radio" value="female" name="gender" required>Female</label>
					</div>
					<div class="col-md-8 my-padding">
						<label class="radio-inline"><input type="radio" value="male" name="gender" required>Male</label>
					</div>
					<div class="col-md-12 my-padding">
						By clicking Sign Up, you agree to our <a href="javascript:void(0);">Terms</a>, <a href="javascript:void(0);">Data Policy</a> and <a href="javascript:void(0);">Cookie Policy</a>. You may receive SMS notifications from us and can opt out at any time.
					</div>
					<div class="col-md-4 my-padding">
						<input type="submit" class="btn" name="registration" value="Sign up">
					</div>
				</div>
			</form>
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
window.onload = birthday;
	function birthday(){
		var today_date = new Date();
		var year = today_date.getFullYear();
		var i=0, temp_string="";
		for(i=2018;i>=1905;i--){
			temp_string += "<option value='"+i+"'>"+i+"</option>"; 
		}
		document.getElementById("year").innerHTML += temp_string;
		temp_string="";
		for(i=1;i<=31;i++){
			temp_string += "<option value='"+i+"'>"+i+"</option>"; 
		}
		document.getElementById("day").innerHTML += temp_string;
	}
</script>

<!-- //script -->
</body>
</html>