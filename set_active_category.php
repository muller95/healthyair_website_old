<?php
	require_once('system_inits.php');

	if(!isset($_SESSION['uid']))
		exit(0);

	$user_id = $_SESSION['uid'];
	$station_name = $_POST['station_name'];
	$category_id = $_POST['category_id'];

	$query = sprintf("UPDATE stations SET room_category=%d WHERE user_id=%d
		AND name='%s';", $category_id, $user_id, $station_name);
	echo $query;
	if ((!$result = $mysqli->query($query))) {
		fprintf($stderr, "Error message: %s\n", $mysqli->error);
		exit(1);
	}

?>