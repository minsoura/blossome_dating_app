<?php

	if($_SERVER['REQUEST_METHOD']=='POST'){

		$userEmail = $_POST['userEmail'];	
		$userBeauty =$_POST['userBeauty'];
		$dateEmail =$_POST['dateEmail'];
			


		define('HOST', "mysql.hostinger.kr");
			define('USER', "u414143907_andro");
			define('PW', "m2m3m5m2");
			define('DB', "u414143907_andro");

			$con= mysqli_connect(HOST,USER,PW,DB) or die("Unable to Connect");
			$keyOperator = 5;
			$RegisteredTime = date("Ymd");

	 		$sql0 = "SELECT userBeautyCalc from detailedInfoGirls1 where userEmail = '$dateEmail'";
			$ready = mysqli_query($con,$sql0);
			while($row = mysqli_fetch_array($ready, MYSQL_ASSOC)){
		
			$beautyTable = $row['userBeautyCalc'];
			
			}

//////////////////////////////////////////

	        $BeautyList = json_decode($beautyTable,true);
			$BeautyCount = sizeof($BeautyList);
			//echo $ListCount;

            $Mover = array();
            $reTable = array();


            if($BeautyCount ==1){
            	for($i=0; $i<1; $i++){
            		$numerator =(double) $BeautyList[$i]['point'] + (double)$userBeauty *2;
            		$denominator =$BeautyList[$i]['count'] + 1 ;
            		$newPoint = $numerator/$denominator;			
					$Mover['point'] = $numerator;
			        $Mover['count'] = $denominator;
			
			        $reTable[] = $Mover;
            }
				             
			}else{
					$Mover['point'] = (double)$userBeauty *2;
			        $Mover['count'] = 1;
					$newPoint = (double)$userBeauty *2;
			        $reTable[] = $Mover;
			} 

				$beautyJson = json_encode($reTable);

  		  $sql ="UPDATE detailedInfoGirls1 SET userBeautyCalc=?, userBeauty=? WHERE userEmail=?";
		  $stmt = mysqli_prepare($con,$sql);
  		  mysqli_stmt_bind_param($stmt,"sss",$beautyJson,$newPoint, $dateEmail);
 	 	  mysqli_stmt_execute($stmt);
  		  $check = mysqli_stmt_affected_rows($stmt);

/////////////////////////////

	 		$sqlKey = "SELECT userKeyCalc, userDateToday from detailedInfoBoys1 where userEmail = '$userEmail'";
			$readyKey = mysqli_query($con,$sqlKey);
			while($rowKey = mysqli_fetch_array($readyKey, MYSQL_ASSOC)){
		
			$keyTable = $rowKey['userKeyCalc'];
			$todayTable = $rowKey['userDateToday'];
			
			}

			$todayList = json_decode($todayTable,true);
			$todayCount = sizeof($todayList);

			$MoverToday = array();
			$retableToday = array();


			for($i=0; $i<$todayCount; $i++){

					if($todayList[$i]['dateEmail'] == $dateEmail){
            		$MoverToday['dateEmail'] = $todayList[$i]['dateEmail'];
            		$MoverToday['introDate'] = $todayList[$i]['introDate'];
			        $MoverToday['rating'] = $userBeauty;
			        		        			
			        $reTableToday[] = $MoverToday;
			    }else{
			   		$MoverToday['dateEmail'] = $todayList[$i]['dateEmail'];
            		$MoverToday['introDate'] = $todayList[$i]['introDate'];
			        $MoverToday['rating'] = $todayList[$i]['rating'];
			        		        			
			        $reTableToday[] = $MoverToday;

			    }
            				             
				}
				$todayJson = json_encode($reTableToday);





			$keyList = json_decode($keyTable,true);
			$keyCount = sizeof($keyList);
			//echo $ListCount;

            $MoverK = array();
            $newEntryK =array();
            $reTableK = array();
            
            	for($i=0; $i<$keyCount; $i++){

            		$MoverK['keyValue'] = $keyList[$i]['keyValue'];
            		$MoverK['keyDesc'] = $keyList[$i]['keyDesc'];
			        $MoverK['keyDate'] = $keyList[$i]['keyDate'];
			        $MoverK['keyAccumulated'] = $keyList[$i]['keyAccumulated'];			        			
			        $reTableK[] = $MoverK;
            				             
				}

					$newEntryK['keyValue'] ="+". $keyOperator;
            		$newEntryK['keyDesc'] = "rating done";
			        $newEntryK['keyDate'] = $RegisteredTime;
			        $newEntryK['keyAccumulated'] = $keyList[$keyCount-1]['keyAccumulated'] + $keyOperator;
			        $userKey = $newEntryK['keyAccumulated'];
			        $reTableK[] = $newEntryK;
			
				$keyJson = json_encode($reTableK);

  		  $sqlKK ="UPDATE detailedInfoBoys1 SET userKeyCalc=?, userKey=?,userDateToday=? WHERE userEmail=?";
		  $stmtKK = mysqli_prepare($con,$sqlKK);
  		  mysqli_stmt_bind_param($stmtKK,"ssss",$keyJson,$userKey,$todayJson, $userEmail);
 	 	  mysqli_stmt_execute($stmtKK);
  		  $check2 = mysqli_stmt_affected_rows($stmtKK);

		if($check ==1 && $check2 ==1){
			echo "ratingRecorded";
		}else{
			echo "nope";
		}
		

		
		mysqli_close($con);
		
	}
	else{

		echo "Error";
	}

?>