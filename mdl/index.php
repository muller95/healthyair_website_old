<?php
  require_once('system_inits.php'); 
  require_once('healthyair_functions/ha_login_functions.php');
  if (ha_validate_login())
    header('Location: user_page.php');
?>

<!DOCTYPE html>
<html lang="en">

  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Вход</title>

    <link rel="stylesheet" href="mdl/material.css">
    <link rel="stylesheet" href="healthyair_css/font_styles.css">
    <script src="mdl/material.min.js"></script>
    <link rel="stylesheet" 
      href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <script src="jquery-3.1.0.min.js"></script>

  <script type="text/javascript">
    function try_login() {
      var error_list = document.getElementById("error_list");
      var email = document.getElementById("email").value;
      var passwd = document.getElementById("passwd").value;
      var remember = document.getElementById("remember").checked;

      error_list.style.display = 'none';
      $.post("try_login.php", { email: email, passwd: passwd, 
          remember: remember},  
          function(data) {
            if (data != "OK") {
              error_list.style.display = '';
              error_list.innerHTML = data;
            } else
                window.location.href = "user_page.php";
          });
    }

    function try_get_stations() {
        /*var stations = document.getElementById("stations");
        var no_stations = document.getElementById("no_stations");
          
        stations.style.display = "none";
        no_stations.style.display = "none";*/

          $.get("try_get_stations.php",  
            function(data) {
                  if (data == "NO STATIONS") {
                    //no_stations.style.display = "";
                  }
                  else {
                    //stations.style.display = ""; 
                    //stations.innerHTML = data;

                    /*var stations_btns = document.getElementById('stations').children;
                    if (stname == null)
                      set_station(stations_btns[0].name);
                    else
                      set_station(stname);*/
                  }
                });
        }
  </script>

  </head>

  <body>
      <!-- Authorization card -->
      <div class="mdl-card mdl-cell mdl-cell--4-offset-desktop 
        mdl-cell--4-col mdl-cell--6-col-tablet mdl-cell--1-offset-tablet
         mdl-shadow--2dp mdl-card--border">
        <div class="mdl-card__title healthyair_font" 
          style="background:#219e21; font-size:20pt;
            color:#FAFAFA">
          Авторизация
        </div>
      
        
        <div class="mdl-card__actions mdl-card--border">
          <ul class="mdl-list" id="error_list" style="display: none">
          </ul>
          <!-- User email -->
          <div class="mdl-textfield mdl-js-textfield 
            mdl-textfield--floating-label" style="width:100%">
            <input class="mdl-textfield__input" type="text" id="email">
            <label class="mdl-textfield__label" for="email">Email</label>
          </div>

           <!-- Password -->
          <div class="mdl-textfield mdl-js-textfield 
            mdl-textfield--floating-label" style="width:100%">
            <input class="mdl-textfield__input" type="password" id="passwd">
            <label class="mdl-textfield__label" for="email">Password</label>
          </div>

          <!-- Remember me checkbox -->
          <label class="mdl-checkbox mdl-js-checkbox 
            mdl-js-ripple-effect" for="remember">
            <input type="checkbox" id="remember" class="mdl-checkbox__input">
            <span class="mdl-checkbox__label">Запомнить меня</span>
          </label>

          <!-- Log-in and redirect to reigistration buttons -->
          <button class="mdl-button  mdl-button--colored mdl-js-button 
            mdl-button--raised" style="width:100%" onclick="try_login()">
            <label class="healthyair_font"  style="color:#FAFAFA">Войти</label>
          </button>
          <button class="mdl-button mdl-button--raised mdl-js-button 
            mdl-js-ripple-effect" style="width:100%; margin-top:2%">
            <a href="register.php" class="mdl-button">Зарегистрироваться</a>
          </button>

        </div>
      </div>
  </body>
</html>
