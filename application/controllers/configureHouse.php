<?php 
class configureHouse extends CI_Controller{
	
	function __construct()
	{
		parent::__construct();
		$this->is_login();
		
	}

	function is_login(){
		$is_login = $this->session->userdata('is_login');
		$is_lock = $this->session->userdata('is_lock');
		$logtype = $this->session->userdata('login_type');
		if($logtype != "admin"){
			//echo $is_login;
			redirect("index.php/homeController/index");
		}
		elseif(!$is_login){
			//echo $is_login;
			redirect("index.php/homeController/index");
		}
		elseif(!$is_lock){
			redirect("index.php/homeController/lockPage");
		}
	}
	function configureHousepage(){
		$data['pageTitle'] = 'House Configuration';
		$data['smallTitle'] = 'House Configuration';
		$data['mainPage'] = 'House';
		$data['subPage'] = 'House Configuration';
		
		$this->load->model("configurehousemodel");
		$data['column'] = $this->configurehousemodel->houseColumnLIst();
		
		$data['title'] = 'House Configuration';
		$data['headerCss'] = 'headerCss/configureClassCss';
		$data['footerJs'] = 'footerJs/configureHouseJs';
		$data['mainContent'] = 'house/configureHouse';
		$this->load->view("includes/mainContent", $data);
	}



}