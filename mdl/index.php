<?php
  require_once('system_inits.php'); 
  if (isset($_SESSION['uid']))
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
      var alerts = document.getElementById("alerts");
      var login_email = document.forms["login_form"]["email"].value;
      var login_passwd = document.forms["login_form"]["passwd"].value;
             
      alerts.innerHTML = "";
      alerts.style.display = "none";

      $.post("try_login.php", { email:login_email, passwd:login_passwd},  
          function(data) {
            if (data != "OK") {
              alerts.style.display = "";
              alerts.innerHTML = data;
            } else 
                window.location.href = "user_page.php";
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
  
        <!-- Log-in and redirect to reigistration buttons -->
          <button class="mdl-button  mdl-button--colored mdl-js-button 
            mdl-button--raised" style="width:100%">
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
