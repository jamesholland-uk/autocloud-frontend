<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <link rel="stylesheet" href="stylesheet.css" type="text/css">
    <title>Cloudy Attacker</title>
  </head>
  <body>
    <b>
    <table border="0">
    <tr><td><img src="logo.png"></td><td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td><td><h1>Cloud Attacker</h1></td></tr>
    <tr><td>&nbsp;</td><td>&nbsp;</td><td>
        <br>
      <br>
      <br>
      <br>
      <br>

<?php

$reqNumber=$_GET["reqNumber"];
exec("/var/www/html/autocloud-frontend/attacker-portal/generate_attacker_links_page.sh $reqNumber");

?>

</td></tr>
        </table>
        </b>
  </body>
</html>