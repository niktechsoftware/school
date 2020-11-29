<?php
class cronjobsA extends CI_Controller{
function __construct()
	{
		parent::__construct();
	$this->load->model("smsmodel");
	$this->load->model("studentmodel");
	 $this->load->model("daybookmodel");
		
	}
 function getCronA(){
            
          $res = $this->db->get("school");
          if($res->num_rows()>0)
          {
              	$cdate =date("Y-m-d");
               	$datec=$cdate;
             foreach($res->result() as $dd):
        		$backDate = date('Y-m-d',(strtotime ( '-1 day' , strtotime ( $cdate) ) ));
        		$openingBalance=$this->daybookmodel->getClosingBalance($backDate);
        		$closingBalance = $this->daybookmodel->getClosingBalance($cdate);
        		$closingBalance=$closingBalance;
                    $bln=$closingBalance  - $openingBalance;
                   if($bln != 0){
                       
                          $query3=$this->db->query("select sum(amount) as cradit from day_book where dabit_cradit='1' and school_code ='".$dd->id."' and DATE(pay_date)= '".$datec."' and status= 1");
                           $oldfee=$this->db->query("select sum(amount) as cradite from day_book where dabit_cradit='2' and school_code ='".$dd->id."' and DATE(pay_date)= '".$datec."' and status= 1");
                          $query4=$this->db->query("select sum(amount) as dabit from day_book where dabit_cradit='0' and school_code ='".$dd->id."' and DATE(pay_date)= '".$datec."' and status= 1");

                          if($oldfee->num_rows()>0){
                              $trv =$oldfee->row()->cradite;
                          }else{
                              $trv=0;
                          }
                          if($query3->num_rows()>0){
                              $credit = $query3->row()->cradit+$trv;
                          }else{
                               $credit =0;
                          }
                          if($query4->num_rows()>0){
                              $dabit = $query4->row()->dabit+0;
                          }else{
                               $dabit =0;
                          }
                         	$sender = $this->smsmodel->getsmssender($dd->id);
                    		$sende_Detail =$sender;
                    		$isSMS = $this->smsmodel->getsmsseting($dd->id);
                    		$sende_Detail1=$sende_Detail->row();
                            $bln=$closingBalance  - $openingBalance;
						    $number ="8382829593";


    						$msg ="Dear Sir/Mam [".$dd->school_name."], Today's School Profit Amount is Rs.".$bln.". Credited Amount is Rs.".$credit." and Debited Amount is Rs.".$dabit." for Query dial +91 9580121878, 8382829593. Niktech Software Solutions." ; 
                            $mob = $dd->mobile_no;
    					    $max_id = $this->db->query("SELECT MAX(id) as maxid FROM sent_sms_master")->row();
                		    $master_id=$max_id->maxid+1;
                		    $getv=  mysms($sende_Detail1->auth_key,$msg,$sende_Detail1->sender_id,$dd->mobile_no);
                		    $this->smsmodel->sentmasterRecord1($msg,2,$master_id,$getv,$dd->id);
                		  if($dd->email1){
                		        $ccregisterEmail= "schoolerp@niktechsoftware.com";
        		                $message = "Dear Sir/Mam, 
        		                [".$dd->school_name."], Today's School Profit Amount is Rs.".$bln.". Credited Amount is Rs.".$credit." and Debited Amount is Rs. ".$dabit." for Query dial +91 9580121878, 8382829593. Niktech Software Solutions.
        		                
        		              
        		               
        		                Deepika Pandey
        		                Niktech Software Solutions
        		                Accounts Department
        		                +91-9454012026
        		                www.schoolerp-niktech.in, www.niktechsoftware.com
        		                ";
        		                $this->sendMail($dd->email1,$dd->school_name,$ccregisterEmail,$message);
        		               // echo $message;
                		  }
                		  if(($dd->email2) && ($dd->email2  != $dd->email1)){
                		        $ccregisterEmail= "schoolerp@niktechsoftware.com";
        		                $message = "Dear Sir/Mam, 
        		                [".$dd->school_name."], Today's School Profit Amount is Rs.".$bln.". Credited Amount is Rs.".$credit." and Debited Amount is Rs. ".$dabit." for Query dial +91 9580121878, 8382829593. Niktech Software Solutions.
        		                
        		              
        		               
        		                Deepika Pandey
        		                Niktech Software Solutions
        		                Accounts Department
        		                +91-9454012026
        		                www.schoolerp-niktech.in, www.niktechsoftware.com
        		                ";
        		                $this->sendMail($dd->email2,$dd->school_name,$ccregisterEmail,$message);
        		               
                		  }
					
                        }   
                        
                     
                    endforeach;
          }
 }

 function sendMail($email1,$schoolname,$ccregisterEmail,$message){
        $subject = "Opening and Closing Balance of ".date("Y-m-d"); 
	        $this->load->library('email');
			$this->email->from('support@schoolerp-niktech.in', $schoolname);
			$this->email->to($email1);
			$this->email->cc($ccregisterEmail);
			$this->email->subject($subject);
			$this->email->message($message);
			$this->email->send();
        }
}