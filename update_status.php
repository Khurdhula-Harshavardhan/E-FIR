<?php
//include the api inorder to send a message to the complainant..
include 'send_notification.php';
$book_no=$_POST['book_no'];
$status=$_POST['status'];
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
	$query1 = "SELECT * FROM fir WHERE book_no='$book_no'";
	$res=mysqli_query($conn,$query1);
	$row=mysqli_fetch_assoc($res);
	$mobile=$row["mobile"];
	if(mysqli_num_rows($res)>0)
	{
	$query="UPDATE fir SET status='$status' WHERE book_no='$book_no'";
	$result=mysqli_query($conn,$query);
	if(!$result)
	{
		echo '<div class = "msg7">'.'Failed to update the status of : '.$book_no.'</div>';
	}
	else
	{
		
		echo '<div class = " msg7">'."<font color='green'>"."<div align='center'>UPDATED SUCCESSFULLY</div>"."</font></div>";
		send_noti($mobile,"Dear citizen, Your F.I.R : ".$book_no."'s status has been updated to : ".$status." please contact nearest police station for further enquiry. -mp/pd");
		header( "refresh:4;url=homepage.html" );
	}
	}
	else
	{
		echo '<div class = "msg7">'."<font color='red'>"."<div align='center'>SORRY THERE ARE NO RECORDS WITH THE BOOKING NUMBER THAT HAS BEEN PROVIDED.</div>"."</font>";
		
		echo "<font color='red'>"."<div align='center'>PLEASE TRY AGAIN!</div>"."</font></div>";
		header( "refresh:4;url=homepage.html" );
	}
}
?>

<style>
		
   body{
			background-color: black;
		}
    .msg7 {
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