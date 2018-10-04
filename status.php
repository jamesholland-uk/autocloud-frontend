<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta http-equiv="refresh" content="5" >
    <link rel="stylesheet" href="stylesheet.css" type="text/css">
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
echo "<br><br><br><h2><b>Status:&nbsp;&nbsp;&nbsp; </b><i>" . $status['STATUS'] . "</i></h2>\r\n";

// Insert message related to current stage of the process
if($status['STATUS'] == "Ready") {
echo "<img src=1.png><br><br><b><i>You already save 10 minutes just using that HTML form!</b></i>";
} elseif($status['STATUS'] == "Deploying") {
echo "<img src=2.png><br><br><b><i>This deployment stage takes about 1 minute, which would be 45 minutes or more if done manually, assuming you know exactly every step (and make no mistakes!)</b></i>";
} elseif($status['STATUS'] == "Bootstrapping") {
echo "<img src=3.png><br><br><b><i>Now we're bootstrapping, which takes around 5 minutes, or at least 60 minutes if you did it by hand!</b></i>";
} elseif($status['STATUS'] == "Configuring") {
echo "<img src=4.png><br><br><b><i>Now a little bit of post-bootstrapping configuration, and we're pretty much done...</b></i>";
} elseif($status['STATUS'] == "Done") {
echo "<img src=5.png><br><br><b><i>We're all done, you saved yourself a two or three hours of manual cloud tasks and PAN-OS tasks, that's plenty of time for tea or coffee, and even that lunch break that's always cut short!</b></i>";
}

echo "<br><br><br>";

if($status['STATUS'] == "Deploying" || $status['STATUS'] == "Bootstrapping" || $status['STATUS'] == "Configuring") {
?>
	<ul>
	<li><a href="process-summary.png" target="_blank">Link to Deployment Process Summary Diagram</a><br>
	<li><a href="network-diagram.png" target="_blank">Link to Topology Diagram</a><br>
	<li><a href="https://www.youtube.com/watch?v=CLgNpVLpaYc&feature=youtu.be" target="_blank">Manual Process Video</a><br>
</ul>
<?php

} elseif($status['STATUS'] == "Done") {
?>
	<ul>
	<li><a href="https://<?php echo $status['MGMTIP']  ?>" target="_blank">Link to GUI of your brand new firewall!</a><br>
	<li><a href="https://demomatic-rama-gcp.panw.co.uk" target="_blank">Link to Panorama</a><br>
	<li><a href="http://<?php echo $status['KALIIP']  ?>:4200" target="_blank">Link to Attacker Console for Metasploit</a><br>
  <li><a href="http://<?php echo $status['UNTRUSTIP']  ?>" target="_blank">Link to Web Server for Web-Based Attacks</a><br>
    </ul>
    <br>
   
    <?php
      if ($_GET['blockme']) {
      # This code will run if ?blockme=true is set.
      exec("blockme.sh");
      }
    ?>
    <!-- This link will add ?blockme=true to your URL, myfilename.php?run=true -->
    <a href="?blockme=true">Set to blocking</a>

    <?php
      if ($_GET['alertme']) {
      # This code will run if ?run=true is set.
      exec("alertme.sh");
      }
    ?>
    <!-- This link will add ?run=true to your URL, myfilename.php?run=true -->
    <a href="?alertme=true">Set to blocking</a>

    <br>
    Deployment took <?php echo $status['DEPLOYTIME'] ?><br>
    Bootstrapping took <?php echo $status['BOOTTIME'] ?><br>
    Post-deployment configuration took <?php echo $status['DONETIME'] ?><br>
    <br>
    <b>Total time taken was <?php echo $status['TOTALTIME'] ?></b><br>
    <br>
    <br>
    <br>
	<br>
	<ul>
        <li><a href="process-summary.png" target="_blank">Link to Deployment Process Summary Diagram</a><br>
        <li><a href="network-diagram.png" target="_blank">Link to Topology Diagram</a><br>
        <li><a href="https://www.youtube.com/watch?v=CLgNpVLpaYc&feature=youtu.be" target="_blank">Manual Process Video</a><br>
</ul>
<?php
}

echo "<br><br><br><br><font color=bfbfbf>";
echo "Message: " . $status['MESSAGE'] . "<br>";
echo "Phone: " . $status['PHONE'] . "<br>";
echo "Email:" . $status['EMAIL'] . "<br>";
echo "Nickname: " . $status['NICKNAME'] . "<br></font><br><br>";

if($status['STATUS'] == "Done") {
echo "<b><a href=index.html>Start Again</a><b><br><br><br><br>";
}


$conn->close();

?>
	</td></tr>
	</table>
	</b>
  </body>
</html>
