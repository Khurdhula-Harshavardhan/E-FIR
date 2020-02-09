<?php
session_start();

//include the api to send a notification..
include 'send_notification.php';

$givenUsername=$_SESSION['SHOID'];
$passwordsho=$_SESSION['PP'];
$mob=$_SESSION['mobile'];

//connect to the db
	$servername = "127.0.0.1";
	$username = "root";
	$password = "";
	$dbname = "users";


	// Create connection
	$conn = mysqli_connect($servername, $username, $password, $dbname);


	// Check connection
	if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
	}
	else{
		$query="INSERT INTO login(username, password, mobile) VALUES('$givenUsername','$passwordsho', '$mob')";
		$result=mysqli_query($conn,$query);
		if(!$result)
		{
		echo '<div class="msg8923">'."<font color='red'>"."Failed to add account as there exists an account with the given username!"."</font>".'</div>';
		header("refresh:3;url=adminhome.html");
		}
		else
		{
			
			echo '<div class="msg8923">'."<font color='green'>"."ACCOUNT ADDED SUCCESSFULLY!"."</font>".'</div>';
			send_noti($_SESSION['mobile'],"Dear SHO, Your account has been created with username : ".$_SESSION['SHOID']." & PASSWORD : ".$_SESSION['PP']." Please do not share it with anyone...");
			session_cache_expire();
			session_destroy();
			header("refresh:3;url=adminhome.html");
		}
		
	}
	?>
	
	<style>
		
    body{
			background-color: black;
		}
    .msg8923 {
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
