<?php

	if($_SERVER['REQUEST_METHOD']=='POST'){

		$userEmail = $_POST['userEmail'];
		$cardAge =	$_POST['cardAge'];
		$cardAgeType =	$_POST['cardAgeType'];
		$cardRegion =	$_POST['cardRegion'];
		$cardUniv = $_POST['cardUniv'];
		$cardHeight = $_POST['cardHeight'];
		$cardHot = $_POST['cardHot'];
		//age,region,height,dating preference bring it from another table?
		$setVerifier ="empty";
        date_default_timezone_set("Asia/Seoul");
		$RegisteredTime = date("Ymd");
	    if($cardAgeType=="same"){

	    			$ageIdentifier = $cardAge;

	    }else if($cardAgeType=="above"){

	    			$ageIdentifier = $cardAge + 2;

	    }else if($cardAgeType=="below"){

	    			$ageIdentifier = $cardAge;

	    			$cardAge = $cardAge -2;

	    }else {

	    			$ageIdentifier = $cardAge+5;
	    			$cardAge = $cardAge - 5;
	    }



			define('HOST', "mysql.hostinger.kr");
			define('USER', "u414143907_andro");
			define('PW', "m2m3m5m2");
			define('DB', "u414143907_andro");

	    $holdingStatus="no";

	     $newDateEntry=array();
         $reDateTable = array();
         $todayDateEntry = array();
         $todayTable = array();

	    $con= mysqli_connect(HOST,USER,PW,DB) or die("Unable to Connect");




	    $sqlM ="SELECT * from detailedInfoGirls1 where userEmail ='$userEmail' ";
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

			

				








	    if($cardUniv=="NONE" && $cardHeight=="NONE" && $cardHot !=="NONE"){
	
				$sql2 ="SELECT * from detailedInfoBoys1 where ".$appendedSql." userHolding ='$holdingStatus' && userAge between '$cardAge' and '$ageIdentifier' && userRegion ='$cardRegion' && userBeauty between 8 AND 10 order by RAND() LIMIT 2 ";
				$ready2 = mysqli_query($con,$sql2);
			   	$family=array();
				$finalArray =array();				
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
       		$todayDateEntry['rating'] = "0";
			    $todayDateEntry['introDate'] = $RegisteredTime;
			
			    $reDateTable[] = $newDateEntry;
			    $todayTable[]  = $todayDateEntry;

		}
	
		

		

		$keyOperator = 15;



	    





	    }else if($cardUniv=="NONE" && $cardHeight !=="NONE" && $cardHot=="NONE"){


	    	$cardHeight2 = $cardHeight +2;
	    	$cardHeight = $cardHeight -2;

	   		$sql2 ="SELECT *  from detailedInfoBoys1 where ".$appendedSql."  userHolding ='$holdingStatus' && userAge between '$cardAge' and '$ageIdentifier' && userRegion ='$cardRegion' &&  userHeight between '$cardHeight' and '$cardHeight2'  order by RAND() LIMIT 2 ";
			$ready2 = mysqli_query($con,$sql2);
			$family=array();
			$finalArray =array();				
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
       		$todayDateEntry['rating'] = "0";
			    $todayDateEntry['introDate'] = $RegisteredTime;
			
			    $reDateTable[] = $newDateEntry;
			    $todayTable[]  = $todayDateEntry;
		}
	
		

			
			$keyOperator = 2;

	    








	    }else if($cardUniv !=="NONE" && $cardHeight=="NONE" && $cardHot=="NONE"){



	    	$sql2 ="SELECT * from detailedInfoBoys1 where ".$appendedSql."  userHolding ='$holdingStatus' && userAge between '$cardAge' and '$ageIdentifier' && userRegion ='$cardRegion' && userUniversity = '$cardUniv'  order by RAND() LIMIT 2 ";
			$ready2 = mysqli_query($con,$sql2);
			$family=array();
			$finalArray =array();				
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
       		$todayDateEntry['rating'] = "0";
			    $todayDateEntry['introDate'] = $RegisteredTime;
			
			    $reDateTable[] = $newDateEntry;
			    $todayTable[]  = $todayDateEntry;

		}
	
		

		
			$keyOperator = 5;

	    












	    }else if($cardUniv=="NONE" && $cardHeight!=="NONE" && $cardHot!=="NONE"){

				$cardHeight2 = $cardHeight +2;
	    		$cardHeight = $cardHeight -2;

	    		$sql2 ="SELECT *  from detailedInfoBoys1 where ".$appendedSql."  userHolding ='$holdingStatus' && userAge between '$cardAge' and '$ageIdentifier' && userRegion ='$cardRegion' &&  userHeight between '$cardHeight' and '$cardHeight2' && userBeauty between 8 AND 10  order by RAND() LIMIT 2 ";
				$ready2 = mysqli_query($con,$sql2);
	 	   		$family=array();
				$finalArray =array();

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
       		$todayDateEntry['rating'] = "0";
			    $todayDateEntry['introDate'] = $RegisteredTime;
			
			    $reDateTable[] = $newDateEntry;
			    $todayTable[]  = $todayDateEntry;     

		}
	
		

	
			$keyOperator = 17;
	    







	    }else if($cardUniv!=="NONE" && $cardHeight!=="NONE" && $cardHot=="NONE"){



	    	$cardHeight2 = $cardHeight +2;
	    	$cardHeight = $cardHeight -2;

	    	 $sql2 ="SELECT *  from detailedInfoBoys1 where ".$appendedSql."  userHolding ='$holdingStatus' && userAge between '$cardAge' and '$ageIdentifier' && userRegion ='$cardRegion' &&  userHeight between '$cardHeight' and '$cardHeight2' &&  userUniversity = '$cardUniv' order by RAND() LIMIT 2 ";
			$ready2 = mysqli_query($con,$sql2);	
			$family=array();
			$finalArray =array();	

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
       		$todayDateEntry['rating'] = "0";
			    $todayDateEntry['introDate'] = $RegisteredTime;
			
			    $reDateTable[] = $newDateEntry;
			    $todayTable[]  = $todayDateEntry; 

		}
	
		

			
			$keyOperator = 7;
	    

	    }else if($cardUniv!=="NONE" && $cardHeight=="NONE" && $cardHot!=="NONE"){



	    	 $sql2 ="SELECT * from detailedInfoBoys1 where ".$appendedSql."  userHolding ='$holdingStatus' && userAge between '$cardAge' and '$ageIdentifier' && userRegion ='$cardRegion' && userBeauty between 8 AND 10 &&  userUniversity = '$cardUniv' order by RAND() LIMIT 2 ";
			$ready2 = mysqli_query($con,$sql2);
			$family=array();
			$finalArray =array();	

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
       		$todayDateEntry['rating'] = "0";
			    $todayDateEntry['introDate'] = $RegisteredTime;
			
			    $reDateTable[] = $newDateEntry;
			    $todayTable[]  = $todayDateEntry;  

		}
	
		

		
			$keyOperator = 20;
	    









	    }else if($cardUniv!=="NONE" && $cardHeight!=="NONE" && $cardHot!=="NONE"){


			$cardHeight2 = $cardHeight +2;
	    	$cardHeight = $cardHeight -2;

	     	$sql2 ="SELECT * from detailedInfoBoys1 where ".$appendedSql."  userHolding ='$holdingStatus' && userAge between '$cardAge' and '$ageIdentifier' && userRegion ='$cardRegion' &&  userHeight between '$cardHeight' and '$cardHeight2' &&  userUniversity = '$cardUniv' && userBeauty between 8 AND 10 order by RAND() LIMIT 2 ";
			$ready2 = mysqli_query($con,$sql2);
			$family=array();
			$finalArray =array();	

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
       			$todayDateEntry['rating'] = "0";
			    $todayDateEntry['introDate'] = $RegisteredTime;
			
			    $reDateTable[] = $newDateEntry;
			    $todayTable[]  = $todayDateEntry;
		}
	
		

			
	    	$keyOperator = 22;


	    }else{
	    		$keyOperator = 0;
	    }



  	
			 
		  if($setVerifier == "exists"){
		  	
	   

					$RegisteredTime = date("Ymd");

   					$keyList = json_decode($keyTable,true);
					$keyCount = sizeof($keyList);
					

         		   $Mover = array();
         		   $newEntry =array();
         		   $reTable = array();


            
            	for($i=0; $i<$keyCount; $i++){

            		$Mover['keyValue'] = $keyList[$i]['keyValue'];
            		$Mover['keyDesc'] = $keyList[$i]['keyDesc'];
			        $Mover['keyDate'] = $keyList[$i]['keyDate'];
			        $Mover['keyAccumulated'] = $keyList[$i]['keyAccumulated'];			        			
			        $reTable[] = $Mover;
            				             
				}

					$newEntry['keyValue'] ="-" + $keyOperator;
            		$newEntry['keyDesc'] = "Special Search";
			        $newEntry['keyDate'] = $RegisteredTime;
			        $newEntry['keyAccumulated'] = $keyList[$keyCount-1]['keyAccumulated'] - $keyOperator;
			        $userKey = $newEntry['keyAccumulated'];
			        $reTable[] = $newEntry;
			

				$keyJson = json_encode($reTable);

				$dateJson = json_encode($reDateTable);	
			
				$todayJson = json_encode($todayTable);



  		  $sql ="UPDATE detailedInfoGirls1 SET userKeyCalc=?, userKey=?, userDateMet=?, userDateToday=? WHERE userEmail=?";
		  $stmt = mysqli_prepare($con,$sql);
  		  mysqli_stmt_bind_param($stmt,"sssss",$keyJson,$userKey,$dateJson,$todayJson,$userEmail);
 	 	  mysqli_stmt_execute($stmt);
  		  $check = mysqli_stmt_affected_rows($stmt);

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

