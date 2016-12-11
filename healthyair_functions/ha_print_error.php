<?php
	require_once("healthyair_classes/ha_web_control.php");

	function ha_print_error($error_meassage) {
		$list_item = new ha_web_control("li");
		$list_item->set_property("class", "mdl-list__item");
		
		$span = new ha_web_control("span");
		$span->set_property("class", "mdl-list__item-primary-content");
		$span->set_text($error_meassage);

		$icon = new ha_web_control("i");
		$icon->set_property("class", "material-icons");
		$icon->set_property("style", "color:#F00000");
		$icon->set_text("error");

		$span->insert_control($icon);
		$list_item->insert_control($span);
		$list_item->print();
	}
?>