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
      function try_send() {
        $.get('get_date.php', 
                function(datetime){
                  var t = 20 + 5 * Math.random();
                  var rh = 30 + 20 * Math.random();
                  var co2 = Math.trunc(600 + 900 * Math.random());
                  $.post("data_listener.php", { email:"muller95@yandex.ru", passwd:"Warcraft123Ab", 
                                                stname:"station", t:t, rh:rh, co2:co2, datetime:datetime }, 
                          function (data) {
                            alert(data);
                          });
                });


        /*$.post("try_login.php", { email:login_email, passwd:login_passwd},  
            function(data) {
              if (data != "OK") {
                alerts.style.display = "";
                alerts.innerHTML = data;
              } else
                  window.location.href = "user_page.php";
            });*/
      }
    </script>

  </head>

  <body>
    <button type="button" name="submit" class="btn btn-success btn-lg" 
      style="margin-left:15%" align="center" onclick="try_send()">Send data</button>
  </body>
</html>
