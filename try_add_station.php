<?php 
	require_once('system_inits.php');

	if (isset($_SESSION['uid'])) {
		$user_id = $_SESSION['uid'];
		$name = $_POST['name'];

		$error = false;

		if (!$name) {
			echo "Необходимо указать название метеостанции<br>";
			$error = true;
		}

		$query = "SELECT * from stations where user_id=" . 
					$user_id . " and name='" . $name . "';";

		if (!$error) {
			if (!($result = $mysqli->query($query))) {
				echo "Неизвестная ошибка<br>";
				fprintf($stderr, "Error message: %s\n", $mysqli->error);
				exit(1);
			}

			if ($result->num_rows > 0) {
				echo "У вас уже есть такая метеостанция";
				$error = true;
			} else {
				$query = sprintf("INSERT INTO stations VALUES(0, '%s', %d, 1);",
						$name, $user_id);

				if (!$mysqli->query($query)) {
					echo "Неизвестная ошибка<br>";
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