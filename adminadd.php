<?php 
session_start();
//INCLUDE THE API TO SEND THE OTP TO SHO..
include 'shootp.php';

//get the values posted from the registration form...

$givenUsername=$_POST['username'];
$passwordsho=$_POST['pp'];
$mob=$_POST['mob'];

//set mobile as session for the otp verification... and password for registration
$_SESSION['mobile']=$mob;
$_SESSION['PP']=$passwordsho;

//initially check if the previously given username is same as current username... 

if($_SESSION['SHOID']!=$givenUsername)
{
	echo '<div class="msg819">'."<font color='red'>"."Failed to create a new account as,<br> sho's id and username given do not match.<br> Please make sure that shoid and given username is same.."."</font>".'</div>';
	header("refresh:5;url=adminhome.html");
	
}
else
{
	//if everything goes right otp should be sent.
	
	sent_it($mob);
}


?>

<style>
		
    body{
			background-color: black;
		}
    .msg819 {
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
