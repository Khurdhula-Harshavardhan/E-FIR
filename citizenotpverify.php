<?php
session_start();


$otpe=$_POST['otp'];

// function to return true or false for mobile verification!
if($_SESSION['sentotp']==$otpe)
{
	
	echo '<div class="msg1776">'."<font color='green'>"."mobile number has been verified! <br> PLEASE WAIT...WHILE WE GENERATE YOUR PDF.."."</font>".'</div>';

header("refresh:3;url=cmadepdf.php");

	
}
else
{
	
	echo '<div class="msg1776">'."<font color='red'>"."Authentication failed, Due to wrong OTP,<br> Please wait while we resend a otp..."."</font>".'</div>';
	header("refresh:3;url=citizengetfir.php");

}



?>

<style>
		
    body{
			background-color: black;
		}
    .msg1776{
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
