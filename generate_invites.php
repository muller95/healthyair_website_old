<?php 
	/*$mysqli = new mysqli("localhost", "db_user", "db_user_password", "clair_db");
	if ($mysqli->connect_error)
		die('Ошибка подключения (' . $mysqli->connect_errno . ') ' . $mysqli->connect_error);

	$mysqli->close();*/

	require_once('system_inits.php');

	$query = "SELECT * FROM invites;";

	$result = $mysqli->query($query);
	if (!$result)
		die("Error message: ". $mysqli->error);

	for ($i = 0, $row = $result->fetch_array(); $row; $i++, $row = $result->fetch_array())
		$rows[$i] = $row;

	$invites = array();
	for ($i = 0; $i < 30; $i++) {
		$not_unique = false;
		$seed = rand();
		$hash = hash("md2", $seed);

		for ($j = 0; $j < $result->num_rows; $j++)
			if ($hash == $rows[$j]["invite"]) {
				$not_unique = true;
				break;
			}

		if ($not_unique) {
			$i--;
			continue;
		}

		for ($j = 0; $j < $i; $j++)
			if ($hash == $invites[$j]) {
				$not_unique = true;
				break;
			}

		if ($not_unique) {
			$i--;
			continue;
		}

		$query = sprintf('INSERT INTO invites VALUES("%s", false);', $hash);

		$result = $mysqli->query($query);
		if (!$result)
			die("Errormessage: ". $mysqli->error);	

		$invites[$i] = $hash;
	}
?>