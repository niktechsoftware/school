<?php
class Conn extends CI_Model{
	function db(){
		
$con=mysqli_connect("208.91.198.93", "schoodhe_school", "Rahul!123singh!@", "schoodhe_website");
if (mysqli_connect_errno()){
return "failed to connect to mysql:".mysqli_connect_error();}
else{
	return "database connect";
}
	}
} ?>