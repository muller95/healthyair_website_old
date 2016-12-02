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

			function get_data() {
				try_get_stations();
				try_get_categories();
			}

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

            				var stations_btns = document.
            					getElementById('stations').children;

            				if (stname == null)
            					set_station(stations_btns[0].name);
            				else
            					set_station(stname);
            			}
          			});
    		}

    		function try_get_categories() {
    			$.get("try_get_categories.php",  
    				function(data) {
            			document.getElementById('categories').innerHTML = data;
            			set_active_category();
          			});
    		
    		}

    		function set_active_category() {
    			var radios = document.getElementsByName('category_radio');

    			radios[0].checked = true;
    		}
		</script>
	</head>

	<body onload="get_data()">
		<nav class="navbar navbar-default navbar-fixed-top">
			<div class="container-fluid">			
				<ul class="nav navbar-nav">
					<li class="">
						<a href="user_page.php">Статистика</a>
					</li>
					<li class="active">
						<a href="#">Настройки</a>
					</li>
				</ul>
			</div>
		</nav>

		<div class="container-fluid" style="margin-top: 3%">

			<div class="row">
				
				<div class="col-lg-3 col-md-4 col-sm-12 col-xs-12">
					<div class="jumbotron">

						<div class="alert alert-danger" role="alert" 
							id="alerts" style="display:none;"></div>
						<div class="alert alert-warning" id="no_stations" 
							role="alert" style="display:none;">
							You have no registered meteostations at the moment
						</div>

						<div class="list-group" id="stations" 
							style="display:none; margin-top: 3%"></div>

						<label for="name">Station name</label>
			            <input type="text" class="form-control" id="name" placeholder="Station name">

		                <div class="row" style="margin-top:3%">
				            <div class="col-lg-offset-3 col-lg-4 col-md-offset-1 col-md-4
				            			col-sm-offset-3 col-sm-4 col-xs-offset-3 col-xs-4">
								<button type="button" name="submit" class="btn btn-success btn-lg" 
				                		onclick="try_add_station()">Add station</button>
			                </div>
		                </div>
					</div>
				</div>

				<div class="col-lg-9 col-md-8 col-sm-12 col-xs-12">
					<div class="jumbotron">
						<div class="row">
							<div id="categories" class="col-lg-12">
							</div>
						</div>
					</div>
				</div>

			</div>

		</div>

	</body>
</html>