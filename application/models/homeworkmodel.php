<?php
class homeWorkModel extends CI_Model{
	function submitHomeWork($data){
		$this->db->insert("homework",$data);
		return true;
	}
	function saveHomeWork($data){
		$this->db->insert("homework_name",$data);
		return true;
	}
	function getHomeWorkList(){
		$this->db->where("school_code",$this->session->userdata("school_code"));
		$var = $this->db->get("homework");
		return $var;
	}
	function getHomeWorkDetail(){
	    	$school_code = $this->session->userdata("school_code");
	    if($this->session->userdata("login_type")=="admin"){
	        
	  
		$this->db->where("school_code",$this->session->userdata("school_code"));
		$var = $this->db->get("homework_name");
		return $var;
	    }else{
	    $username=$this->session->userdata('username');
	    $this->db->where('username',$username);
	    $stuinfo=$this->db->get('student_info')->row();
			// print_r($stuinfo);
			// exit();
	    $this->db->where("class_id",$stuinfo->class_id);
		$this->db->where("school_code",$this->session->userdata("school_code"));
		$var = $this->db->get("homework_name");
		return $var;}
	}
	function getHomeWorkDetailTeacher(){
		$school_code = $this->session->userdata("school_code");
	//	$var = $this->db->query("SELECT * FROM homework_name WHERE class_id = 0");
		$var = $this->db->query("SELECT * FROM homework_name WHERE workfor ='teachers' And school_code='$school_code'");
		return $var;
	}
		function getHomeWorkDetailemp(){
		$school_code = $this->session->userdata("school_code");
		$var = $this->db->query("SELECT * FROM homework_name WHERE workfor ='employee' And school_code='$school_code'");
		return $var;
	}
	function getHomeWorkDetailStudent(){
	    	$school_code = $this->session->userdata("school_code");
	    if($this->session->userdata("login_type")=="admin"){
	        
      
		$var = $this->db->query("SELECT * FROM homework_name WHERE workfor ='students' And school_code='$school_code'");
		return $var;
	    }else{
		$school_code = $this->session->userdata("school_code");
        $cid = $this->session->userdata("class_id");
       // print_r($cid);exit();
		//$var = $this->db->query("SELECT * FROM homework_name WHERE class_id = '$cid' ");
		$var = $this->db->query("SELECT * FROM homework_name WHERE workfor ='students' and class_id = '$cid' And school_code='$school_code'");
		return $var;
	    }
	}
	function updateHomeWork($data,$sno){
		$this->db->where("school_code",$this->session->userdata("school_code"));
		$this->db->where("s_no",$sno);
		$var = $this->db->update("homework",$data);
		return TRUE;
	}
	function getClassWise($classv){
		$this->db->where("school_code",$this->session->userdata("school_code"));
		$this->db->where("class1",$classv);
		$var = $this->db->get("homework");
		return $var;
	}
	function getSectionWise($classv,$section){
     //	$this->db->where("school_code",$this->session->userdata("school_code"));
	//	$this->db->where("class_id >",0);
	//	$this->db->where("workfor","students");
	//	$this->db->where("section",$section);
	//	$var = $this->db->get("homework_name");
	$school_code = $this->session->userdata("school_code");
		$var = $this->db->query("SELECT * FROM homework_name WHERE workfor ='students' And school_code='$school_code' And class_id='$section'");
		return $var;
	}
	
	
}