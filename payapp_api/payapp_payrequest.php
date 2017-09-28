<?php
/*************************************************************************/
/* payapp                                                                */
/* copyright ⓒ 2012 UDID. all rights reserved.                           */
/*                                                                       */
/* oapi sample                                                           */
/* - version 005-001                                                     */
/* - payapp 서버로 결제요청 정보를 전달합니다.                           */
/*                                                                       */
/*************************************************************************/
if($_SERVER['REQUEST_METHOD']=='POST'){

$productChoice= $_POST['productChoice'];
$productPrice= $_POST['productPrice'];
$userCell = $_POST['userCell'];
$userHidden =  $_POST['userHidden'];
$keyOperator =  $_POST['keyOperator'];
$keyBoughtDialog ="on";
$keyBoughtDialogEncoded = base64_encode($keyBoughtDialog);
include("payapp_lib.php");
/*
TODO : 이곳에서 결제요청전 정보를 저장합니다.

ex) INSERT INTO payrequest (orderno,memberid,goodcode,goodname,goodprice) VALUES ('1234567890','kim','abcdefg','테스트상품',1000)
*/

// 결제요청 정보

$postdata = array(
	'cmd'	    	=> 'payrequest',			// 결제요청, 필수
	'userid'		=> 'blossome',	// 판매자 아이디, 필수

	'goodname'		=> $productChoice,			// 상품명, 필수
	'price'			=> $productPrice,					// 결제요청 금액 (1,000원 이상), 필수
	'recvphone'		=> $userCell,						// 수신자 휴대폰번호 (구매자), 필수
	'memo'			=> 'blossome 결제요청',		// 결제요청시 메모
	'reqaddr'		=> '0',						// 주소요청 여부
	'feedbackurl'	=> 'http://blossome.be/payapp_feedbackurl.php',		// 피드백 URL, feedbackurl은 외부에서 접근이 가능해야 합니다. payapp 서버에서 호출 하는 페이지 입니다.
	'var1'			=> $userHidden,			// 임의변수1
	'var2'			=> $keyOperator,				// 임의변수2
												// 임의변수는 고객사의 주문번호,상품코드 등 필요에 따라 자유롭게 이용이 가능합니다. feedbackurl로 값을 전달합니다.
	'smsuse'		=> 'n',						// 결제요청 SMS 발송여부 ('n'인 경우 SMS 발송 안함)
	'reqmode'		=> 'krw',					// 요청구분 (krw:원화결제, usd:US달러 결제, unionpay:중국은련카드 결제)
	'vccode'		=> '',						// 국제전화 국가번호 (currency가 usd일 경우 필수)
	'returnurl'		=> 'http://blossome.be/keyStore.php?userHidden='.$userHidden.'&keyBoughtDialog='.$keyBoughtDialogEncoded.'',	// 결제완료 이동 URL (결제완료 후 매출전표 페이지에서 "확인" 버튼 클릭시 이동)
    'openpaytype'   => 'phone,card',  // 결제수단 선택 (휴대전화:phone, 신용카드:card, 계좌이체:rbank, 가상계좌:vbank)
                            // 판매자 사이트 "설정" 메뉴의 "결제 설정"이 우선 합니다.
                            // 해외결제는 현재 신용카드 결제만 가능하며, 입력된 값은 무시됩니다.
    'checkretry'    => 'y'  // feedbackurl의 응답이 'SUCCESS'가 아닌 경우 feedbackurl 호출을 재시도 합니다. (총 10회)
);

$oResData = payapp_oapi_post($postdata);
if( $oResData['state']=='1' ){

	// 결제요청성공
	// 결제요청번호($oResData['mul_no'])를 고객사 DB에 저장해 놓으셔야 합니다.
	// 요청이 성공한 것으로 결제완료 상태가 아닙니다. 여기에서 상품배송/서비스 제공을 하면 안됩니다.
	// 결제완료는 feedbackurl에서만 확인이 가능합니다.
	/*
	$oResData['mul_no'];	// 결제요청번호
	$oResData['payurl'];	// 결제창 URL
	*/

	/*
	# TODO : 이곳에서 결제요청 성공 정보를 저장합니다.
	ex) UPDATE payrequest SET mul_no='{$oResData['mul_no']}' WHERE orderno='1234567890'
	*/

    
    # TODO : 아래처럼 'payurl'로 페이지를 이동 하시면 결제할 수 있는 페이지가 열립니다.
    echo <<<EOT
<script type="text/javascript">
location.href = '{$oResData['payurl']}';
</script>
EOT;
   

}else{
	// 결제요청실패
	// 오류메시지($oResData['errorMessage'])를 확인하고, 오류를 수정하셔야 합니다.
	/*
	$oResData['errorMessage'];	// 오류메시지
	$oResData['errno'];			// 오류코드
	*/

	/*
	TODO : 이곳에서 결제요청 실패 정보를 저장하거나, 이전 페이지로 이동해서 다시 시도할 수 있도록 해야 합니다.

	ex) UPDATE payrequest SET errorMessage='{$oResData['errorMessage']}' WHERE orderno='1234567890'
	*/
   
    echo <<<EOT
<script type="text/javascript">
alert('{$oResData['errorMessage']}');
window.close();
</script>
EOT;
    
}


}


?>
