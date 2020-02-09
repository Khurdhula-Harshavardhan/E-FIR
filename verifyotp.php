<?php
session_start();

$otpe=$_POST['otp'];
if($_SESSION['sentotp']==$otpe)
{
	
	echo '<div class="msg1711">'."<font color='green'>"."mobile number has been verified! <br> PLEASE WAIT..."."</font>".'</div>';

header("refresh:3;url=username.html");	
	
}
else
{
	echo '<div class="msg1711">'."<font color='red'>"."sorry you have entered wrong otp, otp has been re-sent to your mobile.."."</font>".'</div>';

	
	header("refresh:2;url=sendotp.php");
}



?>

<style>
		
    body{
			background-color: black;
		}
    .msg1711 {
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
