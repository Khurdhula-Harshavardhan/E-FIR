<?php
session_start();
$key=$_POST['givenname'];
$key1=str_replace(' ', '', $key);
$key1=strtolower($key1);

//connect to database..
$servername = "127.0.0.1";
$username = "root";
$password = "";
$dbname = "users";


// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);

//check the connection..
if(!$conn)
{
	echo "sorry something went wrong!";
}
else
{
	$query="SELECT * FROM criminalrecord WHERE criminal='$key1'";
	if($result=mysqli_query($conn,$query))
	{
			$count=mysqli_num_rows($result);
			if($count>0)
			{
				$row=mysqli_fetch_assoc($result);
				echo "criminal found in data base!";
				echo "<br> These are the details obtained! <br>";
				echo $row['firstname'];
			}
			else
			{
				echo "<br> Sorry there are no criminal records existing on the given name : ".$key;
			}
	}
}

?>