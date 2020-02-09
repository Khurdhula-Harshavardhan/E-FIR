<?php
session_start();

$firstname=base64_encode($_POST["fname"]);
$lastname=base64_encode($_POST["lname"]);
$mobile=base64_encode($_POST["mobile"]);
$age=$_POST["age"];
$address=base64_encode($_POST["address"]);
$aadhar=base64_encode($_POST["adhaar"]);
//set connection to the database..
$servername="root";
$serverpass ="";
$databasename = "users";

//now establish the connection of the database using mysqli function../.

$conn =mysqli_connect("127.0.0.1",$servername,$serverpass , $databasename);

if(!$conn)
{
	echo "failed to connect to the madhya pradesh police database..";
}
else
{
//copythe posted values into session variables to prevent data loss upon redirecting to another page..

$_SESSION['number']=$_POST["mobile"];
$_SESSION['mobile']=$mobile;
$_SESSION['firstname']=$firstname;
$_SESSION['lastname']=$lastname;
$_SESSION['age']=$age;
$_SESSION['address']=$address;
$_SESSION['aadhar']=$aadhar;

//if the above details are not empty go to next page..
if(empty($firstname) && empty($lastname) && empty($mobile) && empty($age) && empty($address) && empty($aadhar) && empty($_SESSION['number']))
{
	echo "Sorry something went wrong...";
	header("refresh:3;url=citizenregister.html");
}
else
{
	$query="SELECT username FROM citizen WHERE mobile='$mobile'";
	if($result=mysqli_query($conn,$query))
	{
		$count= mysqli_num_rows($result);
		if($count == 0)
		{
			$query="SELECT aadhar FROM citizen WHERE aadhar='$aadhar'";
			if($result=mysqli_query($conn,$query))
			{
				$count= mysqli_num_rows($result);
				if($count == 0)
				{
			
				header("refresh:0;url=sendotp.php");
				}
				else
				{
				echo '<div class="msg17812">'."<font color='RED'>".'Sorry, someone else has already registered with the aadhar number provided.. <br> PLEASE TRY AGAIN LATER'."</font>".'</div>';
				header("refresh:3;url=citizenregister.html");
				}
			}
			else
				{
				echo '<div class="msg17812">'."<font color='RED'>".'Sorry, someone else has already registered with the mobile number provided.. <br> PLEASE TRY AGAIN LATER'."</font>".'</div>';
				header("refresh:3;url=citizenregister.html");
				}
		}
	
	}
}
}

?>

<style>
		
    body{
			background-color: black;
		}
    .msg17812 {
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
