<?php
session_start();
//include the api code..
include 'shootp.php';
//caller php code for repeatative calling of otp api..

$mob=$_SESSION['mobile'];
	sent_it($mob);
?>