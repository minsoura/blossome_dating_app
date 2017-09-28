<?php

	if($_SERVER['REQUEST_METHOD']=='POST'){


			define('HOST', "mysql.hostinger.kr");
			define('USER', "u414143907_andro");
			define('PW', "m2m3m5m2");
			define('DB', "u414143907_andro");
	$con= mysqli_connect(HOST,USER,PW,DB) or die("Unable to Connect");






	    $userEmail = $_POST['userEmail'];
		
		$message = $_POST['text'];
		$dateEmail = $_POST['dateEmail'];


		$sqlGender = "SELECT * from logSet where userEmail = '$dateEmail'";

		 $r = mysqli_query($con,$sqlGender);
    
    
   		 $result = mysqli_fetch_array($r);
   		 $dateGender = $result['Gender'];


		$RegisteredTime = date("Ymd");
		$InputTime =$RegisteredTime;
		$keyOperator = 2;




				if($dateGender =="boys"){


					$sql0 = "SELECT Liking,userKey,userKeyCalc from detailedInfoGirls1 where userEmail = '$userEmail'";
		$ready = mysqli_query($con,$sql0);
		while($row = mysqli_fetch_array($ready, MYSQL_ASSOC)){
		$TableValueBoys = $row['Liking'];
		$keyVerifier = $row['userKey'];
		$keyTable = $row['userKeyCalc'];

		}
			if($keyVerifier-$keyOperator >=0){


			$keyList = json_decode($keyTable,true);
			$keyCount = sizeof($keyList);
			//echo $ListCount;

            $Mover = array();
            $newEntryK =array();
            $reTable = array();


            
            	for($i=0; $i<$keyCount; $i++){

            		$Mover['keyValue'] = $keyList[$i]['keyValue'];
            		$Mover['keyDesc'] = $keyList[$i]['keyDesc'];
			        $Mover['keyDate'] = $keyList[$i]['keyDate'];
			        $Mover['keyAccumulated'] = $keyList[$i]['keyAccumulated'];			        			
			        $reTable[] = $Mover;
            				             
				}

					$newEntryK['keyValue'] ="-" + $keyOperator;
            		$newEntryK['keyDesc'] = "message sent";
			        $newEntryK['keyDate'] = $RegisteredTime;
			        $newEntryK['keyAccumulated'] = $keyList[$keyCount-1]['keyAccumulated'] - $keyOperator;
			        $userKey = $newEntryK['keyAccumulated'];
			        $reTable[] = $newEntryK;
			

				$keyJson = json_encode($reTable);


////////////////////////////////////////////keyRecord up up up see up
		
	        $ArrayList = json_decode($TableValueBoys,true);
			$ListCount = sizeof($ArrayList);
			//echo $ListCount;

            $arrayMover = array();
            $reLiking = array();
		
			for($i=0; $i<$ListCount; $i++){
				if( 4 >$InputTime - $ArrayList[$i]['InputTime']){
					$arrayMover['InputTime'] = $ArrayList[$i]['InputTime'];
			        $arrayMover['dateEmail'] = $ArrayList[$i]['dateEmail'];
			        $arrayMover['message'] = $ArrayList[$i]['message'];
			        $reLiking[] = $arrayMover;
				}                          
			} 
			         $newEntry = array();
			         $newEntry['InputTime'] = $InputTime;
			         $newEntry['dateEmail'] = $dateEmail;
			         $newEntry['message'] = $message;
					 $reLiking[] = $newEntry;

			$InputJson = json_encode($reLiking);
 
    $sql ="UPDATE detailedInfoGirls1 SET  Liking=?,userKey=?,userKeyCalc=? WHERE userEmail=?";
    $stmt = mysqli_prepare($con,$sql);
    mysqli_stmt_bind_param($stmt,"ssss",$InputJson,$userKey,$keyJson,$userEmail);
    mysqli_stmt_execute($stmt);
    $check = mysqli_stmt_affected_rows($stmt);

//Girl'sTable ---->LikedBY


	$sql2 = "SELECT LikedBY from detailedInfoBoys1 where userEmail = '$dateEmail'";
		$ready2 = mysqli_query($con,$sql2);
		while($rowG = mysqli_fetch_array($ready2, MYSQL_ASSOC)){
		$TableValueGirls = $rowG['LikedBY'];
		}
		
	        $ArrayListG = json_decode($TableValueGirls,true);
			$ListCountG = sizeof($ArrayListG);
			//echo $ListCount;

            $arrayMoverG = array();
            $reLikedBy = array();
		
			for($i=0; $i<$ListCountG; $i++){
				if( 4 >$InputTime - $ArrayListG[$i]['InputTime']){
					$arrayMoverG['InputTime'] = $ArrayListG[$i]['InputTime'];
			        $arrayMoverG['userEmail'] = $ArrayListG[$i]['userEmail'];
			         $arrayMoverG['message'] = $ArrayListG[$i]['message'];
			        $reLikedBy[] = $arrayMoverG;
				}                          
			} 
			         $newEntryG = array();
			         $newEntryG['InputTime'] = $InputTime;
			         $newEntryG['userEmail'] = $userEmail;
			         $newEntryG['message'] = $message;
					 $reLikedBy[] = $newEntryG;

			$InputJsonG = json_encode($reLikedBy);
			
 	$messageChecker="yes";
    $sql3 ="UPDATE detailedInfoBoys1 SET LikedBY=?,messageListener=? WHERE userEmail=?";
    $stmt3 = mysqli_prepare($con,$sql3);
    mysqli_stmt_bind_param($stmt3,"sss",$InputJsonG,$messageChecker, $dateEmail);
    mysqli_stmt_execute($stmt3);
    $check2 = mysqli_stmt_affected_rows($stmt3);

   		 if($check ==1 &&  $check2 ==1 ){

    	echo "yes";

  		  }else{

    	echo "no";

  		  }

  		}
  		else{
  			echo "notEnoughKey";
		}
			mysqli_close($con);







				}else if($dateGender=="girls"){

						$sql0 = "SELECT Liking,userKey,userKeyCalc from detailedInfoBoys1 where userEmail = '$userEmail'";
		$ready = mysqli_query($con,$sql0);
		while($row = mysqli_fetch_array($ready, MYSQL_ASSOC)){
		$TableValueBoys = $row['Liking'];
		$keyVerifier = $row['userKey'];
		$keyTable = $row['userKeyCalc'];

		}
			if($keyVerifier-$keyOperator >=0){


			$keyList = json_decode($keyTable,true);
			$keyCount = sizeof($keyList);
			//echo $ListCount;

            $Mover = array();
            $newEntryK =array();
            $reTable = array();


            
            	for($i=0; $i<$keyCount; $i++){

            		$Mover['keyValue'] = $keyList[$i]['keyValue'];
            		$Mover['keyDesc'] = $keyList[$i]['keyDesc'];
			        $Mover['keyDate'] = $keyList[$i]['keyDate'];
			        $Mover['keyAccumulated'] = $keyList[$i]['keyAccumulated'];			        			
			        $reTable[] = $Mover;
            				             
				}

					$newEntryK['keyValue'] ="-" + $keyOperator;
            		$newEntryK['keyDesc'] = "message sent";
			        $newEntryK['keyDate'] = $RegisteredTime;
			        $newEntryK['keyAccumulated'] = $keyList[$keyCount-1]['keyAccumulated'] - $keyOperator;
			        $userKey = $newEntryK['keyAccumulated'];
			        $reTable[] = $newEntryK;
			

				$keyJson = json_encode($reTable);


////////////////////////////////////////////keyRecord up up up see up
		
	        $ArrayList = json_decode($TableValueBoys,true);
			$ListCount = sizeof($ArrayList);
			//echo $ListCount;

            $arrayMover = array();
            $reLiking = array();
		
			for($i=0; $i<$ListCount; $i++){
				if( 4 >$InputTime - $ArrayList[$i]['InputTime']){
					$arrayMover['InputTime'] = $ArrayList[$i]['InputTime'];
			        $arrayMover['dateEmail'] = $ArrayList[$i]['dateEmail'];
			        $arrayMover['message'] = $ArrayList[$i]['message'];
			        $reLiking[] = $arrayMover;
				}                          
			} 
			         $newEntry = array();
			         $newEntry['InputTime'] = $InputTime;
			         $newEntry['dateEmail'] = $dateEmail;
			         $newEntry['message'] = $message;
					 $reLiking[] = $newEntry;

			$InputJson = json_encode($reLiking);
 
    $sql ="UPDATE detailedInfoBoys1 SET  Liking=?,userKey=?,userKeyCalc=? WHERE userEmail=?";
    $stmt = mysqli_prepare($con,$sql);
    mysqli_stmt_bind_param($stmt,"ssss",$InputJson,$userKey,$keyJson,$userEmail);
    mysqli_stmt_execute($stmt);
    $check = mysqli_stmt_affected_rows($stmt);

//Girl'sTable ---->LikedBY


	$sql2 = "SELECT LikedBY from detailedInfoGirls1 where userEmail = '$dateEmail'";
		$ready2 = mysqli_query($con,$sql2);
		while($rowG = mysqli_fetch_array($ready2, MYSQL_ASSOC)){
		$TableValueGirls = $rowG['LikedBY'];
		}
		
	        $ArrayListG = json_decode($TableValueGirls,true);
			$ListCountG = sizeof($ArrayListG);
			//echo $ListCount;

            $arrayMoverG = array();
            $reLikedBy = array();
		
			for($i=0; $i<$ListCountG; $i++){
				if( 4 >$InputTime - $ArrayListG[$i]['InputTime']){
					$arrayMoverG['InputTime'] = $ArrayListG[$i]['InputTime'];
			        $arrayMoverG['userEmail'] = $ArrayListG[$i]['userEmail'];
			         $arrayMoverG['message'] = $ArrayListG[$i]['message'];
			        $reLikedBy[] = $arrayMoverG;
				}                          
			} 
			         $newEntryG = array();
			         $newEntryG['InputTime'] = $InputTime;
			         $newEntryG['userEmail'] = $userEmail;
			         $newEntryG['message'] = $message;
					 $reLikedBy[] = $newEntryG;

			$InputJsonG = json_encode($reLikedBy);
			
 	$messageChecker="yes";
    $sql3 ="UPDATE detailedInfoGirls1 SET LikedBY=?,messageListener=? WHERE userEmail=?";
    $stmt3 = mysqli_prepare($con,$sql3);
    mysqli_stmt_bind_param($stmt3,"sss",$InputJsonG,$messageChecker, $dateEmail);
    mysqli_stmt_execute($stmt3);
    $check2 = mysqli_stmt_affected_rows($stmt3);

   		 if($check ==1 &&  $check2 ==1 ){

    	echo "yes";

  		  }else{

    	echo "no";

  		  }

  		}
  		else{
  			echo "notEnoughKey";
		}
			mysqli_close($con);




				}

//Boys's Table -->Liking
		
  		
	}

	else{
		echo "Error";
	}

?>
