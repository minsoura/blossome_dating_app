<?php

	if($_SERVER['REQUEST_METHOD']=='GET'){
		$userEmail = $_GET['userEmail'];
		$sql = "SELECT userPic from accountInfoBoys where userEmail = '$userEmail'";


		define('HOST', "mysql.hostinger.kr");
			define('USER', "u414143907_andro");
			define('PW', "m2m3m5m2");
			define('DB', "u414143907_andro");

$con= mysqli_connect(HOST,USER,PW,DB) or die("Unable to Connect");

		
		$r = mysqli_query($con,$sql);
		
		$result = mysqli_fetch_array($r);
		
		header('content-type: image/jpeg');
	
		echo base64_decode($result['userPic']);
		
		mysqli_close($con);
		
	}else{
		echo "Error";
	}
}

?>
