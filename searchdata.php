<?php 

	require_once 'db_connection.php';

	// You can access the values posted by jQuery.ajax
	// through the global variable $_POST, like this:
	$bar = isset($_POST['test']) ? $_POST['test'] : null;//JULAN - refernces to the 'Name' in the form field and puts it in a var

	if(strlen($bar)>0){
		$query= "SELECT thingsToDoName FROM `thingstodo` WHERE thingsToDoName like '%$bar%' UNION SELECT restaurantName FROM `restaurant` WHERE restaurantName like '%$bar%' UNION SELECT concertName FROM `concert` WHERE concertName like '%$bar%'";

		$result = mysqli_query($mysqli,$query);
		if($result->num_rows >0){
			while($searchRow = $result->fetch_assoc()){
				echo '
					<div class="centermepls">
						<h3>'. $searchRow["thingsToDoName"]. "</h3><br>". '
					</div>

				';
			}
		}
		else {
			echo "No Data found!";
		}
	}

?>