<?php
	require_once('system_inits.php');	
	require_once("healthyair_functions/ha_print_error.php");
	require_once("healthyair_classes/ha_web_control.php");

	$query = sprintf("SELECT * FROM stations WHERE user_id=%d", 
		$_SESSION['user_id']);

	if ((!$result = $mysqli->query($query))) {
		ha_print_error("Произошла неизвестная ошибка.");
		fprintf($stderr, "Error message: %s\n", $mysqli->error);
		exit(1);
	}

	if ($result->num_rows == 0)
		echo "NO STATIONS";
	else {
	/*	$table = new ha_web_control("table");
		$table->set_property("class", 
			"mdl-data-table mdl-js-data-table");
		$table->set_property("style", "width:100%");*/

		$body = new ha_web_control("tbody");

		while (($row = $result->fetch_array())) {
			$id =  $row["id"];
			$table_row = new ha_web_control("tr");

			//Inser name and radio
			$table_cell = new ha_web_control("td");
			$table_cell->set_property("class", 
				"mdl-data-table__cell--non-numeric");

			$label = new ha_web_control("label");
			$label->set_property("class", 
				"mdl-radio mdl-js-radio mdl-js-ripple-effect");
			$label->set_property("for", $id);

			$radio = new ha_web_control("input");
			$radio->set_property("type", "radio");
			$radio->set_property("id", $id);
			$radio->set_property("class", "mdl-radio__button");
			$radio->set_property("name", "selected_station");

			$span = new ha_web_control("span");
			$span->set_property("class", "mdl-radio__label");
			$span->set_text($row["name"]);

			$label->insert_control($radio);
			$label->insert_control($span);

			$table_cell->insert_control($label);
			$table_row->insert_control($table_cell);

			$table_cell = new ha_web_control("td");
			$table_cell->set_property("class", 
				"mdl-data-table__cell--non-numeric");

						$button = new ha_web_control("button");
			$button->set_property("class", "mdl-button mdl-js-button 
				mdl-button--raised mdl-js-ripple-effect mdl-button--accent");
			$button->set_property("onclick", 
				sprintf("delete_station(%d)", $row["id"]));
			$button->set_text("Удалить");

			$table_cell->insert_control($button);
			$table_row->insert_control($table_cell);

			$body->insert_control($table_row);
		}

		$body->print();
/*		$table->insert_control($body);
		$table->print();*/
	}
?>
