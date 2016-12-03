<?php 
	require_once('system_inits.php'); 
	if (!isset($_SESSION['uid']))
		header('Location: index.php');

?>

<!DOCTYPE html>
<html lang="en">

	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
		<meta name="description" content="">
		<meta name="author" content="">
		<link rel="icon" href="../../favicon.ico">

		<title>User page</title>

		<!-- Bootstrap core CSS -->
		<link href="css/bootstrap.min.css" rel="stylesheet">

		<!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
		<link href="css/ie10-viewport-bug-workaround.css" rel="stylesheet">

		<!-- Custom styles for this template -->
		<link href="jumbotron.css" rel="stylesheet">

		<!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
		<!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
		<script src="js/ie-emulation-modes-warning.js"></script>

		<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
		<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
		<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
		<![endif]-->

		<script src="jquery-3.1.0.min.js"></script>
		<script src="js/bootstrap.min.js"></script>
		<script type="text/javascript" 
			src="https://www.gstatic.com/charts/loader.js"></script>

		<script type="text/javascript">
    		function try_add_category() {
    			var alerts;
    			var t_good_low, t_good_high, t_norm_low, t_norm_high;
    			var	rh_good_low, rh_good_high, rh_norm_low, rh_norm_high;
    			var co2_good_high, co2_norm_high;
    			var category_desc;

    			alerts = document.getElementById('alerts');
    			alerts.style.display = 'none';

    			t_good_low = document.getElementById('t_good_low').value;
    			t_good_high = document.getElementById('t_good_high').value;
    			t_norm_low = document.getElementById('t_norm_low').value;
    			t_norm_high = document.getElementById('t_norm_high').value;

    			rh_good_low = document.getElementById('rh_good_low').value;
    			rh_good_high = document.getElementById('rh_good_high').value;
    			rh_norm_low = document.getElementById('rh_norm_low').value;
    			rh_norm_high = document.getElementById('rh_norm_high').value;

    			co2_good_high = document.getElementById('co2_good_high').value;
    			co2_norm_high = document.getElementById('co2_norm_high').value;

    			category_desc = document.getElementById('category_desc').value;
    			category_name = document.getElementById('category_name').value;

    			$.post("try_add_category.php", { category_name: category_name,
    				category_desc: category_desc, t_good_low: t_good_low, 
    				t_good_high:t_good_high, t_norm_low: t_norm_low,
    				t_norm_high: t_norm_high, rh_good_low: rh_good_low, 
    				rh_good_high: rh_good_high, rh_norm_low: rh_norm_low,
    				rh_norm_high: rh_norm_high, co2_good_high: co2_good_high,
    				co2_norm_high: co2_norm_high },
    				function (data) {
    					if (data != 'OK') {
    						alerts.style.display = '';
    						alerts.innerHTML = data;
    					}
    				});
    		}
		</script>
	</head>

	<body onload="get_data()">
		<nav class="navbar navbar-default navbar-fixed-top">
			<div class="container-fluid">	
				<div class="navbar-header">
					<button type="button" class="navbar-toggle collapsed" 
						data-toggle="collapse" data-target="#collapsable-navbar" aria-expanded="false">
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
					<a class="navbar-brand" href="user_page.php">Healthy air</a>
				</div>		

				<div class="collapse navbar-collapse" id="collapsable-navbar">
					<ul class="nav navbar-nav">
						<li class="">
							<a href="user_page.php">Статистика</a>
						</li>

						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown" 
								role="button" aria-haspopup="true" 
								aria-expanded="false">
								Настройки<span class="caret"></span>
							</a>
							<ul class="dropdown-menu">
								<li>
									<a href="common_settings.php">
										Общие настройки
									</a>
								</li>
								<li>
									<a href="#">	
										Добавление категорий
									</a>
								</li>
							</ul>
						</li>
					</ul>
				</div>	
			</div>
		</nav>

		<div class="container-fluid" style="margin-top: 3%">

			<div class="row">
				
				
				<div class="col-lg-12">
					<div class="jumbotron">
						<div class="row">
							<div class="alert alert-danger" role="alert" 
								id="alerts" style="display:none;"></div>

							<div class="col-lg-12">
								<form class="form">
									<!-- Category info -->
									<div class="panel panel-default">
										<div class="panel-heading">
											Информация о категории
										</div>
										<div class="panel-body">
											<label for="category_name">
												Название категории:
											</label>
											<input type="text" class="form-control" 
												id="category_name" 
												placeholder="Название категории">
											<label for="category_desc">
												Описание категории:
											</label>
											<input type="text" class="form-control" 
												id="category_desc" 
												placeholder="Описание категории (необязательно)">
										</div>
									</div>
									
									<!-- Good temperature -->
									<div class="panel panel-default">
										<div class="panel-heading">
											Параметры оптимальной темепературы
										</div>
										<div class="panel-body">
											<label for="t_good_low">
												Нижняя граница оптимальной температуры: 
											</label>
											<input type="text" class="form-control" 
												id="t_good_low" 
												placeholder="Нижняя граница оптимальной температуры">
											
											<label for="t_good_high">
												Верхняя граница оптимальной температуры:
											</label>
											<input type="text" class="form-control" 
												id="t_good_high" 
												placeholder="Верхняя граница оптимальной температуры:">
										</div>
									</div>

									<!-- Normal temperature -->
									<div class="panel panel-default">
										<div class="panel-heading">
											Параметры допустимой темепературы
										</div>
										<div class="panel-body">
											<label for="t_norm_low">
												Нижняя граница допустимой температуры: 
											</label>
											<input type="text" class="form-control" 
												id="t_norm_low" 
												placeholder="Нижняя граница допустимой температуры">
											
											<label for="t_norm_high">
												Верхняя граница допустимой температуры:
											</label>
											<input type="text" class="form-control" 
												id="t_norm_high" 
												placeholder="Верхняя граница допустимой температуры:">
										</div>
									</div>

									<!-- Good rh -->
									<div class="panel panel-default">
										<div class="panel-heading">
											Параметры оптимальной влажности
										</div>
										<div class="panel-body">
											<label for="rh_good_low">
												Нижняя граница оптимальной влажности: 
											</label>
											<input type="text" class="form-control" 
												id="rh_good_low" 
												placeholder="Нижняя граница оптимальной влажности">
											
											<label for="rh_good_high">
												Верхняя граница оптимальной влажности:
											</label>
											<input type="text" class="form-control" 
												id="rh_good_high" 
												placeholder="Верхняя граница оптимальной влажности:">
										</div>
									</div>

									<!-- Normal rh -->
									<div class="panel panel-default">
										<div class="panel-heading">
											Параметры нормальной влажности
										</div>
										<div class="panel-body">
											<label for="rh_norm_low">
												Нижняя граница нормальной влажности: 
											</label>
											<input type="text" class="form-control" 
												id="rh_norm_low" 
												placeholder="Нижняя граница нормальной влажности">
											
											<label for="rh_norm_high">
												Верхняя граница нормальной влажности:
											</label>
											<input type="text" class="form-control" 
												id="rh_norm_high" 
												placeholder="Верхняя граница нормальной влажности:">
										</div>
									</div>

									<!-- CO2 params-->
									<div class="panel panel-default">
										<div class="panel-heading">
											Параметры CO2
										</div>
										<div class="panel-body">
											<label for="co2_good_high">
												Верхняя граница оптимальной концентрации CO2: 
											</label>
											<input type="text" class="form-control" 
												id="co2_good_high" 
												placeholder="Верхняя граница оптимальной концентрации CO2">
											
											<label for="co2_good_high">
												Верхняя граница допустимой концентрации CO2:
											</label>
											<input type="text" class="form-control" 
												id="co2_norm_high" 
												placeholder="Верхняя граница допустимой концентрации CO2">
										</div>
									</div>
									
									<button type="button" name="submit" 
										class="btn btn-success btn-md" 
										onclick="try_add_category()" 
										style="margin-top:1%">
										Добавить категорию
									</button>
								</form>
								</div>
						</div>
					</div>
				</div>

			</div>

		</div>

	</body>
</html>