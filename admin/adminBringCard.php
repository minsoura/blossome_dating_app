<?php

	if($_SERVER['REQUEST_METHOD']=='POST'){

		$userGender = $_POST['userGender'];
		$numberID = $_POST['numberID'];
	
			define('HOST', "mysql.hostinger.kr");
			define('USER', "u414143907_andro");
			define('PW', "m2m3m5m2");
			define('DB', "u414143907_andro");
		
	  	
		

   		$con= mysqli_connect(HOST,USER,PW,DB) or die("Unable to Connect");

	  if($userGender =="boys"){

				
	 		    $sqlM ="SELECT * from detailedInfoBoys1 where ID = '$numberID'";
				$readyM = mysqli_query($con,$sqlM);
				$family=array();

				while($SelectedRowsM= mysqli_fetch_array($readyM, MYSQLI_ASSOC)){
					$newTry = array();
				
					$newTry['userID'] = $SelectedRowsM['userID'];
					$newTry['userEmail'] = $SelectedRowsM['userEmail'];
					$newTry['userHeight'] = $SelectedRowsM['userHeight'];
					$newTry['userJob'] = $SelectedRowsM['userJob'];			
					$newTry['userAge'] = $SelectedRowsM['userAge'];
					$newTry['userSayHi'] = $SelectedRowsM['userSayHi'];
					$newTry['userRegion'] = $SelectedRowsM['userRegion'];
					$newTry['userRegion2'] = $SelectedRowsM['userRegion2'];
					$newTry['userUniversity'] = $SelectedRowsM['userUniversity'];


		   			 $family[] = $newTry;
     
		 		 }
		 		 echo json_encode($family);



	   } else if($userGender =="girls"){

				
	 	 	    $sqlM ="SELECT * from detailedInfoGirls1 where ID = '$numberID'";
				$readyM = mysqli_query($con,$sqlM);
				$family=array();

				while($SelectedRowsM= mysqli_fetch_array($readyM, MYSQLI_ASSOC)){
					$newTry = array();

					$newTry['userID'] = $SelectedRowsM['userID'];
					$newTry['userEmail'] = $SelectedRowsM['userEmail'];
					$newTry['userHeight'] = $SelectedRowsM['userHeight'];
					$newTry['userJob'] = $SelectedRowsM['userJob'];			
					$newTry['userAge'] = $SelectedRowsM['userAge'];
					$newTry['userSayHi'] = $SelectedRowsM['userSayHi'];
					$newTry['userRegion'] = $SelectedRowsM['userRegion'];
					$newTry['userRegion2'] = $SelectedRowsM['userRegion2'];
					$newTry['userUniversity'] = $SelectedRowsM['userUniversity'];
		
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