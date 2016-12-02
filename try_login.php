<?php 
	require_once("system_inits.php");

	$email = $_POST['email'];
	$passwd = $_POST['passwd'];
	$invite = $_POST['invite'];

	$error = false;

	if (!$email) {
		echo "Email is required<br>";
		$error = true;
	}

	if (!$passwd) {
		echo "Password is required<br>";
		$error = true;
	}

	if (!$error) {
		$passwd_hash = hash("whirlpool", $passwd);
		$query = "SELECT * FROM users where email='" . $email . 
					"' and passwd_hash='" . $passwd_hash . "';";

		if (!($result = $mysqli->query($query))) {
			fprintf($stderr, "Error message: %s\n", $mysqli->error);
			exit(1);
		}

		if ($result->num_rows == 0) {
			echo "Incorrect email or password";
			$error = true;
		}

		if (!$error) {
			echo "OK";
			$row = $result->fetch_array();
			$_SESSION['uid'] = $row['id'];
		}
	}
?>