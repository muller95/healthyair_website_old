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

    <script type="text/javascript">
        function logout() {
          $.post("logout.php",
            function (data) {
              window.location.href = "index.php";
            });
        }

        function try_get_stations() {
          var stations = document.getElementById("stations");
          /*var no_stations = document.getElementById("no_stations");
          
            stations.style.display = "none";
            no_stations.style.display = "none";*/

          $.get("try_get_stations.php",  
            function(data) {
            
            if (data == "NO STATIONS"){
              no_stations.style.display = "";
            }
            else {
              stations.innerHTML = data;

/*              var stations_btns = document.getElementById('stations').children;
                if (stname == null)
                  set_station(stations_btns[0].name);
                else
                  set_station(stname);*/
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


    </script>

  </head>

  <body onload="try_get_stations()"> 
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
    </div>

    <main class="mdl-layout__content">
      <div class="page-content">   
        <div class="mdl-grid">
          <!-- Meteostations card -->
          <div class="mdl-card mdl-cell mdl-cell--3-col mdl-cell--6-col-tablet 
             mdl-cell--1-offset-tablet mdl-shadow--2dp mdl-card--border"
             style="min-width: 325px">
            <div class="mdl-card__title healthyair_font" 
              style="background:#219e21; font-size:20pt;
                color:#FAFAFA">
              Мои метеостанции
            </div>
            <!--Adding station-->
            <div class="mdl-card__actions mdl-card--border">
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
        </div>
      </div>
    </main>

    <input type="hidden" id="form_secret" 
      value="<?php echo $_SESSION["form_secret"]?>">
  </body>
</html>