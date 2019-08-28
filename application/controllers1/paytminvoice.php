<?php
class Paytminvoice extends CI_Controller{
    
    	function onlinefeesubmit(){
		 $school_code = $this->session->userdata("school_code");
		 $invoice_number = $this->uri->segment(3);
         $student_id = $this->uri->segment(4);
         $fsd = $this->uri->segment(5);
		 
		 $this->db->where("school_code",$school_code);
        $this->db->where("invoice_no",$invoice_number);
        $this->db->where("student_id",$student_id);
        $fsd =$this->db->get("fee_deposit")->row();
        
        //  $this->db->where("school_code",$school_code);
        // $this->db->where("invoice_no",$invoice_number);
         $this->db->where("id",$student_id);
        $student =$this->db->get("student_info")->row();
        
	     $isSMS = $this->smsmodel->getsmsseting($school_code);
		 $sende_Detail1=$sende_Detail->row();
				
		$this->db->where("school_code",$school_code);
			$this->db->where("student_id",$student_id);
			$this->db->where("invoice_no",$invoice_number);
			$current_balance =$this->db->get("feedue")->row()->mbalance;
			
		$this->db->where("school_code",$school_code);
			$this->db->where("student_id",$student_id);
			$var=$this->db->get("guardian_info")->row();
			$fmobile=$student->mobile;
			
		  //get fee details
	         	    $this->db->where("invoice_no",$invoice_number);
                    //$this->db->where("school_code",$this->session->userdata("school_code"));
					$rty = 	$this->db->get("deposite_months");
					$monthmk=array();
					$this->db->where('id',$fsd->finance_start_date);
					$fsd1=$this->db->get('fsd')->row();
					$demont = $rty->num_rows();
                    $i=0;$printMonth=""; foreach($rty->result() as $tyu):
                    $ffffu= $tyu->deposite_month-4;
					
						$printMonth= $printMonth."".date('M-Y', strtotime("$ffffu months", strtotime($fsd1->finance_start_date))).", ";
						$monthmk[$i]=$tyu->deposite_month;
                    	//echo date("d-M-y", $rdt); 
				    	$i++; endforeach;	
			//end get fee details
			
			
			$stuname=$student->name;
			$msg = "Dear Parent your child ".$stuname.",Fee of Month ".$printMonth.",is deposited of Rs.".$fsd->paid."/-with due balance Rs.".$current_balance."/-.For more info visit: ".$sende_Detail1->web_url;
		//echo $msg;exit;
			sms($fmobile,$msg,$sende_Detail1->uname,$sende_Detail1->password,$sende_Detail1->sender_id);
			$this->db->where("id",$school_code);
		    $admin_mobile = $this->db->get('school')->row();
		    if($admin_mobile->id==1){
			$msg1 = "Dear School Manager your Student ".$stuname.",Fee of Month ".$printMonth.",is deposited of Rs.".$fsd->paid."/-with due balance Rs.".$current_balance."/-.For more info visit: ".$sende_Detail1->web_url;
			sms($admin_mobile->mobile_no,$msg1,$sende_Detail1->uname,$sende_Detail1->password,$sende_Detail1->sender_id);
				$msg2 = "Dear School Principle your Student ".$stuname.",Fee of Month ".$printMonth.",is deposited of Rs.".$fsd->paid."/-with due balance Rs.".$current_balance."/-.For more info visit: ".$sende_Detail1->web_url;
			sms(7398863503,$msg2,$sende_Detail1->uname,$sende_Detail1->password,$sende_Detail1->sender_id);
		    }
			$this->db->where("school_code",$school_code);
			$this->db->where("student_id",$this->input->post('stuId'));
			$this->db->where("invoice_no",$invoice_number);
		    $mode = $this->db->get('fee_deposit')->row()->payment_mode;
		    
		   redirect("index.php/invoiceController/fee/$invoice_number/$student_id/$fsd/yes");
		    //print_r($mode);exit;
			
	}


     function onlinefee(){
         
    $invoice_number = $this->uri->segment(3);
    $student_id = $this->uri->segment(4);
    $fsd = $this->uri->segment(5);
    
    print_r($invoice_number);
    // print_r($invoice_number1);
    // print_r($invoice_number2);
   // exit();
    
    $school_code=$this->session->userdata("school_code");
    print_r($school_code);
    $this->db->where("school_code",$school_code);
    $this->db->where("invoice_no",$invoice_number);
    $this->db->where("student_id",$student_id);
    $feerow =$this->db->get("fee_deposit");
    if($feerow->num_rows()>0){
    $paidamount= $feerow->row()->paid;
  	$op1 = $this->db->query("select closing_balance from opening_closing_balance where opening_date='".date('Y-m-d')."' AND school_code='$school_code'")->row();
	$balance = $op1->closing_balance;
	$close1 = $balance - $paidamount;
	$bal = array(
			"closing_balance" => $close1
	);
	$this->db->where("school_code",$school_code);
	$this->db->where("opening_date",date('Y-m-d'));
	$this->db->update("opening_closing_balance",$bal);
   
    
    $this->db->where("school_code",$school_code);
    $this->db->where("invoice_no",$invoice_number);
    $this->db->where("student_id",$student_id);
    $ab =$this->db->delete("feedue");
    //print_r($ab);
    
    $this->db->where("fsd",$fsd);
    $this->db->where("invoice_no",$invoice_number);
    $this->db->where("student_id",$student_id);
    $ab1 =$this->db->delete("deposite_months");
    //print_r($ab1);
    
    $this->db->where("school_code",$school_code);
    $this->db->where("invoice_no",$invoice_number);
    $this->db->where("student_id",$student_id);
    $ab2 =$this->db->delete("fee_deposit");
    //print_r($ab2);
    
      $this->db->where("school_code",$school_code);
    $this->db->where("invoice_no",$invoice_number);
   
    $ab3 =$this->db->delete("invoice_serial");
    //print_r($ab3);
    
     $this->db->where("school_code",$school_code);
    $this->db->where("invoice_no",$invoice_number);
    $this->db->where("paid_by",$student_id);
    $ab4 =$this->db->delete("day_book");
   // print_r($ab4);exit;
    
    redirect("login/collectFee/");
    
    }
	
}
    
}