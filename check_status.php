<?php
session_start();
$book_no=$_POST['book_no'];
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
 $query = "SELECT status FROM fir WHERE book_no='$book_no'";
  $result=mysqli_query($conn,$query);
  if(!$result)
  {
	  echo "SOMETHING WENT WRONG.";
  }
  else{
	  if(mysqli_num_rows($result)>0)
	  {
	  $row = mysqli_fetch_assoc($result);
	  $status=$row['status'];
	  if($status=="PENDING")
	  {
		  echo '<div class="msg1">'.'THE CURRENT STATUS CASE WITH BOOKING NUMBER :'.$book_no.'  ,<br>IS : '."<font color='red'>".$status."</font> </div>";
		  
	  }
	  else if($status=="INVESTIGATION UNDERWAY")
	  {
		  echo '<div class="msg1">'.'THE CASE WITH BOOKING NUMBER :'.$book_no.' , <br>IS : '."<font color='green'>".$status."</font> </div>";
		 
	  }
	  else
	  {
		  echo '<div class="msg1">'.'THE CASE WITH BOOKING NUMBER :'.$book_no.' ,<br>IS : '."<font color='blue'>".$status."</font> </div>";
		  
	  }
			if($_SESSION["PERSON"]=="citizen")
			{
			header( "refresh:4;url=citizenhome.html" );
			}
			else
			{
				header( "refresh:4;url=homepage.html" );
			}
	  }
	  else
	  {
		  echo '<div class="msg1">'."<font color='red'>"."<div align='center'>SORRY THERE ARE NO RECORDS WITH THE BOOKING NUMBER THAT HAS BEEN PROVIDED.</div>"."</font>";
		
		echo "<font color='red'>"."<div align='center'>PLEASE TRY AGAIN!</div>"."</font></div>";
		
		if($_SESSION['PERSON']=='citizen')
		{
			header( "refresh:4;url=citizenhome.html" );
		}
		else
		{
		header( "refresh:4;url=homepage.html" );
		}
	  }
  }
  
}

?>

<style>
		body{
			background-color: black;
		}
    .msg1 {
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