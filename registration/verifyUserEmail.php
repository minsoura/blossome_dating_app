<?php
	if($_SERVER['REQUEST_METHOD']=='POST'){
		$userEmail = $_POST['userEmail'];	
header('Content-type: text/plain; charset=utf-8');
header('Content-type: text/html; charset=utf-8');



$subject .= "=?UTF-8?B?".base64_encode("안녕하세요. BLOSSOM 입니다. 전송된 모든 코드를 복사하여 CODE란에 입력하여 주세요.")."?="."\r\n";
 

function sendmail($receiver,$subject,$body){
    $headers = 'From: ' . "minsilk@gmail.com\r\n". 
      'Reply-To: ' . "misilk@gmail.com\r\n" . 
      'X-Mailer: PHP/' . phpversion();   
    mail($receiver, $subject, $body, $headers);
}
 
$body = base64_encode($userEmail);
sendmail($userEmail, $subject, $body);






echo "emailSent";

}
else{
	echo "Error";
}





?>