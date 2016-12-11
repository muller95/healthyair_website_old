<?php
	require_once("system_inits.php");

	if ($_POST["form_secret"] != $_SESSION["form_secret"])
		exit(0);

	$station_id = $_POST["station_id"];
	$room_category = $_POST["new_category_id"];
	
	$query = sprintf("UPDATE stations SET room_category=%d WHERE id=%d;", 
		$room_category, $station_id);

	if (!$mysqli->query($query)) {
		fprintf($stderr, "Error message: %s\n", $mysqli->error);
		exit(1);
	}
?>