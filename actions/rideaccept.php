<?php

require 'db_connect.php';

$con = connect_2_db();
date_default_timezone_set("Asia/Kolkata");
$date = date("Y-m-d H:i:s");

if($_POST) {
	$rideid = $_POST["rideid"];
	$driverid = $_POST["driverid"];

	$check_driver_ride = mysqli_query($con, "SELECT * FROM driver WHERE status = 0 AND id = '$driverid'");

	//Check if Drive is on Ride
	if(mysqli_num_rows($check_driver_ride) == 1) {
		$check_ride_aval = mysqli_query($con, "SELECT * FROM ride WHERE status = -1 AND id = '$rideid'");

		//Check if ride is available
		if(mysqli_num_rows($check_ride_aval) == 1) {
			//Ride is available
			$ride_confirm = mysqli_query($con, "UPDATE ride SET status = 0,start_time = '$date', driver = '$driverid' WHERE id = '$rideid'");

			$driver_status_change = mysqli_query($con, "UPDATE driver SET status = 1 WHERE id = '$driverid'");

			$response = "Ride Accepted";
		}
		else {
			//Ride is not available
			$response = "Request no longer available";
		}
	}
	else {
		$response = "There is an Ongoing ride. You can't accept ride now.";
	}

	//echo json_encode($response);
	echo '<script>
	alert("'.$response.'");
	window.location = "../driverapp.php?id='.$driverid.'";
	</script>';
}

?>