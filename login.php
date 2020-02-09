<?php
session_start();
//include the api code..
include 'send_notification.php';
//taking the values from the user..
$user=$_POST['username'];
$pass=$_POST['password'];
//data base details
$servername = "127.0.0.1";
$username = "root";
$password = "";
$dbname = "users";


//connecting to the data base...
$conn = mysqli_connect($servername, $username, $password, $dbname);


//checking if the connection is set...
if (!$conn) {
    echo "failed to connect to the data base!";
}
else{
//functional code if the data base is connected succesfully...
if($result12=mysqli_query($conn,"SELECT * FROM login WHERE username='$user'"))
{
	$countu=mysqli_num_rows($result12);
	if($countu>0)
	{
	if($result=mysqli_query($conn,"SELECT Account FROM login WHERE username='$user' AND password='$pass' "))
	{
		
		$count = mysqli_num_rows($result); 
		$row=mysqli_fetch_assoc($result);
		$statu=$row["Account"];
		$row=mysqli_fetch_assoc($result);
		$attempts=$row["attemps"];
			if($count>0 && $statu=="ACTIVE" && $attempts<3)
			{
				if(mysqli_query($conn,"UPDATE login SET attemps='0' WHERE username='$user'"))
				{
			  echo '<div class="msg10">'.'LOGIN SUCCESFULL, WELCOME : '."<font color='red'>".$user."</font>".'</div>';
				$_SESSION['USER']=$user;
				$_SESSION['PASS']=$pass;
				$_SESSION['ERROR']=3;
				$_SESSION['PERSON']="sho";
		
				header( "refresh:2;url=homepage.html" );
				}
			}
			else if($statu=="DEACTIVATED")
				{  //here the account is not being accessed as the coloumn has been set to deactivated previously!!!
					echo '<div class="msg10">'."<font color='red'>".'YOUR ACCOUNT HAS BEEN BLOCKED!<br> DUE TO TOO MANY INCORRECT ATTEMPTS.<br> PLEASE CONTACT THE ADMINISTRATOR.'."</font>".'</div>';
					header( "refresh:3;url=shologin.html" );
				}
	
	else if($res=mysqli_query($conn,"SELECT * FROM login WHERE username='$user'"))
	{   //get the number of the fields that are affected for the given user name.
		$NumberOfColumns = mysqli_num_rows($res);
		//now get the account attemps.
		$row=mysqli_fetch_assoc($res);
		$mobile=$row["mobile"];
		$attempts=$row["attemps"];
		//now check for number of fields that are affected and then check if the attempts are less than three...
		if($NumberOfColumns>0 && $attempts<3 && $row["Account"]=="ACTIVE")
		{
			$attempts++;
			$query_1="UPDATE login SET attemps='$attempts' WHERE username='$user'";
			$result_1=mysqli_query($conn,$query_1);
			//now checkif that query has been executed or not.
			if($result_1)
			{		//here only user name is being accessed as the previous query had "AND" where the password is wrong.
					echo '<div class="msg10">'."<font color='red'>".' Authentication failure : Invalid Username/Password.  <br>Your account will be blocked after 3 incorrect attempts. <br>'.'PLEASE TRY AGAIN IN 3 SECONDS...'."</font>".'</div>';
					send_noti($mobile,'Dear SHO : '.$user.'You have attempted to login with wrong password for : '.$attempts.' time/s');
					header( "refresh:3;url=shologin.html" );
			}
		}
		else if($NumberOfColumns>0 && $row["attemps"]==3)
		{
			$query_2="UPDATE login SET Account='DEACTIVATED' where username='$user'";
			if(mysqli_query($conn,$query_2))
			{
				echo '<div class="msg10">'."<font color='red'>".'YOUR ACCOUNT HAS BEEN BLOCKED!<br> DUE TO TOO MANY INCORRECT ATTEMPTS.<br> PLEASE CONTACT THE ADMINISTRATOR.'."</font>".'</div>';
				send_noti($mobile,'Dear SHO : '.$user.', your account has been blocked due to , too many invalid login attempts , if not you please contact the administrator ');
				header( "refresh:3;url=shologin.html" );
			}
							
			
		}
		
		
	}
}
}
else
{
	echo '<div class="msg10">'."<font color='red'>".' Authentication failure : Invalid Username/Password.'."</font>".'</div>';
	header( "refresh:3;url=shologin.html" );
}
}
}
?>

<!--code to disable back button. has to be modified to force-reload @gourang/@vikas
<script language="javascript" type="text/javascript">
  window.history.forward();
  location.reload();
  
  </script>-->

<!--code for java script for dialougue box-->
<style>
		body{
			background-color: black;
		}
    .msg10 {
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
