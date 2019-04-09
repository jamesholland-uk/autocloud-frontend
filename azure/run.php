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
include('azure-creds.php');

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

// Setup variables anc collect POST data
$uid=date("Ymd.His");
$resgrp='atailor-demomatic_' . $uid;
$message=$_POST["message"];
$phone=$_POST["phone"];
$email=$_POST["email"];
$nickname=$_POST["nickname"];
$se=$_POST["se"];


// Sort out inputs
if($message == "") {
	$message='Default message';
}
if($phone == "") {
        $phone='+447764490426';
}
if($email == "") {
        $email='jholland@paloaltonetworks.com';
}
if($nickname == "") {
        $nickname='Colonel Mustard';
}
if($se == "") {
        $se='contact_salesEMEA@paloaltonetworks.com';
}

// Create deployment job record
$sql = "INSERT INTO jobs (JOB,RESGRP,STATUS,MESSAGE,PHONE,EMAIL,NICKNAME,SE) VALUES ('$uid', '$resgrp', 'Ready', '$message', '$phone', '$email', '$nickname', '$se')";

if ($conn->query($sql) === TRUE) {
	echo "Deployment started<br><br>\r\n";
	$sqlcheck = "SELECT * FROM jobs WHERE JOB = '$uid'";
	$result = $conn->query($sqlcheck);
	$status= $result->fetch_assoc();
	echo $status['STATUS'] . "<br>\r\n";
} else {
	echo "Error: " . $sql . "<br>" . $conn->error;
}


$conn->close();

// redirect user to status page
header("Location: status.php?uid=$uid");

?>

</td></tr>
        </table>
        </b>
  </body>
</html>
