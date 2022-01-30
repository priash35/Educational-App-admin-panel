<?php
$key =$_POST['key'];
$paramList = array();

if ($key = "161070"){

	$paramList = array();
	/*$paramList["MID"] = 'Ashish20956425876110';
	$paramList["INDUSTRY_TYPE_ID"] = 'Retail';
	$paramList["CHANNEL_ID"] = 'WAP';
	$paramList["WEBSITE"] = 'APPSTAGING';
	//$paramList["CALLBACK_URL"] = 'https://securegw-stage.paytm.in/theia/processTransaction';
	$paramList["CALLBACK_URL"] = 'https://securegw.paytm.in/theia/paytmCallback?ORDER_ID=';*/
	$paramList["MID"] = 'Ashish59206706321863';
	$paramList["INDUSTRY_TYPE_ID"] = 'Retail109';
	$paramList["CHANNEL_ID"] = 'WAP';
	$paramList["WEBSITE"] = 'APPPROD';
	//$paramList["CALLBACK_URL"] = 'https://securegw-stage.paytm.in/theia/processTransaction';
	$paramList["CALLBACK_URL"] = 'https://securegw.paytm.in/theia/paytmCallback?ORDER_ID=';
}	

 echo json_encode($paramList);
  //Sample response return to SDK
 
//  {"CHECKSUMHASH":"GhAJV057opOCD3KJuVWesQ9pUxMtyUGLPAiIRtkEQXBeSws2hYvxaj7jRn33rTYGRLx2TosFkgReyCslu4OUj\/A85AvNC6E4wUP+CZnrBGM=","ORDER_ID":"asgasfgasfsdfhl7","payt_STATUS":"1"} 
 
?>
