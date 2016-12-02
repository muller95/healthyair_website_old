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
		<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

		<script type="text/javascript">
			var stname = null;
			var initiated = false;

			var t_lowest = 0;
            var t_mid = 25;
            var t_high = 40;
            var t_highest = 100;
            var t_gauge, co2_gauge_options;
			var temp_gauge, temp_gauge_options;
			var temp_graphic, temp_graphic_options, temp_graphic_data;
			
			
			var rh_lowest = 0;
            var rh_mid = 50;
            var rh_high = 70;
            var rh_highest = 100;
			var rh_gauge, rh_gauge_options;
			var rh_graphic, rh_graphic_options, rh_graphic_data;

			
            var co2_lowest = 0;
            var co2_mid = 1000;
            var co2_high = 2500;
            var co2_highest = 10000;
            var co2_gauge, co2_gauge_options;
            var co2_graphic, co2_graphic_options, co2_graphic_data;

			window.setInterval(request_gauges_data, 1000);
			window.setInterval(request_graphics_data, 1000);
			google.charts.load('current', {'packages':['corechart', 'line', 'gauge']});
			google.charts.setOnLoadCallback(init_charts);

			function set_station(name) {
				var stations_btns = document.getElementById('stations').children;
				var prev_name;
				prev_stname = stname;
				stname = name;

				for (var i = 0; i < stations_btns.length; i++)
					if (stations_btns[i].name == stname)
						stations_btns[i].className = "list-group-item active";
					else if (stations_btns[i].name == prev_stname)
						stations_btns[i].className = "list-group-item";
					
			}

			function request_graphics_data() {
				if (!initiated || !stname)
					return;

				$.post("json_response.php", {stname:stname, limit:100}, function(data) {
					var json_strings = JSON.parse(data);

					temp_graphic_data.removeRows(0, temp_graphic_data.getNumberOfRows());
					rh_graphic_data.removeRows(0, rh_graphic_data.getNumberOfRows());
					co2_graphic_data.removeRows(0, co2_graphic_data.getNumberOfRows());

					for (var i = json_strings.length - 1, j = 0; i >= 0; i--, j++) {
						var meas_params = JSON.parse(json_strings[i]);
						var t = parseFloat(meas_params["t"]);
						var rh = parseFloat(meas_params["rh"]);
						var co2 = parseFloat(meas_params["co2"]);
						temp_graphic_data.addRow([j, t]);
						rh_graphic_data.addRow([j, rh]);
						co2_graphic_data.addRow([j, co2]);
					}
					
					temp_graphic.draw(temp_graphic_data, temp_graphic_options);
					rh_graphic.draw(rh_graphic_data, rh_graphic_options);
					co2_graphic.draw(co2_graphic_data, co2_graphic_options);
				});
			}

			function init_charts() {
				temp_gauge = new google.visualization.Gauge(document.getElementById('temp_gauge'));
				temp_gauge_options = {minorTicks:5, greenFrom:t_lowest, greenTo:t_mid,
										yellowFrom:t_mid, yellowTo:t_high, redFrom:t_high,
										redTo:t_highest};

				rh_gauge = new google.visualization.Gauge(document.getElementById('rh_gauge'));
				rh_gauge_options = {minorTicks:5, greenFrom:rh_lowest, greenTo:rh_mid,
										yellowFrom:rh_mid, yellowTo:rh_high, redFrom:rh_high,
										redTo:rh_highest};

				co2_gauge = new google.visualization.Gauge(document.getElementById('co2_gauge'));
				co2_gauge_options = {minorTicks:5, max:10000, greenFrom:co2_lowest, greenTo:co2_mid,
										yellowFrom:co2_mid, yellowTo:co2_high, redFrom:co2_high,
										redTo:co2_highest};


				temp_graphic = new google.visualization.LineChart(document.getElementById('temp_graphic'));		
				temp_graphic_options = {
					title: 'Temperature',
					curveType: 'function',
					legend: { position: 'bottom' }
				};
				temp_graphic_data = new google.visualization.DataTable();
				temp_graphic_data.addColumn('number', 'X');
				temp_graphic_data.addColumn('number', 'Temperature');

				rh_graphic = new google.visualization.LineChart(document.getElementById('rh_graphic'));
				rh_graphic_options = {
					title: 'RH',
					curveType: 'function',
					legend: { position: 'bottom' }
				};
				rh_graphic_data = new google.visualization.DataTable();
				rh_graphic_data.addColumn('number', 'X');
				rh_graphic_data.addColumn('number', 'RH');

				co2_graphic = new google.visualization.LineChart(document.getElementById('co2_graphic'));
				co2_graphic_options = {
					title: 'CO2',
					curveType: 'function',
					legend: { position: 'bottom' }
				};
				co2_graphic_data = new google.visualization.DataTable();
				co2_graphic_data.addColumn('number', 'X');
				co2_graphic_data.addColumn('number', 'CO2');

				initiated = true;			

			}

			function request_gauges_data() {
				if (!initiated || !stname)
					return;
				
				$.post("json_response.php", {stname:stname, limit:1}, function(data) {
					var json_strings = JSON.parse(data);
					
					var t = 0, rh = 0, co2 = 0;

					if (json_strings.length > 0) {
						var meas_params = JSON.parse(json_strings[0]);
						
						t = parseFloat(meas_params["t"]);
						rh = parseFloat(meas_params["rh"]);
						co2 = parseFloat(meas_params["co2"]);
					}
					
            		var temp_gauge_data = google.visualization.arrayToDataTable([['Label', 'Value'],
         				['Temperature', t]]);
            		temp_gauge.draw(temp_gauge_data, temp_gauge_options);

            		var rh_gauge_data = google.visualization.arrayToDataTable([['Label', 'Value'],
         				['RH', rh]]);
            		rh_gauge.draw(rh_gauge_data, rh_gauge_options);
       		
            		var co2_gauge_data = google.visualization.arrayToDataTable([['Label', 'Value'],
         				['CO2', co2]]);
            		co2_gauge.draw(co2_gauge_data, co2_gauge_options);
				});
			}

			function try_add_station() {
			    var alerts = document.getElementById("alerts");
			   	var station_name = document.getElementById('name').value;

			   	alerts.innerHTML = "";
      			alerts.style.display = "none";

    			$.post("try_add_station.php", { name:station_name },  
    				function(data) {
            			if (data != "OK") {
             				alerts.style.display = "";
              				alerts.innerHTML = data;
            			} 

            			try_get_stations();
          			});
    		}

    		function try_get_stations() {
    			var stations = document.getElementById("stations");
    			var no_stations = document.getElementById("no_stations");
    			
				stations.style.display = "none";
				no_stations.style.display = "none";

    			$.get("try_get_stations.php",  
    				function(data) {
            			if (data == "NO STATIONS")
           					no_stations.style.display = "";
            			else {
            				stations.style.display = ""; 
            				stations.innerHTML = data;

            				var stations_btns = document.getElementById('stations').children;
            				if (stname == null)
            					set_station(stations_btns[0].name);
            				else
            					set_station(stname);
            			}
          			});
    		}

    		function change_chart(button) {
    			var graphics_button = document.getElementById('graphics_button');
    			var gauge_button = document.getElementById('gauges_button');
    			var graphics = document.getElementById('graphics');
    			var gauges = document.getElementById('gauges');

    			if (button.id == 'graphics_button') {
    				graphics_button.className = 'btn btn-default active';
    				gauges_button.className = 'btn btn-default';
    				graphics.style.display = '';
    				gauges.style.display = 'none';
    			} else if (button.id == 'gauges_button') {
    				graphics_button.className = 'btn btn-default';
    				gauges_button.className = 'btn btn-default active';
    				graphics.style.display = 'none';
    				gauges.style.display = '';			
    			}
    		}
		</script>
	</head>

	<body onload="try_get_stations()">
		<nav role="navigation" class="navbar navbar-default navbar-fixed-top">
			<div class="container-fluid">	
				<ul class="nav navbar-nav">
					<li class="active">
						<a href="#">Статистика</a>
					</li>
					<li class="">
						<a href="user_settings.php">Настройки</a>
					</li>
				</ul>
			</div>
		</nav>

		<div class="container-fluid" style="margin-top: 3%">

			<div class="row">
				
				<div class="col-lg-3 col-md-4 col-sm-12 col-xs-12">
					<div class="jumbotron">

						<div class="alert alert-danger" role="alert" id="alerts" style="display:none;"></div>
						<div class="alert alert-warning" id="no_stations" role="alert" style="display:none;">
							You have no registered meteostations at the moment
						</div>


						<div class="row">
							<div class="col-lg-12">
								<div class="btn-group btn-group-justified">
									<div id="chart_selector" class="btn-group" role="group">
										<button id="graphics_button" type="button" class="btn btn-default active" 
											onclick="change_chart(this)">График</button>
									</div>
									<div id="chart_selector" class="btn-group" role="group">
										<button id="gauges_button" type="button" class="btn btn-default" 
											onclick="change_chart(this)">Сейчас</button>
									</div>
								</div>
							</div>
						</div>

						<div class="list-group" id="stations" style="display:none; margin-top: 3%"></div>

						<label for="name">Название метеостанции:</label>
			            <input type="text" class="form-control" id="name" placeholder="Название метеостанции">

		                <div class="row" style="margin-top:3%">
				            <div class="col-lg-offset-3 col-lg-4 col-md-offset-3 col-md-4
				            			col-sm-offset-3 col-sm-4 col-xs-offset-3 col-xs-4">
								<button type="button" name="submit" class="btn btn-success btn-lg" 
				                		onclick="try_add_station()">Добавить</button>
			                </div>
		                </div>
					</div>
				</div>

				<div class="col-lg-9 col-md-8 col-sm-12 col-xs-12">
					<div class="jumbotron">
						<div id="graphics" class="row">
							<div id="temp_graphic"></div>
							<div id="rh_graphic"></div>
							<div id="co2_graphic"></div>
						</div>

						<div id="gauges" class="row" style="display:none">
							<div class="col-lg-4 col-md-7 col-sm-7">
								<div id="temp_gauge"></div>
							</div>

							<div class="col-lg-4 col-md-5 col-sm-5">
								<div id="rh_gauge"></div>
							</div>
							<div class="col-lg-4 col-md-12 col-sm-12">
								<div id="co2_gauge">
							</div>
						</div>

					</div>
				</div>

			</div>

		</div>

	</body>
</html>