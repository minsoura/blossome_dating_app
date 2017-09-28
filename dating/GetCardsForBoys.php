<?php

	if($_SERVER['REQUEST_METHOD']=='POST'){
		$userEmail = $_POST['userEmail'];	
		$cardAge =	$_POST['cardAge'];
		$cardAgeType =	$_POST['cardAgeType'];
		$cardRegion =	$_POST['cardRegion'];


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

	    if($cardAgeType=="same"){

	    			$ageIdentifier = $cardAge;

	    }else if($cardAgeType=="above"){

	    			$ageIdentifier = $cardAge + 5;

	    }else if($cardAgeType=="below"){

	    			$ageIdentifier = $cardAge;

	    			$cardAge = $cardAge -5;

	    }else {

	    			$ageIdentifier = $cardAge+5;
	    			$cardAge = $cardAge - 5;
	    }


	    $sqlM ="SELECT * from detailedInfoBoys1 where userEmail ='$userEmail' ";
		$readyM = mysqli_query($con,$sqlM);
		

		while($SelectedRowsM= mysqli_fetch_array($readyM, MYSQLI_ASSOC)){
		
				$keyTable = $SelectedRowsM['userKeyCalc'];
				$keyVerifier = $SelectedRowsM['userKey'];

				$dateTable = $SelectedRowsM['userDateMet'];
     
		}

				$dateList = json_decode($dateTable,true);
				$dateCount = sizeof($dateList);					
         		$DateMover = array();
         		
            
            	for($i=0; $i<$dateCount; $i++){

            		$DateMover['dateIndex'] = $dateList[$i]['dateIndex'];
            		$DateMover['introDate'] = $dateList[$i]['introDate'];			    	       		
			        $reDateTable[] = $DateMover;
			        $appendedSql = $appendedSql. "ID != " .$dateList[$i]['dateIndex']. " && ";
            	}

			


		$sql2 ="SELECT * from detailedInfoGirls1 where ".$appendedSql." userHolding ='$holdingStatus' && userAge between '$cardAge' and '$ageIdentifier' && userRegion ='$cardRegion' order by RAND() LIMIT 2 ";
		$ready2 = mysqli_query($con,$sql2);
		$i=0;
		$index =1;
		$family=array();
		$finalArray =array();
		$setVerifier ="empty";
				
		while($SelectedRows= mysqli_fetch_array($ready2, MYSQLI_ASSOC)){
			$setVerifier ="exists";
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
			$family[] = $newTry;


				$newDateEntry['dateIndex'] = $SelectedRows['ID'];
       
			    $newDateEntry['introDate'] = $RegisteredTime;


				$todayDateEntry['dateEmail'] = $SelectedRows['userEmail'];
       
			    $todayDateEntry['introDate'] = $RegisteredTime;
			 	$todayDateEntry['rating'] = "0";
			
			    $reDateTable[] = $newDateEntry;
			    $todayTable[]  = $todayDateEntry;
		     



		}


				$dateJson = json_encode($reDateTable);	
			
				$todayJson = json_encode($todayTable);



  		  $sql ="UPDATE detailedInfoBoys1 SET userDateMet=?, userDateToday=? WHERE userEmail=?";
		  $stmt = mysqli_prepare($con,$sql);
  		  mysqli_stmt_bind_param($stmt,"sss",$dateJson,$todayJson,$userEmail);
 	 	  mysqli_stmt_execute($stmt);
  		  $check = mysqli_stmt_affected_rows($stmt);
	
		 
		  if($check ==1 && $setVerifier == "exists"){
  		  	echo json_encode($family);
  		  }else if ($setVerifier =="empty"){
  		  	echo "noSuchPerson";
  		  }
		mysqli_close($con);
		
	}
	else{

		echo "Error";
	}

?>
