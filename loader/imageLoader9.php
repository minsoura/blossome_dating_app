<?php

	if($_SERVER['REQUEST_METHOD']=='GET'){
		$userEmail = $_GET['userEmail'];
		//$pictureVerifier = $_GET['pictureVerifier'];
		$userGender = $_GET['userGender'];


if($userGender =="boys"){
	$sql = "SELECT userPicMain from detailedInfoBoys1 where userEmail = '$userEmail'";
		define('HOST', "mysql.hostinger.kr");
			define('USER', "u414143907_andro");
			define('PW', "m2m3m5m2");
			define('DB', "u414143907_andro");

	$con= mysqli_connect(HOST,USER,PW,DB) or die("Unable to Connect");

		
		$r = mysqli_query($con,$sql);
		
		$result = mysqli_fetch_array($r);
		header('Content-Type: image/jpeg');
		echo base64_decode($result['userPicMain']);

} else if($userGender =="girls"){
		$sql = "SELECT userPicMain from detailedInfoGirls1 where userEmail = '$userEmail'";
		define('HOST', "mysql.hostinger.kr");
			define('USER', "u414143907_andro");
			define('PW', "m2m3m5m2");
			define('DB', "u414143907_andro");

	$con= mysqli_connect(HOST,USER,PW,DB) or die("Unable to Connect");

		
		$r = mysqli_query($con,$sql);
		
		$result = mysqli_fetch_array($r);
		header('Content-Type: image/jpeg');
		echo base64_decode($result['userPicMain']);

}
	        
		
		mysqli_close($con);
		
	}else{
		echo "Error";
	}


?>