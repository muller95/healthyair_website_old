<?php
		require_once('../system_inits.php');
		setcookie("login", "", 1);
		setcookie("email", "", 1);
		setcookie("user_name", "", 1);
		setcookie("user_id", "", 1);

		unset($_SESSION["login"]);
		unset($_SESSION["email"]);
		unset($_SESSION["user_name"]);
		unset($_SESSION["user_id"]);
?>;