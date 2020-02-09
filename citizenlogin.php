<?php
session_start();



$use=strtolower($_POST['username']);
$pass=$_POST['password'];


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
	$query="SELECT * FROM citizenlogin WHERE username='$use'";
	if($result=mysqli_query($conn,$query))
	{
		//count the number of rows being affected by the select query...
		$count = mysqli_num_rows($result); 
		//now try and fetch the row itself by the successful query
		$row =mysqli_fetch_assoc($result);
		$encrypt = $row["password"];
		$dbun=$row["username"];
		$dbpassword=base64_decode($encrypt);
		if($count==0)
		{
			echo '<div class="msg101">'."<font color='red'>".' Authentication failure : Invalid Username/Password<br>'."</font>".'</div>';
			header( "refresh:3;url=citizenlogin.html" );
		}
		
		else if($count>0 && $dbun==$use && $pass==$dbpassword)
		{
			if($resu=mysqli_query($conn,"SELECT * FROM citizen WHERE username='$use'"))
			$row=mysqli_fetch_assoc($resu);
			$name=$row["firstname"];
			$mobile=$row["mobile"];
			
			 echo '<div class="msg101">'.'LOGIN SUCCESFULL, WELCOME : '."<font color='red'>".base64_decode($name)."</font>".'</div>';
		$_SESSION['cUSER']=base64_decode($name);
		$_SESSION['cPASS']=$pass;
		$_SESSION['PERSON']="citizen";
		$_SESSION['mobile']=base64_decode($mobile);
		
		
		header( "refresh:2;url=citizenhome.html" );
		
		}
		else if($dbun!=$use || $pass!=$password)
		{
			echo '<div class="msg101">'."<font color='red'>".' Authentication failure : Invalid Username/Password. <br>'.'PLEASE TRY AGAIN IN 3 SECONDS...'."</font>".'</div>';
			header( "refresh:3;url=citizenlogin.html" );
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
    .msg101 {
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
		 
