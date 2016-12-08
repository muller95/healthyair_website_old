<?php 
	require_once("system_inits.php");
	require_once("healthyair_functions/ha_print_error.php");
	require_once("healthyair_functions/ha_login_functions.php");

	$email = $_POST["email"];
	$passwd = $_POST["passwd"];
	$remember = $_POST["remember"];

	$error = false;

	if (!$email) {
		$error = true;
		ha_print_error("Необходимо ввести e-mail.");
	}

	if (!$passwd) {
		$error = true;
		ha_print_error("Необходимо ввести пароль.");
	}

	
	if (!$error) {
		$passwd_hash = hash("whirlpool", $passwd);
		$query = sprintf("SELECT * FROM users WHERE email='%s' AND
			passwd_hash='%s';", $email, $passwd_hash);

		if (!($result = $mysqli->query($query))) {
			ha_print_error("Произошла неизвестная ошибка.");
			fprintf($stderr, "Error message: %s".PHP_EOL , $mysqli->error);
			exit(1);
		}

		if ($result->num_rows == 0) {
			$error = true;
			ha_print_error("Неправильный e-mail или пароль.");
		}

		if (!$error) {
			if ($remember == "true") {
				$row = $result->fetch_array();
				$_SESSION["user_id"] = $row["id"];
				setcookie("user_id", $row["id"], time() + 3 * 24 * 60 * 60);
				setcookie("user_name", $row["user_name"], 
					time() + 3 * 24 * 60 * 60);
				$_SESSION["user_name"] = $row["user_name"];

				$login_hash = ha_generate_login_hash($email);
				$_SESSION["login"] = $login_hash;
				setcookie("login", $login_hash, time() + 3 * 24 * 60 * 60);
				setcookie("email", $email, time() + 3 * 24 * 60 * 60);

				echo $_COOKIE["user_name"];
			}
			echo "OK";
		}
	}
?>