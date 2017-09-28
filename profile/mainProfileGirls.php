<?php

	if($_SERVER['REQUEST_METHOD']=='POST'){
		$userEmail = $_POST['userEmail'];


		$sql = "select * from detailedInfoGirls1 where userEmail = '$userEmail'";
		
		define('HOST', "mysql.hostinger.kr");
			define('USER', "u414143907_andro");
			define('PW', "m2m3m5m2");
			define('DB', "u414143907_andro");
$con= mysqli_connect(HOST,USER,PW,DB) or die("Unable to Connect");

		
		$ready = mysqli_query($con,$sql);
		
		while($row = mysqli_fetch_array($ready, MYSQL_ASSOC)){



				$arrayMover['userKey'] =$row['userKey'];
				$arrayMover['userRegion']=$row['userRegion'];
				$arrayMover['userRegion2']=$row['userRegion2'];
				$arrayMover['userUniversity'] =$row['userUniversity'] ;
				$arrayMover['userSayHi'] =$row['userSayHi'];
				$arrayMover['userID'] =$row['userID'];
				$arrayMover['userEmail'] =$row['userEmail'];
				$arrayMover['userHeight'] =$row['userHeight'];
				$arrayMover['userAge'] =$row['userAge'];
				$arrayMover['userJob'] =$row['userJob'];
				$arrayMover['userPicMain'] =$row['userPicMain'];

				

		}

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