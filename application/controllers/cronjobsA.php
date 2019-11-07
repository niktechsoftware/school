<?php
class cronjobsA extends CI_Controller{
function __construct()
	{
		parent::__construct();
	$this->load->model("smsmodel");
		
	}
 function getCronA(){
   
         
          $res = $this->db->get("school");
          if($res->num_rows()>0)
          {
             foreach($res->result() as $dd):
              
                $datec  = date('Y-m-d');
                    $this->db->where("school_code",$dd->id);
                    $this->db->where("DATE(opening_date)",$datec);
                   $getDaybook = $this->db->get("opening_closing_balance");
                   if($getDaybook->num_rows()>0){
                       $getDaybook = $getDaybook->row();
                          $query3=$this->db->query("select sum(amount) as cradit from day_book where dabit_cradit='1' and school_code ='".$dd->id."' and DATE(pay_date)= '".$datec."'");
                          $query4=$this->db->query("select sum(amount) as dabit from day_book where dabit_cradit='0' and school_code ='".$dd->id."' and DATE(pay_date)= '".$datec."'");
                          if($query3->num_rows()>0){
                              $credit = $query3->row()->cradit;
                          }else{
                               $credit =0;
                          }
                          if($query4->num_rows()>0){
                              $dabit = $query4->row()->dabit;
                          }else{
                               $dabit =0;
                          }
                         	$sender = $this->smsmodel->getsmssender($dd->id);
                    		$sende_Detail =$sender;
                    		$isSMS = $this->smsmodel->getsmsseting($dd->id);
                    		 $sende_Detail1=$sende_Detail->row();
                         $bln=$getDaybook->closing_balance - $getDaybook->opening_balance;
						$number ="8382829593";
						$msg ="Dear Sir/Madam [".$dd->school_name."], Today's School Profit Amount is Rs.".$bln.". Credited Amount is Rs.".$credit." and Debited Amount is Rs. ".$dabit."for Query dial 6389027901,2,3 Niktech Software Solutions." ; 
					
					$mob = $dd->mobile_no;
					    $max_id = $this->db->query("SELECT MAX(id) as maxid FROM sent_sms_master")->row();
                		    $master_id=$max_id->maxid+1;
                		    $getresultm = $this->smsmodel->sentmasterRecord($msg,1,$master_id);
                		    if($getresultm){
                		    	//$getv=sms($fmobile,$msg,$sende_Detail1->uname,$sende_Detail1->password,$sende_Detail1->sender_id);
                		    		$getv=sms($dd->mobile_no,$msg,$sende_Detail1->uname,$sende_Detail1->password,$sende_Detail1->sender_id);
                		    	
                		    	$this->smsmodel->sendReport($getv,$master_id);
                		    }
					
                        }      
                    endforeach;
          }}


}