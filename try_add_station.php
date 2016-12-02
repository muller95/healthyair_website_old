<?php 
	require_once('system_inits.php');

	if (isset($_SESSION['uid'])) {
		$uid = $_SESSION['uid'];
		$name = $_POST['name'];

		$error = false;

		if (!$name) {
			echo "Name is required<br>";
			$error = true;
		}

		$query = "SELECT * from stations where user_id=" . 
					$uid . " and name='" . $name . "';";

		if (!$error) {
			if (!($result = $mysqli->query($query))) {
				fprintf($stderr, "Error message: %s\n", $mysqli->error);
				exit(1);
			}

			if ($result->num_rows > 0) {
				echo "You already have such meteostation";
				$error = true;
			} else {
				$query = "INSERT INTO stations VALUES(0, '" . $name . "'," . 
							$uid . ");";

				if (!$mysqli->query($query)) {
					fprintf($stderr, "Error message: %s\n", $mysqli->error);
					exit(1);
				}
			}
		}

		if (!$error)
			echo "OK";
	} else 
		header('Location: index.php');

?>