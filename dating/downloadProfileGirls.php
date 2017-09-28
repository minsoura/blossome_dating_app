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

		


		echo "{\"result\":[";

		echo "{	\"userRegion\":\"$row[userRegion]\",\"userRegion2\":\"$row[userRegion2]\",\"userUniversity\":\"$row[userUniversity]\",\"userSayHi\":\"$row[userSayHi]\",\"userID\":\"$row[userID]\",\"userEmail\":\"$row[userEmail]\",\"userHeight\":\"$row[userHeight]\",\"userAge\":\"$row[userAge]\",\"userJob\":\"$row[userJob]\",\"userPic\":\"$row[userPicMain]\",\"userPicTwo\":\"$row[userPicTwo]\",\"userPicThree\":\"$row[userPicThree]\",\"userPicFour\":\"$row[userPicFour]\",\"userPicFive\":\"$row[userPicFive]\"}";        
                echo "]}";


		}
		
	
		
		mysqli_close($con);
		
	}



	else{
		echo "Error";
	}

?>

