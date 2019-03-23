<?php

	session_start();

	require_once 'db_connection.php';

	if (isset($_SESSION['user'])){
		$res=mysqli_query($mysqli, "SELECT * FROM `userdata` WHERE userdata_id=". $_SESSION['user']. "");
		$userRow=mysqli_fetch_array($res, MYSQLI_ASSOC);
	}

	if (isset($_SESSION['admin'])){
		$res=mysqli_query($mysqli, "SELECT * FROM `userdata` WHERE userdata_id=". $_SESSION['admin']. "");
		$userRow=mysqli_fetch_array($res, MYSQLI_ASSOC);
	}

	if(!isset($_SESSION['admin']) && !isset($_SESSION['user'])){
		header("Location: login.php");
	}

	$log = "Login";

	if(isset($_SESSION['admin']) || isset($_SESSION['user'])){
		$log = "Logout";
	}

	if(isset($_POST['createThingToDo'])){

		$thingsToDoName = $_POST['thingsToDoName'];
		$thingsToDoImage = $_POST['thingsToDoImage'];
		$thingsToDoAddress = $_POST['thingsToDoAddress'];
		$thingsToDoType = $_POST['thingsToDoType'];
		$thingsToDoDesc = $_POST['thingsToDoDesc'];
		$thingsToDoWebAddress = $_POST['thingsToDoWebAddress'];

		$sql = "INSERT INTO `thingstodo`(`thingsToDoName`, `thingsToDoImage`, `thingsToDoAddress`, `thingsToDoType`, `thingsToDoDesc`, `thingsToDoWebAddress`) VALUES ('$thingsToDoName', '$thingsToDoImage', '$thingsToDoAddress', 'thingsToDoType', '$thingsToDoDesc', '$thingsToDoWebAddress')";

		if($mysqli->query($sql) === TRUE) {
			header("Location: a_create.php");
		}
		else {
			echo "Error while updating record : ". $mysqli->error;
		}
	}

?>


<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Create</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css">
	<link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
	<div class="navbar">
		<p>Travel-o-matic blog</p>
		<span class="navbar-login">
			<a href="login.php" title=" <?php echo $log ?>">
			<?php
				if (isset($_SESSION['user'])) {
					$displayName = $userRow['userFirstName']. " ". $userRow['userLastName'][0]. ".";
					echo '<i class="fas fa-sign-out-alt"></i> '. $displayName;
				}
				elseif (isset($_SESSION['admin'])) {
					$displayName = $userRow['userFirstName']. " ". $userRow['userLastName'][0]. ".";
					echo '<i class="fas fa-sign-out-alt"></i> '. $displayName. " ADMIN";
				}	
				else {
					echo '<i class="fas fa-sign-in-alt"></i> Login';
				}
			?>
			</a>
		</span>
	</div>
	<div class="container">
		<div class="pageheader">
			<h1>Create a new Thing To Do!</h1>
		</div>
		<a class="mainpageback" href="home.php"><i class="fas fa-arrow-left"></i> Back to main page</a>
		<hr>
		<form method="post">
			<p>Name</p>
			<input type="text" name="thingsToDoName" maxlength="55" required>
			<p>Image (url)</p>
			<input type="text" name="thingsToDoImage" maxlength="500" required>
			<p>Address</p>
			<input type="text" name="thingsToDoAddress" maxlength="100" required>
			<p>Type (what kind of thing)</p>
			<input type="text" name="thingsToDoType" maxlength="55" required>
			<p>Description (max:100)</p>
			<textarea name="thingsToDoDesc" maxlength="100" required></textarea>
			<p>Web Address</p>
			<input type="text" name="thingsToDoWebAddress" maxlength="200" required>
			<br>
			<input class="btn btn-success" type="submit" name="createThingToDo" value="CREATE">
		</form>
	</div>
	<div class="footer">
		<p>Benjamin Schneider - CodeFactory 2019</p>
	</div>
</body>
</html>