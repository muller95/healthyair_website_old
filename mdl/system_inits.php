<?php
	session_start();

	$secret_word = "JusT HeaLthy Air Stupid secret word 
		fvdfbgfghssdfgdsfg231434758";

	$mysqli = new mysqli("localhost", "vh26035_db_user", "db_user_very_long", 
		"vh26035_healthy_air_db");
	if ($mysqli->connect_error)
		die('Ошибка подключения (' . $mysqli->connect_errno . ') ' . 
			$mysqli->connect_error);

	$mysqli->query( "SET CHARSET utf8" );

	$stderr = fopen('php://stderr', 'rw');
?>