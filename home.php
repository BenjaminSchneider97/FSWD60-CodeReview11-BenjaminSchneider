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

	//For creating/updating/deleting the Things to do

	if(isset($_POST['createThingsToDo'])){

		$thingsToDoName = $_POST['thingsToDoName'];
		$thingsToDoImage = $_POST['thingsToDoImage'];
		$thingsToDoAddress = $_POST['thingsToDoAddress'];
		$thingsToDoType = $_POST['thingsToDoType'];
		$thingsToDoDesc = $_POST['thingsToDoDesc'];
		$thingsToDoWebAddress = $_POST['thingsToDoWebAddress'];

		$sql = "INSERT INTO `thingstodo` (`thingsToDoName`, `thingsToDoImage`, `thingsToDoAddress`, `thingsToDoType`, `thingsToDoDesc`, `thingsToDoWebAddress`) VALUES ('$thingsToDoName', '$thingsToDoImage', '$thingsToDoAddress', '$thingsToDoType', '$thingsToDoDesc', '$thingsToDoWebAddress')";

		if($mysqli->query($sql) === TRUE) {
			header("Location: home.php");
		}
		else {
			echo "Error while updating record : ". $mysqli->error;
		}
	}

	if(isset($_POST['updateThingsToDo'])){

		$id = $_POST['thingsToDo_id'];

		$thingsToDoName = $_POST['thingsToDoName'];
		$thingsToDoImage = $_POST['thingsToDoImage'];
		$thingsToDoAddress = $_POST['thingsToDoAddress'];
		$thingsToDoType = $_POST['thingsToDoType'];
		$thingsToDoDesc = $_POST['thingsToDoDesc'];
		$thingsToDoWebAddress = $_POST['thingsToDoWebAddress'];

		$sql = "UPDATE `thingstodo` SET thingsToDoName = '$thingsToDoName', thingsToDoImage = '$thingsToDoImage', thingsToDoAddress = '$thingsToDoAddress', thingsToDoType = '$thingsToDoType', thingsToDoDesc = '$thingsToDoDesc', thingsToDoWebAddress = '$thingsToDoWebAddress' WHERE thingsToDo_id = {$id}";

		if($mysqli->query($sql) === TRUE) {
			header("Location: home.php");
		} else {
			echo "Error while updating record: ". $mysqli->error;
		}
	}

	if(isset($_POST['deleteThingsToDo'])){

		$id = $_POST['thingsToDo_id'];

		$sql = "DELETE FROM `thingstodo` WHERE thingsToDo_id = {$id}";

		if($mysqli->query($sql) === TRUE) {
			header("Location: home.php");
		} else {
			echo "Error while deleting record: ". $mysqli->error;
		}
	}

	//For creating/updating/deleting the Restaurants

	if(isset($_POST['createRestaurant'])){

		$restaurantName = $_POST['restaurantName'];
		$restaurantImage = $_POST['restaurantImage'];
		$restaurantAddress = $_POST['restaurantAddress'];
		$restaurantType = $_POST['restaurantType'];
		$restaurantDesc = $_POST['restaurantDesc'];
		$restaurantNumber = $_POST['restaurantNumber'];
		$restaurantWebAddress = $_POST['restaurantWebAddress'];

		$sql = "INSERT INTO `restaurant`(`restaurantName`, `restaurantImage`, `restaurantAddress`, `restaurantType`, `restaurantDesc`, `restaurantNumber`, `restaurantWebAddress`) VALUES ('$restaurantName', '$restaurantImage', '$restaurantAddress', '$restaurantType', '$restaurantDesc', '$restaurantNumber', '$restaurantWebAddress')";

		if($mysqli->query($sql) === TRUE) {
			header("Location: home.php");
		}
		else {
			echo "Error while creating record : ". $mysqli->error;
		}
	}

	if(isset($_POST['updateRestaurant'])){

		$id = $_POST['restaurant_id'];

		$restaurantName = $_POST['restaurantName'];
		$restaurantImage = $_POST['restaurantImage'];
		$restaurantAddress = $_POST['restaurantAddress'];
		$restaurantType = $_POST['restaurantType'];
		$restaurantDesc = $_POST['restaurantDesc'];
		$restaurantNumber = $_POST['restaurantNumber'];
		$restaurantWebAddress = $_POST['restaurantWebAddress'];

		$sql = "UPDATE `restaurant` SET restaurantName = '$restaurantName', restaurantImage = '$restaurantImage', restaurantAddress = '$restaurantAddress', restaurantType = '$restaurantType', restaurantDesc = '$restaurantDesc', restaurantNumber = '$restaurantNumber', restaurantWebAddress = '$restaurantWebAddress' WHERE restaurant_id = {$id}";

		if($mysqli->query($sql) === TRUE) {
			header("Location: home.php");
		} else {
			echo "Error while updating record: ". $mysqli->error;
		}
	}

	if(isset($_POST['deleteRestaurant'])){

		$id = $_POST['restaurant_id'];

		$sql = "DELETE FROM `restaurant` WHERE restaurant_id = {$id}";

		if($mysqli->query($sql) === TRUE) {
			header("Location: home.php");
		} else {
			echo "Error while deleting record: ". $mysqli->error;
		}
	}

	//For creating/updating/deleting the Concerts

	if(isset($_POST['createConcert'])){

		$concertName = $_POST['concertName'];
		$concertImage = $_POST['concertImage'];
		$concertDate = $_POST['concertDate'];
		$concertLocation = $_POST['concertLocation'];
		$concertPrice = $_POST['concertPrice'];
		$concertWebAddress = $_POST['concertWebAddress'];

		$sql = "INSERT INTO `concert`(`concertName`, `concertImage`, `concertDate`, `concertLocation`, `concertPrice`, `concertWebAddress`) VALUES ('$concertName', '$concertImage', '$concertDate', '$concertLocation', '$concertPrice', '$concertWebAddress')";

		if($mysqli->query($sql) === TRUE) {
			header("Location: home.php");
		}
		else {
			echo "Error while creating record : ". $mysqli->error;
		}
	}

	if(isset($_POST['updateConcert'])){

		$id = $_POST['concert_id'];

		$concertName = $_POST['concertName'];
		$concertImage = $_POST['concertImage'];
		$concertDate = $_POST['concertDate'];
		$concertLocation = $_POST['concertLocation'];
		$concertPrice = $_POST['concertPrice'];
		$concertWebAddress = $_POST['concertWebAddress'];

		$sql = "UPDATE `concert` SET concertName = '$concertName', concertImage = '$concertImage', concertDate = '$concertDate', concertLocation = '$concertLocation', concertPrice = '$concertPrice', concertWebAddress = '$concertWebAddress' WHERE concert_id = {$id}";

		if($mysqli->query($sql) === TRUE) {
			header("Location: home.php");
		} else {
			echo "Error while updating record: ". $mysqli->error;
		}
	}

	if(isset($_POST['deleteConcert'])){

		$id = $_POST['concert_id'];

		$sql = "DELETE FROM `concert` WHERE concert_id = {$id}";

		if($mysqli->query($sql) === TRUE) {
			header("Location: home.php");
		} else {
			echo "Error while deleting record: ". $mysqli->error;
		}
	}

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Home</title>
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
	<div class="slide">
		
	</div>
	<div class="container">
		<div class="pageheader">
			<h1>Places to visit when you are in Vienna</h1>
		</div>
		<div class="maincontent">
			<!-- Things to do -->
			<div class="row thingsToDo">
				<div class="rowdesc">	
					<h1>Things To Do</h1>
					<?php

						if(isset($_SESSION['admin'])){
							echo '
								<a data-toggle="modal" data-target="#createThingToDo" class="create" title="Create new Thing To Do"><button class="btn btn-success" type="submit" name ="create">Create new entry</button></a>
								<form method="POST" accept-charset="utf-8">
									<div class="modal fade" id="createThingToDo" role="dialog">
										<div class="modal-dialog">
											<div class="modal-content">
												<div class="modal-header">
													<button type="button" class="close" data-dismiss="modal">&times;</button>
													<h4 class="modal-title">Create a new "Thing To Do"</h4>
												</div>
												<div class="modal-body">
													<p>Name</p>
													<input type="text" name="thingsToDoName" maxlength="55" required>
													<p>Image (url)</p>
													<input type="text" name="thingsToDoImage" maxlength="500" required>
													<p>Address</p>
													<input type="text" name="thingsToDoAddress" maxlength="100" required>
													<p>Type (e.g. Museum, Park, Market etc.)</p>
													<input type="text" name="thingsToDoType" maxlength="55" required>
													<p>Description (max:100)</p>
													<textarea name="thingsToDoDesc" maxlength="100" required></textarea>
													<p>Web Address</p>
													<input type="text" name="thingsToDoWebAddress" maxlength="200" required>
												</div>
												<div class="modal-footer">
													<input type="submit" name="createThingsToDo" class="btn btn-success" value="Create">
													<button type="submit" class="btn btn-default" data-dismiss="modal">Go back</button>
												</div>
											</div>
										</div>
									</div>
								</form>
								';
						}

					?>
				</div>
				<hr>

				<?php

				$sql = mysqli_query($mysqli, "SELECT * FROM `thingsToDo`");

				$count = mysqli_num_rows($sql);

				if($count > 0) {
					while($thingsToDoRow = mysqli_fetch_array($sql)){
					echo 
					'
						<div class="card col-lg-3 col-md-6 col-sm-12">
							<div class="cardName">
								<h3>'. $thingsToDoRow["thingsToDoName"]. '</h3>
							</div>
							<div class="cardImage">
								<img src="'. $thingsToDoRow["thingsToDoImage"]. '">
							</div>
							<div class="cardDescription">
								<p><i class="fas fa-map-marker-alt fasdesc"></i>'. $thingsToDoRow["thingsToDoAddress"]. '</p>
								<p><i class="fas fa-question fasdesc"></i>'. $thingsToDoRow["thingsToDoType"]. '</p>
								<p><i class="fas fa-pencil-alt fasdesc"></i>'. $thingsToDoRow["thingsToDoDesc"]. '</p>
								<p><i class="fas fa-globe-europe fasdesc"></i><a target="_blank" href="'. $thingsToDoRow["thingsToDoWebAddress"]. '">'. $thingsToDoRow["thingsToDoWebAddress"]. '</a></p>
							</div>';

							if(isset($_SESSION['admin'])){

								echo 
								'
									<div class="changeButtons">
										<form class="changeform" method="POST" accept-charset="utf-8">
											<input type="hidden" name="thingsToDo_id" value="'.$thingsToDoRow['thingsToDo_id'].'">
											<a data-toggle="modal" data-target="#editThingsToDoModal'. $thingsToDoRow['thingsToDo_id']. '" class="create" title="Edit"><button class="btn btn-primary change" type="submit" name ="edit">Edit</button></a>
											<div class="modal fade" id="editThingsToDoModal'. $thingsToDoRow['thingsToDo_id']. '" role="dialog">
												<div class="modal-dialog">
													<div class="modal-content">
														<div class="modal-header">
															<button type="button" class="close" data-dismiss="modal">&times;</button>
															<h4 class="modal-title">Edit "'. $thingsToDoRow['thingsToDoName']. '"</h4>
														</div>
														<div class="modal-body">
															<p>Name</p>
															<input type="text" name="thingsToDoName" maxlength="55" value="'. $thingsToDoRow['thingsToDoName']. '" required>
															<p>Image (url)</p>
															<input type="text" name="thingsToDoImage" maxlength="500" value="'. $thingsToDoRow['thingsToDoImage']. '" required>
															<p>Address</p>
															<input type="text" name="thingsToDoAddress" maxlength="100" value="'. $thingsToDoRow['thingsToDoAddress']. '" required>
															<p>Type (e.g. Museum, Park, Market etc.)</p>
															<input type="text" name="thingsToDoType" maxlength="55" value="'. $thingsToDoRow['thingsToDoType']. '" required>
															<p>Description (max:100)</p>
															<textarea name="thingsToDoDesc" maxlength="100" required>'. $thingsToDoRow['thingsToDoDesc']. '</textarea>
															<p>Web Address</p>
															<input type="text" name="thingsToDoWebAddress" maxlength="200" value="'. $thingsToDoRow['thingsToDoWebAddress']. '" required>
														</div>
														<div class="modal-footer">
															<input type="submit" name="updateThingsToDo" class="btn btn-primary" value="Update">
															<button type="submit" class="btn btn-default" data-dismiss="modal">Go back</button>
														</div>
													</div>
												</div>
											</div>
										</form>
										<form class="changeform" method="POST" accept-charset="utf-8">
											<input type="hidden" name="thingsToDo_id" value="'.$thingsToDoRow['thingsToDo_id'].'">
											<a data-toggle="modal" data-target="#deleteThingToDoModal'. $thingsToDoRow['thingsToDo_id']. '" class="create" href="deleteThingToDo.php" title="Delete"><button class="btn btn-danger change" type="submit" name ="deleteThingToDo">Delete</button></a>
											<div class="modal fade" id="deleteThingToDoModal'. $thingsToDoRow['thingsToDo_id']. '" role="dialog">
												<div class="modal-dialog">
													<div class="modal-content">
														<div class="modal-header">
															<button type="button" class="close" data-dismiss="modal">&times;</button>
															<h4 class="modal-title">Delete "'. $thingsToDoRow['thingsToDoName']. '"</h4>
														</div>
														<div class="modal-body">
															<h3>Are you sure you want to delete "'. $thingsToDoRow['thingsToDoName']. '"?</h3>
														</div>
														<div class="modal-footer">
															<input type="submit" name="deleteThingsToDo" class="btn btn-danger" value="Delete">
															<button type="submit" class="btn btn-default" data-dismiss="modal">Go back</button>
														</div>
													</div>
												</div>
											</div>
										</form>
									</div>
								';
							}
							echo '
						</div>

					';

					}
				}
				else
				{
					echo '<p>Sorry, no Things to do found!</p>';
				}

				?>

			</div>
			<!-- Restaurants -->
			<div class="row restaurants">
				<div class="rowdesc">	
					<h1>Restaurants</h1>

					<?php

						if(isset($_SESSION['admin'])){
							echo '
								<a data-toggle="modal" data-target="#createRestaurant" class="create" title="Create new Restaurant"><button class="btn btn-success" type="submit" name ="create">Create new entry</button></a>
								<form method="POST" accept-charset="utf-8">
									<div class="modal fade" id="createRestaurant" role="dialog">
										<div class="modal-dialog">
											<div class="modal-content">
												<div class="modal-header">
													<button type="button" class="close" data-dismiss="modal">&times;</button>
													<h4 class="modal-title">Create a new "Restaurant"</h4>
												</div>
												<div class="modal-body">
													<p>Name</p>
													<input type="text" name="restaurantName" maxlength="55" required>
													<p>Image (url)</p>
													<input type="text" name="restaurantImage" maxlength="500" required>
													<p>Address</p>
													<input type="text" name="restaurantAddress" maxlength="100" required>
													<p>Type (e.g. Asian, Mexican, Burgers etc.)</p>
													<input type="text" name="restaurantType" maxlength="55" required>
													<p>Description (max:100)</p>
													<textarea name="restaurantDesc" maxlength="100" required></textarea>
													<p>Phone Number</p>
													<input type="text" name="restaurantNumber" maxlength="20" required>
													<p>Web Address</p>
													<input type="text" name="restaurantWebAddress" maxlength="200" required>
												</div>
												<div class="modal-footer">
													<input type="submit" name="createRestaurant" class="btn btn-success" value="Create">
													<button type="submit" class="btn btn-default" data-dismiss="modal">Go back</button>
												</div>
											</div>
										</div>
									</div>
								</form>
								';
						}

					?>
				</div>
				<hr>

				<?php

				$sql = mysqli_query($mysqli, "SELECT * FROM `restaurant`");

				$count = mysqli_num_rows($sql);

				if($count > 0) {
					while($restaurantRow = mysqli_fetch_array($sql)){
					echo 
					'
						<div class="card col-lg-3 col-md-6 col-sm-12">
							<div class="cardName">
								<h3>'. $restaurantRow["restaurantName"]. '</h3>
							</div>
							<div class="cardImage">
								<img src="'. $restaurantRow["restaurantImage"]. '">
							</div>
							<div class="cardDescription">
								<p><i class="fas fa-map-marker-alt fasdesc"></i>'. $restaurantRow["restaurantAddress"]. '</p>
								<p><i class="fas fa-utensils fasdesc"></i></i>'. $restaurantRow["restaurantType"]. '</p>
								<p><i class="fas fa-pencil-alt fasdesc"></i>'. $restaurantRow["restaurantDesc"]. '</p>
								<p><i class="fas fa-phone fasdesc"></i>'. $restaurantRow["restaurantNumber"]. '</p>
								<p><i class="fas fa-globe-europe fasdesc"></i><a target="_blank" href="'. $restaurantRow["restaurantWebAddress"]. '">'. $restaurantRow["restaurantWebAddress"]. '</a></p>
							</div>';

							if(isset($_SESSION['admin'])){

								echo 
								'
									<div class="changeButtons">
										<form class="changeform" method="POST" accept-charset="utf-8">
											<input type="hidden" name="restaurant_id" value="'.$restaurantRow['restaurant_id'].'">
											<a data-toggle="modal" data-target="#editRestaurantModal'. $restaurantRow['restaurant_id']. '" class="create" title="Edit"><button class="btn btn-primary change" type="submit" name ="edit">Edit</button></a>
											<div class="modal fade" id="editRestaurantModal'. $restaurantRow['restaurant_id']. '" role="dialog">
												<div class="modal-dialog">
													<div class="modal-content">
														<div class="modal-header">
															<button type="button" class="close" data-dismiss="modal">&times;</button>
															<h4 class="modal-title">Edit "'. $restaurantRow['restaurantName']. '"</h4>
														</div>
														<div class="modal-body">
															<p>Name</p>
															<input type="text" name="restaurantName" maxlength="55" value="'. $restaurantRow['restaurantName']. '" required>
															<p>Image (url)</p>
															<input type="text" name="restaurantImage" maxlength="500" value="'. $restaurantRow['restaurantImage']. '" required>
															<p>Address</p>
															<input type="text" name="restaurantAddress" maxlength="100" value="'. $restaurantRow['restaurantAddress']. '" required>
															<p>Type (e.g. Asian, Mexican, Burgers etc.)</p>
															<input type="text" name="restaurantType" maxlength="55" value="'. $restaurantRow['restaurantType']. '" required>
															<p>Description (max:100)</p>
															<textarea name="restaurantDesc" maxlength="100" required>'. $restaurantRow['restaurantDesc']. '</textarea>
															<p>Phone Number</p>
															<input type="text" name="restaurantNumber" value="'. $restaurantRow['restaurantNumber']. '">
															<p>Web Address</p>
															<input type="text" name="restaurantWebAddress" maxlength="200" value="'. $restaurantRow['restaurantWebAddress']. '" required>
														</div>
														<div class="modal-footer">
															<input type="submit" name="updateRestaurant" class="btn btn-primary" value="Update">
															<button type="submit" class="btn btn-default" data-dismiss="modal">Go back</button>
														</div>
													</div>
												</div>
											</div>
										</form>
										<form class="changeform" method="POST" accept-charset="utf-8">
											<input type="hidden" name="restaurant_id" value="'.$restaurantRow['restaurant_id'].'">
											<a data-toggle="modal" data-target="#deleteRestaurantModal'. $restaurantRow['restaurant_id']. '" class="create" href="deleteThingToDo.php" title="Delete"><button class="btn btn-danger change" type="submit" name ="deleteThingToDo">Delete</button></a>
											<div class="modal fade" id="deleteRestaurantModal'. $restaurantRow['restaurant_id']. '" role="dialog">
												<div class="modal-dialog">
													<div class="modal-content">
														<div class="modal-header">
															<button type="button" class="close" data-dismiss="modal">&times;</button>
															<h4 class="modal-title">Delete "'. $restaurantRow['restaurantName']. '"</h4>
														</div>
														<div class="modal-body">
															<h3>Are you sure you want to delete "'. $restaurantRow['restaurantName']. '"?</h3>
														</div>
														<div class="modal-footer">
															<input type="submit" name="deleteRestaurant" class="btn btn-danger" value="Delete">
															<button type="submit" class="btn btn-default" data-dismiss="modal">Go back</button>
														</div>
													</div>
												</div>
											</div>
										</form>
									</div>
								';
							}
							echo '
						</div>

					';

					}
				}
				else
				{
					echo '<p>Sorry, no Restaurants found!</p>';
				}

				?>

			</div>
			<!-- Concerts -->
			<div class="row concerts">
				<div class="rowdesc">	
					<h1>Concerts</h1>

					<?php

						if(isset($_SESSION['admin'])){
							echo '
								<a data-toggle="modal" data-target="#createConcert" class="create" title="Create new Restaurant"><button class="btn btn-success" type="submit" name ="create">Create new entry</button></a>
								<form method="POST" accept-charset="utf-8">
									<div class="modal fade" id="createConcert" role="dialog">
										<div class="modal-dialog">
											<div class="modal-content">
												<div class="modal-header">
													<button type="button" class="close" data-dismiss="modal">&times;</button>
													<h4 class="modal-title">Create a new "Concert"</h4>
												</div>
												<div class="modal-body">
													<p>Name</p>
													<input type="text" name="concertName" maxlength="55" required>
													<p>Image (url)</p>
													<input type="text" name="concertImage" maxlength="500" required>
													<p>Date</p>
													<input type="date" name="concertDate" required>
													<p>Location</p>
													<input type="text" name="concertLocation" maxlength="100" required>
													<p>Ticket Price</p>
													<input type="text" name="concertPrice" required>
													<p>Web Address</p>
													<input type="text" name="concertWebAddress" maxlength="200" required>
												</div>
												<div class="modal-footer">
													<input type="submit" name="createConcert" class="btn btn-success" value="Create">
													<button type="submit" class="btn btn-default" data-dismiss="modal">Go back</button>
												</div>
											</div>
										</div>
									</div>
								</form>
							';
						}

					?>
				</div>
				<hr>

				<?php

				$sql = mysqli_query($mysqli, "SELECT * FROM `concert`");

				$count = mysqli_num_rows($sql);

				if($count > 0) {
					while($concertRow = mysqli_fetch_array($sql)){
					echo 
					'
						<div class="card col-lg-3 col-md-6 col-sm-12">
							<div class="cardName">
								<h3>'. $concertRow["concertName"]. '</h3>
							</div>
							<div class="cardImage">
								<img src="'. $concertRow["concertImage"]. '">
							</div>
							<div class="cardDescription">
								<p><i class="fas fa-calendar-alt fasdesc"></i>'. $concertRow["concertDate"]. '</p>
								<p><i class="fas fa-map-marker-alt fasdesc"></i>'. $concertRow["concertLocation"]. '</p>
								<p><i class="fas fa-dollar-sign fasdesc"></i>'. $concertRow["concertPrice"]. '</p>
								<p><i class="fas fa-globe-europe fasdesc"></i><a target="_blank" href="'. $concertRow["concertWebAddress"]. '">'. $concertRow["concertWebAddress"]. '</a></p>
							</div>';

							if(isset($_SESSION['admin'])){

								echo 
								'
									<div class="changeButtons">
										<form class="changeform" method="POST" accept-charset="utf-8">
											<input type="hidden" name="concert_id" value="'.$concertRow['concert_id'].'">
											<a data-toggle="modal" data-target="#editConcertModal'. $concertRow['concert_id']. '" class="create" title="Edit"><button class="btn btn-primary change" type="submit" name ="edit">Edit</button></a>
											<div class="modal fade" id="editConcertModal'. $concertRow['concert_id']. '" role="dialog">
												<div class="modal-dialog">
													<div class="modal-content">
														<div class="modal-header">
															<button type="button" class="close" data-dismiss="modal">&times;</button>
															<h4 class="modal-title">Edit "'. $concertRow['concertName']. '"</h4>
														</div>
														<div class="modal-body">
															<p>Name</p>
															<input type="text" name="concertName" maxlength="55" value="'. $concertRow['concertName']. '" required>
															<p>Image (url)</p>
															<input type="text" name="concertImage" maxlength="500" value="'. $concertRow['concertImage']. '" required>
															<p>Date</p>
															<input type="date" name="concertDate" value="'. $concertRow['concertDate']. '" required>
															<p>Location</p>
															<input type="text" name="concertLocation" maxlength="100" value="'. $concertRow['concertLocation']. '" required>
															<p>Ticket Price</p>
															<input type="text" name="concertPrice" value="'. $concertRow['concertPrice']. '" required>
															<p>Web Address</p>
															<input type="text" name="concertWebAddress" maxlength="200" value="'. $concertRow['concertWebAddress']. '" required>
														</div>
														<div class="modal-footer">
															<input type="submit" name="updateConcert" class="btn btn-primary" value="Update">
															<button type="submit" class="btn btn-default" data-dismiss="modal">Go back</button>
														</div>
													</div>
												</div>
											</div>
										</form>
										<form class="changeform" method="POST" accept-charset="utf-8">
											<input type="hidden" name="concert_id" value="'.$concertRow['concert_id'].'">
											<a data-toggle="modal" data-target="#deleteConcertModal'. $concertRow['concert_id']. '" class="create" href="deleteThingToDo.php" title="Delete"><button class="btn btn-danger change" type="submit" name ="deleteThingToDo">Delete</button></a>
											<div class="modal fade" id="deleteConcertModal'. $concertRow['concert_id']. '" role="dialog">
												<div class="modal-dialog">
													<div class="modal-content">
														<div class="modal-header">
															<button type="button" class="close" data-dismiss="modal">&times;</button>
															<h4 class="modal-title">Delete "'. $concertRow['concertName']. '"</h4>
														</div>
														<div class="modal-body">
															<h3>Are you sure you want to delete "'. $concertRow['concertName']. '"?</h3>
														</div>
														<div class="modal-footer">
															<input type="submit" name="deleteConcert" class="btn btn-danger" value="Delete">
															<button type="submit" class="btn btn-default" data-dismiss="modal">Go back</button>
														</div>
													</div>
												</div>
											</div>
										</form>
									</div>
								';
							}
							echo '
						</div>

					';

					}
				}
				else
				{
					echo '<p>Sorry, no Concerts found!</p>';
				}

				?>

			</div>
			<h1>Map with locations</h1>
				<hr>
		</div>
	</div>
   <div id="map"></div>
   <script>
	function initMap() {
     	var Naschmarkt = {lat: 48.198409, lng: 16.3609278};
    	var Stadthalle = {lat: 48.2023646, lng: 16.3307072};
    	var Rinderwahn = {lat: 48.1986157, lng: 16.3611352};
    	var AsiaJasmin = {lat: 48.2506594, lng: 16.4703394};
    	var Schoenbrunn = {lat: 48.1817271, lng: 16.3016802};
    	var CharlesChurch = {lat: 48.2011828, lng: 16.3673226};
    	var Prater = {lat: 48.2164699, lng: 16.3969051};
    	var Donauzentrum = {lat: 48.2423644, lng: 16.4328016};
    	var LemonLeafThai = {lat: 48.1959985, lng: 16.3575996};
    	var sixta = {lat: 48.1940169, lng: 16.3574611};

    	var map = new google.maps.Map(document.getElementById('map'), {
    		zoom: 11.5,
    		center: {lat: 48.2211394, lng: 16.3773116}
    	});

    	var marker = new google.maps.Marker({
    		position: Naschmarkt,
        	map: map,
        	title: 'Vienna Naschmarkt'
    	});

    	var marker2 = new google.maps.Marker({
       		position: Stadthalle,
       		map: map,
       		title: 'Stadthalle'
    	});

    	var marker3 = new google.maps.Marker({
       		position: Rinderwahn,
       		map: map,
       		title: 'Rinderwahn'
    	});

    	var marker4 = new google.maps.Marker({
       		position: AsiaJasmin,
       		map: map,
       		title: 'Asia Jasmin'
    	});

    	var marker5 = new google.maps.Marker({
       		position: Schoenbrunn,
       		map: map,
       		title: 'Schönbrunn'
    	});

    	var marker6 = new google.maps.Marker({
       		position: CharlesChurch,
       		map: map,
       		title: 'Charles Church'
    	});

    	var marker7 = new google.maps.Marker({
       		position: Prater,
       		map: map,
       		title: 'Prater'
    	});

    	var marker8 = new google.maps.Marker({
       		position: Donauzentrum,
       		map: map,
       		title: 'Donauzentrum'
    	});

    	var marker9 = new google.maps.Marker({
       		position: LemonLeafThai,
       		map: map,
       		title: 'Lemon Leaf Thai'
    	});

    	var marker10 = new google.maps.Marker({
       		position: sixta,
       		map: map,
       		title: 'SIXTA'
    	});
     }
   </script>
   <script async defer
   src="https://maps.googleapis.com/maps/api/js?key=&callback=initMap">
   </script>
	<div class="footer">
		<p>Benjamin Schneider - CodeFactory 2019</p>
	</div>
</body>
</html>