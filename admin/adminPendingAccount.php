<?php

	if($_SERVER['REQUEST_METHOD']=='POST'){
	
			define('HOST', "mysql.hostinger.kr");
			define('USER', "u414143907_andro");
			define('PW', "m2m3m5m2");
			define('DB', "u414143907_andro");
	
		
	  	 $family=array();

		 $setVerifier ="empty";

   		 $con= mysqli_connect(HOST,USER,PW,DB) or die("Unable to Connect");

	 
	    $sqlM ="SELECT * from userTransfer";
		$readyM = mysqli_query($con,$sqlM);
		

		while($SelectedRowsM= mysqli_fetch_array($readyM, MYSQLI_ASSOC)){
			$newTry = array();
			$setVerifier = "exists";
			$newTry['userName'] =$SelectedRowsM['userName'];
			$newTry['userID']=$SelectedRowsM['userID'];
			$newTry['userEmail']=$SelectedRowsM['userEmail'];
			$newTry['userCell']=$SelectedRowsM['userCell'];
		    $newTry['userUniversity']=$SelectedRowsM['userUniversity'];
		    $newTry['userGender'] = $SelectedRowsM['Gender'];
		    $family[] = $newTry;
     
		}
			

		 
		  if($setVerifier == "exists"){
  		  	echo json_encode($family);
  		  }else if ($setVerifier == "empty"){
  		  	echo "empty";
  		  }
		mysqli_close($con);
		
	}
	else{

		echo "Error";
	}

?>
