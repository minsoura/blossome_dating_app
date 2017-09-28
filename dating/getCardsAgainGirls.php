<?php

	if($_SERVER['REQUEST_METHOD']=='POST'){
		$userEmail = $_POST['userEmail'];	


		define('HOST', "mysql.hostinger.kr");
			define('USER', "u414143907_andro");
			define('PW', "m2m3m5m2");
			define('DB', "u414143907_andro");
		
		date_default_timezone_set("Asia/Seoul");
		 $holdingStatus="no";
		 $RegisteredTime = date("Ymd");

	     $newDateEntry=array();
         $reDateTable = array();
         $todayDateEntry = array();
         $todayTable = array();

 		  $con= mysqli_connect(HOST,USER,PW,DB) or die("Unable to Connect");	   

	      $sqlM ="SELECT * from detailedInfoGirls1 where userEmail ='$userEmail' ";
	 	  $readyM = mysqli_query($con,$sqlM);
		

		while($SelectedRowsM= mysqli_fetch_array($readyM, MYSQLI_ASSOC)){
		
				$dateTable = $SelectedRowsM['userDateToday'];
     		}
	            $dateList = json_decode($dateTable,true);
				$dateCount = sizeof($dateList);					
         	

         		if($RegisteredTime - $dateList[0]['introDate']==0){	 

         			if($dateCount ==1){
         				$dateOne =$dateList[0]['dateEmail'] ;
         				  $ratingOne = $dateList[0]['rating'];
         	

				    $sql2 ="SELECT * from detailedInfoBoys1 where userEmail = $dateOne";
				    $ready2 = mysqli_query($con,$sql2);
			
					$family=array();
					$finalArray =array();

				
				while($SelectedRows= mysqli_fetch_array($ready2, MYSQLI_ASSOC)){

					$newTry = array();
					$newTry['userID'] = $SelectedRows['userID'];
					$newTry['userEmail'] = $SelectedRows['userEmail'];
					$newTry['userHeight'] = $SelectedRows['userHeight'];
					$newTry['userJob'] = $SelectedRows['userJob'];

					$newTry['userAge'] = $SelectedRows['userAge'];
					$newTry['userRegion'] = $SelectedRows['userRegion'];
					$newTry['userRegion2'] = $SelectedRows['userRegion2'];
					$newTry['userUniversity'] = $SelectedRows['userUniversity'];
					$newTry['userSayHi'] = $SelectedRows['userSayHi'];
					$newTry['userRating'] = $ratingOne;
					$family[] = $newTry;

		   	}
	
  		  	echo json_encode($family);

         			}else if($dateCount ==2){

         			  $dateOne =$dateList[0]['dateEmail'] ;
         			  $dateTwo =$dateList[1]['dateEmail'] ;


         			  $ratingOne = $dateList[0]['rating'];
         			  $ratingTwo = $dateList[1]['rating'];

				      $sql2 ="SELECT * from detailedInfoBoys1 where userEmail = '$dateOne' ";

				      $ready2 = mysqli_query($con,$sql2);
			
				 	 $family=array();
					 $finalArray =array();
					 

				while($SelectedRows= mysqli_fetch_array($ready2, MYSQLI_ASSOC)){
					
					$newTry = array();
				
					$newTry['userID'] = $SelectedRows['userID'];
					$newTry['userEmail'] = $SelectedRows['userEmail'];
					$newTry['userHeight'] = $SelectedRows['userHeight'];
					$newTry['userJob'] = $SelectedRows['userJob'];

					$newTry['userAge'] = $SelectedRows['userAge'];
					$newTry['userRegion'] = $SelectedRows['userRegion'];
					$newTry['userRegion2'] = $SelectedRows['userRegion2'];
					$newTry['userUniversity'] = $SelectedRows['userUniversity'];
					$newTry['userSayHi'] = $SelectedRows['userSayHi'];
					$newTry['userRating'] = $ratingOne;						
					
					$family[] = $newTry;
									
				}	

				      $sql3 ="SELECT * from detailedInfoBoys1 where userEmail = '$dateTwo' ";

				      $ready3 = mysqli_query($con,$sql3);
			
				 while($SelectedRows3= mysqli_fetch_array($ready3, MYSQLI_ASSOC)){
					
					$newTry = array();
				
					$newTry['userID'] = $SelectedRows3['userID'];
					$newTry['userEmail'] = $SelectedRows3['userEmail'];
					$newTry['userHeight'] = $SelectedRows3['userHeight'];
					$newTry['userJob'] = $SelectedRows3['userJob'];

					$newTry['userAge'] = $SelectedRows3['userAge'];
					$newTry['userRegion'] = $SelectedRows3['userRegion'];
					$newTry['userRegion2'] = $SelectedRows3['userRegion2'];
					$newTry['userUniversity'] = $SelectedRows3['userUniversity'];
					$newTry['userSayHi'] = $SelectedRows3['userSayHi'];		
					$newTry['userRating'] = $ratingTwo;									
					
					$family[] = $newTry;
									
				}				

				echo json_encode($family);


         			}
    		
            } else{
            	echo "newDating";
            }
  		  
			mysqli_close($con);	
	}
	else{

		echo "Error";
	}

?>


