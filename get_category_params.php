<?php
	require_once("system_inits.php");

	if ($_POST["form_secret"] != $_SESSION["form_secret"])
		exit(0);

	$station_id = $_POST["category_id"];
	
	$query = sprintf("SELECT * FROM room_categories WHERE category_id=%d;", 
		$station_id);

	if ((!$result = $mysqli->query($query))) {
		fprintf($stderr, "Error message: %s\n", $mysqli->error);
		exit(1);
	}

	$row = $result->fetch_array();
	$row_array = array("t_good_low" => $row["t_good_low"], 
		"t_good_high" => $row["t_good_high"], 
		"t_norm_low" => $row["t_norm_low"], 
		"t_norm_high" => $row["t_norm_high"],
		"rh_good_low" => $row["rh_good_low"], 
		"rh_good_high" => $row["rh_good_high"], 
		"rh_norm_low" => $row["rh_norm_low"], 
		"rh_norm_high" => $row["rh_norm_high"],
		"co2_good_high" => $row["co2_good_high"],
		"co2_norm_high" => $row["co2_norm_high"]);

	echo json_encode($row_array); 		
?>