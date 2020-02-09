<?php
session_start();
//include the api so that we can send the notification..
include 'send_notification.php';
$user = $_SESSION['USER'];
$newpass = base64_encode($_POST['pass']);
//now connect to the data base 

$servername = "127.0.0.1";
$username = "root";
$password = "";
$dbname = "users";
//set up the connection for the above credentials..
$conn = mysqli_connect($servername, $username, $password, $dbname);


//checking if the connection is set...
if (!$conn) {
    echo "failed to connect to the data base!";
}
else{
//functional code if the data base is connected succesfully...
$query="UPDATE citizenlogin SET password='$newpass' WHERE username = '$user' ";
	if($result = mysqli_query($conn,$query))
	{
		$count = mysqli_affected_rows($conn);
		if($count==0)
		{
			echo '<div class="msg8888">'."<font color='red'>".'Failed to reset password, <br> Please try again later!'."</font>".'</div>';
			header("refresh:3;url=citizenlogin.html");
		}
		else{
			//throw a toast message that the password has been updated also send the notification to the citizen.
			echo '<div class="msg8888">'."<font color='green'>".'Password has been reset succesfully : '.$_SESSION['USER']."</font>".'</div>';
			send_noti($_SESSION['mobile'],'Dear '.$user.', your password has been reset succesfully');
			session_cache_expire();
			session_unset();
			session_destroy();
			header("refresh:3;url=citizenlogin.html");
		}
		
	}
}
	
	
?>

<style>
		body{
			background-color: black;
		}
    .msg8888 {
		border:1px solid #bbb;
		padding:5px; 
		margin:10px 5px; 
		background:#eee;
		position : absolute;
		top : 280px;
		left : 530px;
		height : 60px;
		width : 400px;
		padding-top : 35px;
		text-align : center;
		}
</style>