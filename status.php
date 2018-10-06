<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <?php 
      // Database variables
      include('creds.php');

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
      
      if($status['STATUS'] == "Done")
      {
        echo '';
      }
      else
      {
        echo '<meta http-equiv="refresh" content="5" >';
      }
    ?>
    <link rel="stylesheet" href="stylesheet.css" type="text/css">
    <title>Demo</title>
  </head>
  <body>
	<b>
	<table border="0">
	<tr><td><img src="logo.png"></td><td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td><td><h1>Cloud Automation Demo</h1></td></tr>
	<tr><td>&nbsp;</td><td>&nbsp;</td><td>
<?php

// Display status
echo "<br><br><br><h2><b>Status:&nbsp;&nbsp;&nbsp; </b><i>" . $status['STATUS'] . "</i></h2>\r\n";

// If done, report stats of NGFW config
if($status['STATUS'] == "Done")
{
    echo "<h2><b>Mode:&nbsp;&nbsp;&nbsp; </b><i>";
    //echo $status['MODE'];
    if($status['MODE'] == "Non-Blocking")
    {
      echo '&nbsp;<a href="changer.php?uid=' . $uid . '&blockme=true"><img src=off.png></a> ' . "We're using the native cloud provider security, the next-generation firewall is off...";
    }
    if($status['MODE'] == "Blocking") 
    { 
      echo '&nbsp;<a href="changer.php?uid=' . $uid  . '&alertme=true"><img src=on.png></a> ' . "We're using the next-generation firewall to block attacks..."; 
    }
    echo "</i></h2>\r\n";

    // Display option to change mode
    if($status['MODE'] == "Non-Blocking") {
      echo '<a href="changer.php?uid=' . $uid . '&blockme=true">Turn next-generation firewall on</a><br><br>';
    }
    else {
      echo '<a href="changer.php?uid=' . $uid  . '&alertme=true">Turn next-generation firewall off</a><br><br>';
    }
}

// Insert message related to current stage of the process
if($status['STATUS'] == "Ready") {
echo "<img src=1.png><br><br><b><i>You already saved 10 minutes just using that HTML form!</b></i>";
} elseif($status['STATUS'] == "Deploying") {
echo "<img src=2.png><br><br><b><i>This deployment stage takes about 2 minutes, which would be 45 minutes or more if done manually, assuming you know exactly every step (and make no mistakes!)</b></i>";
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
Information:
<ul>
  <li><a href="process-summary.png" target="_blank">Deployment Process Summary Diagram</a>
  <li><a href="network-diagram.png" target="_blank">Topology Diagram</a>
  <li><a href="https://www.youtube.com/watch?v=DvLN-VH_xoo&feature=youtu.be" target="_blank">Manual Process Video</a>
</ul>
<?php
} elseif($status['STATUS'] == "Done") {
?>
Palo Alto Networks Virtual Appliances:
<ul>
	<li><a href="https://<?php echo $status['MGMTIP']  ?>" target="_blank">Web GUI for your brand new firewall!</a>
	<li><a href="https://demomatic-rama-gcp.panw.co.uk" target="_blank">Web GUI for Panorama - Central Managemenet, Logging and Reporting</a>
</ul>
Mischief:
<ul>	
  <li><a href="http://<?php echo $status['UNTRUSTIP'] ?>:8080/struts2_2.3.15.1-showcase/showcase.action" target="_blank">Java Web App</a>
  <li><a href="http://<?php echo $status['KALIIP'] ?>:4200" target="_blank">Metasploit Console for Attacking Java Web App</a>
  <li><a href="http://<?php echo $status['UNTRUSTIP' ]?>" target="_blank">PHP Web App and Web-Based Attacks</a>
  <li><a href="http://<?php echo $status['UNTRUSTIP' ]?>?uoGSo[]=%3Cscript%3Ealert(%E2%80%98BreakingPoint%E2%80%99)%3C/script%3E" target="_blank">Generic XSS</a>
  <li><a href="http://<?php echo $status['UNTRUSTIP' ]?>/graph.php?current_language=/../../../../../../../../etc/passwd.&module=Accounts&action=Import&parenttab=Support%5D" target="_blank">Generic Traversal and /etc/passwd Access</a> 
  <li><a href="http://<?php echo $status['UNTRUSTIP'] ?>:4200" target="_blank">Console on Web Server</a>
</ul>
<br>
<br>
Timings:
<ul>	
  <li>Deployment took <?php echo $status['DEPLOYTIME'] ?>
  <li>Bootstrapping took <?php echo $status['BOOTTIME'] ?>
  <li>Post-deployment configuration took <?php echo $status['DONETIME'] ?>
  <br>
  <li><b>Total time taken was <?php echo $status['TOTALTIME'] ?></b>
</ul>
<br>
<br>
Information:
<ul>
  <li><a href="process-summary.png" target="_blank">Deployment Process Summary Diagram</a><br>
  <li><a href="network-diagram.png" target="_blank">Topology Diagram</a><br>
  <li><a href="https://www.youtube.com/watch?v=DvLN-VH_xoo&feature=youtu.be" target="_blank">Manual Process Video</a><br>
</ul>
<?php
}

echo "<br><br><br><br><font color=bfbfbf>";
echo "Message: " . $status['MESSAGE'] . "<br>";
echo "Phone: " . $status['PHONE'] . "<br>";
echo "Email:" . $status['EMAIL'] . "<br>";
echo "Nickname: " . $status['NICKNAME'] . "<br></font><br><br>";

if($status['STATUS'] == "Done") {
echo '<b><a href=index.html><img src=startagain.jpg alt="Start Again"></a><b><br><br><br><br>';
}

$conn->close();

?>
	</td></tr>
	</table>
	</b>
  </body>
</html>
