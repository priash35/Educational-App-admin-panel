<?php
$orderid =$_POST['ORDER_ID'];
$email =$_POST['EMAIL'];
$mobile =$_POST['MOBILE_NO'];
$amount =$_POST['AMOUNT'];
 
 
 
//require_once('db_Connect.php');

header("Pragma: no-cache");
header("Cache-Control: no-cache");
header("Expires: 0");
// following files need to be included
require_once("./lib/config_paytm.php");
require_once("./lib/encdec_paytm.php");
//$checkSum = "";

// below code snippet is mandatory, so that no one can use your checksumgeneration url for other purpose .
$findme   = 'REFUND';
$findmepipe = '|';
$cust= 'CUST'.mt_rand(100000, 999999);
$paramList = array();

$paramList["MID"] = 'Ashish59206706321863';
$paramList["ORDER_ID"] = $orderid;
$paramList["CUST_ID"] = $_POST['CUST_ID'];
$paramList["INDUSTRY_TYPE_ID"] = 'Retail109';
$paramList["CHANNEL_ID"] = 'WAP';
$paramList["TXN_AMOUNT"] = $amount;
$paramList["WEBSITE"] = 'APPPROD';
//$paramList["MOBILE_NO"] = $mobile;
//$paramList["EMAIL"] = $email; // customer email id
//$paramList["CALLBACK_URL"] = 'https://pguat.paytm.com/paytmchecksum/paytmCallback.jsp';
$paramList["CALLBACK_URL"] = $_POST['CALLBACK_URL'];

/*foreach($_POST as $key=>$value)
{  
  $pos = strpos($value, $findme);
  $pospipe = strpos($value, $findmepipe);
  if ($pos === false || $pospipe === false) 
    {
        $paramList[$key] = $value;
    }
}*/


  
//Here checksum string will return by getChecksumFromArray() function.
$checkSum = getChecksumFromArray($paramList,PAYTM_MERCHANT_KEY);
//print_r($_POST);
//added by priya
//$checkSum = getChecksumFromArray($paramList,PAYTM_MERCHANT_KEY);
//$paramList["CHECKSUMHASH"] = $checkSum;
 
//echo json_encode($paramList, JSON_UNESCAPED_SLASHES);

 echo json_encode(array("CHECKSUMHASH" => $checkSum,"ORDER_ID" => $_POST["ORDER_ID"], "payt_STATUS" => "1"));
  //Sample response return to SDK
 
//  {"CHECKSUMHASH":"GhAJV057opOCD3KJuVWesQ9pUxMtyUGLPAiIRtkEQXBeSws2hYvxaj7jRn33rTYGRLx2TosFkgReyCslu4OUj\/A85AvNC6E4wUP+CZnrBGM=","ORDER_ID":"asgasfgasfsdfhl7","payt_STATUS":"1"} 
 
?>
