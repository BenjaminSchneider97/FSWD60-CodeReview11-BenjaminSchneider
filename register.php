<?php

	session_start();

	if(isset($_SESSION['user']) || isset($_SESSION['admin'])){
		header("Location: home.php");
	}

	require_once 'db_connection.php';

	$userFirstName = "";
	$userLastName = "";
	$userEmail = "";
	$userPassword = "";
	$userEmailError = "";
	$error = false;

	if(isset($_POST['signup'])){
		$userFirstName = $_POST['userFirstName'];
		$userLastName = $_POST['userLastName'];
		$userEmail = $_POST['userEmail'];
		$userPassword = $_POST['userPassword'];

		$userPass = hash('sha256', $userPassword);

		$sqlQuery = "SELECT userEmail FROM `userdata` WHERE userEmail='$userEmail'";
		$result = mysqli_query($mysqli, $sqlQuery);
		$emailRows = mysqli_num_rows($result);

		if($emailRows!=0){
			$error = true;
			$userEmailError = "That Email is already in use.";
		}
		elseif (!filter_var($userEmail, FILTER_VALIDATE_EMAIL)){
			$error = true;
			$userEmailError = "Please enter valid email address.";
		}

		if(!$error){
			$sql = "INSERT INTO `userdata` (userFirstName, userLastName, userEmail, userPassword) VALUES ('$userFirstName', '$userLastName', '$userEmail', '$userPass')";
			header("Location: a_registration.php");

			if($mysqli->query($sql) === FALSE){
				echo "Error signing up". $mysqli->connect_error;
				}
		}
	}

	$log = "Login";

	if(isset($_SESSION['admin']) || isset($_SESSION['user'])){
		$log = "Logout";
	}

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Registration</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css">
	<link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
	<script type="text/javascript">
		$(document).ready(function(){

			$('.emailSuccess').hide();
			$('.emailFail').hide();

			$('#emailCheck').keyup(useremailcheck);
			});
				
			function useremailcheck(){
				
				var userEmail = $('#emailCheck').val();

				if (isEmail(userEmail)) {
					jQuery.ajax({
						type: "POST",
						url: "checkEmail.php",
						data: "userEmail=" + userEmail,
						cache: false,
						success: function(response){
							console.log(response);
							if(response > 0){
								$('.emailFail').show();
								$('.emailSuccess').hide();
							}
							else{
								$('.emailSuccess').show();
								$('.emailFail').hide();
							}
						}
					});
				}

			function isEmail(email) {
				var isemail = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
				return isemail.test(email);
			}
		}
	</script>
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
		<h1 class="pageheader">Create an account!</h1>
		<hr>
		<form class="loginform" method="post" accept-charset="utf-8">
			<div class="loginfield">
				<i class="fas fa-user"></i>
				<input type="text" name="userFirstName"  placeholder="First Name" value="<?php echo $userFirstName ?>" maxlength="55" required>
			</div>
			<div class="loginfield">
				<i class="fas fa-user"></i>
				<input type="text" name="userLastName"  placeholder="Last Name" value="<?php echo $userLastName ?>" maxlength="55" required>
			</div>
			<div class="loginfield">
				<i class="fas fa-envelope"></i>
				<input id="emailCheck" type="text" name="userEmail"  placeholder="Email" value="<?php echo $userEmail ?>" maxlength="55" required>
				<div class="emailFail"><i class="fas fa-times emailChecker"></i></div>
				<div class="emailSuccess"><i class="fas fa-check emailChecker"></i></div>
			</div>
			<span><?php echo $userEmailError ?></span>
			<div class="loginfield">
				<i class="fas fa-key"></i>
				<input type="password" name="userPassword" placeholder="Password" maxlength="255" required>
			</div>
			<input class="btn btn-success loginbutton" type="submit" name="signup" value="Sign up">
		</form>
	</div>
	<div class="footer">
		<p>Benjamin Schneider - CodeFactory 2019</p>
	</div>
</body>
</html>