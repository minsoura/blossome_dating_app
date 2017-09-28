<?php

	if($_SERVER['REQUEST_METHOD']=='POST'){
    
     $adminEmailBoys ="minsoura@snu.ac.kr";
     $adminEmailGirls = "misnilk@naver.com";


		 $userEmail = $_POST['userEmail'];	
		
     $adminCheckType = $_POST['adminCheckType'];

		 $userGender =	$_POST['userGender'];
	
			define('HOST', "mysql.hostinger.kr");
			define('USER', "u414143907_andro");
			define('PW', "m2m3m5m2");
			define('DB', "u414143907_andro");
	    date_default_timezone_set("Asia/Seoul");
      $con= mysqli_connect(HOST,USER,PW,DB) or die("Unable to Connect");


		$holdingStatus="no";
		$RegisteredTime = date("Ymd");


    if($adminCheckType =="ratify"){

        $sqlP = "SELECT * from userPicTransfer where userEmail ='$userEmail'";
    $readyP = mysqli_query($con,$sqlP);
      while($rowG=mysqli_fetch_array($readyP, MYSQL_ASSOC)){
             $userPicTransferReady = $rowG['userPicTemp'];
              $userPicTransferReady2 = $rowG['userPicThumb'];
                  
      }
          header('Content-Type: image/jpeg');
          $userPicTransferR = base64_decode($userPicTransferReady);
          $userPicTransfer = base64_encode($userPicTransferR);

          header('Content-Type: image/jpeg');
          $userPicTransferR2 = base64_decode($userPicTransferReady2);
          $userPicTransfer2 = base64_encode($userPicTransferR2);



         if($userGender == "boys"){  


      $sql ="UPDATE detailedInfoBoys1 SET userPicMain=?,userPicSmall=? WHERE userEmail=?";
      $stmt = mysqli_prepare($con,$sql);
      mysqli_stmt_bind_param($stmt,"sss",$userPicTransfer,$userPicTransfer2,$userEmail);
      mysqli_stmt_execute($stmt);
      $check1 = mysqli_stmt_affected_rows($stmt);


      }
      else if($userGender =="girls"){
 

      $sql ="UPDATE detailedInfoGirls1 SET userPicMain=?,userPicSmall=? WHERE userEmail=?";
      $stmt = mysqli_prepare($con,$sql);
      mysqli_stmt_bind_param($stmt,"sss",$userPicTransfer,$userPicTransfer2,$userEmail);
      mysqli_stmt_execute($stmt);
      $check1 = mysqli_stmt_affected_rows($stmt);



      }

       if($check1 ==1){

        $sql3 ="DELETE FROM userPicTransfer WHERE userEmail='$userEmail'";
        $check3 = mysqli_query($con,$sql3);
          echo "yes";
        }else{
          echo "no";
        }






    }else if($adminCheckType =="reject"){

          if($userGender =="boys"){


              $sql2 = "SELECT LikedBY from detailedInfoBoys1 where userEmail = '$userEmail'";
              $ready2 = mysqli_query($con,$sql2);
              while($rowG = mysqli_fetch_array($ready2, MYSQL_ASSOC)){
              $TableValueGirls = $rowG['LikedBY'];
              }
              
                $ArrayListG = json_decode($TableValueGirls,true);
                $ListCountG = sizeof($ArrayListG);
                //echo $ListCount;

                      $arrayMoverG = array();
                      $reLikedBy = array();
              
                for($i=0; $i<$ListCountG; $i++){
                  if( 4 >$InputTime - $ArrayListG[$i]['InputTime']){
                        $arrayMoverG['InputTime'] = $ArrayListG[$i]['InputTime'];
                        $arrayMoverG['userEmail'] = $ArrayListG[$i]['userEmail'];
                        $arrayMoverG['message'] = $ArrayListG[$i]['message'];
                        $reLikedBy[] = $arrayMoverG;
                  }                          
                } 
                         $newEntryG = array();
                         $newEntryG['InputTime'] = $InputTime;
                         $newEntryG['userEmail'] = $adminEmailGirls;
                         $newEntryG['message'] = "사진 승인이 이루어지지 않았습니다.";
                         $reLikedBy[] = $newEntryG;

              $InputJsonG = json_encode($reLikedBy);
                
              $messageChecker="yes";
              $sql3 ="UPDATE detailedInfoBoys1 SET LikedBY=?,messageListener=? WHERE userEmail=?";
              $stmt3 = mysqli_prepare($con,$sql3);
              mysqli_stmt_bind_param($stmt3,"sss",$InputJsonG,$messageChecker, $userEmail);
              mysqli_stmt_execute($stmt3);
              $check2 = mysqli_stmt_affected_rows($stmt3);

                 if($check ==1 &&  $check2 ==1 ){

                echo "yesReject";

                  }else{

                echo "noReject";

                  }








          }else if($userGender=="girls"){



              $sql2 = "SELECT LikedBY from detailedInfoGirls1 where userEmail = '$userEmail'";
              $ready2 = mysqli_query($con,$sql2);
              while($rowG = mysqli_fetch_array($ready2, MYSQL_ASSOC)){
              $TableValueGirls = $rowG['LikedBY'];
              }
              
                $ArrayListG = json_decode($TableValueGirls,true);
                $ListCountG = sizeof($ArrayListG);
                //echo $ListCount;

                      $arrayMoverG = array();
                      $reLikedBy = array();
              
                for($i=0; $i<$ListCountG; $i++){
                  if( 4 >$InputTime - $ArrayListG[$i]['InputTime']){
                        $arrayMoverG['InputTime'] = $ArrayListG[$i]['InputTime'];
                        $arrayMoverG['userEmail'] = $ArrayListG[$i]['userEmail'];
                        $arrayMoverG['message'] = $ArrayListG[$i]['message'];
                        $reLikedBy[] = $arrayMoverG;
                  }                          
                } 
                         $newEntryG = array();
                         $newEntryG['InputTime'] = $InputTime;
                         $newEntryG['userEmail'] = $adminEmailBoys;
                         $newEntryG['message'] = "사진 승인이 이루어지지 않았습니다.";
                         $reLikedBy[] = $newEntryG;

              $InputJsonG = json_encode($reLikedBy);
                
              $messageChecker="yes";
              $sql3 ="UPDATE detailedInfoGirls1 SET LikedBY=?,messageListener=? WHERE userEmail=?";
              $stmt3 = mysqli_prepare($con,$sql3);
              mysqli_stmt_bind_param($stmt3,"sss",$InputJsonG,$messageChecker, $userEmail);
              mysqli_stmt_execute($stmt3);
              $check2 = mysqli_stmt_affected_rows($stmt3);

                 if($check ==1 &&  $check2 ==1 ){

               echo "yesReject";

                  }else{

                echo "noReject";

                  }













          }









    }
 		  

		 
		mysqli_close($con);
		
	}
	else{

		echo "Error";
	}

?>
