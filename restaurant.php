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
			header("Location: restaurant.php");
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
			header("Location: restaurant.php");
		} else {
			echo "Error while updating record: ". $mysqli->error;
		}
	}

	if(isset($_POST['deleteRestaurant'])){

		$id = $_POST['restaurant_id'];

		$sql = "DELETE FROM `restaurant` WHERE restaurant_id = {$id}";

		if($mysqli->query($sql) === TRUE) {
			header("Location: restaurant.php");
		} else {
			echo "Error while deleting record: ". $mysqli->error;
		}
	}

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Restaurants</title>
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
			<h1>All Restaurants</h1>
		</div>
		<div class="maincontent">
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
		</div>
	</div>
	<div class="footer">
		<p>Benjamin Schneider - CodeFactory 2019</p>
	</div>
</body>
</html>