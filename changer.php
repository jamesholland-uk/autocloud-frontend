<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>Demo</title>
  </head>
  <body>

           <b>
        <table border="0">
        <tr><td><img src="logo.png"></td><td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td><td><h1>Customised Cloud Automation Demo</h1></td></tr>
        <tr><td>&nbsp;</td><td>&nbsp;</td><td>

<?php
        // Database variables
        $servername = "localhost";
        $username = "dbuser";
        $password = "Panadmin001!";
        $dbname = "auto-hack-cloud";

        // Create connection
        $conn = new mysqli($servername, $username, $password, $dbname);
        // Check connection
        if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
        } 

        // Collect job variable and get status
        $uid=$_GET["uid"];
        $sqlcheck = "SELECT * FROM jobs WHERE JOB = '$uid'";

        $conn->query($sqlcheck);
        $result = $conn->query($sqlcheck);
        $status= $result->fetch_assoc();

        $ipadd=$status['MGMTIP'];
        //echo $ipadd;
        
        if ($_GET['blockme']) {
                exec("/var/www/html/autocloud-frontend/blockme.sh $ipadd");
                echo "Selected Security Profiles with block...";
        }

        if ($_GET['alertme']) {
                exec("/var/www/html/autocloud-frontend/alertme.sh $ipadd");
                echo "Selected Security Profiles with alert...";
        }

        header("refresh:3; url=status.php?uid=$uid");
        exit();
?>

</td></tr>
        </table>
        </b>
  </body>
</html>
