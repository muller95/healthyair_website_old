<?php
	require_once('system_inits.php');	

	$query = "SELECT * from stations where user_id=" . $_SESSION['uid'];

	if ((!$result = $mysqli->query($query))) {
		fprintf($stderr, "Error message: %s\n", $mysqli->error);
		exit(1);
	}

	if ($result->num_rows == 0)
		echo "NO STATIONS";
	else {
		while (($row = $result->fetch_array()))
			printf ('<button type="button" name="%s" class="list-group-item" 
				onclick="set_station(\'%s\')">%s</button>', 
				$row['name'], $row['name'], $row['name']);
	}
?>