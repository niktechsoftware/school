<?php
class cronjobsBirth extends CI_Controller{
function __construct()
	{
		parent::__construct();
	$this->load->model("smsmodel");
	$this->load->model("studentmodel");
		
	}
 function getCronBirth(){
          $res = $this->db->get("school");
          if($res->num_rows()>0)
          {
             foreach($res->result() as $dd):
                 	$sender = $this->smsmodel->getsmssender($dd->id);
                    		$sende_Detail =$sender;
                    		$isSMS = $this->smsmodel->getsmsseting($dd->id);
                    		 $sende_Detail1=$sende_Detail->row();
                $doblist =  $this->studentmodel->dobStudentList($dd->id);
                if($doblist->num_rows()>0){
                      foreach($doblist->result() as $birth):
                          echo $birth->name."school".$dd->id."<br>";
                          $msg = "Dear ".$birth->name." The day has come and it’s so special. Today is your birthday day, We wish you love, wisdom, and strenght, on this special day. Happy Birthday!".$dd->school_name;
                        
					        $max_id = $this->db->query("SELECT MAX(id) as maxid FROM sent_sms_master")->row();
                		    $master_id=$max_id->maxid+1;
                		     $getv=  mysms($sende_Detail1->auth_key,$msg,$sende_Detail1->sender_id,$birth->mobile);
				 
                		    	//	$getv=sms($dd->mobile_no,$msg,$sende_Detail1->uname,$sende_Detail1->password,$sende_Detail1->sender_id);
                		     $this->smsmodel->sentmasterRecord1($msg,2,$master_id,$getv,$dd->id);
                		    
                          endforeach;
                }
                    endforeach;
          }
 }


}