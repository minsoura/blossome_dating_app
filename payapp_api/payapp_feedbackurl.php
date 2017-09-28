<?php
/*************************************************************************/
/* payapp                                                                */
/* copyright ⓒ 2012 UDID. all rights reserved.                           */
/*                                                                       */
/* oapi sample                                                           */
/* - version 005-001                                                     */
/* - payapp 서버로부터 결제요청상태 정보를 전달받아 처리합니다.          */
/*                                                                       */
/*************************************************************************/

/*
결제요청시 feedbackurl로 작성하는 페이지 입니다.
결제완료 또는 취소가 되면 feedbackurl을 payapp.kr에서 호출합니다.
feedbackurl 페이지는 외부로 노출되지 않도록 주의 해야 합니다. 외부로 노출되면 결제를 변조하는 시도를 할 수 있습니다.

이 페이지는 payapp 서버에서 호출을 하는 페이지 입니다. 따라서 사용자는 이페이지를 볼 수 없습니다.
본페이지는 payapp.kr에서 접속이 가능해야 합니다.

payapp.kr에서 데이터는 POST로 전송을 합니다.

feedbackurl은 여러번 호출이 될 수 있습니다. 각 상태별 중복처리 되지 않도록 하셔야 합니다.
결제요청시 checkretry이 'y'인 경우 응답으로 'SUCCESS'가 아니면 재요청합니다.

이 페이지에서 페이지 이동을 하시면 정상적인 동작이 되지 않습니다.
(javascript, http code 302 등을 사용한 페이지 이동 포함)

*/


/*
$_POST['userid'];	판매자 회원 아이디
$_POST['linkkey'];	연동 KEY
$_POST['linkval'];	연동 VALUE
$_POST['goodname'];	상품명
$_POST['price'];	결제요청 금액
$_POST['recvphone'];수신 휴대폰번호
$_POST['memo'];		메모
$_POST['reqaddr'];	주소요청 (1:요청, 0:요청안함)
$_POST['reqdate'];	결제요청 일시
$_POST['pay_memo'];	결제시 입력한 메모
$_POST['pay_addr'];	결제시 입력한 주소
$_POST['pay_date'];	결제승인 일시
$_POST['pay_type'];	결제수단 (1:신용카드, 2:휴대전화, 3:해외결제, 4:대면결제, 6:계좌이체, 7:가상계좌, 9:문화상품권)
$_POST['pay_state'];결제요청 상태 (4:결제완료, 8,16,31:요청취소, 9,64:승인취소, 10:결제대기)
$_POST['var1'];		임의 사용 변수 1
$_POST['var2'];		임의 사용 변수 2
$_POST['mul_no'];	결제요청번호
$_POST['payurl'];	결제페이지 주소
$_POST['csturl'];	매출전표URL
$_POST['card_name'];	신용카드명
$_POST['currency'];	통화 (krw:원화,usd:달러)
$_POST['vccode'];	국제전화 국가번호
$_POST['score'];	DM Score (currency가 usd이고 결제성공일 때 DM 점수
$_POST['vbank'];	은행명 (가상계좌 결제일 경우)
$_POST['vbankno'];	입금계좌번호 (가상계좌 결제일 경우)
$_POST['feedbacktype'];	feedback 구분 (0:REST API, 1:COMMON FEEDBACK)
*/

// 아래 정보를 payapp 판매자의 정보로 입력하세요.
// 판매자 사이트에 있는 연동KEY, 연동VALUE는 일반 사용자에게 노출이 되지 않도록 주의 하시기 바랍니다.
$payapp_userid	= 'blossome';	// payapp 판매자 아이디
$payapp_linkkey	= 'c8Fxyu8nW4blwOYG9igyde1DPJnCCRVaOgT+oqg6zaM=';				// payapp 연동key, 판매자 사이트 로그인 후 설정 메뉴에서 확인 가능
$payapp_linkval	= 'c8Fxyu8nW4blwOYG9igydW8KlwQhysAmEi8dRFy6pS0=';				// payapp 연동value, 판매자 사이트 로그인 후 설정 메뉴에서 확인 가능
                   // 결제요청한 금액

$check_userid	= $_POST['userid'] == $payapp_userid;
$check_key	= $_POST['linkkey'] == $payapp_linkkey;
$check_val	= $_POST['linkval'] == $payapp_linkval;

/*
userid, linkkey, linkval 값을 비교 확인 하고 동일한 경우에만 결제여부를 처리 하셔야 합니다.
*/
if($check_userid && $check_key && $check_val )
{
	switch( $_POST['pay_state'] )
	{
		case '1':
            // 결제요청
            break;
		case '4':
			// 결제완료
            // 결제요청한 결제건이 결제가 완료된 상태입니다.
            // 이곳에서 결제완료에 대한 처리 (상품배송/서비스 제공 등)를 하시면 됩니다.

 		define('HOST', "mysql.hostinger.kr");
			define('USER', "u414143907_andro");
			define('PW', "m2m3m5m2");
			define('DB', "u414143907_andro");

        $con= mysqli_connect(HOST,USER,PW,DB) or die("Unable to Connect");

		$userHidden= $_POST['var1'];				
		$userEmail= base64_decode($userHidden);

		$checker = 0;

		$sqlM = "SELECT userEmail from payRequest";
	    $readyM = mysqli_query($con,$sqlM);
		while($rowG=mysqli_fetch_array($readyM, MYSQL_ASSOC)){

			if($rowG['userEmail'] ==$userEmail){

		         $checker = 1;
		         $purchaseInfoJson = $rowG['purchaseInfo'];
			}
				
		}		


		$sqlMT = "SELECT Gender from logSet WHERE userEmail='$userEmail'";
	    $readyMT = mysqli_query($con,$sqlMT);
		while($rowGT=mysqli_fetch_array($readyMT, MYSQL_ASSOC)){

			$userGender = $rowGT['Gender'];
		}		


	  if($userGender =="boys"){

	    $sqlKey = "SELECT userKeyCalc from detailedInfoBoys1 where userEmail ='$userEmail'";
	    $readyKey = mysqli_query($con,$sqlKey);
	    $rowKey=mysqli_fetch_array($readyKey, MYSQL_ASSOC);
	    $keyTable=$rowKey['userKeyCalc'];

	  }else if($userGender =="girls"){

	    $sqlKey = "SELECT userKeyCalc from detailedInfoGirls1 where userEmail ='$userEmail'";
	    $readyKey = mysqli_query($con,$sqlKey);
	    $rowKey=mysqli_fetch_array($readyKey, MYSQL_ASSOC);
	    $keyTable=$rowKey['userKeyCalc'];

	  }

		 $keyOperator = $_POST['var2'];
		 date_default_timezone_set("Asia/Seoul");
	    
	    if($checker ==1){	    	

	        $purchaseList = json_decode($purchaseInfoJson,true);
			$purchaseCount = sizeof($purchaseList);			

            $Mover = array();
            $newEntry =array();
            $reTable = array();

            	for($i=0; $i<$purchaseCount; $i++){

            		$Mover['mul_no'] = $purchaseList[$i]['mul_no'];
            		      			        			
			        $reTable[] = $Mover;
            				             
				}

					$newEntry['mul_no'] = $_POST['mul_no'];
            	    $reTable[] = $newEntry;			      		

					$newValueJson = json_encode($reTable);

				  $sql ="UPDATE payRequest SET purchaseInfo=? WHERE userEmail=?";
				  $stmt = mysqli_prepare($con,$sql);
		  		  mysqli_stmt_bind_param($stmt,"ss",$newValueJson, $userEmail);
		 	 	  mysqli_stmt_execute($stmt);
		  		  $check0 = mysqli_stmt_affected_rows($stmt);

                               $RegisteredTime = date("Ymd");
				               $keyList = json_decode($keyTable,true);
				               $keyCount = sizeof($keyList);
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

				                $newEntry['keyValue'] ="+" . $keyOperator;
				                $newEntry['keyDesc'] = "Key Purchased";
				                $newEntry['keyDate'] = $RegisteredTime;
				                $newEntry['keyAccumulated'] = $keyList[$keyCount-1]['keyAccumulated'] + $keyOperator;
				                $userKey = $newEntry['keyAccumulated'];
				                $reTable[] = $newEntry;
				      

				                $keyJson = json_encode($reTable);
				             
		  		  if($userGender=="boys"){

						  	   

				                $sql ="UPDATE detailedInfoBoys1 SET userKeyCalc=?, userKey=? WHERE userEmail=?";
				                $stmt = mysqli_prepare($con,$sql);
				                mysqli_stmt_bind_param($stmt,"sss",$keyJson,$userKey,$userEmail);
				                mysqli_stmt_execute($stmt);
				                $check = mysqli_stmt_affected_rows($stmt);

				                 


		  		  }else if($userGender=="girls"){

		  		                $sql ="UPDATE detailedInfoGirls1 SET userKeyCalc=?, userKey=? WHERE userEmail=?";
				                $stmt = mysqli_prepare($con,$sql);
				                mysqli_stmt_bind_param($stmt,"sss",$keyJson,$userKey,$userEmail);
				                mysqli_stmt_execute($stmt);
				                $check = mysqli_stmt_affected_rows($stmt);


		  		  }
















	    }else if($checker==0){

	    		$sql0="INSERT INTO payRequest(purchaseInfo,userEmail) VALUES (?,?)";

				$stmt0 = mysqli_prepare($con,$sql0);

				
	            $newEntry =array();
	            $reTable = array();            

						$newEntry['mul_no'] = $_POST['mul_no'];
	            	    $reTable[] = $newEntry;	      
				
				$newValueJson = json_encode($reTable);
				mysqli_stmt_bind_param($stmt0,"ss",$newValueJson,$userEmail);
				mysqli_stmt_execute($stmt0);
				$check0 = mysqli_stmt_affected_rows($stmt0);


                               $RegisteredTime = date("Ymd");
				               $keyList = json_decode($keyTable,true);
				               $keyCount = sizeof($keyList);
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

				                $newEntry['keyValue'] ="+" . $keyOperator;
				                $newEntry['keyDesc'] = "Key Purchased";
				                $newEntry['keyDate'] = $RegisteredTime;
				                $newEntry['keyAccumulated'] = $keyList[$keyCount-1]['keyAccumulated'] + $keyOperator;
				                $userKey = $newEntry['keyAccumulated'];
				                $reTable[] = $newEntry;
				      

				                $keyJson = json_encode($reTable);
				            

		  		  if($userGender=="boys"){

						  	   

				                $sql ="UPDATE detailedInfoBoys1 SET userKeyCalc=?, userKey=? WHERE userEmail=?";
				                $stmt = mysqli_prepare($con,$sql);
				                mysqli_stmt_bind_param($stmt,"sss",$keyJson,$userKey,$userEmail);
				                mysqli_stmt_execute($stmt);
				                $check = mysqli_stmt_affected_rows($stmt);

				                 


		  		  }else if($userGender=="girls"){

		  		                $sql ="UPDATE detailedInfoGirls1 SET userKeyCalc=?, userKey=? WHERE userEmail=?";
				                $stmt = mysqli_prepare($con,$sql);
				                mysqli_stmt_bind_param($stmt,"sss",$keyJson,$userKey,$userEmail);
				                mysqli_stmt_execute($stmt);
				                $check = mysqli_stmt_affected_rows($stmt);


		  		  }



	    }

	    	echo 'SUCCESS';
		
			break;
		case '8':
		case '16':
		case '32':
			// 요청취소

			/*
			TODO : 이곳에서 결제요청 취소 처리를 합니다. (결제하지 않은 상태에서 취소)
			*/
			break;
		case '9':
		case '64':
			// 승인취소

			/*
			TODO : 이곳에서 결제승인 취소 처리를 합니다. (결제완료 상태에서 취소)

			ex) UPDATE payrequest SET pay_state='결제취소', pay_date='{$_POST['pay_date']}' WHERE orderno='$_POST['var1']' AND mul_no={$_POST['mul_no']};
			*/
			break;
		case '10':
			// 결제대기

			break;
		default:
			break;
	}



}
else{
	echo 'FAIL';

}


// 처리응답
// 결제요청시 checkretry이 'y'인 경우 응답이 'SUCCESS'가 아니면 재호출 합니다. (총 10회)

// 처리실패

exit;


?>
