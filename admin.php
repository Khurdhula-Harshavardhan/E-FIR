<?php
session_start();
//code to handle user accounts as a network admin..
include 'send_notification.php';

$action = $_POST['action'];
$user=$_POST['shoid'];
//assign session variables for adding an account !..
$_SESSION['SHOID']=$user;



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

if($action == "ACTIVATE")
{	$result=mysqli_query($conn,"SELECT * FROM login WHERE username='$user'");
$count = mysqli_num_rows($result);
if($count>0)
{
	$query="UPDATE login SET Account='ACTIVE',attemps='0' WHERE username='$user'";
	if(mysqli_query($conn,$query))
	{
		$row=mysqli_fetch_assoc($result);
		$mobile=$row["mobile"];
		echo '<div class="msg89">'."<font color='green'>"."ACTIVATED SHO'S ACCOUNT : ".$user.'SUCCESSFULLY!'."</font>".'</div>';
		send_noti($mobile,"Dear SHO : ".$user." Your account, has been activated by the adminstrator -mp/pd");
		header("refresh:3;url=adminhome.html");
	}
}
	else
	{
		echo '<div class="msg89">'."<font color='red'>"."Failed to activate as there is no such existing account!"."</font>".'</div>';
		header("refresh:3;url=adminhome.html");
	}
}
else if($action == "DEACTIVATE")
{
	$result=mysqli_query($conn,"SELECT * FROM login WHERE username='$user'");
	$count = mysqli_num_rows($result);
	if($count>0)
	{
		$query1="UPDATE login SET Account='DEACTIVATED' WHERE username='$user'";
		if(mysqli_query($conn,$query1))
		{
			$row=mysqli_fetch_assoc($result);
		$mobile=$row["mobile"];
		echo '<div class="msg89">'."<font color='red'>"."DEACTIVATED SHO'S ACCOUNT : ".$user.' SUCCESSFULLY!'."</font>".'</div>';
		send_noti($mobile,"Dear SHO : ".$user." Your account, has been deactivated by the adminstrator -mp/pd");
		header("refresh:3;url=adminhome.html");
		}
		
	}
	else
	{
		echo '<div class="msg89">'."<font color='red'>"."Failed to activate as there is no such existing account!"."</font>".'</div>';
		header("refresh:3;url=adminhome.html");
	}
	
}
else if($action == "ADD_ACCOUNT")
{
	echo '<div class="msg89">'."<font color='green'>"."PLEASE WAIT..."."</font>".'</div>';
	header("refresh:3;url=adminadd.html");
}
else if($action == "REMOVE_ACCOUNT")
{
	$result=mysqli_query($conn,"SELECT * FROM login WHERE username='$user'");
	$count = mysqli_num_rows($result);
	if($count>0)
	{
			$row=mysqli_fetch_assoc($result);
		$mobile=$row["mobile"];
		$query1="DELETE FROM login WHERE username='$user'";
		if(mysqli_query($conn,$query1))
		{
		echo '<div class="msg89">'."<font color='red'>"."DELETED SHO'S ACCOUNT : ".$user.' SUCCESSFULLY!'."</font>".'</div>';
		send_noti($mobile,"Dear SHO : ".$user." Your account, has been deleted by the adminstrator,please contact the admin for further details. -mp/pd");
		header("refresh:3;url=adminhome.html");
		}
		
	}
	else
	{
		echo '<div class="msg89">'."<font color='red'>"."Failed to delete as there is no such existing account!"."</font>".'</div>';
		header("refresh:3;url=adminhome.html");
	}
}
}
?>


<style>
		
    body{
			background-color: black;
		}
    .msg89 {
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
