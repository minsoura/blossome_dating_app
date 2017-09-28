<?php

	if($_SERVER['REQUEST_METHOD']=='POST'){

		$userEmail = $_POST['userEmail'];	
		
			define('HOST', "mysql.hostinger.kr");
			define('USER', "u414143907_andro");
			define('PW', "m2m3m5m2");
			define('DB', "u414143907_andro");

			$con= mysqli_connect(HOST,USER,PW,DB) or die("Unable to Connect");
			
			$holdingStatus ="no";

  		    $sqlG ="UPDATE detailedInfoGirls1 SET userHolding=? WHERE userEmail=?";
		    $stmtG = mysqli_prepare($con,$sqlG);
  		    mysqli_stmt_bind_param($stmtG,"ss",$holdingStatus, $userEmail);
 	 	    mysqli_stmt_execute($stmtG);
  		    $checkG = mysqli_stmt_affected_rows($stmtG);


  		    $sqlB ="UPDATE detailedInfoBoys1 SET userHolding=? WHERE userEmail=?";
		    $stmtB = mysqli_prepare($con,$sqlB);
  		    mysqli_stmt_bind_param($stmtB,"ss",$holdingStatus, $userEmail);
 	 	    mysqli_stmt_execute($stmtB);
  		    $checkB = mysqli_stmt_affected_rows($stmtB);

  		    $sql ="UPDATE logSet SET userHolding=? WHERE userEmail=?";
		    $stmt = mysqli_prepare($con,$sql);
  		    mysqli_stmt_bind_param($stmt,"ss",$holdingStatus, $userEmail);
 	 	    mysqli_stmt_execute($stmt);
  		    $check = mysqli_stmt_affected_rows($stmt);

		if($checkG==1 && $check ==1){
			echo "girlsActivated";
		} elseif ($checkB==1 && $check ==1) {
			echo "boysActivated";
		}

		else {
			echo "nope";
		}
				
		mysqli_close($con);
		
	}

	else{

		echo "Error";
	}

?>
