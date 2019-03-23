<?php 

	include_once 'db_connection.php';

	$userEmail = trim(strtolower($_POST['userEmail']));

	$query ="SELECT userEmail FROM `userdata` WHERE userEmail = '$userEmail'";

	$result = $mysqli->query($query);

	$num = mysqli_num_rows($result);

	echo $num;

 ?>