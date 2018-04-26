<?php

require 'db_connect.php';

$con = connect_2_db();

if($_POST) {
	$identifier = $_POST["identifier"];
	// $xcord = $_POST["xcord"];
	// $ycord = $_POST["ycord"];

	 $check_user = mysqli_query($con, "SELECT * FROM customer WHERE id = '$identifier'");
	 $count = mysqli_num_rows($check_user);
	 if($count == 1) {
	 	
		$result = mysqli_query($con, "INSERT INTO ride (driver, start_time, status, customer, x, y) VALUES (0, 0, -1, '$identifier', 0,0)");
	
		$response = "Ride Requested";
	}
	else {
		$response = "User not found";
	}

	exit(json_encode($response));
}

?>