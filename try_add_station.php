<?php 
	require_once("system_inits.php");
	require_once("healthyair_functions/ha_print_error.php");

	if ($_POST["form_secret"] != $_SESSION["form_secret"])
		exit(0);

	$user_id = $_SESSION["user_id"];
	$station_name = trim($_POST["station_name"]);

	$error = false;

	if (!$station_name) {
		$error = true;
		ha_print_error("Необходимо указать название метеостанции.");
	} else if (mb_strlen($station_name, "UTF-8") > 20) {
		$error = true;
		ha_print_error("Слишком длинное название.");
	}

	$query = sprintf("SELECT * FROM stations WHERE user_id=%d AND name='%s';",
		$user_id, $station_name);
	
	if (!$error) {
		if (!($result = $mysqli->query($query))) {
			ha_print_error("Произошла неизвестная ошибка.");
			fprintf($stderr, "Error message: %s\n", $mysqli->error);
			exit(1);
		}

		if ($result->num_rows > 0) {
			$error = true;
			ha_print_error("У вас уже есть такая метеостанция.");
		} else {
			$query = sprintf("INSERT INTO stations VALUES(0, '%s', %d, 1);",
				$station_name, $user_id);
	
			if (!$mysqli->query($query)) {
				ha_print_error("Произошла неизвестная ошибка.");
				fprintf($stderr, "Error message: %s\n", $mysqli->error);
				exit(1);
			}
		}
	}

	if (!$error)
		echo "OK";


?>