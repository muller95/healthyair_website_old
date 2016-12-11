<?php
	require_once("system_inits.php");

	if ($_POST["form_secret"] != $_SESSION["form_secret"])
		exit(0);

	$station_id = $_POST["station_id"];
	$limit = $_POST["limit"];
	$query = sprintf("SELECT t, rh, co2, datetime FROM air_data 
		WHERE station_id=%d ORDER BY datetime DESC LIMIT %d;", 
		$station_id, $limit);

	$result = $mysqli->query($query);
	if (!($result = $mysqli->query($query))) {
		fprintf($stderr, "Error_message: %s\n", $mysqli->error);
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
