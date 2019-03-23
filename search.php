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
			// Variable to hold request
			var request;

			// Bind to the submit event of our form
			$("#test").keyup(function(event){

			   // Prevent default posting of form - put here to work in case of errors
			   event.preventDefault();

			   // Abort any pending request
			   if (request) {
			       request.abort();
			   }
			   // setup some local variables
			   var $form = $(this);

			   // Let's select and cache all the fields
			   var $inputs = $form.find("input, select, button, textarea");//JULAN - always name all to be safe

			   // Serialize the data in the form
			   var serializedData = $form.serialize();

			   // Let's disable the inputs for the duration of the Ajax request.
			   // Note: we disable elements AFTER the form data has been serialized.
			   // Disabled form elements will not be serialized.
			   $inputs.prop("disabled", true);

			   // Fire off the request to /form.php ->JULAN or the php file you are working on
			   request = $.ajax({
			       url: "searchdata.php",
			       type: "post",
			       data: serializedData
			   });

			   // Callback handler that will be called on success
			   request.done(function (response, textStatus, jqXHR){
			       // Log a message to the console
			        document.getElementById("content").innerHTML=response;
			     });

			   // Callback handler that will be called on failure
			   request.fail(function (jqXHR, textStatus, errorThrown){
			       // Log the error to the console
			       /*console.error(
			           "The following error occurred: "+
			           textStatus, errorThrown,jqXHR
			       );*/
			   });

			   // Callback handler that will be called regardless
			   // if the request failed or succeeded
			   request.always(function () {
			       // Reenable the inputs
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