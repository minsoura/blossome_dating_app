<?php

	if($_SERVER['REQUEST_METHOD']=='POST'){
		$userEmail = $_POST['userEmail'];	
		$userUniv=	$_POST['userUniv'];
		$userGender =	$_POST['userGender'];
	
			define('HOST', "mysql.hostinger.kr");
			define('USER', "u414143907_andro");
			define('PW', "m2m3m5m2");
			define('DB', "u414143907_andro");
	
    	date_default_timezone_set("Asia/Seoul");

		$holdingStatus="showManual";
		$RegisteredTime = date("Ymd");
	
		if($userGender == "boys"){
      	  $con= mysqli_connect(HOST,USER,PW,DB) or die("Unable to Connect");
 
  		  $sql ="UPDATE detailedInfoBoys1 SET userHolding=?, userUniversity=? WHERE userEmail=?";
		  $stmt = mysqli_prepare($con,$sql);
  		  mysqli_stmt_bind_param($stmt,"sss",$holdingStatus,$userUniv,$userEmail);
 	 	  mysqli_stmt_execute($stmt);
  		  $check1 = mysqli_stmt_affected_rows($stmt);
  		}
  		else if($userGender =="girls"){

  		 $con= mysqli_connect(HOST,USER,PW,DB) or die("Unable to Connect");
 
  		  $sql ="UPDATE detailedInfoGirls1 SET userHolding=?, userUniversity=? WHERE userEmail=?";
		  $stmt = mysqli_prepare($con,$sql);
  		  mysqli_stmt_bind_param($stmt,"sss",$holdingStatus,$userUniv,$userEmail);
 	 	  mysqli_stmt_execute($stmt);
  		  $check1 = mysqli_stmt_affected_rows($stmt);

  		}

  		  $con= mysqli_connect(HOST,USER,PW,DB) or die("Unable to Connect");
 
  		  $sql2 ="UPDATE logSet SET userHolding=? WHERE userEmail=?";
		  $stmt2 = mysqli_prepare($con,$sql2);
  		  mysqli_stmt_bind_param($stmt2,"ss",$holdingStatus,$userEmail);
 	 	  mysqli_stmt_execute($stmt2);
  		  $check2 = mysqli_stmt_affected_rows($stmt2);
	
		 
  		  $sql3 ="DELETE FROM userTransfer WHERE userEmail='$userEmail'";
  		  $check3 = mysqli_query($con,$sql3);


		  if($check1 ==1 && $check2 ==1  && $check3 ==1 ){
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
