<?php
$connect = mysqli_connect("localhost", "root", "", "my_facebook_data");
// Check connection
if (!$connect) {
    die("Connection failed: " . mysqli_connect_error());
	// Change character set to utf8
	mysqli_set_charset($connect,"utf8mb4");

}
?>  