<?php
	require_once('system_inits.php');

	if (!isset($_SESSION['uid']))
		exit(0);

	$uid = $_SESSION['uid'];
	$stname = $_POST['stname'];

	$query = "SELECT * from stations where user_id=" . 
					$uid . " and name='" . $stname . "';";

	if (!($result = $mysqli->query($query))) {
		fprintf($stderr, 'Error_message: %s\n', $mysqli->error);
		exit(1);
	}	

	if ($result->num_rows == 0) {
		ECHO "no such meteostation;";
		exit(0);
	}

	$row = $result->fetch_array();
	$sid = $row['id'];
	
	/*$query = "SELECT t, rh, co2, datetime FROM air_data 
				ORDER BY datetime DESC LIMIT 100;";*/

	$limit = $_POST['limit'];
	$query = sprintf("SELECT t, rh, co2, datetime FROM air_data 
						WHERE station_id=%d
						ORDER BY datetime DESC LIMIT %d;", $sid, $limit);

	$result = $mysqli->query($query);
	if (!($result = $mysqli->query($query))) {
		fprintf($stderr, 'Error_message: %s\n', $mysqli->error);
		exit(1);
	}	

	$json_strings = array();
	$i = 0;
	while (($row = $result->fetch_array())) {
		$row_array = array("t" => $row["t"], "rh" => $row["rh"], 
							"co2" => $row["co2"], "datetime" => $row["datetime"]);
		$json_strings[$i++] = json_encode($row_array); 		
	}
	
	echo json_encode($json_strings);
?>
