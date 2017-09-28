<?php
if($_SERVER['REQUEST_METHOD']=='POST'){
$userEmail = $_POST['userEmail'];
$emailTitle = $_POST['emailTitle'];
$emailMessage = $_POST['emailMessage'];

/*
header('Content-type: text/plain; charset=utf-8');
header('Content-type: text/html; charset=utf-8');

$toAdmin="minsilk@korea.ac.kr";

//$body.= "=?UTF-8?B?".base64_encode($emailMessage)."?=";

$subject.= "=?UTF-8?B?".base64_encode($emailTitle)."?=";
$body.= "=?UTF-8?B?".base64_encode($emailTitle)."?=";



function sendmail($receiver,$subject,$body){
    $headers = 'From: ' . "minsilk@gmail.com\r\n". 
      'Reply-To: ' . "misilk@gmail.com\r\n" . 
      'X-Mailer: PHP/' . phpversion();   
    mail($receiver, $subject, $body, $headers);
}





sendmail($toAdmin, $subject, $body);
*/

$recipient="minsilk@korea.ac.kr"; 
$subject.= "=?UTF-8?B?".base64_encode($emailTitle)."?=";
$mail_body=$emailMessage; 
$headers .= "From: =?utf-8?B?".base64_encode($userEmail)."?= <".$userEmail."> \n"; 
$headers .= 'MIME-Version: 1.0' . "\r\n"; 
$headers .= 'Content-type: text/html; charset=utf-8' . "\r\n"; 

mail($recipient,$subject,$mail_body,$headers); 













	
		echo "sent";

}
	else{
		echo "Error";
	}


?>
