<?php
	require_once('system_inits.php');

	if (!isset($_SESSION['uid']))
		exit(0);

	$user_id = $_SESSION['uid'];

	$query = sprintf("SELECT * FROM room_categories 
						WHERE user_id=%d OR user_id=-1;", $user_id);

	if ((!$result = $mysqli->query($query))) {
		fprintf($stderr, "Error message: %s\n", $mysqli->error);
		exit(1);
	}


	echo '<div class="panel panel-default pre-scrollable">';
	echo '<div class="panel-heading">Категории помещений</div>';
		
	echo '<table class="table" table="table_categories">';
		
	echo '<thead>';
    echo '<tr>';
    echo '<th></th>';
    echo '<th>Категория</th>';
    echo '<th>Описание</th>';
    echo '<th>Оптимальная температура</th>';
    echo '<th>Допустимая температура</th>';
    echo '<th>Оптимальная влажнсоть</th>';
    echo '<th>Допустимая влажность</th>';
    echo '<th>Оптимальная концентрация CO2</th>';
    echo '<th>Допустимая концентрация CO2</th>';
    echo '<th></th>';
	echo '</tr>';
	echo '</thead>';

	echo '<tbody>';

	while (($row = $result->fetch_array())) {
		$category_id = $row['category_id'];
		$category_name = $row['category_name'];
		$category_desc = $row['category_desc'];
		
		$t_good_low = $row['t_good_low'];
		$t_good_high = $row['t_good_high'];
		$t_norm_low = $row['t_norm_low'];
		$t_norm_high = $row['t_norm_high'];

		$rh_good_low = $row['rh_good_low'];
		$rh_good_high = $row['rh_good_high'];
		$rh_norm_low = $row['rh_norm_low'];
		$rh_norm_high = $row['rh_norm_high'];

		$co2_good_high = $row['co2_good_high'];
		$co2_norm_high = $row['co2_norm_high'];		

		echo '<tr>';

		printf('<td><div class="radio"><label><input type="radio" 
			name="category_radio" value="%d"></label></div></td>', 
			$category_id);

		printf("<td>%s</td>", $category_name);
		printf("<td>%s</td>", $category_desc);

		printf("<td>%d—%d</td>", $t_good_low, $t_good_high);
		printf("<td>%d—%d</td>", $t_norm_low, $t_norm_high);

		printf("<td>%d—%d</td>", $rh_good_low, $rh_good_high);
		printf("<td>%d—%d</td>", $rh_norm_low, $rh_norm_high);

		printf("<td>0—%d</td>", $co2_good_high);
		printf("<td>0—%d</td>", $co2_norm_high);

		/*	echo '<td>';
			printf ('<input type="password" class="form-control" 
				id="worker%d_passwd" placeholder="Новый пароль">', $worker_id);
			echo '</td>';

			echo '<td>';

			printf('<button type="button" name="submit" class="btn btn-success" 
				onclick="try_update_worker(%d, %d)">Подтвердить</button>',
				$company_id, $worker_id);

			printf('<button type="button" name="submit" class="btn btn-danger" 
				onclick="delete_worker(%d, %d)"
				style="margin-left:2%%">Удалить</button>',
				$company_id, $worker_id);*

			echo '</td>';*/

			echo '</tr>';
	}

	echo '</tbody>';
	echo '</table>';
	echo '</div>';
?>