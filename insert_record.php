<?php
session_start();
$fname = $_POST['fname'];
$lname = $_POST['lname'];
$gender = $_POST['gender'];
$dob = $_POST['dob'];
$address1 = $_POST['address1'];
$address2 = $_POST['address2'];
$inputCity = $_POST['inputCity'];
$inputDistrict = $_POST['inputDistrict'];
$inputState = $_POST['inputState'];
$inputZip = $_POST['inputZip'];
$mob = $_POST['mob'];
$email = $_POST['email'];
$subject = $_POST['subject'];
$comment = $_POST['comment'];
$adhaar = $_POST['adhaar'];
/*$image = $_FILES['sign']['tmp_name'];
$imgContent = addslashes(file_get_contents($image));*/
//details of the accused..
$aname=$_POST['aname'];
$alname=$_POST['alname'];
$agender=$_POST['agender'];
$adob=$_POST['adob'];
$aaddress=$_POST['aaddress1'];
$aaadhaar=$_POST['aaadhaar'];
$_SESSION['NO']= $_POST['uniqueid'];



$book_no=$_SESSION['NO'];


$servername = "127.0.0.1";
$username = "root";
$password = "";
$dbname = "users";
$sql;
// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
$imageData =mysqli_real_escape_string($conn,file_get_contents($_FILES["image"]["tmp_name"]));
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$sql = "INSERT INTO fir (book_no, first_name, last_name, gender, dob, address1, address2, city, district, state, zip, mobile, email, subject, report, aadhar, sign, afname, alname, adob, aaadhar, agender, aaddress) VALUES ('$book_no', '$fname', '$lname', '$gender', '$dob', '$address1', '$address2', '$inputCity', '$inputDistrict', '$inputState', '$inputZip', '$mob', '$email' ,'$subject', '$comment', '$adhaar', '$imageData', '$aname', '$alname',  '$adob', '$aaadhaar','$agender','$aaddress')";


if(mysqli_query($conn, $sql))
{
       echo '<div class="msg2">'."<font color='red'>".'<div align="center">FIR FILED SUCCESSFULLY!, please wait....</div>'."</font></div>";
		header( "refresh:4;url=password_verify.php" );	

}
else{
    echo '<br>'.'<div class="msg2">'.'FAILED TO FILE THE FIR PLEASE TRY AGAIN LATER.'.'</div>';
	header( "refresh:3;url=applyform.html" );
  }
?>

<style>
	body{
			background-color: black;
		}
    .msg2 {
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