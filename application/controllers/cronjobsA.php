<?php
class cronjobsA extends CI_Controller{
function __construct()
	{
		parent::__construct();
		$this->getCronA();
		
	}
 function getCronA(){
    sms("8382829593","cronJobA","niktecht","niktech@123","NIKTEC");
    echo "send";
}

}