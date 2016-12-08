<?php
  require_once('system_inits.php'); 
  require_once('healthyair_functions/ha_login_functions.php');
  if (!ha_validate_login())
    header('Location: index.php');
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
  </script>

  </head>

  <body>

    <div class="mdl-layout mdl-js-layout mdl-layout--fixed-header">
      <header class="mdl-layout__header">
        <div class="mdl-layout__header-row">
          <!-- Title -->
          <span class="mdl-layout-title">Healthy air</span>
          <!-- Add spacer, to align navigation to the right -->
          <div class="mdl-layout-spacer"></div>
          <!-- Navigation. We hide it in small screens. -->
          <nav class="mdl-navigation">
            <label> Привет, <?php echo $_SESSION["user_name"]; ?></label>
            <a class="mdl-navigation__link" href="">Выйти</a>
          </nav>
        </div>
      </header>
  </body>
</html>