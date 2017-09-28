<?php

	if($_SERVER['REQUEST_METHOD']=='POST'){

		$userGender =	$_POST['userGender'];
	
				define('HOST', "mysql.hostinger.kr");
			define('USER', "u414143907_andro");
			define('PW', "m2m3m5m2");
			define('DB', "u414143907_andro");
		
	  	
		

   		$con= mysqli_connect(HOST,USER,PW,DB) or die("Unable to Connect");

	  if($userGender =="boys"){

				$family=array();
	 		    $sqlM ="SELECT ID from detailedInfoBoys1";
				$readyM = mysqli_query($con,$sqlM);
		

				while($SelectedRowsM= mysqli_fetch_array($readyM, MYSQLI_ASSOC)){
					$newTry = array();
					$newTry['ID'] =$SelectedRowsM['ID'];
		
		   			 $family[] = $newTry;
     
		 		 }
		 		 echo json_encode($family);
	   } else if($userGender =="girls"){

				$family=array();
	 	 	    $sqlM ="SELECT ID from detailedInfoGirls1";
				$readyM = mysqli_query($con,$sqlM);
		

				while($SelectedRowsM= mysqli_fetch_array($readyM, MYSQLI_ASSOC)){
					$newTry = array();
					$newTry['ID'] =$SelectedRowsM['ID'];
		
		   			 $family[] = $newTry;
     
		 		 }
		 		 echo json_encode($family);
		}	 
		
		mysqli_close($con);
		
	}
	else{

		echo "Error";
	}

?>
