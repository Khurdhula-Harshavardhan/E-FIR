<?php
session_Start();
//include the api calling code to send the sms
include 'citizenotp.php';
//set mobile number to which the otp should be sent to..
$_SESSION['NO']=$_POST['book_no1'];
$mob=$_SESSION['mobile'];
sent_it($mob);
?>