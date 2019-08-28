<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Paytm extends CI_Controller{
    
	function __construct(){
		parent::__construct();
		include APPPATH . 'third_party/PaytmKit/lib/config_paytm.php';
		include APPPATH . 'third_party/PaytmKit/lib/encdec_paytm.php';
	}

	function pgRedirect(){
		header("Pragma: no-cache");
		header("Cache-Control: no-cache");
		header("Expires: 0");
		$segment7 = $this->uri->segment(5);
		$checkSum = "";
		$paramList = array();
		$ORDER_ID = $this->uri->segment(3);
		$CUST_ID = $this->uri->segment(4);
		$INDUSTRY_TYPE_ID = "PrivateEducation";
		$CHANNEL_ID = "WEB";
		$TXN_AMOUNT = $this->uri->segment(6);
		$paramList["MID"] = PAYTM_MERCHANT_MID;
		$paramList["ORDER_ID"] = $ORDER_ID;
		$paramList["CUST_ID"] = $CUST_ID;
		$paramList["INDUSTRY_TYPE_ID"] = $INDUSTRY_TYPE_ID;
		$paramList["CHANNEL_ID"] = $CHANNEL_ID;
		$paramList["TXN_AMOUNT"] = $TXN_AMOUNT;
		$paramList["WEBSITE"] = PAYTM_MERCHANT_WEBSITE;
		$paramList["CALLBACK_URL"] = "https://schoolerp-niktech.in/school/index.php/paytm/pgResponse/$ORDER_ID/$CUST_ID/$segment7/$TXN_AMOUNT";
		$checkSum = getChecksumFromArray($paramList,PAYTM_MERCHANT_KEY);
		$data["PAYTM_TXN_URL"] = PAYTM_TXN_URL;
		$data["paramList"] = $paramList;
		$data["checkSum"] = $checkSum;
		$this->load->view("paytm/waitredirect", $data);
	}
	
	
	function pgResponse(){
	    
        header("Pragma: no-cache");
        header("Cache-Control: no-cache");
        header("Expires: 0");

        $paytmChecksum = "";
        $paramList = array();
        $isValidChecksum = "FALSE";

        $paramList = $_POST;
        $paytmChecksum = isset($_POST["CHECKSUMHASH"]) ? $_POST["CHECKSUMHASH"] : ""; //Sent by Paytm pg

        //Verify all parameters received from Paytm pg to your application. Like MID received from paytm pg is same as your application�s MID, TXN_AMOUNT and ORDER_ID are same as what was sent by you to Paytm PG for initiating transaction etc.
        $isValidChecksum = verifychecksum_e($paramList, PAYTM_MERCHANT_KEY, $paytmChecksum); //will return TRUE or FALSE string.
        
        $insert["order_id"] = $_POST["ORDERID"];
        $insert["txn_id"]   = $_POST["TXNID"];
        $insert["txn_amount"] = $_POST["TXNAMOUNT"];
        $insert["status"] = $_POST["STATUS"];
        $insert["txn_date_time"] = isset($_POST["TXNDATE"])?$_POST["TXNDATE"]:date("Y-m-d H:i:s");
        $insert["product"] = "shopping";
        
        $segment3 = $this->uri->segment(3);
        $segment4 = $this->uri->segment(4);
        $segment5 = $this->uri->segment(5);
        
        $data['POST'] = $_POST;
        $data['successURI'] = base_url()."invoiceController/onlinefeesubmit/$segment3/$segment4/$segment5";
        $data['failURI'] = base_url()."invoiceController/onlinefee/$segment3/$segment4/$segment5";
       // $data['studentDetail'] = $studentDetail;
        
        if($isValidChecksum == "TRUE"):
            $this->load->view("paytm/paytmResponse", $data);
        else:
            echo "<strong>Checksum mismatched.</strong>";
        endif;
    }

	public function feeStatus(){

        $data['pageTitle'] = 'Fee Invoice';
		$data['smallTitle'] = 'Fee Invoice';
		$data['mainPage'] = 'invoice';
		$data['subPage'] = 'Print Fee';	
		$data['title'] = 'Print Fee Invoice';
		$data['headerCss'] = 'headerCss/configureClassCss';
		$data['footerJs'] = 'footerJs/configureClassJs';
		$data['mainContent'] = 'feeInvoice';
		$this->load->view("includes/mainContent", $data);
     
        
    }		
}


	