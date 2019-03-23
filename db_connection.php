<?php 

	$mysqli = @mysqli_connect('localhost','root','', 'cr11_benjamin_schneider_travelmatic');
	if (!$mysqli) {
	   die("Connection failed: " . mysqli_connect_error());
	}
?>