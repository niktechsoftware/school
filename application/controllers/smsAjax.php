
<?php
class SmsAjax extends CI_Controller{
	function __construct()
	{
		parent::__construct();
		$this->is_login();
		include APPPATH . 'third_party/PaytmKit/lib/config_paytm1.php';
		include APPPATH . 'third_party/PaytmKit/lib/encdec_paytm.php';
		$this->load->model("smsmodel");
		$this->load->model("employeemodel");
		}
		
		function is_login(){
			$is_login = $this->session->userdata('is_login');
			$is_lock = $this->session->userdata('is_lock');
			$logtype = $this->session->userdata('login_type');
			if(($logtype == 1)){
			}else{

			if($logtype != "admin"){
				//echo $is_login;
				redirect("index.php/homeController/index");
			}
			elseif(!$is_login){
				//echo $is_login;
				redirect("index.php/homeController/index");
			}
			elseif(!$is_lock){
				redirect("index.php/homeController/lockPage");
			}
			}
		}
	
	function smsSetting(){
		$msg = $this->input->post("message");
		$this->db->where("school_code",$this->session->userdata("school_code"));
		$val = $this->db->get("sms")->row();
		
		$val1 = $val->$msg;
		
		if($val1){
			$data = array(
				"$msg" => 0
			);
			?>
				<script>
					$("#<?php echo $msg;?>").removeClass("btn btn-sm btn-light-green").addClass("btn btn-sm btn-light-red");
					$("#<?php echo $msg;?>").removeClass("fa fa-check").addClass("fa fa-times fa fa-white");
					$("#<?php echo $msg;?>").html(" NO");
				</script>
			<?php
		}else{
			$data = array(
				"$msg" => 1
			);
			?>
				<script>
					$("#<?php echo $msg;?>").removeClass("btn btn-sm btn-light-red").addClass("btn btn-sm btn-light-green");
					$("#<?php echo $msg;?>").removeClass("fa fa-times fa fa-white").addClass("fa fa-check");
					$("#<?php echo $msg;?>").html(" YES");
				</script>		
			<?php
		}
		$this->db->where("school_code",$this->session->userdata("school_code"));
		$this->db->update("sms",$data);
	}
	
	function sendNotice(){
    	$count=0;
		$smsc =0;
		$smscount=0;
		$totsmssent = $this->input->post("totsmsv");
		$totbal = $this->input->post("totbal");
	
		if($totbal > $totsmssent){

		$school=$this->session->userdata("school_code");
		$sender = $this->smsmodel->getsmssender($this->session->userdata("school_code"));
		$sende_Detail =$sender->row();
// 		print_r($sende_Detail);
		$msg =	$this->input->post("meg");
	
		$fmobile1 = $this->input->post("m_number");
		$str_arr=explode(",",$fmobile1);
		$totnumb =  sizeof($str_arr);
		$max_id = $this->db->query("SELECT MAX(id) as maxid FROM sent_sms_master")->row();
		$master_id=$max_id->maxid+1;
		
		$fmobile = $this->smsmodel->getMobile($str_arr,$msg,$master_id,1);
	
				if($this->input->post("language")==1){
				  $getv=  mysms($sende_Detail->auth_key,$msg,$sende_Detail->sender_id,$fmobile);
				  
				}else{
				  $getv= mysmsHindi($sende_Detail->auth_key,$msg,$sende_Detail->sender_id,$fmobile);
				     }	
		 $this->smsmodel->sentmasterRecord($msg,$totnumb,$master_id,$getv);
			

			redirect("index.php/login/mobileNotice/Notice");
		}
		else{ 
	     redirect("index.php/login/mobileNotice/Notice/$count/9");
	}
}

	function sendallParent(){
		$smscount=0;
		$count=0;
		$smsc =0;
		$totsmssent = $this->input->post("totsmsv");
		$totbal = $this->input->post("totbal");
	
		if($totbal > $totsmssent){
		$sender = $this->smsmodel->getsmssender($this->session->userdata("school_code"));
		if($sender->num_rows()>0){
		$sende_Detail =$sender->row();
		$msg =$this->input->post("meg");
		
		$max_id = $this->db->query("SELECT MAX(id) as maxid FROM sent_sms_master")->row();
		$master_id=$max_id->maxid+1;
		$query = $this->smsmodel->getAllFatherNumber($this->session->userdata("school_code"));
		$isSMS = $this->smsmodel->getsmsseting($this->session->userdata("school_code"));
		$fmobile=$this->session->userdata("mobile_number");
		if($isSMS->parent_message)
		{
		if($query->num_rows() > 0)

		{   $totnumb=$query->num_rows();
		    $i=1;	$fmobile = $this->smsmodel->getMobile($query->result(),$msg,$master_id,2);
				if($this->input->post("language")==1){
				  $getv=  mysms($sende_Detail->auth_key,$msg,$sende_Detail->sender_id,$fmobile);
				  

				}else{
				  $getv= mysmsHindi($sende_Detail->auth_key,$msg,$sende_Detail->sender_id,$fmobile);
				     }	
		        $this->smsmodel->sentmasterRecord($msg,$totnumb,$master_id,$getv);

			}
			redirect("index.php/login/mobileNotice/Parent%20Message/$count");
		}
		
		else{
			$data['subPage'] = 'Mobile Message And Notice';
			$data['title'] = 'Mobile Message And Notice';
			$data['headerCss'] = 'headerCss/noticeCss';
			$data['footerJs'] = 'footerJs/noticeJs';
			$data['mainContent'] = 'norecordFound';
			$this->load->view("includes/mainContent", $data);
		} 
	}else{
	    	redirect("index.php/login/mobileNotice/Parent%20Message/$count/7");
	   // echo "this message already sent for resend  plz try after some time ";
	}	}else{ 
	     redirect("index.php/login/mobileNotice/Parent%20Message/$count/9");
	}
	}
	
	
	function sendAnnuncement(){
		$smscount=0;
		$count=0;
		$smsc =0;
		$totsmssent = $this->input->post("totsmsv");
		$totbal = $this->input->post("totbal");
	
		if($totbal > $totsmssent){
		$sender = $this->smsmodel->getsmssender($this->session->userdata("school_code"));
		if($sender){
		$sende_Detail =$sender->row();
		$msg =$this->input->post("meg");
		
		$totsmssent = $this->input->post("totsmsv");
		$max_id = $this->db->query("SELECT MAX(id) as maxid FROM sent_sms_master")->row();
		$master_id=$max_id->maxid+1;
	
		$employee = $this->employeemodel->employeeList($this->session->userdata("school_code"));
	
		$isSMS = $this->smsmodel->getsmsseting($this->session->userdata("school_code"));
		
		if($isSMS->announcement)
		{ 
	
		    $totnumb=$employee->num_rows();
		    $i=1;	$fmobile = $this->smsmodel->getMobile($employee->result(),$msg,$master_id,2);
	
				if($this->input->post("language")==1){

				  $getv=  mysms($sende_Detail->auth_key,$msg,$sende_Detail->sender_id,$fmobile);
				  
				}else{
				  $getv= mysmsHindi($sende_Detail->auth_key,$msg,$sende_Detail->sender_id,$fmobile);
				     }	
		        $this->smsmodel->sentmasterRecord($msg,$totnumb,$master_id,$getv);
			
			redirect("index.php/login/mobileNotice/Announcement/$count/7");
		}
		else{
		    	$data['pageTitle'] = 'SMS Panel';
		$data['smallTitle'] = 'Mobile SMS error in table';
		$data['mainPage'] = 'SMS Panel Area';
			$data['subPage'] = 'Mobile Message And Notice';
			$data['title'] = 'Mobile Message And Notice';
			$data['headerCss'] = 'headerCss/noticeCss';
			$data['footerJs'] = 'footerJs/noticeJs';
			$data['mainContent'] = 'error';
			$this->load->view("includes/mainContent", $data);
		}
	
		}
	else{
	    	$data['subPage'] = 'Mobile Message And Notice';
			$data['title'] = 'Sender ID Not Approved Error Please Contact Administrator';
			$data['headerCss'] = 'headerCss/noticeCss';
			$data['footerJs'] = 'footerJs/noticeJs';
			$data['mainContent'] = 'error';
			$this->load->view("includes/mainContent", $data);
	}
	
		}else{ 
	     redirect("index.php/login/mobileNotice/Announcement/$count/9");
	}	    
	}	
	
	function sendGreeting(){
		$smscount=0;
		$count=0;
		$smsc =0;
		$totsmssent = $this->input->post("totsmsv");
		$totbal = $this->input->post("totbal");
	
		if($totbal > $totsmssent){
		$sender = $this->smsmodel->getsmssender($this->session->userdata("school_code"));
		if($sender){
		$sende_Detail =$sender->row();
		
		$msg =$this->input->post("meg");
	
		$totsmssent = $this->input->post("totsmsv");
		$max_id = $this->db->query("SELECT MAX(id) as maxid FROM sent_sms_master")->row();
		$master_id=$max_id->maxid+1;
		$employee = $this->employeemodel->employeeList($this->session->userdata("school_code"));
		$query = $this->smsmodel->getAllFatherNumber($this->session->userdata("school_code"));
		$isSMS = $this->smsmodel->getsmsseting($this->session->userdata("school_code"));
    	$fmobile1=$this->session->userdata("mobile_number");
		if($isSMS->greeting)
		{  
			
		    $totnumb=$employee->num_rows();
		    $i=1;	$fmobile = $this->smsmodel->getMobile($employee->result(),$msg,$master_id,2);
	
				if($this->input->post("language")==1){

				  $getv=  mysms($sende_Detail->auth_key,$msg,$sende_Detail->sender_id,$fmobile);
				  
				}else{
				  $getv= mysmsHindi($sende_Detail->auth_key,$msg,$sende_Detail->sender_id,$fmobile);
				     }	
		        $this->smsmodel->sentmasterRecord($msg,$totnumb,$master_id,$getv);
				$master_id =$master_id+1;
		
			 $totnumb=$query->num_rows();
		    $i=1;	$fmobile = $this->smsmodel->getMobile($query->result(),$msg,$master_id,2);
	
				if($this->input->post("language")==1){
				  $getv=  mysms($sende_Detail->auth_key,$msg,$sende_Detail->sender_id,$fmobile);
				  
				}else{
				  $getv= mysmsHindi($sende_Detail->auth_key,$msg,$sende_Detail->sender_id,$fmobile);
				     }	
		        $this->smsmodel->sentmasterRecord($msg,$totnumb,$master_id,$getv);

		redirect("index.php/login/mobileNotice/Greeting/$count");
			}	else{
			    	$data['pageTitle'] = 'SMS Panel';
					$data['smallTitle'] = 'Mobile SMS';
					$data['mainPage'] = 'SMS Panel Area';
				$data['subPage'] = 'Mobile Message And Notice';
				$data['title'] = 'Mobile Message And Notice';
				$data['headerCss'] = 'headerCss/noticeCss';
				$data['footerJs'] = 'footerJs/noticeJs';
				$data['mainContent'] = 'norecordFound';
				$this->load->view("includes/mainContent", $data);
			}
			//echo $fmobile;
		
	
		}
		redirect("index.php/login/mobileNotice/Greeting/$count");
		}else{ 
	     redirect("index.php/login/mobileNotice/Greeting/$count/9");
	}	  
	}
	function classwise(){	
		$smscount=0;
		$count=0;
		$smsc =0;
		$fmobile=0;
		$totsmssent = $this->input->post("totsmsv");
		$totbal = $this->input->post("totbal");
	
		if($totbal > $totsmssent){
		$class_id = $this->input->post("class");
	//	$section_id = $this->input->post("section");
	
		$sender = $this->smsmodel->getsmssender($this->session->userdata("school_code"));
		if($sender->num_rows()>0){
		$sende_Detail =$sender->row();
		$msg =$this->input->post("meg");
		
		$totsmssent = $this->input->post("totsmsv");
		$max_id = $this->db->query("SELECT MAX(id) as maxid FROM sent_sms_master")->row();
		$master_id=$max_id->maxid+1;
	
		$isSMS = $this->smsmodel->getsmsseting($this->session->userdata("school_code"));
		$fmobile=$this->session->userdata("mobile_number");
		if($isSMS->parent_message)
		{
			$query = $this->smsmodel->getClassFatherNumber($this->session->userdata("school_code"),$class_id);
		if($query->num_rows() > 0)
		{   
		 $totnumb=$query->num_rows();
		    $i=1;	$fmobile = $this->smsmodel->getMobile($query->result(),$msg,$master_id,2);
	
				if($this->input->post("language")==1){

				  $getv=  mysms($sende_Detail->auth_key,$msg,$sende_Detail->sender_id,$fmobile);
				  
				}else{
				  $getv= mysmsHindi($sende_Detail->auth_key,$msg,$sende_Detail->sender_id,$fmobile);
				     }	
		        $this->smsmodel->sentmasterRecord($msg,$totnumb,$master_id,$getv);
		}
			redirect("index.php/login/mobileNotice/classwise/$totsmssent");
		
		}
		else{	$data['pageTitle'] = 'SMS Panel';
		$data['smallTitle'] = 'Mobile SMS';
		$data['mainPage'] = 'SMS Panel Area';
			$data['subPage'] = 'Mobile Message And Notice';
			$data['title'] = 'Mobile Message And Notice';
			$data['headerCss'] = 'headerCss/noticeCss';
			$data['footerJs'] = 'footerJs/noticeJs';
			$data['mainContent'] = 'norecordFound';
			$this->load->view("includes/mainContent", $data);
		
		}
	redirect("index.php/login/mobileNotice/classwise/$count");
	
	
		}else
		{	$data['pageTitle'] = 'SMS Panel';
		$data['smallTitle'] = 'Mobile SMS';
		$data['mainPage'] = 'SMS Panel Area';
			$data['subPage'] = 'Mobile Message And Notice';
			$data['title'] = 'Mobile Message And Notice';
			$data['headerCss'] = 'headerCss/noticeCss';
			$data['footerJs'] = 'footerJs/noticeJs';
			$data['mainContent'] = 'Error';
			$this->load->view("includes/mainContent", $data);
		}
		}else{ 
	     redirect("index.php/login/mobileNotice/classwise/$count/9");
	}	  
	}
	
	function transportwise(){	
		$smscount=0;
		$count=0;
		$smsc =0;
		$vehicle_id = $this->input->post("vehicle");
		$sender = $this->smsmodel->getsmssender($this->session->userdata("school_code"));
		if($sender->num_rows()>0){
		$sende_Detail =$sender->row();
		$msg =	$this->input->post("meg");
		
		$totsmssent = $this->input->post("totsmsv");
		$max_id = $this->db->query("SELECT MAX(id) as maxid FROM sent_sms_master")->row();
		$master_id=$max_id->maxid+1;
	
		if($isSMS->parent_message)
		{
		  $query = $this->smsmodel->getTransportFatherNumber($vehicle_id);
	    if($query->num_rows() > 0)
	     	{   
	     	
            $totnumb=$query->num_rows();
		    $i=1;	$fmobile = $this->smsmodel->getMobile($query->result(),$msg,$master_id,2);
	
				if($this->input->post("language")==1){
				  $getv=  mysms($sende_Detail->auth_key,$msg,$sende_Detail->sender_id,$fmobile);
				  
				}else{
				  $getv= mysmsHindi($sende_Detail->auth_key,$msg,$sende_Detail->sender_id,$fmobile);
				     }	
		        $this->smsmodel->sentmasterRecord($msg,$totnumb,$master_id,$getv);
		}
		redirect("index.php/login/mobileNotice/transportwise/$count");
	    }
		else{	
			$data['pageTitle'] = 'SMS Panel';
			$data['smallTitle'] = 'Mobile SMS';
			$data['mainPage'] = 'SMS Panel Area';
			$data['subPage'] = 'Mobile Message And Notice';
			$data['title'] = 'Mobile Message And Notice';
			$data['headerCss'] = 'headerCss/noticeCss';
			$data['footerJs'] = 'footerJs/noticeJs';
			$data['mainContent'] = 'norecordFound';
			$this->load->view("includes/mainContent", $data);
		
		}
	
	redirect("index.php/login/mobileNotice/transportwise/$count");
	
		}else
		{	
			$data['pageTitle'] = 'SMS Panel';
			$data['smallTitle'] = 'Mobile SMS';
			$data['mainPage'] = 'SMS Panel Area';
			$data['subPage'] = 'Mobile Message And Notice';
			$data['title'] = 'Mobile Message And Notice';
			$data['headerCss'] = 'headerCss/noticeCss';
			$data['footerJs'] = 'footerJs/noticeJs';
			$data['mainContent'] = 'Error';
			$this->load->view("includes/mainContent", $data);
		}
	   
	}
	
	function smsPanel(){
		$sender = $this->smsmodel->getsmssender($this->session->userdata("school_code"))->row();
		
		$data['sender_Detail'] =$sender;
		$data['cbs']=checkBalSms($sender->uname,$sender->password);
		$data['pageTitle'] = 'SMS Panel';
		$data['smallTitle'] = 'Mobile SMS';
		$data['mainPage'] = 'SMS Panel Area';
		$data['subPage'] = 'SMS Panel';
		$data['title'] = 'SMS Panel Area ';
		$data['headerCss'] = 'headerCss/noticeCss';
		$data['footerJs'] = 'footerJs/noticeJs';
		$data['mainContent'] = 'smsPanel';
		$this->load->view("includes/mainContent", $data);
	}	
	function updatesms_status(){
				 $msg=	$this->input->post("msgid");
				 
				$school_code =$this->session->userdata("school_code");
				$this->db->where("school_code",$school_code);
			  $msgdata=$this->db->get("sms_setting");
			  	if($msgdata->num_rows()>0){
						$sender_detail=$msgdata->row();
						$username=$sender_detail->uname;
						$password=$sender_detail->password;
						
						$dt=checkDeliver($username,$password,$msg);
						echo $dt;
				}


	}
	function viewsmsdetail(){
			$data['pageTitle'] = 'View SMS Report';
		$data['smallTitle'] = 'View SMS Report';
		$data['mainPage'] = 'View SMS Report';
		$data['subPage'] = 'View SMS Report';
		$data['title'] = 'View SMS Report ';
		$data['headerCss'] = 'headerCss/smsCss';
		$data['footerJs'] = 'footerJs/smsJs';
		$data['mainContent'] = 'viewsmsdetail';
		$this->load->view("includes/mainContent", $data);
	}	
	function wrongsmsdetail(){
		$data['pageTitle'] = 'View SMS Report';
		$data['smallTitle'] = 'View SMS Report';
		$data['mainPage'] = 'View SMS Report';
		$data['subPage'] = 'View SMS Report';
		$data['title'] = 'View SMS Report ';
		$data['headerCss'] = 'headerCss/smsCss';
		$data['footerJs'] = 'footerJs/smsJs';
		$data['mainContent'] = 'wrongsmsdetail';
		$this->load->view("includes/mainContent", $data);
}
function resendsms(){
    
    	$count=0;
		$smsc =0;
		$smscount=0;
// 		$totsmssent = $this->input->post("totsmsv");
// 		$totbal = $this->input->post("totbal");
	
// 		if($totbal > $totsmssent){

		$school=$this->session->userdata("school_code");
		$sender = $this->smsmodel->getsmssender($this->session->userdata("school_code"));
		$sende_Detail =$sender->row();
// 		print_r($sende_Detail);
		$msg =	$this->input->post("meg");
	
		$fmobile1 = $this->input->post("m_number");
		$str_arr=explode(",",$fmobile1);
		$totnumb =  sizeof($str_arr);
		$max_id = $this->db->query("SELECT MAX(id) as maxid FROM sent_sms_master")->row();
		$master_id=$max_id->maxid+1;
		
		$fmobile = $this->smsmodel->getMobile($str_arr,$msg,$master_id,1);
	
				if($this->input->post("language")==1){
				  $getv=  mysms($sende_Detail->auth_key,$msg,$sende_Detail->sender_id,$fmobile);
				  
				}else{
				  $getv= mysmsHindi($sende_Detail->auth_key,$msg,$sende_Detail->sender_id,$fmobile);
				     }	
		$dt= $this->smsmodel->sentmasterRecord($msg,$totnumb,$master_id,$getv);
		if($dt){
		   echo "Sent"; 
		}	

}
  function buysms(){
    	header("Pragma: no-cache");
		header("Cache-Control: no-cache");
		header("Expires: 0");
		
		$checkSum = "";
		$paramList = array();

       $smsid= $this->input->post("vehicle");
       $this->db->where("id",$smsid);
       $smsrow=$this->db->get("sms_plan");
       
     if($smsrow->num_rows()>0){
         $school_code=$this->session->userdata("school_code");
            $quant= $smsrow->row()->sms_quantity;
            $amount= $smsrow->row()->amount;
            $tot=$quant*$amount;
            $rannum=rand(10000,99999);
            $orderno="ORD".$rannum;
            $arr=array(
               "order_id" =>$orderno,
               "txn_date_time"=>date("Y-m-d H:i:s"),
               "reason"=>"buysms",
                "sms_quantity"=>$quant,
               "total_amount"=>$tot,
               "school_code"=>$this->session->userdata("school_code")
               
               );
           
           $this->db->insert("sms_transaction",$arr);
           	$ORDER_ID = $orderno;
           		$CUST_ID=$school_code;
           	$INDUSTRY_TYPE_ID = "Retail";

		$CHANNEL_ID = "WEB";
		$TXN_AMOUNT = $tot;
		
		// Create an array having all required parameters for creating checksum.
		
		$paramList["MID"] = PAYTM_MERCHANT_MID;
		$paramList["ORDER_ID"] = $ORDER_ID;
			$paramList["CUST_ID"] = $CUST_ID;
		$paramList["INDUSTRY_TYPE_ID"] = $INDUSTRY_TYPE_ID;
		$paramList["CHANNEL_ID"] = $CHANNEL_ID;
		$paramList["TXN_AMOUNT"] = $TXN_AMOUNT;
		$paramList["WEBSITE"] = PAYTM_MERCHANT_WEBSITE;
       

		$paramList["CALLBACK_URL"] = "https://www.schoolerp-niktech.in/school/index.php/smsAjax/payStatus/";
	
		/*$paramList["MSISDN"] = $MSISDN; //Mobile number of customer
		$paramList["EMAIL"] = $EMAIL; //Email ID of customer
		$paramList["VERIFIED_BY"] = "EMAIL"; //
		$paramList["IS_USER_VERIFIED"] = "YES"; //

		*/

		//Here checksum string will return by getChecksumFromArray() function.
		$checkSum = getChecksumFromArray($paramList,PAYTM_MERCHANT_KEY);

		?>
		<html>
		<head>
		<title>Merchant Check Out Page</title>
		</head>
		<body>
			<center><h1>Please do not refresh this page...</h1></center>
				<form method="post" action="<?php echo PAYTM_TXN_URL ?>" name="f1">
				<table border="1">
					<tbody>
					<?php
					foreach($paramList as $name => $value) {
						echo '<input type="hidden" name="' . $name .'" value="' . $value . '">';
					}
				
					?>
					<input type="hidden" name="CHECKSUMHASH" value="<?php echo $checkSum ?>">
					</tbody>
				</table>
				<script type="text/javascript">
					document.f1.submit();
				</script>
			</form>
		</body>
		</html>
  <?php }
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

		//Verify all parameters received from Paytm pg to your application. Like MID received from paytm pg is same as your application’s MID, TXN_AMOUNT and ORDER_ID are same as what was sent by you to Paytm PG for initiating transaction etc.
		$isValidChecksum = verifychecksum_e($paramList, PAYTM_MERCHANT_KEY, $paytmChecksum); //will return TRUE or FALSE string.


		if($isValidChecksum == "TRUE") {
			echo "<b>Checksum matched and following are the transaction details:</b>" . "<br/>";
			if ($_POST["STATUS"] == "TXN_SUCCESS") {
				echo "<b>Transaction status is success</b>" . "<br/>";
				//Process your transaction here as success transaction.
				//Verify amount & order id received from Payment gateway with your application's order id and amount.
			}
			else {
				echo "<b>Transaction status is failure</b>" . "<br/>";
			}

			if (isset($_POST) && count($_POST)>0 )
			{ 
				foreach($_POST as $paramName => $paramValue) {
						echo "<br/>" . $paramName . " = " . $paramValue;
				}
				
			}
			

		}
		else {
			echo "<b>Checksum mismatched.</b>";
			//Process transaction as suspicious.
		}


			}
			
public function payStatus(){

        header("Pragma: no-cache");
		header("Cache-Control: no-cache");
		header("Expires: 0");

       
        	$data['pageTitle'] = 'View SMS Report';
		$data['smallTitle'] = 'View SMS Report';
		$data['mainPage'] = 'View SMS Report';
		$data['subPage'] = 'View SMS Report';
		$data['title'] = 'View SMS Report ';
		$data['headerCss'] = 'headerCss/smsCss';
		$data['footerJs'] = 'footerJs/smsJs';
		$data['mainContent'] = 'paysmsStatus';
		$this->load->view("includes/mainContent", $data);
    }
   
   function requestsms(){
   $smsid= $this->input->post("vehicle");
   $this->db->where("id",$smsid);
   $smsrow=$this->db->get("sms_plan");
   if($smsrow->num_rows()>0){
      $quant= $smsrow->row()->sms_quantity;
       $amount= $smsrow->row()->amount;
       $tot=$quant*$amount;
       $rannum=rand(10000,99999);
       $orderno="ORD".$rannum;
       $arr=array(
           "order_id" =>$orderno,
           "txn_date_time"=>date("Y-m-d H:i:s"),
           "reason"=>"requestsms",
           "sms_quantity"=>$quant,
           "total_amount"=>$tot,
           "school_code"=>$this->session->userdata("school_code")
           
           );
           
          $dt= $this->db->insert("sms_transaction",$arr);
          if($dt){
              redirect("login/mobileNotice/requestsms");
          }
   }
   
   }
   


}