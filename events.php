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

	if(isset($_POST['createThingsToDo'])){

		$thingsToDoName = $_POST['thingsToDoName'];
		$thingsToDoImage = $_POST['thingsToDoImage'];
		$thingsToDoAddress = $_POST['thingsToDoAddress'];
		$thingsToDoType = $_POST['thingsToDoType'];
		$thingsToDoDesc = $_POST['thingsToDoDesc'];
		$thingsToDoWebAddress = $_POST['thingsToDoWebAddress'];

		$sql = "INSERT INTO `thingstodo` (`thingsToDoName`, `thingsToDoImage`, `thingsToDoAddress`, `thingsToDoType`, `thingsToDoDesc`, `thingsToDoWebAddress`) VALUES ('$thingsToDoName', '$thingsToDoImage', '$thingsToDoAddress', '$thingsToDoType', '$thingsToDoDesc', '$thingsToDoWebAddress')";

		if($mysqli->query($sql) === TRUE) {
			header("Location: events.php");
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
			header("Location: events.php");
		} else {
			echo "Error while updating record: ". $mysqli->error;
		}
	}

	if(isset($_POST['deleteThingsToDo'])){

		$id = $_POST['thingsToDo_id'];

		$sql = "DELETE FROM `thingstodo` WHERE thingsToDo_id = {$id}";

		if($mysqli->query($sql) === TRUE) {
			header("Location: events.php");
		} else {
			echo "Error while deleting record: ". $mysqli->error;
		}
	}

	if(isset($_POST['createConcert'])){

		$concertName = $_POST['concertName'];
		$concertImage = $_POST['concertImage'];
		$concertDate = $_POST['concertDate'];
		$concertLocation = $_POST['concertLocation'];
		$concertPrice = $_POST['concertPrice'];
		$concertWebAddress = $_POST['concertWebAddress'];

		$sql = "INSERT INTO `concert`(`concertName`, `concertImage`, `concertDate`, `concertLocation`, `concertPrice`, `concertWebAddress`) VALUES ('$concertName', '$concertImage', '$concertDate', '$concertLocation', '$concertPrice', '$concertWebAddress')";

		if($mysqli->query($sql) === TRUE) {
			header("Location: events.php");
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
			header("Location: events.php");
		} else {
			echo "Error while updating record: ". $mysqli->error;
		}
	}

	if(isset($_POST['deleteConcert'])){

		$id = $_POST['concert_id'];

		$sql = "DELETE FROM `concert` WHERE concert_id = {$id}";

		if($mysqli->query($sql) === TRUE) {
			header("Location: events.php");
		} else {
			echo "Error while deleting record: ". $mysqli->error;
		}
	}


?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Events</title>
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
			<h1>All Things to Do And Concerts</h1>
		</div>
		<div class="maincontent">
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
		</div>
	</div>
	<div class="footer">
		<p>Benjamin Schneider - CodeFactory 2019</p>
	</div>
</body>
</html>