<?php
  require_once('system_inits.php'); 
  require_once('healthyair_functions/ha_login_functions.php');
  if (!ha_validate_login())
    header('Location: index.php');

  $_SESSION["form_secret"] = rand(0, 1000);
?>

<!DOCTYPE html>
<html lang="en">

  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Статистика</title>

    <link rel="stylesheet" href="mdl/material.css">
    <link rel="stylesheet" href="healthyair_css/font_styles.css">
    <script src="mdl/material.min.js"></script>
    <link rel="stylesheet" 
      href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <script src="jquery-3.1.0.min.js"></script>
    <script type="text/javascript" 
      src="https://www.gstatic.com/charts/loader.js"></script>

    <script type="text/javascript">
      var station_id = null;
      var initiated = false;

      var t_lowest = 0;
      var t_mid = 25;
      var t_high = 40;
      var t_highest = 100;
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


      function logout() {
        $.post("logout.php",
          function (data) {
            window.location.href = "index.php";
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
          title: 'T',
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
        var form_secret = document.getElementById("form_secret").value;

        if (!initiated || !station_id)
          return;


        
        $.post("json_response.php", { station_id: station_id, limit:1, 
          form_secret: form_secret }, 
          function(data) {
            var json_strings = JSON.parse(data);
            
            var t = 0, rh = 0, co2 = 0;

            if (json_strings.length > 0) {
              var meas_params = JSON.parse(json_strings[0]);
              
              t = parseFloat(meas_params["t"]);
              rh = parseFloat(meas_params["rh"]);
              co2 = parseFloat(meas_params["co2"]);
          }
          
                var temp_gauge_data = google.visualization.arrayToDataTable([['Label', 'Value'],
                ['T', t]]);
                temp_gauge.draw(temp_gauge_data, temp_gauge_options);

                var rh_gauge_data = google.visualization.arrayToDataTable([['Label', 'Value'],
                ['RH', rh]]);
                rh_gauge.draw(rh_gauge_data, rh_gauge_options);
          
                var co2_gauge_data = google.visualization.arrayToDataTable([['Label', 'Value'],
                ['CO2', co2]]);
                co2_gauge.draw(co2_gauge_data, co2_gauge_options);
        });
      }

      function request_graphics_data() {
        var form_secret = document.getElementById("form_secret").value;
        if (!initiated || !station_id)
          return;

        $.post("json_response.php", { station_id: station_id, limit:100 , form_secret: form_secret }, 
          function(data) {
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

        function set_station_id(radio) {
          radio.checked = true;
          station_id = radio.value;
        }

        function upgrade_radios() {
          var radios;
          alert('here');
          radios = document.getElementsByName("station_radios");
          alert(station_radios);
        }

        function try_get_stations() {
          var stations = document.getElementById("stations");
          var warn_list = document.getElementById("warn_list");
          var form_secret = document.getElementById("form_secret").value;

          $.post("try_get_stations.php", { form_secret: form_secret },
            function(data) {
              if (data == "NO STATIONS"){
                warn_list.style.display = "";
                stations.innerHTML = "";
              }
              else {
                var radios;

                stations.innerHTML = data;
                radios = document.getElementsByName('station_radios');
                set_station_id(radios[0]);
              
              }
            });
        }

        function delete_station(station_id) {
          var error_list = document.getElementById("error_list");
          var form_secret = document.getElementById("form_secret").value;
          
          error_list.style.display = 'none';
          $.post("delete_station.php", { station_id: station_id,
            form_secret: form_secret },
            function (data) {
              if (data != "OK") {
                error_list.style.display = '';
                error_list.innerHTML = data;
              }

              try_get_stations();
            });
        }

        function try_add_station() {
          var error_list = document.getElementById("error_list");
          var station_textbox = document.getElementById("station_name");
          var station_name = station_textbox.value;
          var form_secret = document.getElementById("form_secret").value;
          
          error_list.style.display = 'none';
          
          $.post("try_add_station.php", { station_name: station_name, 
            form_secret: form_secret },  
            function(data) {
              if (data != "OK") {
                error_list.style.display = "";
                error_list.innerHTML = data;
              } else
                station_textbox.value = "";
                try_get_stations();
            });
        } 

        function set_graphic(graphic_button) {
          var index = graphic_button.id.indexOf("_");
          var meas_type = graphic_button.id.substring(0, index);
          var statistic_controls = document.
            getElementById("statistics_card").children;

          for (var i = 0; i < statistic_controls.length; i++) {
            var type
            var id = statistic_controls[i].id;
            
            index = id.indexOf("_");
            type = id.substring(index + 1);
            
            if (type == "button") {
              if (id.substring(0, index) == meas_type)
                statistic_controls[i].style.backgroundColor =  
                  "rgba(33, 158, 33, 0.5)";
              else 
                statistic_controls[i].style.backgroundColor = 
                  "rgba(0, 0,0, 0)";
            } else if (type == "graphic") {
              if (id.substring(0, index) == meas_type)
                statistic_controls[i].style.display =  "";
              else 
                statistic_controls[i].style.display = "none";
            }
          }
        }

        $(document).ready(function() {
          $("#slide_left").click(function() {
            alert("left.");
          });

          $("#slide_right").click(function() {
            alert("right.");
          });
        });

    </script>

  </head>

  <body onload="try_get_stations()" style="background-color: #EAEAEA"> 
    <div class="mdl-layout mdl-js-layout mdl-layout--fixed-header">
      <header class="mdl-layout__header">
        <div class="mdl-layout__header-row">
          <!-- Title -->
          <span class="mdl-layout-title">Healthy air</span>
          <!-- Add spacer, to align navigation to the right -->
          <div class="mdl-layout-spacer"></div>
          <!-- Navigation. We hide it in small screens. -->
          <nav class="mdl-navigation">
            <a class="mdl-navigation__link" href="" 
                onclick="logout()">Выйти</a>
          </nav>
        </div>
      </header>
    

      <main class="mdl-layout__content">
        <!-- Meteostations card -->
        <div class="mdl-card mdl-cell mdl-cell--3-col mdl-cell--6-col-tablet 
          mdl-cell--1-offset-tablet mdl-shadow--2dp mdl-card--border
          mdl-cell--4-col-phone" style="float: left;">
          <div class="mdl-card__title healthyair_font" 
            style="background:rgb(33, 158, 33); font-size:20pt;
              color:#FAFAFA">
            Мои метеостанции
          </div>
          <!--Adding station-->
          <div class="mdl-card__actions mdl-card--border">
            <!-- No station warn -->
            <ul class="mdl-list" id="warn_list" style="display: none">
              <li class="mdl-list__item">
                <span class="mdl-list__item-primary-content">
                  <i class="material-icons" 
                    style="color: rgb(247, 226, 34)">
                    warning
                  </i>
                  Вы ещё не добавили ни одной метеостанции.
                </span>
              </li>
            </ul>
            <!--Adding station errors -->
            <ul class="mdl-list" id="error_list" style="display: none">
            </ul>
            <div style="max-height: 350px; overflow: auto;">
              <table class="mdl-data-table mdl-js-data-table" id="stations"
                style="width: 100%;">
              </table>
            </div>
            <div class="mdl-textfield mdl-js-textfield 
              mdl-textfield--floating-label" style="width:100%">
              <input class="mdl-textfield__input" type="text" id="station_name">
              <label class="mdl-textfield__label" for="station_name">
                Название метеостанции
              </label>          
            </div>
            <small>
              Название метеостанции должно быть не длиннее 10 символов.
            </small>
            <button class="mdl-button  mdl-button--colored mdl-js-button 
              mdl-button--raised" style="width:100%" onclick="try_add_station()">
              <label class="healthyair_font"  style="color:#FAFAFA">
                Добавить метеостанцию
              </label>
            </button>
          </div>
        </div>
        <!-- Meteostations card end -->

        <!--Statistics card-->
        <div class="mdl-card mdl-cell mdl-cell--9-col mdl-cell--6-col-tablet 
          mdl-cell--1-offset-tablet mdl-shadow--2dp mdl-card--border">
          <div class="mdl-card__title healthyair_font" 
            style="background: rgb(33, 158, 33); font-size:20pt;
            color:#FAFAFA">
            Статистика
          </div>

          <!--Statistics card actions -->
          <div class="mdl-card__actions mdl-card--border mdl-grid" 
            id="statistics_card">           
            <!--Desktop Gauges-->
            <button class="mdl-cell mdl-cell--hide-tablet mdl-cell--hide-phone 
              mdl-button mdl-js-button mdl-js-ripple-effect" id="temp_button"
              onclick="set_graphic(this)"
              style="height: 200px; width:240px; margin-left:22%; 
              background:rgba(33, 158, 33, 0.5)">
              <div id="temp_gauge" class="mdl-cell 
                mdl-cell--2-col" style="min-width:200px; margin-top: 1%"></div>
            </button>
            
            <button class="mdl-cell mdl-cell--hide-tablet mdl-cell--hide-phone 
              mdl-button mdl-js-button mdl-js-ripple-effect" id="rh_button"
              onclick="set_graphic(this)" style="height: 200px; width:240px">
              <div id="rh_gauge"  class="mdl-cell mdl-cell--2-col" 
                style="min-width:200px;  margin-top: 1%"></div>
            </button>

            <button class="mdl-cell mdl-cell--hide-tablet mdl-cell--hide-phone 
              mdl-button mdl-js-button mdl-js-ripple-effect" id="co2_button"
              onclick="set_graphic(this)" style="height: 200px; width:240px ">
              <div id="co2_gauge" class="mdl-cell mdl-cell--2-col" 
                style="min-width:200px;  margin-top: 1%"></div>
            </button>

            <!-- Tablet and mobile gauges -->
            <button class="mdl-cell mdl-cell--1-col mdl-cell--hide-desktop
              mdl-button mdl-js-button mdl-button--fab" id="slide_left">
              <i class="material-icons">keyboard_arrow_left</i>
            </button>

            <div class="mdl-cell mdl-cell--hide-desktop" id="mobile_gauges">
            </div>

            <button class="mdl-cell mdl-cell--1-col mdl-cell--hide-desktop
              mdl-button mdl-js-button mdl-button--fab" id="slide_right">
              <i class="material-icons">keyboard_arrow_right</i>
            </button>


               
            <!-- Graphics -->
            <div id="temp_graphic" class="mdl-cell mdl-cell--12-col"></div>
            <div id="rh_graphic" class="mdl-cell mdl-cell--12-col" 
              style="display: none"></div>
            <div id="co2_graphic" class="mdl-cell mdl-cell--12-col" 
              style="display: none"></div>
          </div>
        </div>
            <!-- End statistics -->

      </main>
    </div>

    <input type="hidden" id="form_secret" 
      value="<?php echo $_SESSION["form_secret"]?>">
  </body>
</html>