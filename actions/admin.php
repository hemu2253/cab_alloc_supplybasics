<?php
require 'db_connect.php';

$con = connect_2_db();

if($_POST) {
	
	$status = $_POST["status"];
	if(true) {
	$json = array();
	$get_details = mysqli_query($con, "SELECT ride.id, ride.start_time, driver.dname, customer.name, ride.status FROM ride 
		INNER JOIN driver ON ride.driver = driver.id 
		INNER JOIN customer ON ride.customer = customer.id");

		while($row = mysqli_fetch_assoc($get_details)) {
			$data = array(
				'id' => $row["id"],
				'start_time' => $row["start_time"],
				'dname' => $row["dname"],
				'cname' => $row["name"],
				'status' => $row["status"]
			);
			array_push($json, $data);
		}

	if(empty($json)) {
		$results = [];
	}
	else {
		$results = array();
		$results = $json;
	}
	exit(json_encode($results));
}
}

?>