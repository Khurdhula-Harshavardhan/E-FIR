<?php
session_start();

//php for inserting the details of a citizen..

$password=base64_encode($_POST['pp']);
$firstname=$_SESSION['firstname'];
$lastname=$_SESSION['lastname'];
$mobile=$_SESSION['mobile'];
$age=$_SESSION["age"];
$address=$_SESSION['address'];
$aadhar=$_SESSION['aadhar'];
$username=strtolower($_POST['username']);

//check if the username already exists in the data base and then send him back to change it.. if it does exist.



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
	
	$query = "SELECT * FROM citizen WHERE username='$username'";
	$result= mysqli_query($conn,$query);
	$count = mysqli_num_rows($result);
	
	if($count > 0)
	{
		echo '<div class="msg428">'."<font color='red'>".'Sorry the username : '.$username.' has already been taken <br> Please enter a unique username for yourself.'."</font>".'</div>';
		header("refresh:3;url=username.html");
	}
	else
	{
		$sql = "INSERT INTO citizen(username, firstname, lastname, age, aadhar, address, mobile) VALUES('$username','$firstname','$lastname','$age','$aadhar','$address','$mobile')";
		if(mysqli_query($conn,$sql))
		{
			$sql1 = "INSERT INTO citizenlogin( username, password) VALUES('$username','$password')";
			if(mysqli_query($conn,$sql1))
			{
				echo '<div class="msg428">'."<font color='green'>".'REGISTERED SUCCESFULLY..<br> PLEASE WAIT WHILE WE REDIRECT YOU TO CITIZEN-LOGIN...'."</font>".'</div>';
				session_unset();
				header("refresh:2;url=citizenlogin.html");
			}
		}
		else
		{
			echo '<div class="msg428">'."<font color='RED'>".'SORRY , SOMETHING WENT WRONG <br> PLEASE TRY AGAIN LATER'."</font>".'</div>';
			header("refresh:3;url=citizenregister.html");
		}
	}
}
?>


<style>
		
    body{
			background-color: black;
		}
    .msg428 {
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
