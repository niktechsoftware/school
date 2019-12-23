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
     
     $arr=array(1,2,3,4,5,6,7,8,9,10,11,12);
     $asize=sizeof($arr);
    
      
      $j=0; ?>
      <option>-Select Month-</option>
     <?php foreach($arr as $tfee):
       //  print_r($tfee);
         $this->db->where("stu_id",$studentdt->row()->id);
         $this->db->where("month",$tfee);
         $this->db->where("school_code",$this->session->userdata("school_code"));
        $transfee= $this->db->get("transport_fee_month");
 
    
        if($transfee->num_rows()>0){
          if($tfee== $transfee->row()->month)
          {
             
          }
          else{
          
           $month_name = date("F", mktime(0, 0, 0, $tfee, 10));

           ?>
           <option value="<?= $tfee ;?>"><?php echo  $month_name; ?></option>
         <?php }

        }
        else{
         
          $month_name = date("F", mktime(0, 0, 0, $tfee, 10));

          ?>
          <option value="<?= $tfee ;?>"><?php echo  $month_name; ?></option>


       <?php  }
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
      // print_r($arr);
      // exit;

    

  }
}


function getfeedata(){
$data['month']= $this->input->post("monnumber");
 $data['stuid'] =$this->input->post("stuid");
 $this->load->view("pay_indivisualfee",$data);

}

function payfee(){
 $school_code=  $this->session->userdata("school_code");
//  print_r($this->session->userdata);
//  exit;
  $studusername= $this->input->post("stud_username");
  $studid= $this->input->post("student_id");
  $month= $this->input->post("paymonth");
  $total_amount= $this->input->post("tfee");
  $paid_amount=$this->input->post("paidfee");

  $this->db->where("school_code",$school_code);
  $invoice = $this->db->get("invoice_serial");
  $invoice1=6000+$invoice->num_rows();
  $invoice_number = $school_code."I19".$invoice1;
 
  	//---------------------------------------------- Invoice SErial Start-------------------------------------------
			
		
  $invoicedata=array(
    "invoice_no" => $invoice_number,
    "reason"=>"Indi. transport fee",
    "invoice_date"=>date("y-m-d H:i:s"),
    "school_code"=>$school_code
  );
  
  $this->db->insert("invoice_serial",$invoicedata);
  	//---------------------------------------------- Invoice Serial  End -------------------------------------------
      
    $tranportdat=array(
      "stu_id"=>$studid,
      "month"=>$month,
      "total_amount"=>$total_amount,
      "paid_amount"=>$paid_amount,
      "invoice_number"=>$invoice_number,
      "school_code"=>$school_code,
      "date"=>date("y-m-d")

    );
		
	//---------------------------------------------- Opening Colsing Balance Start -----------------------------------------

  
  $this->db->where("school_code",$school_code);
  $this->db->where("opening_date",date('Y-m-d'));
  $open =$this->db->get("opening_closing_balance")->row();
		$balance = $open->closing_balance;
    $close1 = $balance + $paid_amount;
    
    $bal = array(
      "closing_balance" => $close1
  );
  $this->db->where("school_code",$school_code);
  $this->db->where("opening_date",date('Y-m-d'));
  $this->db->update("opening_closing_balance",$bal);
	//---------------------------------------------- Opening Colsing Balance End -------------------------------------------
			
		//---------------------------------------------- Daybook Start-------------------------------------------
			
			
  $daybook=array(
    "paid_to" =>$this->session->userdata("username"),
    "paid_by"=>$studid,
    "dabit_cradit"=>1,
    "amount"=>$paid_amount,
    "closing_balance"=>$close1,
    "invoice_no"=>$invoice_number,
    "school_code"=>$school_code

  );

  
  if(($this->db->insert("transport_fee_month",$tranportdat)) && ($this->db->insert("day_book",$daybook)) ){
   
    $data['stuid']=$studid;
    $data['month']=$month;
    $data['invoice']=$invoice_number;

    $data['pageTitle'] = 'Sale Invoice';
		$data['smallTitle'] = 'Sale Invoice';
		$data['mainPage'] = 'invoice';
		$data['subPage'] = 'Print Sale Invoice';
		$data['title'] = 'Print Sale Invoice';
		$data['headerCss'] = 'headerCss/configureClassCss';
		$data['footerJs'] = 'footerJs/configureClassJs';
		$data['mainContent'] = 'tranposrt_invoice';
		$this->load->view("includes/mainContent", $data);
    
  }else{
    
  }

  	//---------------------------------------------- Daybook End -------------------------------------------
			
		
}
  function tfeeInvoice(){
    $data['stuid']=$this->uri->segment(3);
    $data['month']= $this->uri->segment(4);
    $data['invoice']= $this->uri->segment(5);
    $this->load->view("print_transportinvoice",$data);
  } 

}


?>