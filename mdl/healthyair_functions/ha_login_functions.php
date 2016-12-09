<?php
	require_once('../system_inits.php');

	function ha_generate_login_hash($email) {
		return $email . hash("whirlpool", $email . $secrert_word);
	}

	function ha_validate_login() {
		if (isset($_SESSION["login"]) && $_SESSION["login"] == 
			ha_generate_login_hash($_SESSION["email"]))
			return true;


		if (isset($_COOKIE["login"]) && $_COOKIE["login"] == 
			ha_generate_login_hash($_COOKIE["email"])) {
			$_SESSION["login"] = $_COOKIE["login"];
			$_SESSION["email"] = $_COOKIE["email"];
			$_SESSION["user_name"] = $_COOKIE["user_name"];
			$_SESSION["user_id"] = $_COOKIE["user_id"];

			setcookie("login", $_COOKIE["login"], time() + 3 * 24 * 60 * 60);
			setcookie("email", $_COOKIE["email"], time() + 3 * 24 * 60 * 60);
			setcookie("user_name", $_COOKIE["user_name"], 
				time() + 3 * 24 * 60 * 60);
			setcookie("user_id", $_COOKIE["user_id"], 
				time() + 3 * 24 * 60 * 60);
			return true;
		}


		return false;
	}
?>