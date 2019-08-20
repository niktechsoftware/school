<?php
class Vreportpanel extends CI_Controller{

	public function __construct(){
		parent::__construct();
			$this->is_login();
	
	}
	
	
		function is_login(){
		$is_login = $this->session->userdata('is_login');
	
		if((!$is_login)){
			
			redirect("index.php/homeController/index");
		}
	
	}



  public function index(){
		$data['pageTitle'] = 'varification report Panel';
		$data['smallTitle'] = 'varification report Panel';
		$data['mainPage'] = 'varification report Panel Area';
		$data['subPage'] = 'varification report Panel';
		$data['title'] = 'varification report Panel Area ';
		$data['headerCss'] = 'headerCss/noticeCss';
		$data['footerJs'] = 'footerJs/noticeJs';
		$data['mainContent'] = 'panel/vreport_panel';
		$this->load->view("includes/mainContent", $data);


  }


    public function tcvreportpanel(){
		$data['pageTitle'] = 'varification report Panel';
		$data['smallTitle'] = 'varification report Panel';
		$data['mainPage'] = 'varification report Panel Area';
		$data['subPage'] = 'varification report Panel';
		$data['title'] = 'varification report Panel Area ';
		$data['headerCss'] = 'headerCss/noticeCss';
		$data['footerJs'] = 'footerJs/noticeJs';
		$data['mainContent'] = 'panel/varificationreport/tc_vreportpanel';
		$this->load->view("includes/mainContent", $data);


  }

    public function ccvreportpanel(){
		$data['pageTitle'] = 'varification report Panel';
		$data['smallTitle'] = 'varification report Panel';
		$data['mainPage'] = 'varification report Panel Area';
		$data['subPage'] = 'varification report Panel';
		$data['title'] = 'varification report Panel Area ';
		$data['headerCss'] = 'headerCss/noticeCss';
		$data['footerJs'] = 'footerJs/noticeJs';
		$data['mainContent'] = 'panel/varificationreport/cc_vreportpanel';
		$this->load->view("includes/mainContent", $data);


  }

    public function tcgenvreportpanel(){
		$data['pageTitle'] = 'varification report Panel';
		$data['smallTitle'] = 'varification report Panel';
		$data['mainPage'] = 'varification report Panel Area';
		$data['subPage'] = 'varification report Panel';
		$data['title'] = 'varification report Panel Area ';
		$data['headerCss'] = 'headerCss/noticeCss';
		$data['footerJs'] = 'footerJs/noticeJs';
		$data['mainContent'] = 'panel/varificationreport/tcgen_vreportpanel';
		$this->load->view("includes/mainContent", $data);


  }

    public function ccgenvreportpanel(){
		$data['pageTitle'] = 'varification report Panel';
		$data['smallTitle'] = 'varification report Panel';
		$data['mainPage'] = 'varification report Panel Area';
		$data['subPage'] = 'varification report Panel';
		$data['title'] = 'varification report Panel Area ';
		$data['headerCss'] = 'headerCss/noticeCss';
		$data['footerJs'] = 'footerJs/noticeJs';
		$data['mainContent'] = 'panel/varificationreport/ccgen_vreportpanel';
		$this->load->view("includes/mainContent", $data);


  }

    public function prostuvreportpanel(){
		$data['pageTitle'] = 'varification report Panel';
		$data['smallTitle'] = 'varification report Panel';
		$data['mainPage'] = 'varification report Panel Area';
		$data['subPage'] = 'varification report Panel';
		$data['title'] = 'varification report Panel Area ';
		$data['headerCss'] = 'headerCss/noticeCss';
		$data['footerJs'] = 'footerJs/noticeJs';
		$data['mainContent'] = 'panel/varificationreport/prostu_vreportpanel';
		$this->load->view("includes/mainContent", $data);


  }

      public function jumpstuvreportpanel(){
		$data['pageTitle'] = 'varification report Panel';
		$data['smallTitle'] = 'varification report Panel';
		$data['mainPage'] = 'varification report Panel Area';
		$data['subPage'] = 'varification report Panel';
		$data['title'] = 'varification report Panel Area ';
		$data['headerCss'] = 'headerCss/noticeCss';
		$data['footerJs'] = 'footerJs/noticeJs';
		$data['mainContent'] = 'panel/varificationreport/jumpstu_vreportpanel';
		$this->load->view("includes/mainContent", $data);


  }

      public function birthrepovreportpanel(){
		$data['pageTitle'] = 'varification report Panel';
		$data['smallTitle'] = 'varification report Panel';
		$data['mainPage'] = 'varification report Panel Area';
		$data['subPage'] = 'varification report Panel';
		$data['title'] = 'varification report Panel Area ';
		$data['headerCss'] = 'headerCss/noticeCss';
		$data['footerJs'] = 'footerJs/noticeJs';
		$data['mainContent'] = 'panel/varificationreport/birthrepo_vreportpanel';
		$this->load->view("includes/mainContent", $data);


  }


    public function stuvarivreportpanel(){
		$data['pageTitle'] = 'varification report Panel';
		$data['smallTitle'] = 'varification report Panel';
		$data['mainPage'] = 'varification report Panel Area';
		$data['subPage'] = 'varification report Panel';
		$data['title'] = 'varification report Panel Area ';
		$data['headerCss'] = 'headerCss/noticeCss';
		$data['footerJs'] = 'footerJs/noticeJs';
		$data['mainContent'] = 'panel/varificationreport/stuvari_vreportpanel';
		$this->load->view("includes/mainContent", $data);


  }

      public function teachvarivreportpanel(){
		$data['pageTitle'] = 'varification report Panel';
		$data['smallTitle'] = 'varification report Panel';
		$data['mainPage'] = 'varification report Panel Area';
		$data['subPage'] = 'varification report Panel';
		$data['title'] = 'varification report Panel Area ';
		$data['headerCss'] = 'headerCss/noticeCss';
		$data['footerJs'] = 'footerJs/noticeJs';
		$data['mainContent'] = 'panel/varificationreport/teachvari_vreportpanel';
		$this->load->view("includes/mainContent", $data);


  }

   public function getcc(){

		$idv =$this->input->post('studid');
		
		$this->db->where('username',$idv);
		$dt=$this->db->get('student_info')->row();
		
		  if( $dt){
           	redirect("vreportpanel/getcc1/$idv");
		}else{
			redirect("login/collectFee/feeFalse");
		}
		

		
		


  }

	function getcc1(){
		$this->load->model("feemodel");
		$cdate=date("Y-m-d");
		$data['stud_id']=$this->uri->segment(3);

		$fsd_id = $this->session->userdata("fsd");
		$this->db->where("school_code",$this->session->userdata("school_code"));
		$this->db->where("id",$fsd_id);
		$data['fsddate']=$this->db->get("fsd");
		if($this->uri->segment(3)){
			if($this->uri->segment(3)!="feeFalse"){
				$data['totdata']=$this->feemodel->getstugurboth($this->uri->segment(3));
				$data['fee_record']=$this->feemodel->getperfeerecord($this->uri->segment(3));
				$data['pageTitle'] = 'Fee collection';
				$data['smallTitle'] = 'Student Fee Collection';
				$data['mainPage'] = 'Fee';
				$data['subPage'] = 'Fee collection';
				$data['title'] = 'Fee collection';
				$data['headerCss'] = 'headerCss/feeCss';
				$data['footerJs'] = 'footerJs/feeJs';
				$data['mainContent'] = 'panel/varificationreport/cc_vreportpanel';
				$this->load->view("includes/mainContent", $data);
			}else{
				$data['stud_id']=0;
				$data['pageTitle'] = 'Fee collection';
				$data['smallTitle'] = 'Student Fee Collection';
				$data['mainPage'] = 'Fee';
				$data['subPage'] = 'Fee collection';
				$data['title'] = 'Fee collection';
				$data['headerCss'] = 'headerCss/feeCss';
				$data['footerJs'] = 'footerJs/feeJs';
				$data['mainContent'] = 'panel/varificationreport/cc_vreportpanel';
				$this->load->view("includes/mainContent", $data);
			}


		}else{
				$data['stud_id']=0;
			$data['pageTitle'] = 'Fee collection';
			$data['smallTitle'] = 'Student Fee Collection';
			$data['mainPage'] = 'Fee';
			$data['subPage'] = 'Fee collection';
			$data['title'] = 'Fee collection';
			$data['headerCss'] = 'headerCss/feeCss';
			$data['footerJs'] = 'footerJs/feeJs';
			$data['mainContent'] = 'collectFee';
			$this->load->view("includes/mainContent", $data);
			}
	}




}

?>