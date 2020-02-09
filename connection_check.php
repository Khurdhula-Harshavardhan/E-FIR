<?php
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

  if($result=mysqli_query($conn,"SELECT * FROM status WHERE username='$user' AND password='$pass'"))
	{
		$count = mysqli_affected_rows($conn); 
		
		if($count==0)
		{
			printf("login failed, Due to authentication failure. \n ");
			
			echo 'PLEASE TRY AGAIN AS WE REDIRECT YOU TO LOGIN PAGE';
			header( "refresh:5;url=index.html" );
		}
		else{
		echo 'logged in successfully, PLEASE WAIT WHILE WE REDIRECT YOU TO HOMEPAGE...  Welcome : ';
		echo "<font color='red'>".$user."</font>";
		header( "refresh:5;url=homepage.html" );
}


?> 
