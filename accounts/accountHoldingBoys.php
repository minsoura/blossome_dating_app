<?php

	if($_SERVER['REQUEST_METHOD']=='POST'){

		$userEmail = $_POST['userEmail'];	
		
			define('HOST', "mysql.hostinger.kr");
			define('USER', "u414143907_andro");
			define('PW', "m2m3m5m2");
			define('DB', "u414143907_andro");

			$con= mysqli_connect(HOST,USER,PW,DB) or die("Unable to Connect");
			
			$holdingStatus ="yes";

  		    $sql ="UPDATE detailedInfoBoys1 SET userHolding=? WHERE userEmail=?";
		    $stmt = mysqli_prepare($con,$sql);
  		    mysqli_stmt_bind_param($stmt,"ss",$holdingStatus, $userEmail);
 	 	    mysqli_stmt_execute($stmt);
  		    $check = mysqli_stmt_affected_rows($stmt);


  		    $sql2 ="UPDATE logSet SET userHolding=? WHERE userEmail=?";
		    $stmt2 = mysqli_prepare($con,$sql2);
  		    mysqli_stmt_bind_param($stmt2,"ss",$holdingStatus, $userEmail);
 	 	    mysqli_stmt_execute($stmt2);
  		    $check2 = mysqli_stmt_affected_rows($stmt2);

		if($check ==1 && $check2 ==1){
			echo "accountHeld";
		}else{
			echo "nope";
		}
				
		mysqli_close($con);
		
	}

	else{

		echo "Error";
	}

?>