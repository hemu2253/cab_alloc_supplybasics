<?php
 
require 'db_connect.php';

$con = connect_2_db();

date_default_timezone_set("Asia/Kolkata");
$date = date("Y-m-d H:i:s");


if($_GET || $_POST) {
	if(isset($_GET["id"])) {
		$driver = $_GET["id"];
	}
	else 
		if(isset($_POST["id"])) {
		$driver = $_POST["id"];
	}	
		
		//Checks Time of ride
		$check_ride_time = mysqli_query($con, "SELECT * FROM ride WHERE driver = '$driver' AND status = 0");

		while($row = mysqli_fetch_assoc($check_ride_time)) {
			$time = $row["start_time"];
		 	$id = $row["id"];
			$driver = $row["driver"];
			
			$d1 = strtotime($date);
			$d2 = strtotime($time);

			$diff = $d1 - $d2; 	
			 if($diff >= 300) {
				$update = mysqli_query($con, "UPDATE ride SET status = 1 WHERE id = '$id'");
				$pdate_driver = mysqli_query($con, "UPDATE driver SET status = 0 WHERE id = '$driver'");
			 }
			 else {
			 	break;
			 }
		}//End of Time checking
	

	$json = array();
	$result = mysqli_query($con, "SELECT ride.id, ride.status, customer.name FROM ride INNER JOIN customer ON ride.customer = customer.id WHERE driver IN ('$driver',0)");

		while($row = mysqli_fetch_assoc($result)) {
				$data = array(
					'id' => $row["id"],
					'status' => $row["status"],
					'cname' => $row["name"]
				);
				array_push($json, $data);
			// }
			
		}

	

	if(empty($json)) {
		$results = [];
	}
	else {
		$results = array();
		$results = $json;
	}

//echo json_encode($results);
 exit(json_encode($results));
}

else {
	$results = "Error occurred";
	exit(json_encode($results));
}

?>