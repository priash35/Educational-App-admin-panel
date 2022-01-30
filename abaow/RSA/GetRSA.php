<?php
$url = "https://secure.ccavenue.com/transaction/getRSAKey";
//$url = "https://test.ccavenue.com/transaction/getRSAKey";
$fields = array(
        //'access_code'=>"AVCZ73EI22BP12ZCPB",
        'access_code'=>"AVLR77FE96AW03RLWA",//richnhappy
        //'access_code'=>"AVEQ74EL83AZ47QEZA",
        'order_id'=>$_POST['order_id']
);

$postvars='';
$sep='';
foreach($fields as $key=>$value)
{
        $postvars.= $sep.urlencode($key).'='.urlencode($value);
        $sep='&';
}

$ch = curl_init();

curl_setopt($ch,CURLOPT_URL,$url);
curl_setopt($ch,CURLOPT_POST,count($fields));
curl_setopt($ch, CURLOPT_CAINFO, $_SERVER['DOCUMENT_ROOT'].'/RSA/cacert.pem');
curl_setopt($ch,CURLOPT_POSTFIELDS,$postvars);
curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);

curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
$result = curl_exec($ch);

echo $result;
?>
