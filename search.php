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

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Search</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css">
	<link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
	<div class="navbar">
		<p><a href="home.php">Travel-o-matic blog</a></p>
		<h4><a href="restaurant.php">Restaurants</a></h4>
		<p></p>
		<h4><a href="events.php">Events</a></h4>
		<p></p>
		<h4><a href="search.php">Search...</a></h4>
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
			<h1>Search for a record by Name</h1>
			<hr>
		</div>
		<div class="maincontent">
			<input id="test" name="test" class="searchbar" value="" type="text" placeholder="Search...">
		</div>
		<div id="content">
			<script>
				var request;

				$("#test").keyup(function(event){

				   event.preventDefault();

				   if (request) {
				       request.abort();
				   }

				   var $form = $(this);

				   var $inputs = $form.find("input, select, button, textarea");

				   var serializedData = $form.serialize();

				   $inputs.prop("disabled", true);

				   request = $.ajax({
				       url: "searchdata.php",
				       type: "post",
				       data: serializedData
				   });

				   request.done(function (response, textStatus, jqXHR){

				        document.getElementById("content").innerHTML=response;
				     });

				   request.fail(function (jqXHR, textStatus, errorThrown){
				   });

				   request.always(function () {
				       $inputs.prop("disabled", false);
				   });
				});
			</script>
		</div>
	</div>
	<div class="footer">
		<p>Benjamin Schneider - CodeFactory 2019</p>
	</div>
</body>
</html>