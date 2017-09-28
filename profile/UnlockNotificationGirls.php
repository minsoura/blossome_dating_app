<?php

	if($_SERVER['REQUEST_METHOD']=='POST'){


		define('HOST', "mysql.hostinger.kr");
			define('USER', "u414143907_andro");
			define('PW', "m2m3m5m2");
			define('DB', "u414143907_andro");

	$con= mysqli_connect(HOST,USER,PW,DB) or die("Unable to Connect");

	    $userEmail = $_POST['userEmail'];
		$dateEmail = $_POST['dateEmail'];
		$decision = $_POST['decision'];

        date_default_timezone_set("Asia/Seoul");
		$RegisteredTime = date("Ymd");
		$InputTime =$RegisteredTime;
		$keyOperator =15;
		
//remove the dateEmail in the LIKEDBY section according to users' decision
		$sql0 = "SELECT Connected,userKey,userKeyCalc from detailedInfoGirls1 where userEmail = '$userEmail'";
		$ready = mysqli_query($con,$sql0);
		while($row = mysqli_fetch_array($ready, MYSQL_ASSOC)){

		$keyVerifier = $row['userKey'];
		$keyTable = $row['userKeyCalc'];
		$ConTableBoys = $row['Connected'];
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

					$newEntryK['keyValue'] ="-".$keyOperator;
            		$newEntryK['keyDesc'] = "unlocked";
			        $newEntryK['keyDate'] = $RegisteredTime;
			        $newEntryK['keyAccumulated'] = $keyList[$keyCount-1]['keyAccumulated'] - $keyOperator;
			        $userKey = $newEntryK['keyAccumulated'];
			        $reTable[] = $newEntryK;
			

				$keyJson = json_encode($reTable);


	   /////////////////////COnnected here 
 
	        $ConList = json_decode($ConTableBoys,true);
			$ConCount = sizeof($ConList);
			//echo $ListCount;

            $ConMover = array();
            $reConTable = array();
		
			for($i=0; $i<$ConCount; $i++){
				if( $dateEmail !== $ConList[$i]['dateEmail']){
					$ConMover['InputTime'] = $ConList[$i]['InputTime'];
			        $ConMover['dateEmail'] = $ConList[$i]['dateEmail'];
			        $ConMover['decision'] = $ConList[$i]['decision'];
			        $reConTable[] = $ConMover;
				}                          
			} 
			         $ConEntry = array();
			         $ConEntry['InputTime'] = $InputTime;
			         $ConEntry['dateEmail'] = $dateEmail;
			         $ConEntry['decision'] = $decision;
					 $reConTable[] = $ConEntry;

			$ConJson = json_encode($reConTable);

    $sql ="UPDATE detailedInfoGirls1 SET Connected=?,userKey=?,userKeyCalc=? WHERE userEmail=?";
    $stmt = mysqli_prepare($con,$sql);
    mysqli_stmt_bind_param($stmt,"ssss",$ConJson,$userKey,$keyJson,$userEmail);
    mysqli_stmt_execute($stmt);
    $check = mysqli_stmt_affected_rows($stmt);

		


//Girl'sTable ---->LikedBY


	$sql2 = "SELECT Connected from detailedInfoBoys1 where userEmail = '$dateEmail'";
		$ready2 = mysqli_query($con,$sql2);
		while($rowG = mysqli_fetch_array($ready2, MYSQL_ASSOC)){
			$ConTableGirls = $rowG['Connected'];
		}
		
	   

///////////////////
			$ConListG = json_decode($ConTableGirls,true);
			$ConCountG = sizeof($ConListG);

			$ConMoverG = array();
            $reConTableG = array();
		
			for($i=0; $i<$ConCountG; $i++){
				if( $userEmail !==$ConListG[$i]['dateEmail']){
					$ConMoverG['InputTime'] = $ConListG[$i]['InputTime'];
			        $ConMoverG['dateEmail'] = $ConListG[$i]['dateEmail'];
			        $ConMoverG['decision'] = $ConListG[$i]['decision'];
			        $reConTableG[] = $ConMoverG;
				}                          
			} 
			         $ConEntryG = array();
			         $ConEntryG['InputTime'] = $InputTime;
			         $ConEntryG['dateEmail'] = $userEmail;
			         $ConEntryG['decision'] = $decision;
					 $reConTableG[] = $ConEntryG;

			$ConJsonG = json_encode($reConTableG);
 
    	$messageChecker="yes";
    $sql3 ="UPDATE detailedInfoBoys1 SET Connected=?,messageListener=? WHERE userEmail=?";
    $stmt3 = mysqli_prepare($con,$sql3);
    mysqli_stmt_bind_param($stmt3,"sss",$ConJsonG,$messageChecker, $dateEmail);
    mysqli_stmt_execute($stmt3);
    $check2 = mysqli_stmt_affected_rows($stmt3);

   		 if($check ==1 &&  $check2 ==1 ){

    	echo "unlocked";

  		  }else{

    	echo "unlockedFailed";

  		  }
  		}else{
			echo "notEnoughKey";
  		}mysqli_close($con);
	}

	else{
		echo "Error";
	}

?>