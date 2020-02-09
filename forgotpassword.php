<?php
session_start();
//include the api to send the otp to the user!
include 'forgototp.php';

//initially get the value from the html for user name !
$user = $_POST['username'];
$_SESSION['USER']=$user;

//now set the connextion with the database...
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


//check if the posted username is present in the database. 
$query = "SELECT * from citizen WHERE username='$user'";

	if($result=mysqli_query($conn,$query))
	{
		$count = mysqli_num_rows($result);
		if($count == 0)
		{
			//tell the user that there are no accounts with that username..
			echo '<div class="msg888">'."<font color='red'>".'Sorry! , there are no user accounts with the username : '.$_SESSION['USER']."</font>".'</div>';
			header( "refresh:3;url=forgotpass.html" );
		}
		else
		{
			//if the user does exist then directly send an sms as a 2FA.
			$row = mysqli_fetch_assoc($result);
			$mob = base64_decode($row['mobile']);
			$_SESSION['mobile']=$mob;
//echo '<div class="msg888">'."<font color='green'>".'An sms will be sent to your registered mobile number! <br> PLEASE WAIT..'."</font>".'</div>';
				
				
				send_it($mob);
			
		}
	}
}
	
?>


<style>
		body{
			background-color: black;
		}
    .msg888 {
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
