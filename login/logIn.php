<?php

if($_SERVER['REQUEST_METHOD']=='POST'){
		$userEmail = $_POST['userEmail'];
		$userPW = $_POST['userPW'];

		$sql = "SELECT * from logSet where userEmail = '$userEmail'";


		define('HOST', "mysql.hostinger.kr");
			define('USER', "u414143907_andro");
			define('PW', "m2m3m5m2");
			define('DB', "u414143907_andro");
$con= mysqli_connect(HOST,USER,PW,DB) or die("Unable to Connect");

		
		$r = mysqli_query($con,$sql);
		
		
		$result = mysqli_fetch_array($r);
		$pwDecoded = base64_decode($result['userPW']);
		
			if($userEmail ==$result['userEmail'] && $userPW == $pwDecoded){

			       if($result['Gender']=="boys" && $result['userHolding'] =="no"){





			    $sqlQ = "select * from detailedInfoBoys1 where userEmail = '$userEmail'";
				$ready = mysqli_query($con,$sqlQ);

				$arrayMover = array();
				$arrayFinal = array();
				$RegisteredTime = date("Ymd");

				$arrayMover['loginResult'] ="yes_boys";

				while($row = mysqli_fetch_array($ready, MYSQL_ASSOC)){

				$arrayMover['userKey'] =$row['userKey'];
				$arrayMover['userRegion']=$row['userRegion'];
				$arrayMover['userRegion2']=$row['userRegion2'];
				$arrayMover['userUniversity'] =$row['userUniversity'] ;
				$arrayMover['userSayHi'] =$row['userSayHi'];
				$arrayMover['userID'] =$row['userID'];
				$arrayMover['userEmail'] =$row['userEmail'];
				$arrayMover['userHeight'] =$row['userHeight'];
				$arrayMover['userAge'] =$row['userAge'];
				$arrayMover['userJob'] =$row['userJob'];
			
				


		}
			

            	


		    	$arrayFinal[] = $arrayMover;

			    echo json_encode($arrayFinal);

	        	

			        }else if ($result['Gender']=="boys" && $result['userHolding'] =="yes") {

			        		$arrayMover['loginResult'] ="boys_deactivated";

		    	$arrayFinal[] = $arrayMover;

			    echo json_encode($arrayFinal);

			        }

			        else if ($result['Gender']=="boys" && $result['userHolding'] =="notRatified") {

			        		$arrayMover['loginResult'] ="boys_notReady";

		    	$arrayFinal[] = $arrayMover;

			    echo json_encode($arrayFinal);

			        }


			       if($result['Gender']=="girls" && $result['userHolding'] =="no"){





				$arrayMover = array();

			    $arrayMover['loginResult'] ="yes_girls";



	 		    $sqlQ = "select * from detailedInfoGirls1 where userEmail = '$userEmail'";
				$ready = mysqli_query($con,$sqlQ);

				$arrayFinal = array();
			
				while($row = mysqli_fetch_array($ready, MYSQL_ASSOC)){

			    $arrayMover['userKey'] =$row['userKey'];
				$arrayMover['userRegion']=$row['userRegion'];
				$arrayMover['userRegion2']=$row['userRegion2'];
				$arrayMover['userUniversity'] =$row['userUniversity'] ;
				$arrayMover['userSayHi'] =$row['userSayHi'];
				$arrayMover['userID'] =$row['userID'];
				$arrayMover['userEmail'] =$row['userEmail'];
				$arrayMover['userHeight'] =$row['userHeight'];
				$arrayMover['userAge'] =$row['userAge'];
				$arrayMover['userJob'] =$row['userJob'];
			}
				
				$arrayFinal[] = $arrayMover;

				echo json_encode($arrayFinal);



		            } else if($result['Gender']=="girls" && $result['userHolding'] =="yes"){

		            			$arrayMover['loginResult'] ="girls_deactivated";
								$arrayFinal[] = $arrayMover;
								echo json_encode($arrayFinal);


		            }
		            else if($result['Gender']=="girls" && $result['userHolding'] =="notRatified"){

		            			$arrayMover['loginResult'] ="girls_notReady";
								$arrayFinal[] = $arrayMover;
								echo json_encode($arrayFinal);


		            }

			}else if($userEmail !==$result['userEmail'] ){
					$arrayMover['loginResult'] ="noID";
					$arrayFinal[] = $arrayMover;
					echo json_encode($arrayFinal);
			}
			else{
					$arrayMover['loginResult'] = "incorrectPW";
					$arrayFinal[] = $arrayMover;
					echo json_encode($arrayFinal);
			}
				
	
		
		mysqli_close($con);
		
	}else{
		echo "Error";
	}

?>