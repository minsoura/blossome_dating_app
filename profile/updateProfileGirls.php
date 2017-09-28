<?php

	if($_SERVER['REQUEST_METHOD']=='POST'){
		

		define('HOST', "mysql.hostinger.kr");
			define('USER', "u414143907_andro");
			define('PW', "m2m3m5m2");
			define('DB', "u414143907_andro");
    $con= mysqli_connect(HOST,USER,PW,DB) or die("Unable to Connect");


    $userEmail =$_POST['userEmail'];
    $userSayHi = $_POST['userSayHi'];
    $userRegion =$_POST['userRegion'];
    $userRegion2 =$_POST['userRegion2'];
    $userAge =$_POST['userAge'];

    $userPicSmall = $_POST['userPicSmall'];
    $userPicMain =$_POST['userPicMain'];
    $userPicTwo=$_POST['userPicTwo'];
    $userPicThree = $_POST['userPicThree'];
    $userPicFour = $_POST['userPicFour'];
    $userPicFive = $_POST['userPicFive'];
    
    $sql ="UPDATE detailedInfoGirls1 SET userSayHi=?, userAge=?,userRegion=?,userRegion2=? WHERE userEmail=?";
    $stmt = mysqli_prepare($con,$sql);
    mysqli_stmt_bind_param($stmt,"sssss",$userSayHi,$userAge,$userRegion,$userRegion2,$userEmail);
    mysqli_stmt_execute($stmt);
    $check = mysqli_stmt_affected_rows($stmt);


    if($userPicMain != "noChange"){
    $sql1 ="UPDATE detailedInfoGirls1 SET  userPicMain=?,userPicSmall=? WHERE userEmail=?";
    $stmt1 = mysqli_prepare($con,$sql1);
    mysqli_stmt_bind_param($stmt1,"sss",$userPicMain,$userPicSmall,$userEmail);
    mysqli_stmt_execute($stmt1);

    }

    if($userPicTwo != "noChange"){
    $sql2 ="UPDATE detailedInfoGirls1 SET  userPicTwo=? WHERE userEmail=?";
    $stmt2 = mysqli_prepare($con,$sql2);
    mysqli_stmt_bind_param($stmt2,"ss",$userPicTwo,$userEmail);
    mysqli_stmt_execute($stmt2);

    }


    if($userPicThree != "noChange"){

    $sql3 ="UPDATE detailedInfoGirls1 SET  userPicThree=? WHERE userEmail=?";
    $stmt3 = mysqli_prepare($con,$sql3);
    mysqli_stmt_bind_param($stmt3,"ss",$userPicThree,$userEmail);
    mysqli_stmt_execute($stmt3);
    }


    if($userPicFour != "noChange"){

    $sql4 ="UPDATE detailedInfoGirls1 SET  userPicFour=? WHERE userEmail=?";
    $stmt4 = mysqli_prepare($con,$sql4);
    mysqli_stmt_bind_param($stmt4,"ss",$userPicFour,$userEmail);
    mysqli_stmt_execute($stmt4);

    }
       if($userPicFive != "noChange"){

    $sql5 ="UPDATE detailedInfoGirls1 SET  userPicFive=? WHERE userEmail=?";
    $stmt5 = mysqli_prepare($con,$sql5);
    mysqli_stmt_bind_param($stmt5,"ss",$userPicFive,$userEmail);
    mysqli_stmt_execute($stmt5);

    }





    	echo "yes";


		mysqli_close($con);



}else{
	echo "error";
}




?>