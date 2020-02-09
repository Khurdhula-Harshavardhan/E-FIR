<?php
session_start();
$pass = $_POST['pass'];
$error_time=$_SESSION['ERROR'];

if($_SESSION['PASS']==$pass)
{
	echo '<div class ="msg6">'.'please wait while we prepare your pdf file! : '."<font color='red'>".$_SESSION['USER']."</font></div>";
		$_SESSION['ERROR']=1;
		header( "refresh:3;url=madepdf.php" );
		
	
}
else
{
	echo '<div class="msg6">'."Wrong password for User_Account: ".$_SESSION['USER']."<br> PLEASE TRY AGAIN IN $error_time SECONDS...".'</div>';
	$_SESSION['ERROR']=$_SESSION['ERROR']*3;
			header( "refresh:$error_time;url=password_verify.php" );
	
}
?>
<style>
		body{
			background-color: black;
		}
    .msg6 {
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