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
	    $userUniversity =$_POST['userUniversity'];
		$userPicSmall =$_POST['userPicStudent'];

					

		$sql = "INSERT INTO userTransfer (userName,userID,userEmail,userCell,userPicStudent,userUniversity) VALUES (?,?,?,?,?,?)";
		$stmt = mysqli_prepare($con,$sql);
		mysqli_stmt_bind_param($stmt,"ssssss",$userName,$userID,$userEmail,$userCell,$userPicStudent,$userUniversity);
		mysqli_stmt_execute($stmt);
		$check = mysqli_stmt_affected_rows($stmt);
          
			if($check ==1 ){
			echo "yes";

			} 	else{

			echo "no";
			}
	

		} 
	
		mysqli_close($con);

	}
	else{

		echo "Error";
	}

?>	