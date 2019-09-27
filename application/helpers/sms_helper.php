<?php
//3a0f49364a8394af435cc495d8d1d24e  9415280879,  sharad 9450725007,
function sms($number,$msg,$user,$pass,$senderid)
{  
	//$pass=1;
$url="http://zapsms.co.in/vendorsms/pushsms.aspx?user=".$user."&password=".$pass."&msisdn=".$number."&sid=".$senderid."&msg=".urlencode($msg)."&fl=0&gwid=2";
	$object1 =array();
//$url="http://bulksms.gfinch.in/api/sendmsg.php?user=ramdoot&pass=ghazipur@123&sender=RAMDOT&phone=".$number."&text=".urlencode($msg)."&priority=ndnd&stype=normal";
	//$url = "http://mysms.sms7.biz/rest/services/sendSMS/sendGroupSms?AUTH_KEY=".$authkey."&message=".urlencode($message)."&senderId=".$senderID."&routeId=1&mobileNos=".$number."&smsContentType=english";
	$ch = curl_init();
	curl_setopt($ch,CURLOPT_URL,$url);
	curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
	$output=curl_exec($ch);
	$rt=json_decode($output,true);
	?> <pre> <?php
//print_r(json_decode($output));?></pre><?php 

$numn = ((strlen($number)+1)/11);
for($i=0; $i<$numn;$i++){
	$dat =  $rt['MessageData'][$i];
	$sentNumber =  $dat['Number'];
	$gt =  $dat['MessageParts'][0];
	 $mid = $gt['MsgId'];
	 $textsms  = $gt['Text'];
	 $date1 = date("Y-m-d H:s:i");
	$status  =checkDeliver($user,$pass,$mid);
	 //echo $sentNumber."-".$mid."-".$date1;
	 $datai= array(
	 	'sent_number'=>$sentNumber,
	 	'msg_id'=>$mid,
	 	'status'=>$status,
	 	'sms'=>$textsms,
	 	'date'=>$date1
	 );
	$object1[$i]=$datai;
	}
	curl_close($ch);
return $object1;
}

function smshindi($number,$msg,$user,$pass,$senderid)
{
	$url="http://zapsms.co.in/vendorsms/pushsms.aspx?user=".$user."&password=".$pass."&msisdn=".$number."&sid=".$senderid."&msg=".urlencode($msg)."&fl=0&dc=8&gwid=2";

	//$url="http://bulksms.gfinch.in/api/sendmsg.php?user=ramdoot&pass=ghazipur@123&sender=RAMDOT&phone=".$number."&text=".urlencode($msg)."&priority=ndnd&stype=normal";
	//$url = "http://mysms.sms7.biz/rest/services/sendSMS/sendGroupSms?AUTH_KEY=".$authkey."&message=".urlencode($message)."&senderId=".$senderID."&routeId=1&mobileNos=".$number."&smsContentType=english";
	$ch = curl_init();
	curl_setopt($ch,CURLOPT_URL,$url);
	curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
	$output=curl_exec($ch);
	curl_close($ch);
}

function checkBalSms($user,$pass)
{ 
$url = "http://zapsms.co.in/vendorsms/CheckBalance.aspx?user=".$user."&password=".$pass;

$ch = curl_init();
curl_setopt($ch,CURLOPT_URL,$url);
curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
$Textt=curl_exec($ch);
curl_close($ch);
return $Textt;
}

function checkDeliver($user,$pass,$messageid)
{ 
$url = "http://zapsms.co.in/vendorsms/checkdelivery.aspx?user=".$user."&password=".$pass."&messageid=".$messageid;

$ch = curl_init();
curl_setopt($ch,CURLOPT_URL,$url);
curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
$Textt=curl_exec($ch);
curl_close($ch);
return $Textt;
}




function getAge($dob) {
	$today = date("Y-m-d");
	$diff = date_diff(date_create($dob), date_create($today));
	return $diff->format('%yYears, %mMonths, %dDays');
}

function highlightText($text, $keywords) {
	$color = "yellow";
	$background = "red";
	foreach($keywords as $keyword) {
		$highlightWord = "<strong style='background:".$background.";color:".$color."'>" . $keyword . "</strong>";
		$text = preg_replace ("/" . trim($keyword) . "/", $highlightWord, $text);
	}
	$keywords = array("Coding 4 Developers","Coding for developers");
	echo highlightText($text, $keywords);
	return $text;
}


