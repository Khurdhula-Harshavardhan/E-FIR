<?php
session_start();

//include api to resend the otp..
include 'shootp.php';

$otpe=$_POST['otp'];

// function to return true or false for mobile verification!
if($_SESSION['sentotp']==$otpe)
{
	
	echo '<div class="msg177">'."<font color='green'>"."mobile number has been verified! <br> PLEASE WAIT..."."</font>".'</div>';

header("refresh:3;url=addshoofficer.php");	
	
}
else
{
	
	echo '<div class="msg177">'."<font color='red'>"."Authentication failed, Due to wrong OTP,<br> Please wait while we resend a otp..."."</font>".'</div>';
	header("refresh:3;url=caller.php");

}



?>

<style>
		
    body{
			background-color: black;
		}
    .msg177{
		border:1px solid #bbb;
		padding:5px; 
		margin-left: 35%;
		margin-right: 65%;
		background:#eee;
		position : fixed;
		top : 280px;
		height : 60px;
		width : 400px;
		padding-top : 35px;
		text-align : center;
		}
</style>
