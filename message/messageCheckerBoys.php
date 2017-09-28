<?php
	if($_SERVER['REQUEST_METHOD']=='POST'){
		define('HOST', "mysql.hostinger.kr");
			define('USER', "u414143907_andro");
			define('PW', "m2m3m5m2");
			define('DB', "u414143907_andro");

	$con= mysqli_connect(HOST,USER,PW,DB) or die("Unable to Connect");

	    $userEmail = $_POST['userEmail'];
	
		$RegisteredTime = date("Ymd");
		$InputTime =$RegisteredTime;

		$arrayMover = array();
		$arrayFinal = array();

		$sql0 = "SELECT messageListener from detailedInfoBoys1 where userEmail = '$userEmail'";
		$ready = mysqli_query($con,$sql0);
		while($row = mysqli_fetch_array($ready, MYSQL_ASSOC)){

		$arrayMover['messageChecker'] = $row['messageListener'];
		
		}
		$notiIndex="main";
		$sqlNoti ="SELECT * from adminNotification where notiIndex='$notiIndex'";
		$ready2 = mysqli_query($con,$sqlNoti);

		while($row2 = mysqli_fetch_array($ready2, MYSQL_ASSOC)){
				$arrayMover['notiCode'] =$row2['notiCode'];
			
				$arrayFinal[] = $arrayMover;
		}

		

			echo json_encode($arrayFinal);         
			mysqli_close($con);
	}

	else{
		echo "Error";
	}

?>
