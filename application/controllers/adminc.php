<?php
class adminc extends CI_Controller{
	
	/**
	 * this function used to load admintcard view.
	 */
	function admitCard(){
		$this->load->model("examModel");
		$this->load->model("configureclassmodel");
		$var=$this->examModel->getExamName();
		$data['request']=$var->result();
		$stream=$this->configureclassmodel->getStramforexam();
		$data['stream']=$stream->result();
		$data['pageTitle'] = 'Admit Card';
		$data['smallTitle'] = 'Admit Card Panel';
		$data['mainPage'] = 'Admit Card Panel';
		$data['subPage'] = 'Admit Card Panel';
		$data['title'] = 'Admit Card';
		$data['headerCss'] = 'headerCss/newAdmissionCss';
		$data['footerJs'] = 'footerJs/admitCardJs';
		$data['mainContent'] = 'admitCard';
		$this->load->view("includes/mainContent", $data);
		
	}
	/*function house(){
	    $row= $this->db->get('house_list')->result();
	          foreach($row as $a){
					    $b=$a->code;
            	           $data= array(
                      	'house_id' =>$b
                      );
					    $this->db->where('username',$a->user);
						$c=$this->db->get('student_info')->num_rows();
						if($c >0){
							$this->db->where('username',$a->user);
							$up=$this->db->update('student_info',$data);
							}
						}
	}*/
	
	function admitCardReports(){
		    $data['pageTitle'] = 'Admit Card';
			$data['smallTitle'] = 'Student Panel';
			$data['mainPage'] = 'Student Panel';
			$data['subPage'] = 'Student Panel';
			$data['title'] = 'Admit Card';
			$data['headerCss'] = 'headerCss/newAdmissionCss';
			$data['footerJs'] = 'footerJs/admitCardJs';
			$data['mainContent'] = 'admitCardReport';
			$this->load->view("includes/mainContent", $data);
	}
	
	function admitCardReports1(){
		$data['pageTitle'] = 'Admit Card';
		$data['smallTitle'] = 'Student Panel';
		$data['mainPage'] = 'Student Panel';
		$data['subPage'] = 'Student Panel';
		$data['title'] = 'Admit Card';
		$data['headerCss'] = 'headerCss/newAdmissionCss';
		$data['footerJs'] = 'footerJs/admitCardJs';
		$data['mainContent'] = 'admitCardReport1';
		$this->load->view("includes/mainContent", $data);
}
	
	function AdmitCardDownload(){
		   $id = $this->uri->segment(3);
			$examrow = $this->uri->segment(4);
			$this->db->where("id",$examrow);
			$exam_data = $this->db->get("exam_name")->row();
			$data['exam_name']=$exam_data->id;
		  $data['id']=$id;
		  $data['title']="Admit Card";
		  $this->load->view("invoice/printAdmit",$data);
	}	
	function AdmitCardDownload1(){
		$id = $this->uri->segment(3);
		 $examrow = $this->uri->segment(4);
		 $this->db->where("id",$examrow);
		 $exam_data = $this->db->get("exam_name")->row();
		 $data['exam_name']=$exam_data->id;
		 $data['exam_date']=$exam_data->exam_date;
	   $data['class_id']=$id;
	   $data['title']="Admit Card";
	   $this->load->view("invoice/printAdmit1",$data);
 }	
 
 function getMobile(){
     $this->db->select("mobile");
     $this->db->where("school_code",9);
     $this->db->where("status",1);
    $dfg = $this->db->get("student_info");
    $mob="8382829593";
     foreach($dfg->result() as $row):
         $mob =$mob.",".$row->mobile;
         endforeach;
     
 }
 
 function updateMobile(){
    
	
    $ts =  $this->db->get("temp");
     foreach($ts->result() as $t):
         
         
          $this->db->select('id');
	     $this->db->from('student_info');
	    
	     $this->db->where("username",$t->uname);
	   
	     $query=$this->db->get()->row();
	     
	     $up = array(
	         "mother_full_name"=> $t->mname
	         );
	         
	        $this->db->where("student_id",$query->id);
         $this->db->update("guardian_info",$up);
	     
         
         endforeach;
 }
 function updateopen(){
	 $dt1="2019-10-04";
	 $dt2=Date("y-m-d");
	 $this->db->order_by("id","asc");
	 $this->db->where("date(pay_date)>=",$dt1);
	 $this->db->where("date(pay_date)<=",$dt2);
	 $this->db->where("school_code",$this->session->userdata("school_code"));
	 $dt=$this->db->get("day_book");
	 if($dt->num_rows()>0){
		 foreach($dt->result() as $data):
			$clo=$data->closing_balance;
			$updtclo=$clo+7745800.00;
			$arr =array(
				"closing_balance"=>$updtclo
			);
			$this->db->where("id",$data->id);
			$this->db->update("day_book",$arr);
		endforeach;
	 }

}
}