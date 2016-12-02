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
        <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../favicon.ico">

    <title>Login</title>

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
    <div class="container">
      <div class="row">
        <div class="col-lg-5 col-lg-offset-3 col-md-6 col-md-offset-4 col-sm-8 col-sm-offset-3 col-xs-12">

          <form name="login_form">

            <div class="jumbotron">
              <div class="alert alert-danger" role="alert" id="alerts" style="display:none;"></div>

              <label for="email">Email</label>
              <input type="email" class="form-control" id="email" placeholder="Email">
              <label for="passwd">Пароль</label>
              <input type="password" class="form-control" id="passwd" placeholder="Пароль">

              <div class="row" style="margin-top:10%">
                <div class="col-lg-offset-1 col-md-offset-1 col-sm-offset-1 col-xs-offset-3">
                    <button type="button" name="submit" class="btn btn-success btn-lg" onclick="try_login()">Войти</button>
                    <a class="btn btn-primary btn-lg" href="register.php" role="button">Зарегистрироваться</a>
                </div>
              </div>

            </div>

          </form>

        </div>
      </div>
    </div>
  </body>
</html>
