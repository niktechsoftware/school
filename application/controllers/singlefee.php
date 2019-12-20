<?php
Class Singlefee extends CI_Controller{

  function _construct(){

    parent::__construct();
		$this->is_login();
     $this->load->model("feemodel");
     $this->load->model("teacherModel");
        $this->load->model("allFormModel");
        $this->load->model("configureclassmodel");
        $this->load->model("smsmodel");

  }


	function is_login(){
		$is_login = $this->session->userdata('is_login');
		$is_lock = $this->session->userdata('is_lock');
		$logtype = $this->session->userdata('login_type');
		if(($logtype == "admin")||($logtype == "2")||($logtype == "3")||($logtype == "9")||($logtype == "1")){
			
	
		} else{
		    	redirect("index.php/homeController/index");
		}
		
	if(!$is_login){
			//echo $is_login;
			redirect("index.php/homeController/index");
		}
		elseif(!$is_lock){
			redirect("index.php/homeController/lockPage");
		}
	}


  function checkstudent(){
    $this->load->model("feemodel");
    $stuid=$this->input->post("stuid");
    // $feedt=$this->feemodel->checkstuid1($stuid);
    // if($feedt->num_rows()>0){  
      ?>
      <option value="">-Select Fee-</option>
    <?php // foreach($feedt->result() as $feehead): ?>
      
      <!-- <option value="<?= $feehead->id ;?>"><?= $feehead->fee_head_name ; ?></option> -->
     <?php //  endforeach;
     $this->db->where("username",$stuid);
     $studentdt=$this->db->get("student_info");
     if($studentdt->num_rows()>0){
       if($studentdt->row()->transport==1){ ?>
        <option value="tfee">Transport Fee</option>
       <?php // $this->db->where("class_id",$studentdt->v_id);
        // $classfee=	$this->db->get("transport_root_amount");
       }
     }
   // }

  }

  function getfeemonth(){
    $this->db->where("school_code",$this->session->userdata("school_code"));
    $this->db->where("id",$this->session->userdata("fsd"));
    $fsddate=$this->db->get("fsd");

      $feehead =$this->input->post("feehead");
      $stuid=$this->input->post("stuid");
      $this->db->where("username",$stuid);
      $studentdt=$this->db->get("student_info");
      if($studentdt->num_rows()>0){
      $this->db->where("stu_id",$studentdt->row()->id);
      $this->db->where("school_code",$this->session->userdata("school_code"));
     $transfee= $this->db->get("transport_fee_month");
     $arr=array(1,2,3,4,5,6,7,8,9,10,11,12);
     $asize=sizeof($arr);
     
    
     if($transfee->num_rows()>0){
      
      $j=0;
      foreach($arr as $tfee):
         print_r($tfee);
         
        // for($i=0 ; $i <=$asize-1; $i++){
        //   if($arr[$i]==$tfee->month){
        //     echo "</pre>";
        //     // print_r($arr[$i]);
        //     // echo "ggg";
        //     array_splice($arr, $arr[$i-1], 1);  
  
        //     // Print modified array 
        //    $arr= var_dump($arr); 
           
            
        //   }else{
               
        //   }


        // }
      
      

      //   $deposite_month =$tfee->month-4;
      //   $rdt =date('Y-m-d', strtotime("$deposite_month months", strtotime($fsddate)));
      //   //$rdt = "01-".$fd->month_number."-2019";
      //   echo date("M-y",strtotime("$rdt"));
      //   echo "bbbb";
      //   exit;


      $j++; endforeach;
      print_r($arr);
      exit;

     }else{
      
     }
     

  }
}


}


?>