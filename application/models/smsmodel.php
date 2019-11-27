<?php
class Smsmodel extends CI_Model{
	function getsmsseting($school_code){
		$this->db->where("school_code",$school_code);
		$row = $this->db->get("sms")->row();
		return $row;
	}
	
	function sentmasterRecord($msg,$totsmssent,$master_id){
		$schol_code = $this->session->userdata("school_code");
		$this->db->where("id",$master_id);
		$getcheck = $this->db->get("sent_sms_master");
		if($getcheck->num_rows()>0){
			return false;
		}else{
		$data=array(
				"id"=>$master_id,
				"tot_count"=>$totsmssent,
				"sms"=>$msg,
				"school_code"=>$schol_code,
				"date"=>Date("Y-m-d G:i:s")
		
		);
		$insertwrongnumber= $this->db->insert("sent_sms_master",$data);
		return true;
		}	
	}
	
	function smstest($msg,$date){
	  $school_code=$this->session->userdata("school_code");
	      $this->db->where("sms",$msg);
	        $this->db->where("school_code",$school_code);
	   $this->db->where("Date(date)",$date);
	   $smsdt= $this->db->get("sent_sms_master");
	   if($smsdt->num_rows()>0){
	      $row= $smsdt->row();
	      
	       
	          $smsdate=$row->date;
	          $cur=date("G",strtotime($smsdate));
	     
	          $curhour= date('H');
	      
            if($curhour==$cur){
              
            return false;
            }
            else{
              
            return true;
            }
	      
	      
	         
	
	       
	   }else{
	         
	       return true;
	   }
	    
	    
	}
	function checknum($cnumber,$msg,$master_id){
	  
		$cnumber = str_replace(' ', '', $cnumber);
		if((is_numeric($cnumber)) && (strlen($cnumber)==10)){
			return $cnumber;
		}else{
			$data=array(
					
					"mobile"=>$cnumber,
					"sms_master_id"=>$master_id
						
			);
			$insertwrongnumber= $this->db->insert("wrong_number_sms",$data);
			return false;
		}
			
	}
	
	
	
	function sendReport($getv,$master_id){
	  
		foreach ($getv as $key => $rowValue):
			if($rowValue['sent_number']){
				$number=$rowValue['sent_number'];
				$msm_id = $rowValue['msg_id'];
				$smsf =$master_id;
				$data=array(
						'sent_number'=>$number,
						'msg_id'=>$msm_id,
						'sms_master_id'=>$master_id,
						'status'=>1,
						'date'=>date('Y-m-d H:s:i')
				);
				$this->db->insert("sent_sms_details",$data);
			}else{
				
			}
			
		endforeach;
		return true;
	}
	
	
	function getsmssender($school_code){
		$this->db->where("school_code",$school_code);
		$val=$this->db->get("sms_setting");
		return $val;
	}
	
	function getAllFatherNumber($school_code){
		$this->db->distinct();
		$this->db->select('student_info.mobile');
		$this->db->from('student_info');
		$this->db->join('class_info','class_info.id=student_info.class_id');
		$this->db->where("class_info.school_code",$school_code);
		$this->db->where("student_info.status",1);
		$query=$this->db->get();
		return $query;
	}
	function getClassFatherNumber($school_code,$classid){
	
			$this->db->distinct();
			$this->db->select('student_info.mobile');
			$this->db->from('student_info');
			$this->db->join('class_info','class_info.id=student_info.class_id');
			$this->db->where("student_info.class_id",$classid);
			$this->db->where("student_info.status",1);
			$query=$this->db->get();
			
	
		return $query;
	}
	
	function getTransportFatherNumber($vid){
	
		$this->db->distinct();
		//$this->db->select('student_info.mobile');
		//$this->db->from('student_info');
		$this->db->where("v_id",$vid);
		$this->db->where("status",1);
		$query=$this->db->get('student_info');
		

	return $query;
}

}