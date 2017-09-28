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

		$RegisteredTime = date("Ymd");
		$InputTime =$RegisteredTime;
		
//remove the dateEmail in the LIKEDBY section according to users' decision
		$sql0 = "SELECT LikedBy,Connected from detailedInfoGirls1 where userEmail = '$userEmail'";
		$ready = mysqli_query($con,$sql0);
		while($row = mysqli_fetch_array($ready, MYSQL_ASSOC)){
		$TableValueBoys = $row['LikedBy'];
		$ConTableBoys = $row['Connected'];
		}
		
	        $ArrayList = json_decode($TableValueBoys,true);
			$ListCount = sizeof($ArrayList);
			//echo $ListCount;

            $arrayMover = array();
            $reLikedBy = array();
		
			for($i=0; $i<$ListCount; $i++){
				if( $dateEmail !== $ArrayList[$i]['userEmail']){
					$arrayMover['InputTime'] = $ArrayList[$i]['InputTime'];
			        $arrayMover['userEmail'] = $ArrayList[$i]['userEmail'];
			        $arrayMover['message'] = $ArrayList[$i]['message'];
			        $reLikedBy[] = $arrayMover;
				}                          
			} 
			        
			$InputJson = json_encode($reLikedBy);
/////////////////////COnnected here 
 
	        $ConList = json_decode($ConTableBoys,true);
			$ConCount = sizeof($ConList);
			//echo $ListCount;

            $ConMover = array();
            $reConTable = array();
		
			for($i=0; $i<$ConCount; $i++){
				if( 7 >$InputTime - $ConList[$i]['InputTime']){
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

    $sql ="UPDATE detailedInfoGirls1 SET LikedBy=?,Connected=? WHERE userEmail=?";
    $stmt = mysqli_prepare($con,$sql);
    mysqli_stmt_bind_param($stmt,"sss",$InputJson,$ConJson, $userEmail);
    mysqli_stmt_execute($stmt);
    $check = mysqli_stmt_affected_rows($stmt);

		


//Girl'sTable ---->LikedBY


	$sql2 = "SELECT Liking,Connected from detailedInfoBoys1 where userEmail = '$dateEmail'";
		$ready2 = mysqli_query($con,$sql2);
		while($rowG = mysqli_fetch_array($ready2, MYSQL_ASSOC)){
		$TableValueGirls = $rowG['Liking'];
		$ConTableGirls = $rowG['Connected'];
		}
		
	        $ArrayListG = json_decode($TableValueGirls,true);
			$ListCountG = sizeof($ArrayListG);
			//echo $ListCount;

            $arrayMoverG = array();
            $reLikingBy = array();
		
			for($i=0; $i<$ListCountG; $i++){
				if( $userEail !==$ArrayListG[$i]['dateEmail']){
					$arrayMoverG['InputTime'] = $ArrayListG[$i]['InputTime'];
			        $arrayMoverG['dateEmail'] = $ArrayListG[$i]['dateEmail'];
			         $arrayMoverG['message'] = $ArrayListG[$i]['message'];
			        $reLikingBy[] = $arrayMoverG;
				}                          
			} 
			         

			$InputJsonG = json_encode($reLikingBy);


///////////////////
			$ConListG = json_decode($ConTableGirls,true);
			$ConCountG = sizeof($ConListG);

			$ConMoverG = array();
            $reConTableG = array();
		
			for($i=0; $i<$ConCountG; $i++){
				if( 7>$InputTime - $ConListG[$i]['InputTime']){
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
    $sql3 ="UPDATE detailedInfoBoys1 SET Liking=?,Connected=?,messageListener=? WHERE userEmail=?";
    $stmt3 = mysqli_prepare($con,$sql3);
    mysqli_stmt_bind_param($stmt3,"ssss",$InputJsonG,$ConJsonG,$messageChecker, $dateEmail);
    mysqli_stmt_execute($stmt3);
    $check2 = mysqli_stmt_affected_rows($stmt3);

   		 if($check ==1 &&  $check2 ==1 ){

    	echo "yes";

  		  }else{

    	echo "no";

  		  }
			mysqli_close($con);
	}

	else{
		echo "Error";
	}

?>
