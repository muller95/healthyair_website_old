<!DOCTYPE html>
<html lang="en">

  <head>
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
      }
    </script>

  </head>

  <body>
    <button type="button" name="submit"
      style="margin-left:15%" align="center" onclick="try_send()">Send data</button>
  </body>
</html>
