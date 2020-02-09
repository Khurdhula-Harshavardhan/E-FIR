<?php
function send_it($numberu)
{
$otp=rand(1000,100000);
$number=$numberu;
$curl = curl_init();
$senderid="errors";
$_SESSION['sentotp']=$otp;

curl_setopt_array($curl, array(
  CURLOPT_URL => "https://control.msg91.com/api/sendotp.php?authkey=312478AT3oC62KDi5e17feb1P1&mobile=$number&message=Dear CITIZEN, Your otp for mobile verification is : $otp&sender=$senderid&otp_length=DEFAULT&country=91&otp=$otp&template=5e1817d6d6fc053f200d6eb2",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "GET",
  CURLOPT_SSL_VERIFYHOST => 0,
  CURLOPT_SSL_VERIFYPEER => 0,
  CURLOPT_HTTPHEADER => array(
    "content-type: application/json"
  ),
));

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

if ($err== false) {
	echo '<div class="msg17192">'."<font color='green'>"."SENDING OTP TO YOUR MOBILE NUMBER PLEASE WAIT...."."</font>".'</div>';
	 header("refresh:3;url=forgotpassotp.html");
  
} else {
	
	echo '<div class="msg17192">'."<font color='red'>"."cURL Error #:" . $err."</font>".'</div>';
 header("refresh:4;url=citizenlogin.html");
}
}
?>


<style>
		
    body{
			background-color: black;
		}
    .msg17192 {
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
