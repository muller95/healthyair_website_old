<?php
	require_once("system_inits.php");

	if ($_POST["form_secret"] != $_SESSION["form_secret"])
		exit(0);

	$station_id = $_POST["station_id"];
	
	$query = sprintf("SELECT * FROM stations WHERE id=%d;", 
		$station_id);

	if ((!$result = $mysqli->query($query))) {
		fprintf($stderr, "Error message: %s\n", $mysqli->error);
		exit(1);
	}

	$row = $result->fetch_array();
	echo $row["room_category"];
?>