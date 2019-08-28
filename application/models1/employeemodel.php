<?php
class EmployeeModel extends CI_Model{
	
	function employeeList($school_code){
		$this->db->where("school_code",$school_code);
		$this->db->where("status",1);
		$result = $this->db->get("employee_info");
		return $result;
	}
	function getstaffvalue($staff_id){
		$this->db->where('username',$staff_id);
		$this->db->where('school_code',$this->session->userdata('school_code'));
		$emp=$this->db->get('employee_info');
		//print_r($emp);
		return $emp;
	}
	public function addEmployeeInfo($stream){
		$query = $this->db->insert("employee_info", $stream);
		return $query;
	}
	public function quickEmpInfo($dataemp){
		$query = $this->db->insert("employee_info", $dataemp);
		return $query;
	}
	public function addEmployeeBankDetail($dataempbank){
		$query = $this->db->insert("bank_account_detail", $dataempbank);
		return $query;
	}
	public function addEmployeeSalaryStructure($stream){
		$query = $this->db->insert("emp_salary_struct", $stream);
		return $query;
	}
	
		function getStudentDetail($empId){
		
		$this->db->where("id",$empId);
		$result = $this->db->get("employee_info");
		return $result;
	}
	
	public function getEmployeProfile($empNo){
		$this->db->where("school_code",$this->session->userdata("school_code"));
		$this->db->where("username",$empNo);
		$result = $this->db->get("employee_info");
		return $result;
	}
	public function updateEmployeProfile($empNo,$data){
		$this->db->where("school_code",$this->session->userdata("school_code"));
		$this->db->where("username",$empNo);
		$result = $this->db->update("employee_info",$data);
		if($result):
			return true;
		endif;
	}
	function updateEmployeeBankProfile($empid,$bankdata){
	    $this->db->where("school_code",$this->session->userdata("school_code"));
	   $this->db->where('username',$empid);
	   $eid=$this->db->get('employee_info')->row()->id;
	
		    $this->db->where("employee_id",$eid);
		$data = $this->db->update("bank_account_detail",$bankdata);
		return $data;
	
	}
	public function updateImage($data){
		$this->db->where("school_code",$this->session->userdata("school_code"));
		$this->db->where('username',$this->input->post('c_id'));
		$this->db->update('employee_info',$data);
		return true;
	}
	
	public function getSalaryDetail($eid){
		$this->db->where("school_code",$this->session->userdata("school_code"));
		$this->db->where('emp_id',$eid);
		$this->db->where('fsd',$this->session->userdata("fsd"));
		$detail = $this->db->get('emp_salary_struct');
		return $detail;
	}
	public function insertSalary($data){
		$query = $this->db->insert("emp_salary_info", $data);
		return true;
	}
	public function updateSalary($data){
		$this->db->where("school_code",$this->session->userdata("school_code"));
		$this->db->where('emp_id',$data['emp_id']);
		$query = $this->db->update("emp_salary_info", $data);
		return true;
	}
	function employeeLeaveApprove()
	{
		$this->db->where("school_code",$this->session->userdata("school_code"));
		$this->db->where('approve',"NO");
		$query = $this->db->get("emp_leave");
		return $query;
	}
	function updateApprove($emp_id,$total_leave,$end_date,$start_date,$data)
	{
		$this->db->where("school_code",$this->session->userdata("school_code"));
		$this->db->where('emp_id',$emp_id);
		$this->db->where('total_leave',$total_leave);
		$this->db->where('end_date',$end_date);
		$this->db->where('start_date',$start_date);
		$this->db->update("emp_leave",$data);
		return true;
	}
	
}