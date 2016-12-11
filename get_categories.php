<?php
	require_once("system_inits.php");
	require_once("healthyair_classes/ha_web_control.php");

	if ($_POST["form_secret"] != $_SESSION["form_secret"])
		exit(0);


	$query = sprintf("SELECT * FROM room_categories", $user_id);

	if ((!$result = $mysqli->query($query))) {
		fprintf($stderr, "Error message: %s\n", $mysqli->error);
		exit(1);
	}


	while (($row = $result->fetch_array())) {
		$list_item = new ha_web_control("li");
		$list_item->set_property("class", "mdl-menu__item");
		$list_item->set_property("onclick", sprintf("set_station_category(%d)",
			$row["category_id"]));
		$list_item->set_text($row["category_name"]);
		$list_item->print();
	}
?>