<?php
	function validate_date($datetime)
	{
		$format = 'Y-m-d H:i:s';
	    $d = DateTime::createFromFormat($format, $datetime);
	    return $d && $d->format($format) == $datetime;
	}


	require_once('system_inits.php');

	$error = false;

	if (!$_POST['email']) {
		echo 'email is required;';
		$error = true;
	}

	if (!$_POST['passwd']) {
		echo 'passwd is required;';
		$error = true;
	}

	if (!$_POST['stname']) {
		echo 'stname is required;';
		$error = true;
	}

	if (!$_POST['t']) {
		echo "t is required;";
		$error = true;
	}

	if (!$_POST['rh']) {
		echo "rh is required";
		$error = true;
	}

	if (!$_POST['co2']) {
		echo "co2 is required";
		$error = true;
	}

	if (!$_POST['datetime']) {
		echo "date is required;";
		$error = true;
	}

	if ($error)
		exit(0);

	$email = $_POST['email'];
	$passwd = $_POST['passwd'];

	$passwd_hash = hash('whirlpool', $passwd);
	$query = "SELECT * FROM users where email='" . $email . 
				"' and passwd_hash='" . $passwd_hash . "';";

	if (!($result = $mysqli->query($query))) {
		fprintf($stderr, 'Error_message: %s\n', $mysqli->error);
		exit(1);
	}

	if ($result->num_rows == 0) {
		echo 'incorrect email or password;';
		exit(0);
	}

	$row = $result->fetch_array();
	$uid = $row['id'];
	$stname = $_POST['stname'];

	$query = "SELECT * from stations where user_id=" . 
					$uid . " and name='" . $stname . "';";

	if (!($result = $mysqli->query($query))) {
		fprintf($stderr, 'Error_message: %s\n', $mysqli->error);
		exit(1);
	}	

	if ($result->num_rows == 0) {
		ECHO "no such meteostation;";
		exit(0);
	}

	$row = $result->fetch_array();
	$sid = $row['id'];

	if ($error)
		exit(0);

	$t = $_POST['t'];
	$rh = $_POST['rh'];
	$co2 = $_POST['co2'];
	$datetime = $_POST['datetime'];

	if (!validate_date($datetime)) {
		echo "invalid datetime format;";
		exit(0);
	}

	$query = sprintf("INSERT INTO air_data 
						VALUES(%d, %d, %lf, %lf, %lf, '%s');",
						$uid, $sid, $t, $rh, $co2, $datetime);

	if (!$mysqli->query($query)) {
		fprintf($stderr, 'Error_message: %s\n', $mysqli->error);
		exit(1);
	}		

	echo "OK";
?>