<?php
	require_once("system_inits.php");
	require_once("healthyair_functions/ha_print_error.php");

	if ($_POST["form_secret"] != $_SESSION["form_secret"])
		exit(0);

	$station_id = $_POST["station_id"];

	$mysqli->autocommit(FALSE);

	$query = sprintf("DELETE FROM stations WHERE id=%d", $station_id);
	$result_delete_station = $mysqli->query($query);

	$query = sprintf('DELETE FROM air_data WHERE station_id=%d;', $station_id);
	$result_delete_data = $mysqli->query($query);
	if (!$result_delete_station || !$result_delete_data) {
		$mysqli->rollback();
		ha_print_error("Произошла неизвестная ошибка.");
		fprintf($stderr, "Error on transaction: %s",  $mysqli->error);
	} else {
		$mysqli->commit();
		echo "OK";
	}
?>