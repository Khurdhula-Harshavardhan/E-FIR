<?php
session_start();

require_once __DIR__ . '/vendor/autoload.php';


$book_no=$_SESSION['NO'];

$servername = "127.0.0.1";
$username = "root";
$password = "";
$dbname = "users";


// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
if(!$conn)
{
	echo 'Failed attempt* to connect to Server';
}
else{
	$query="SELECT * FROM fir WHERE book_no='$book_no'";
	$result=mysqli_query($conn,$query);
	//$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
	if (mysqli_num_rows($result) > 0) {
    // output data of each row
    while($row = mysqli_fetch_assoc($result)) {
	$fname=$row["first_name"];
	$lname=$row["last_name"];	
	$gender=$row["gender"];
	$dob=$row["dob"];
	$address1=$row["address1"];
	$address2=$row["address2"];
	$inputCity=$row["city"];
	$inputDistrict=$row["district"];
	$inputState=$row["state"];
	$inputZip=$row["zip"];
	$mob=$row["mobile"];
	$email=$row["email"];
	$subject=$row["subject"];
	$comment=$row["report"];
	$adhaar=$row["aadhar"];
	$uniqueid=$row["book_no"];
	$date=$row["d/h"];
	
	}
	
	while($row = mysqli_fetch_assoc($result)) {
		$image=$row["sign"];
	}
	header("content-type: image/jpeg");
	
//create new pdf instance
$mpdf=new \Mpdf\Mpdf();

$data='';

//$data.='<h1>Your details</h1>';
$data .='<strong><div align="right"> BOOKING_NO : ' .$uniqueid.'</div> </strong>'.'<br />';
$data .= ' <div align="center"> <strong> FORM NO. 24.5 (1) </strong> </div> '.'<br />';
$data .= ' <div align="center"> <strong> FIRST INFORMATION REPORT </strong> </div> ' .'<br />';
$data .= ' <div align="center"> <strong> First Information of a Cognizable Crime Reported under Section 154,' .'<br />'.'Cr.P.C Police  Station: HYD headquaters,District:'.$inputDistrict.', No:'.$inputZip.' ,Date of Occurrence:'.$dob.'</strong> </div> '.'<br />';

$data .= ' <div align ="left"> <strong> Date/Hour of report: '.$date.' </strong> </div>'.'<br />';

$data .= '<div align="left"><strong>Date of occurance :</strong>' .$dob.'</div>'.'<br />';
$data .= '<div align="left"><strong>Name of the complainant : </strong>' .$fname.' '.$lname.'('.$gender.')'.'</div>'.'<br />';
$data .= '<div align="left"><strong>Gender :</strong>' .$gender.'<br />';
$data .= '<div align="left"><strong>Adhaar (unique identity of the complainant) : </strong>' .$adhaar.'</div>'.'<br />';
$data .= '<div align="left"><strong>Address of the complainant:  </strong>' .$address1.'<br />';
$data .= '<div align="left"><strong>Contact details of the complainant :  Mobile : </strong>' .$mob.', Email: '.$email.'</div>'.'<br />';
$data .= '<div align="left"><strong>Subject : </strong>' .$subject.'</div>'.'<br />';
$data .= ' <div align="left"><strong> REPORT:  </div> </strong>' .'</div>'.'<br />';
$data .= '<div align="left"><strong>'.$comment.'</strong>'.'</div>'.'<br /><br />';
$data .= '<div align="left"><strong>Place of occurance : </strong>' .$inputCity.','.$inputDistrict.','.$inputState.', INDIA, '.$inputZip.'</div>'.'<br />';
$data .= '<div align="left"><strong>Address of the Criminal: </strong>' .$address2.'</div>'.'<br /> <br />'; 
//$data .= '<strong>Steps take for investigation : </strong>' .$info.'<br />';
//$data .= '<strong>'.$comment.'</strong>'.'<br />';
//$data .= ' <style="text-align:center;"><strong> Signature of the S.H.O :</strong></style>                           Signature of the Informer : </div></strong>'; 
$data .= '<div class = "Align">'.'<strong> Signature of the S.H.O : </strong>'.'<span >'.'<strong>Signature of the Informer :</strong>'.'</span></div>';
$inputPath="./img/signature.jpg";
$data .='<img src="'.$inputPath.'" align="bottom" height="125" width="150"/> <style="align:left;">';
$inputPath="./img/signature.jpg";
$data .='<img src="'.$inputPath.'" align="bottom" height="125" width="150"/> <style="align:right;">';


//write pdf
$mpdf->WriteHTML($data);

//check flag to understand approach and give the neccessary output.


$mpdf->Output($book_no.'.pdf','I');



else
{
	echo '<div class = "msg5">'.'failed to generate pdf something went wrong.'.'</div>';
	header("refresh:3;url=homepage.html");
}
}
}
?>

<style type = text/css>
	body{
			background-color: black;
		}
		.Align span {
			margin-left : 100px;
		}
    .msg5 {
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
