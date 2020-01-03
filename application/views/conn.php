<?php
$conn=mysqli_connect("208.91.198.93", "schoodhe_school", "Rahul!123singh!@");
$db= mysqli_select_db($conn,"schoodhe_website");
if (mysqli_connect_errno()){
return "failed to connect to mysql:".mysqli_connect_error();}
else{
	return "database connect";
}
?>