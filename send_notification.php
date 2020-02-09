<?php
function send_noti($number,$me)
{	// Account details
	$apiKey = urlencode('	xb70eRKPaPw-XPnvqeijanAwcgPk6JEIaPrkxzEo2T');
	
	// Message details
	$numbers = $number;
	$sender = urlencode('TXTLCL');
	
	$message = rawurlencode($me);
 
	//$numbers = implode(',', $numbers);
 
	// Prepare data for POST request
	$data = array('apikey' => $apiKey, 'numbers' => $numbers, "sender" => $sender, "message" => $message);
 
	// Send the POST request with cURL
	$ch = curl_init('https://api.textlocal.in/send/');
	curl_setopt($ch, CURLOPT_POST, true);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	$response = curl_exec($ch);
	curl_close($ch);
	
	// Process your response here
	echo $response;
}
?>