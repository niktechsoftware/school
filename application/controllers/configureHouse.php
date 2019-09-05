<?php 
class configureHouse extends CI_Controller{
	
	function __construct()
	{
		parent::__construct();
		$this->load->model('configurehousemodel');
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
		
		
		$data['column'] = $this->configurehousemodel->houseColumnLIst();
		
		$data['title'] = 'House Configuration';
		$data['headerCss'] = 'headerCss/configureClassCss';
		$data['footerJs'] = 'footerJs/configureHouseJs';
		$data['mainContent'] = 'house/configureHouse';
		$this->load->view("includes/mainContent", $data);
	}

	function addHouse(){
			$stream=$this->input->post('streamName');
			
			$streamList = $this->configurehousemodel->addHouse($stream);
			//print_r($streamList);
			$data['streamList'] = $streamList;
			$this->load->view("ajax/addHouse",$data);
		
	}
	
	function updateHouse(){
		
			
			if($query = $this->configurehousemodel->updateHouse($this->input->post("streamId"),$this->input->post("streamName"))){
				?>
					<script>
					 $.post("<?php echo site_url('index.php/configureHouse/addHouse') ?>", {streamName : ''}, function(data){
				        	 $("#streamList1").html(data);
						});
					</script>
					<?php 
				}	
				
			
	}
	
	function deleteHouse(){
		
		if($query =$this->configurehousemodel->deleteHouse($this->input->post("streamId"))){
			?>
					<script>
					 $.post("<?php echo site_url('index.php/configureHouse/addHouse') ?>", {streamName : ''}, function(data){
				        	 $("#streamList1").html(data);
						});
					</script>
					<?php 
				}
				else
				{?>
				   <script>
					 $.post("<?php echo site_url('index.php/configureHouse/addHouse') ?>", {streamName : ''}, function(data){
				        	 $("#streamList1").html(data);
						});
					</script>
			<?php	}
			
	}

}