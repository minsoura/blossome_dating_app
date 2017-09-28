<?php

	if($_SERVER['REQUEST_METHOD']=='POST'){
		$userEmail = $_POST['userEmail'];
		
		define('HOST', "mysql.hostinger.kr");
			define('USER', "u414143907_andro");
			define('PW', "m2m3m5m2");
			define('DB', "u414143907_andro");
	$con= mysqli_connect(HOST,USER,PW,DB) or die("Unable to Connect");

		

		$arrayMover = array();
		$arrayFinal = array();
	
		$notiIndex="main";

		$sqlNoti ="SELECT * from adminNotification where notiIndex ='$notiIndex'";
		$ready2 = mysqli_query($con,$sqlNoti);

		while($row2 = mysqli_fetch_array($ready2, MYSQL_ASSOC)){
				$arrayMover['notiCode'] =$row2['notiCode'];
				$arrayMover['notiDate']=$row2['notiDate'];
				$arrayMover['notiTitle']=$row2['notiTitle'];
				$arrayMover['notiContent'] =$row2['notiContent'] ;



		}

		$arrayFinal[] = $arrayMover;

		echo json_encode($arrayFinal);
				
		mysqli_close($con);
	}



	else{
		echo "Error";
	}

?>

