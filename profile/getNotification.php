<?php

	if($_SERVER['REQUEST_METHOD']=='POST'){
		


		
		define('HOST', "mysql.hostinger.kr");
			define('USER', "u414143907_andro");
			define('PW', "m2m3m5m2");
			define('DB', "u414143907_andro");

	$con= mysqli_connect(HOST,USER,PW,DB) or die("Unable to Connect");

		$sqlNoti ="SELECT * from adminNotification";
		$ready2 = mysqli_query($con,$sqlNoti);

		date_default_timezone_set("Asia/Seoul");
	
		 $RegisteredTime = date('Y\.F\.j');

		while($row2 = mysqli_fetch_array($ready2, MYSQL_ASSOC)){
				$arrayMover['notiCode'] =$row2['notiCode'];
				$arrayMover['notiDate']=$row2['notiDate'];
				$arrayMover['notiTitle']=$row2['notiTitle'];
				$arrayMover['notiContent'] =$row2['notiContent'] ;
				$arrayFinal[] = $arrayMover;
		}

		$sqlNotiBoys ="SELECT ID from detailedInfoBoys1";
		$readyBoys = mysqli_query($con,$sqlNotiBoys);

		if($readyBoys){
			$numOfBoys = mysqli_num_rows($readyBoys);

		}

		$sqlNotiGirls ="SELECT ID from detailedInfoGirls1";
		$readyGirls = mysqli_query($con,$sqlNotiGirls);
		if($readyGirls){
	     	$numOfGirls = mysqli_num_rows($readyGirls);
		}
		//$totalNum = $numOfBoys + $numOfGirls;
/*
				$arrayMover['notiCode'] = "100";
				$arrayMover['notiDate']=$RegisteredTime;
				$arrayMover['notiTitle']="현재 가입자 수";
			//	$arrayMover['notiContent'] ="남성: ".$numOfBoys."    "."여성: ".$numOfGirls."   "."전체: ".$totalNum."                                                    ";
				$arrayMover['notiContent'] ="남성: 42, 여성: 3 전체:78                                                 ";
				
				$arrayFinal[] = $arrayMover;
	*/

		echo json_encode($arrayFinal);
				
		mysqli_close($con);
	}



	else{
		echo "Error";
	}

?>

