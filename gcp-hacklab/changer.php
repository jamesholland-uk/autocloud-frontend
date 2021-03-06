<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <link rel="stylesheet" href="stylesheet.css" type="text/css">
    <title>Demo</title>
  </head>
  <body>

           <b>
        <table border="0">
        <tr><td><img src="logo.png"></td><td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td><td><h1>Cloud Automation Demo</h1></td></tr>
        <tr><td>&nbsp;</td><td>&nbsp;</td><td>
        <br><br><br>
        <h2>

<?php
        // Database variables
        include('gcp-creds.php');

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
        
        if ($_GET['blockme']) {
                exec("./blockme.sh $ipadd");
                
                $sql = "UPDATE jobs SET MODE = 'Blocking' WHERE JOB = '$uid'";
                if ($conn->query($sql) === TRUE) {
                        echo "<br>";
                } else {
                        echo "Error: " . $sql . "<br>" . $conn->error;
                }
                $conn->close();

                echo "Now we're going to be using the next-generation firewall with a blocking posture...";
        }

        if ($_GET['alertme']) {
                exec("./alertme.sh $ipadd");

                $sql = "UPDATE jobs SET MODE = 'Non-Blocking' WHERE JOB = '$uid'";
                if ($conn->query($sql) === TRUE) {
                        echo "<br>";
                } else {
                        echo "Error: " . $sql . "<br>" . $conn->error;
                }
                $conn->close();

                echo "Now we're going to make the next-generation firewall permissive, relying solely on cloud provider security...";
        }

        header("refresh:12; url=status.php?uid=$uid");
        exit();
?>
</h2>
</td></tr>
        </table>
        </b>
  </body>
</html>
