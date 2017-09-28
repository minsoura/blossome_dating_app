<?php

if($_SERVER['REQUEST_METHOD']=='POST'){
		

		define('HOST', "mysql.hostinger.kr");
			define('USER', "u414143907_andro");
			define('PW', "m2m3m5m2");
			define('DB', "u414143907_andro");

$con= mysqli_connect(HOST,USER,PW,DB) or die("Unable to Connect");

		
		
		$userName =$_POST['userName'];
		$userID= $_POST['userID'];
		$userEmail = $_POST['userEmail'];
		$userCell =$_POST['userCell'];
		$userPW =$_POST['userPW'];
		$userPic =$_POST['userPic'];
		$userPicSmall =$_POST['userPicSmall'];

		$userHeight=$_POST['userHeight'];
		$userAge =$_POST['userAge'];
		$userJob =$_POST['userJob'];
		$userRegion=$_POST['userRegion'];
		$userRegion2 =$_POST['userRegion2'];
		$userUniversity =$_POST['userUniversity'];

		$pwEncoded = base64_encode($userPW);

		
		$sql0 = "SELECT userID,userEmail from logSet";
		$checkData = mysqli_query($con,$sql0);
		
			$keyID =0;	
			$keyEmail =0;
			

		while($row = mysqli_fetch_array($checkData, MYSQL_ASSOC)){


			if( "{$row['userID']}" == $userID){
				$keyID =1;
			}

			if("{$row['userEmail']}" == $userEmail){
				$keyEmail =1;
			}

		}

		if($keyID ==0 && $keyEmail ==0){

		$userKeyFirst = 500;
		$RegisteredTime = date("Ymd");
					  $newEntry =array();
          			  $reTable = array();

					$newEntry['keyValue'] ="+" + $userKeyFirst;
            		$newEntry['keyDesc'] = "Registration";
			        $newEntry['keyDate'] = $RegisteredTime;
			        $newEntry['keyAccumulated'] = $userKeyFirst;
			        $reTable[] = $newEntry;
			

				$keyJson = json_encode($reTable);

		

		$sql = "INSERT INTO accountInfoBoys (userName,userID,userEmail,userCell,userPW,userPic,userHeight,userAge,userJob) VALUES (?,?,?,?,?,?,?,?,?)";
		$stmt = mysqli_prepare($con,$sql);
		mysqli_stmt_bind_param($stmt,"sssssssss",$userName,$userID,$userEmail,$userCell,$pwEncoded,$userPic,$userHeight,$userAge,$userJob);
		mysqli_stmt_execute($stmt);
		$check = mysqli_stmt_affected_rows($stmt);

                $userGender="boys";
		$sql2= "INSERT INTO logSet (userID,userEmail,userPW,Gender) VALUES (?,?,?,?)";
		$stmt2 = mysqli_prepare($con,$sql2);
		mysqli_stmt_bind_param($stmt2,"ssss", $userID,$userEmail,$pwEncoded,$userGender);
		mysqli_stmt_execute($stmt2);
		$check2 = mysqli_stmt_affected_rows($stmt2);

		$sql3= "INSERT INTO detailedInfoBoys1 (userID,userCell,userHeight,userJob,userEmail,userAge,userPicSmall,userPicMain,userRegion,userRegion2,userUniversity,userKey,userKeyCalc) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?)";
		$stmt3 = mysqli_prepare($con,$sql3);
		mysqli_stmt_bind_param($stmt3,"sssssssssssss", $userID,$userCell,$userHeight,$userJob,$userEmail,$userAge,$userPicSmall,$userPic,$userRegion,$userRegion2,$userUniversity,$userKeyFirst,$keyJson);
		mysqli_stmt_execute($stmt3);
		$check3 = mysqli_stmt_affected_rows($stmt3);

	        $sql4= "INSERT INTO preferenceForBoys (userEmail,cardAge,cardRegion) VALUES (?,?,?)";
		$stmt4 = mysqli_prepare($con,$sql4);
		mysqli_stmt_bind_param($stmt4,"sss", $userEmail,$userAge,$userRegion);
		mysqli_stmt_execute($stmt4);
		$check4 = mysqli_stmt_affected_rows($stmt4);


			if($check ==1 && $check2==1 && $check3==1 && $check4==1){


			echo "yes";

			} 	else{

			echo "no";
			}
	

		} else if($keyID ==1 && $keyEmail !==1){
				echo "changeID";

		} else if($keyEmail ==1 && $keyID !==1 ){
				echo "changeEmail";

		} else{
			echo "changeID_EMAIL";
		}

		

		
		


		mysqli_close($con);

	}
	else{

		echo "Error";
	}

?>	