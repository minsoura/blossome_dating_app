<?php

	if($_SERVER['REQUEST_METHOD']=='POST'){

		$userEmail = $_POST['userEmail'];	
		$keyType =$_POST['keyType'];

		if($keyType =="item1"){
			$keyOperator = 10;

		}else if($keyType =="item2"){
			$keyOperator = 35;

		}else if($keyType =="item3"){
			$keyOperator = 75;
			
		}else if($keyType =="item4"){
			$keyOperator = 250;
			
		}else if($keyType =="item5"){
			$keyOperator = 600;
			
		}



			$RegisteredTime = date("Ymd");
			


				define('HOST', "mysql.hostinger.kr");
			define('USER', "u414143907_andro");
			define('PW', "m2m3m5m2");
			define('DB', "u414143907_andro");

			$con= mysqli_connect(HOST,USER,PW,DB) or die("Unable to Connect");

	 		$sql0 = "SELECT userKeyCalc from detailedInfoBoys1 where userEmail = '$userEmail'";
			$ready = mysqli_query($con,$sql0);
			while($row = mysqli_fetch_array($ready, MYSQL_ASSOC)){
		
			$keyTable = $row['userKeyCalc'];

			}


	        $keyList = json_decode($keyTable,true);
			$keyCount = sizeof($keyList);
			//echo $ListCount;

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

					$newEntry['keyValue'] ="+" + $keyOperator;
            		$newEntry['keyDesc'] = $keyType;
			        $newEntry['keyDate'] = $RegisteredTime;
			        $newEntry['keyAccumulated'] = $keyList[$keyCount-1]['keyAccumulated'] + $keyOperator;
			        $userKey = $newEntry['keyAccumulated'];
			        $reTable[] = $newEntry;
			

				$keyJson = json_encode($reTable);



  		  $sql ="UPDATE detailedInfoBoys1 SET userKeyCalc=?, userKey=? WHERE userEmail=?";
		  $stmt = mysqli_prepare($con,$sql);
  		  mysqli_stmt_bind_param($stmt,"sss",$keyJson,$userKey, $userEmail);
 	 	  mysqli_stmt_execute($stmt);
  		  $check = mysqli_stmt_affected_rows($stmt);

		if($check ==1){
			echo "keyBought";
		}else{
			echo "nope";
		}
		

		
		mysqli_close($con);
		
	}
	else{

		echo "Error";
	}

?>