<?php

	if($_SERVER['REQUEST_METHOD']=='POST'){

		$userEmail = $_POST['userEmail'];	
		
			define('HOST', "mysql.hostinger.kr");
			define('USER', "u414143907_andro");
			define('PW', "m2m3m5m2");
			define('DB', "u414143907_andro");


			$con= mysqli_connect(HOST,USER,PW,DB) or die("Unable to Connect");
			
  		    $sql ="DELETE FROM detailedInfoBoys1 WHERE userEmail='$userEmail'";
		    $check = mysqli_query($con,$sql);



  		   	$sql2 ="DELETE FROM accountInfoBoys WHERE userEmail='$userEmail'";
		   	$check2 = mysqli_query($con,$sql2);


  		    $sql3 ="DELETE FROM preferenceForBoys WHERE userEmail='$userEmail'";
		   	$check3 = mysqli_query($con,$sql3);

  		    $sql4 ="DELETE FROM logSet WHERE userEmail='$userEmail'";
  		    $check4 = mysqli_query($con,$sql4);
		   	
  		   

		if($check ==1 && $check2 ==1 && $check3 ==1 &&$check4 ==4){
			echo "accountRemoved";
		}else{
			echo "nope";
		}
				
		mysqli_close($con);
		
	}

	else{

		echo "Error";
	}

?>