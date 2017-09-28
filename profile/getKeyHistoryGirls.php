<?php

	if($_SERVER['REQUEST_METHOD']=='POST'){
		define('HOST', "mysql.hostinger.kr");
			define('USER', "u414143907_andro");
			define('PW', "m2m3m5m2");
			define('DB', "u414143907_andro");

	$con= mysqli_connect(HOST,USER,PW,DB) or die("Unable to Connect");

	  			  $userEmail = $_POST['userEmail'];
	

//Boys's Table -->Liking
				$sql0 = "SELECT userKeyCalc from detailedInfoGirls1 where userEmail = '$userEmail'";
				$ready = mysqli_query($con,$sql0);
				while($row = mysqli_fetch_array($ready, MYSQL_ASSOC)){

				$keyTable = $row['userKeyCalc'];

				}
		

			

			echo $keyTable;



			mysqli_close($con);
  		
	}

	else{
		echo "Error";
	}

?>