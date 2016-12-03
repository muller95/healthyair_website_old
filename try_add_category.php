<?php
	require_once('system_inits.php');

	if (!isset($_SESSION['uid'])) 
		exit(0);

	$error = false;

	$user_id = $_SESSION['uid'];

	$category_name = trim($_POST['category_name']);
	$category_desc = $_POST['category_desc'];
		
	$t_good_low = $_POST['t_good_low'];
	$t_good_high = $_POST['t_good_high'];
	$t_norm_low = $_POST['t_norm_low'];
	$t_norm_high = $_POST['t_norm_high'];

	$rh_good_low = $_POST['rh_good_low'];
	$rh_good_high = $_POST['rh_good_high'];
	$rh_norm_low = $_POST['rh_norm_low'];
	$rh_norm_high = $_POST['rh_norm_high'];

	$co2_good_high = $_POST['co2_good_high'];
	$co2_norm_high = $_POST['co2_norm_high'];		

	if (!$category_name) {
		echo 'Необходимо указать название категории<br>';
		$error = true;
	} else {
		$query = sprintf("SELECT * FROM room_categories WHERE ($user_id=%d
			OR $user_id=-1) AND category_name='%s';", $user_id, 
			$category_name);

		if (!($result=$mysqli->query($query))) {
			fprintf($stderr, 'Error message: %s\n', $mysqli->error);
			exit(1);
		}

		if ($result->num_rows > 0) {
			echo 'Такая категория уже есть<br>';
			$error = true;
		}
	}

	//Good temperature checks
	if (!$t_good_low) {
		echo 'Необходимо указать нижнюю границу оптимальной температуры<br>';
		$error = true;
	} else if (!is_numeric($t_good_low)) {
		echo 'Нижняя граница оптимальной температуры должна быть 
			вещественным числом, например, 123.45<br>';
		$error = true;
	}

	if (!$t_good_high) {
		echo 'Необходимо указать верхнюю границу оптимальной температуры<br>';
		$error = true;
	} else if (!is_numeric($t_good_high)) {
		echo 'Верхняя граница оптимальной температуры должна быть 
			вещественным числом, например, 123.45<br>';
		$error = true;
	}

	//Norm temperature checks
	if (!$t_norm_low) {
		echo 'Необходимо указать нижнюю границу допустимой температуры<br>';
		$error = true;
	} else if (!is_numeric($t_norm_low)) {
		echo 'Нижняя граница допустимой влажности должна быть 
			вещественным числом, например, 123.45<br>';
		$error = true;
	}

	if (!$t_norm_high) {
		echo 'Необходимо указать верхнюю границу допустимой темпратуры<br>';
		$error = true;
	} else if (!is_numeric($t_norm_high)) {
		echo 'Верхняя граница допустимой влажности должна быть 
			вещественным числом, например, 123.45<br>';
		$error = true;
	}

	//Good rh checks
	if (!$rh_good_low) {
		echo 'Необходимо указать нижнюю границу оптимальной влажности<br>';
		$error = true;
	} else if (!is_numeric($rh_good_low)) {
		echo 'Нижняя граница оптимальной влажности должна быть 
			вещественным числом, например, 123.45<br>';
		$error = true;
	}

	if (!$rh_good_high) {
		echo 'Необходимо указать верхнюю границу оптимальной влажности<br>';
		$error = true;
	} else if (!is_numeric($rh_good_high)) {
		echo 'Верхняя граница оптимальной влажности должна быть 
			вещественным числом, например, 123.45<br>';
		$error = true;
	}

	//Norm rh checks
	if (!$rh_norm_low) {
		echo 'Необходимо указать нижнюю границу допустимой влажности<br>';
		$error = true;
	} else if (!is_numeric($rh_norm_low)) {
		echo 'Нижняя граница допустимой влажности должна быть 
			вещественным числом, например, 123.45<br>';
		$error = true;
	}

	if (!$rh_norm_high) {
		echo 'Необходимо указать верхнюю границу допустимой влажности<br>';
		$error = true;
	} else if (!is_numeric($rh_norm_high)) {
		echo 'Верхняя граница допустимой влажности должна быть 
			вещественным числом, например, 123.45<br>';
		$error = true;
	}

	//СO2 params checks
	if (!$co2_good_high) {
		echo 'Необходимо указать верхню границу оптимальной концентрации
			CO2<br>';
		$error = true;
	} else if (!is_numeric($co2_good_high)) {
		echo 'Верхняя граница оптимальной концентрации CO2 должна быть 
			вещественным числом, например, 123.45<br>';
		$error = true;
	}

	if (!$co2_norm_high) {
		echo 'Необходимо указать верхнюю границу допустимой концентрации 
			CO2<br>';
		$error = true;
	} else if (!is_numeric($co2_norm_high)) {
		echo 'Верхняя граница допустимой концентрации CO2 должна быть 
			вещественным числом, например, 123.45<br>';
		$error = true;
	}

	if (!$error) {
		$query = sprintf("INSERT INTO room_categories 
			VALUES(0, '%s', '%s', %d, %lf, %lf, %lf, %lf, %lf, %lf, %lf, %lf,
				%lf, %lf);", $category_name, $category_desc, $user_id,
				$t_good_low, $t_good_high, $t_norm_low, $t_norm_high,
				$rh_good_low, $rh_good_high, $rh_norm_high, $rh_norm_low,
				$co2_good_high, $co2_norm_high);

		if (!$mysqli->query($query)) {
			echo 'Неизвестная ошибка<br>';
			fprintf($stderr, 'Error message: %s\n', $mysqli->error);
			exit(1);
		}

		echo 'OK';
	}
?>