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
}