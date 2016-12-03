<?php
	require_once('system_inits.php');

	if (!isset($_SESSION['uid']))
		exit(0);

	$user_id = $_SESSION['uid'];
	$station_name = $_POST['station_name'];

	$query = sprintf("SELECT * FROM stations WHERE name='%s' and user_id=%d;",
		$station_name, $user_id);

	if ((!$result = $mysqli->query($query))) {
		fprintf($stderr, "Error message: %s\n", $mysqli->error);
		exit(1);
	}

	if ($result->num_rows > 0) {
		$row = $result->fetch_array();
		echo $row['room_category'];
	}
?>