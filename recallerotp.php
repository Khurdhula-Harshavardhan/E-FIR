<?php
session_start();
//include the api code..
include 'forgototp.php';
$number=$_SESSION['mobile'];
//recaller for the otp inorder to send the otp again...
send_it($number);
?>


