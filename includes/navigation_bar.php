

<nav class="navbar navbar-default navbar-fixed-top my-navbar">
	<div class="container">
	<div class="col-md-7">
		<div class="navbar-header my-navbar-header">
			<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>                        
			</button>
			<a class="navbar-brand my-navbar-brand" href="home.php">friendsbook</a>
		</div>
		<form class="navbar-form navbar-left" action="search_list.php"  method="POST">
			<div class="input-group  my-friend-search">
				<input type="text" id="show_friend_search" name="show_friend_search" class="form-control" autocomplete="off" placeholder="Search" required>
				<div id="show_friend_search_result" class="show-friend-search-result"></div>
				<div class="input-group-btn">
					<button class="btn btn-default" type="submit">
						<i class="glyphicon glyphicon-search"></i>
					</button>												
				</div>
			</div>
		</form>
	</div>
	<div class="col-md-4">
		<div class="collapse navbar-collapse" id="myNavbar">
			<ul class="nav navbar-nav my-navbar-nav navbar-right" >
				<li><a href="profile.php" title="Your Profile"><?php echo $name; ?></a></li>
				<!-- <li><a href="home.php">Home</a></li> -->
				<li class="my-icon-color">
					<a href="home.php" title="Home Page">
						<i class="material-icons nav-icon">home</i>
					</a>
				</li>
				<li class="my-icon-color">
					<a href="javascript:void(0)" id="show_friend_request" class="" title="Friend(s) Request">
						<i class="material-icons nav-icon">group</i>
						<mark id="total_friend_request"></mark>
					</a>
					<div id="show_friend_request_result" class="show_friend_request_result"></div>
				</li>
				<!-- <li><a href="logout.php">Logout</a></li> -->
				<li class="my-icon-color">
					<a href="logout.php" title="Logout">
						<i class="material-icons nav-icon">logout</i>
					</a>
				</li>
			</ul>
		</div>
	</div>
	<div class="col-md-1">
		&nbsp;
	</div>
	</div>
</nav>
