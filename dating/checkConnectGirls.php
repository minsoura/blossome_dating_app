<?php

	if($_SERVER['REQUEST_METHOD']=='POST'){


			define('HOST', "mysql.hostinger.kr");
			define('USER', "u414143907_andro");
			define('PW', "m2m3m5m2");
			define('DB', "u414143907_andro");

	$con= mysqli_connect(HOST,USER,PW,DB) or die("Unable to Connect");

		
		date_default_timezone_set("Asia/Seoul");
	    $userEmail = $_POST['userEmail'];
		$RegisteredTime = date("Ymd");
		$InputTime =$RegisteredTime;

		
		$sql0 = "SELECT Liking,LikedBy,Connected from detailedInfoGirls1 where userEmail = '$userEmail'";
		$ready0 = mysqli_query($con,$sql0);
		while($row0 = mysqli_fetch_array($ready0, MYSQL_ASSOC)){
		
		$LikedByGirls = $row0['LikedBy'];
		$Connected = $row0['Connected'];
		}
		
	       
			//echo $ListCount;

			$ArrayList2 = json_decode($LikedByGirls,true);
			$ListCount2 =sizeof($ArrayList2);

			$ArrayList3 = json_decode($Connected,true);
			$ListCount3 =sizeof($ArrayList3);

          
            $arrayMover2 =array();
            $arrayMover3 = array();


            $reLiking = array();


			for($i=0; $i<$ListCount2; $i++){
				if( 4 >$InputTime - $ArrayList2[$i]['InputTime']){
					$arrayMover2['type'] = "FROM";
			        $arrayMover2['dateEmail'] = $ArrayList2[$i]['userEmail'];
                    $makeEmail2 =$ArrayList2[$i]['userEmail'];
                    $dayChecker2 =$ArrayList2[$i]['InputTime'];


			        $sql2 = "SELECT userID,userCell  from detailedInfoBoys1 where userEmail = '$makeEmail2'";
			        $ready2 = mysqli_query($con,$sql2);
		
		            while($row2 = mysqli_fetch_array($ready2, MYSQL_ASSOC)){
		            	
		            	$arrayMover2['dateID']= $row2['userID'];
		            	$arrayMover2['dateCell'] = $row2['userCell'];
		            	$arrayMover2['d_day'] = $dayChecker2 + 6 - $InputTime;
		            }


			        $arrayMover2['message'] = $ArrayList2[$i]['message'];
			        $reLiking[] = $arrayMover2;
				}                          
			} 




			for($i=0; $i<$ListCount3; $i++){
				if( 7 >$InputTime - $ArrayList3[$i]['InputTime']){
					$arrayMover3['type'] = $ArrayList3[$i]['decision'];
			        $arrayMover3['dateEmail'] = $ArrayList3[$i]['dateEmail'];
                    $makeEmail3 =$ArrayList3[$i]['dateEmail'];
                    $dayChecker3 =$ArrayList3[$i]['InputTime'];

			        $sql3 = "SELECT userID,userCell  from detailedInfoBoys1 where userEmail = '$makeEmail3'";
			        $ready3 = mysqli_query($con,$sql3);
		
		            while($row3 = mysqli_fetch_array($ready3, MYSQL_ASSOC)){
		            
		            	$arrayMover3['dateID']= $row3['userID'];
		            	$arrayMover3['dateCell'] = $row3['userCell'];
		            	$arrayMover3['d_day'] = $dayChecker3 + 6 - $InputTime;
		            }


			        $arrayMover3['message'] = "Decision Delivered";
			        $reLiking[] = $arrayMover3;
				}                          
			} 

			$messageCheck ="none";
			$sqlTimer ="UPDATE detailedInfoGirls1 SET messageListener=? WHERE userEmail=?";
    		$stmtTimer = mysqli_prepare($con,$sqlTimer);
   			 mysqli_stmt_bind_param($stmtTimer,"ss",$messageCheck, $userEmail);
   			 mysqli_stmt_execute($stmtTimer);
   			 $check2 = mysqli_stmt_affected_rows($stmtTimer);

		
            // $check2 = mysqli_stmt_affected_rows($stmt3);

			echo json_encode($reLiking);  
		 



     }

	else{
		echo "Error";
	}

?>