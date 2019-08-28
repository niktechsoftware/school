<?php
class SearchStudentModel extends CI_Model{
	
	function getValue(){
	    $school_code = $this->session->userdata("school_code");
	    $this->db->select('*');
	    $this->db->from('student_info');
	    $this->db->join('class_info','class_info.id=student_info.class_id');
	    $this->db->where("class_info.school_code",$school_code);
	    $this->db->where("student_info.status",1);
	    $query=$this->db->get();
	    return $query;
       
    }
    
    function getValueleave(){
        $school_code = $this->session->userdata("school_code");
     
        $this->db->where("school_code",$school_code);
        $query=$this->db->get('emp_leave');
        return $query;
       
    }
     function getValueleave1(){
        $school_code = $this->session->userdata("school_code");
      
        $this->db->where("school_code",$school_code);
        $query=$this->db->get('stu_leave');
        return $query;
       
    }
    function getValuefordriver()
    {
          $transportid=$this->input->post('transportid');
         $school_code = $this->session->userdata("school_code");
        $this->db->select('*');
        $this->db->from('student_info');
        $this->db->join('class_info','class_info.id=student_info.class_id');
        $this->db->where("class_info.school_code",$school_code);
        $this->db->where("student_info.status",1);
       $this->db->where("student_info.transport",1);
        $this->db->where("student_info.transport",1);
        $this->db->where("student_info.v_id",$transportid);
        $query=$this->db->get();
        return $query;
    }
    
    function getValuefortransport(){
      
        $school_code = $this->session->userdata("school_code");
        $this->db->select('*');
        $this->db->from('student_info');
        $this->db->join('class_info','class_info.id=student_info.class_id');
        $this->db->where("class_info.school_code",$school_code);
        $this->db->where("student_info.status",1);
         $this->db->where("student_info.fsd",$this->session->userdata('fsd'));
       $this->db->where("student_info.transport",1);
        $query=$this->db->get();
        return $query;
       
    }
    
    function getValueNotActive(){
        $school_code = $this->session->userdata("school_code");
        $this->db->select('*');
        $this->db->select('student_info.id as stuid');
        $this->db->from('student_info');
        $this->db->join('class_info','class_info.id=student_info.class_id');
        $this->db->where("class_info.school_code",$school_code);
        $this->db->where("student_info.status",0);
        $query=$this->db->get();
        return $query;
    }
    
    function getValue1($temps){
    	//$this->db->where("school_code",$this->session->userdata("school_code"));
    	$this->db->where("status",1);
    	$this->db->where("username",$temps);
    	$dam = $this->db->get("student_info");
    	return $dam;
    }
    function getStuInCertificate($temps){
    	$this->db->where("school_code",$this->session->userdata("school_code"));
    	
    	$this->db->where("student_id",$temps);
    	$dam = $this->db->get("cc_certificate");
    	return $dam;
    }
    



    function getValuecc($temps){
        //$this->db->where("school_code",$this->session->userdata("school_code"));
        $this->db->where("status",1);
        $this->db->where("username",$temps);
        $dam = $this->db->get("student_info");
        return $dam;
    }
    function getStuccInCertificate($temps){
        $this->db->where("school_code",$this->session->userdata("school_code"));
        
        $this->db->where("student_id",$temps);
        $dam = $this->db->get("cc_certificate");
        return $dam;
    }
    
}