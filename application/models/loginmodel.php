<?php
class LoginModel extends CI_Model{
	
	function validate(){
		// get username password and check is it for admin,employee or student.
		
		// check is it for admin
        $this->db->where("admin_username", $this->input->post("username"));
        $this->db->where("admin_password", md5($this->input->post("password")));
        //$this->db->where("mobile_number", $this->input->post("mobile"));
        $general = $this->db->get("general_settings");
        
        if($general->num_rows() >0){
            $res1 = $general->row();
            $this->db->where("id",$res1->school_code);
            $res  = $this->db->get("school")->row();
        	$loginData = array(
        			"login_type" => "admin",
        			"your_school_name" => $res->school_name,
        			"address_1" => $res->address1,
        			"address_2" => $res->address2,
        			"city" => $res->city,
        			"state" => $res->state,
        			"pin" => $res->pin,
        			"school_code"=>$res->id,
        			"mobile_number" => $res->mobile_no,
        			"username" => $res1->admin_username,
        			"name" => $res->principle_name,
        			"photo" => $res->ico_logo,
        			"logo" => $res->logo,
        			"fsd" => $res1->fsd_id,
        			
        			"is_login" => true,
        			"is_lock" => true,
        			"login_date" => date("d-M-Y"),
        			"login_time" => date("H:i:s")
        	);
        		$this->db->where("chat_username",$res1->admin_username);
        	$chatvalue = $this->db->get("chat");
        	if($chatvalue->num_rows()>0){
        	     $data['school_code']=$res->id;
        	     $this->db->where("chat_username",$res1->admin_username);
        	     $this->db->update("chat",$data);
        	}else{
        	     $data['school_code']=$res->id;
        	    $data['status']=1;
        	    $data['chat_username']=$res1->admin_username;
        	    $this->db->insert("chat",$data);
        	}
            return $loginData;
        }
        
        // check is it for employee
        $this->db->where("status",1);
        $this->db->where("username",$this->input->post("username"));
        $this->db->where("password",$this->input->post("password"));
        $query = $this->db->get("employee_info");
	
        if($query->num_rows() >0){
        	$res = $query->row();
            		
        	$this->db->where("id",$res->school_code);
        	$general = $this->db->get("school");
        	$school = $general->row();
        	if($res->job_category=='9'){
        	    $jb="admin";
        	}else{
        	    $jb=$res->job_category;
        	}
        	$this->db->where("school_code",$res->school_code);
    		$fsddate= $this->db->get('general_settings')->row()->fsd_id;
    		//print_r($fsddate);exit;
        	$loginData = array(
        	    "your_school_name" => $school->school_name,
        			"login_type" => $jb,
        			"job_category" => $res->job_category,
        			"address_1" => $res->address,
        		    "id" => $res->id,
        			"city" => $res->city,
        			"state" => $res->state,
        			"pin" => $res->pin_code,
        			"mobile_number" => $res->mobile,
        			"email" => $res->email,
        			"username" => $res->username,
        			"name" => $res->name,
        			"photo" => $res->photo,
        			"logo" => $school->logo,
        			"fsd" => $fsddate,
                    "school_code"=>$school->id,
        			"is_login" => true,
        			"is_lock" => true,
        			"login_date" => date("d-M-Y"),
        			"login_time" => date("H:i:s")
        	);
        	$this->db->where("chat_username",$res->username);
        	$chatvalue = $this->db->get("chat");
        	if($chatvalue->num_rows()>0){
        	     $data['school_code']=$school->id;
        	     $this->db->where("chat_username",$res->username);
        	     $this->db->update("chat",$data);
        	}else{
        	     $data['school_code']=$school->id;
        	    $data['status']=1;
        	    $data['chat_username']=$res->username;
        	    $this->db->insert("chat",$data);
        	}
            return $loginData;
        }
	
        // check is it for student
        $this->db->where("status",1);
        $this->db->where("username",$this->input->post("username"));
        $this->db->where("password",$this->input->post("password"));
        // $this->db->where("mobile", $this->input->post("mobile"));
        $query = $this->db->get("student_info");
      
       //print_r($res);exit;
        if($query->num_rows > 0){
        	 $res = $query->row();
        	 
			  $this->db->where("id",$res->class_id);
        	$general = $this->db->get("class_info");
			$scode=$general->row()->school_code;
			
        	$this->db->where("id",$scode);
        	$general = $this->db->get("school");
        	$school = $general->row();
        	$loginData = array(
        	    "your_school_name" => $school->school_name,
        			"login_type" => "student",
        			"username" => $res->username,
        			"name" => $res->name,
        			"id" => $res->id,
        			"class_id" => $res->class_id,
        			//"section" => $res->section,
        			"address_1" => $res->address1,
        			//"address_2" => $res->address2,
        			"city" => $res->city,
        			"school_code"=>$scode,
        			"state" => $res->state,
        			"pin" => $res->pin,
        			"mobile_number" => $res->mobile,
        			"email" => $res->email,
        			"photo" => $res->photo,
        			"logo" => $school->logo,
        			"fsd" => $res->fsd,
        			"is_login" => true,
        			"is_lock" => true,
        			"login_date" => date("d-M-Y"),
        			"login_time" => date("H:i:s")
        	);
        		$this->db->where("chat_username",$res->username);
        	$chatvalue = $this->db->get("chat");
        	if($chatvalue->num_rows()>0){
        	     $data['school_code']=$scode;
        	     $this->db->where("chat_username",$res->username);
        	     $this->db->update("chat",$data);
        	}else{
        	     $data['school_code']=$scode;
        	    $data['status']=1;
        	    $data['chat_username']=$res->username;
        	    $this->db->insert("chat",$data);
        	}
		//	print_r($loginData);exit;
            return $loginData;
        }
    }
    
    
    function validateLock(){
    	$login_type = $this->input->post('logintype');
    	//echo $login_type;
    	//die();
    	if($login_type == 'admin'){

    		$this->db->where("school_code",$this->session->userdata("school_code"));
    		$this->db->where("admin_username", $this->input->post("username"));
    		$this->db->where("admin_password", md5($this->input->post("password")));
    		$result = $this->db->get('general_settings');
    		if($result->num_rows() > 0){
    			return true;
    		}
    		else{
    			return false;
    		}
    	}
    	elseif($login_type == "student"){

    		$this->db->where("school_code",$this->session->userdata("school_code"));
    		$this->db->where("status",1);
    		$this->db->where("username", $this->input->post("username"));
    		$this->db->where("password", $this->input->post("password"));
    		$result = $this->db->get('student_info');
    		if($result->num_rows() > 1){
    			return true;
    		}
    		else{
    			return false;
    		}
    	}
    	else{

    		$this->db->where("school_code",$this->session->userdata("school_code"));
    		$this->db->where("status",1);
    		$this->db->where("username", $this->input->post("username"));
    		$this->db->where("password", $this->input->post("password"));
    		$result = $this->db->get('employee_info');
    		if($result->num_rows() > 1){
    			return true;
    		}
    		else{
    			return false;
    		}
    	}
    }
    
}