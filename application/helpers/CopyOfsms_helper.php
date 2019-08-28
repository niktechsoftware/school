
<?php
function sms($number,$msg)
{
	$user = "";
	$pass = "";
	$from = "";
	$txt = substr($txt, 0, 320);

	$url = "http://zapsms.co.in/vendorsms/pushsms.aspx?user=ramdoot&password=ghazipur@123&msisdn=".$number."&sid=RAMDOT&msg=".str_replace(" ", "%20", $msg)."&fl=0&gwid=2";

	$url;
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $url);

	curl_setopt($ch, CURLOPT_HEADER, 1);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);

	$response = curl_exec($ch);
	curl_close($ch);
	//header("location:thanks-exe.php?fname='$fname'");
}
?>

