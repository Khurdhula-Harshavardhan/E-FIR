<?php
session_start();
//get the otp from the user through the html page..
$otpe=$_POST['otp'];

//check if the sent otp is same as the entered otp..
if($_SESSION['sentotp']==$otpe)
{
	
	echo '<div class="msg17113">'."<font color='green'>"."mobile number has been verified! <br> PLEASE WAIT..."."</font>".'</div>';
	//now allow him to reset the password!
	header("refresh:3;url=newpassword.html");	
	
}
else
{
	echo '<div class="msg17113">'."<font color='red'>"."sorry you have entered wrong otp, otp has been re-sent to your mobile.."."</font>".'</div>';
	header("refresh:2;url=recallerotp.php");
}



?>

<style>
		
    body{
			background-color: black;
		}
    .msg17113 {
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
