<?php
session_start();
$_SESSION['password1']=$_POST['password'];
$_SESSION['password2']=$_POST['password1'];
$_SESSION['usu']=$_POST['USER'];

if($_SESSION['password1']!=$_SESSION['password2'])
{
	echo '<div class="msg198">'."<font color='red'>".'Sorry, the passwords entered do not match..'."</font>".'</div>';
	header("refresh:3;url=username.html");
}

?>

<style>
		
    body{
			background-color: black;
		}
    .msg198 {
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
