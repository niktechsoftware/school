<?php class enterStockController extends CI_Controller{
	
		public function __construct(){
		parent::__construct();
			$this->is_login();
	
	}
	
	
		function is_login(){
		$is_login = $this->session->userdata('is_login');
	
		if(($is_login != true)){
			
			redirect("index.php/homeController/index");
		}
	
	}
	function checkStock(){
		$msg = '<div class="alert alert-info"><button data-dismiss="alert" class="close">&times;</button><strong><h3>New Item Entry :)</h3> </strong></div>';
		$itemNo = $this->input->post("itemNo");
		
		$this->load->model("enterStockModel");
		$var = $this->enterStockModel->checkStock($itemNo);
		if($var->num_rows() > 0){
			foreach ($var->result() as $row){
				$itemData = array(
						"itemName" =>$row->item_name,
						"itemCat" =>$row->item_cat,
						"itemsize" =>$row->item_size,
						"price" =>$row->item_price,
						"itemQuantity"=>$row->item_quantity,
						"msg" => ""
				);
			}
		}
		else{
			$itemData = array(
					"itemName" =>"",
					"itemCat" =>"",
					"itemsize" =>"",
					"price" =>"",
					"itemQuantity"=>"",
					"msg" => $msg
			);
		}
		
		echo (json_encode($itemData));
	}
	
	
	
	function enterStock(){
		$stockData = array(
				"item_no" => $this->input->post("itemNo"),
				"item_name" => $this->input->post("itemName"),
				"item_cat" => $this->input->post("itemCat"),
				"item_size" => $this->input->post("itemSize"),
				"item_price" => $this->input->post("price"),
				"item_quantity" => $this->input->post("itemQuantity"),
				"extraQuantity" => $this->input->post("extraQuantity"),
				"a_date" => date("Y-m-d"),
				"school_code"=>$this->session->userdata("school_code")
		);
		
		$this->load->model("enterStockModel");
		$this->enterStockModel->enterStock($stockData);
		redirect("index.php/login/enterStock");
	}
	
		
	function checkStudID(){ 
			$pBalance = array();
			$tid = $this->input->post("cat");
			$this->load->model("teacherModel");
			$var = $this->teacherModel->checkStudID($tid);
			if($var->num_rows() > 0){
				$row=$var->row();	
					$msg = '<div class="alert alert-success">ID Found ! <strong>'. $row->name.' </strong></div>';
					$pBalance['msg'] = $msg;
					$pBalance['indicator'] = "true";
					
					$valid_id = $this->teacherModel->checkBal($tid);
					if($valid_id->num_rows() > 0){
						foreach ($valid_id->result() as $row){
							$pBalance['balance'] = $row->balance;
						}
					}
					echo (json_encode($pBalance));
			}
			else{
				$msg = '<div class="alert alert-danger">Sorry :( <strong> Student Not Found ! Wrong Student Id !</strong></div>';
				$pBalance['msg'] = $msg;
				$pBalance['balance'] = '';
				$pBalance['indicator'] = "false";
				echo (json_encode($pBalance));
			}
			
		}
	function checkempID(){
			$pBalance = array();
			$tid = $this->input->post("teacherid");
			$this->load->model("teacherModel");
			$var = $this->teacherModel->checkID($tid);
			if($var->num_rows() > 0){
				foreach ($var->result() as $row){
					$msg = '<div class="alert alert-success">ID Found ! <strong>'. $row->name.' </strong></div>';
					$pBalance['msg'] = $msg;
					$pBalance['indicator'] = "true";
					}
					$valid_id = $this->teacherModel->checkBal($tid);
					if($valid_id->num_rows() > 0){
						foreach ($valid_id->result() as $row){
							$pBalance['balance'] = $row->balance;
						}
					}
					echo (json_encode($pBalance));
			}
				else{
				$msg = '<div class="alert alert-danger">Sorry :( <strong> Employee Not Found ! Wrong Employee Id !</strong></div>';
				$pBalance['msg'] = $msg;
				$pBalance['balance'] = '';
				$pBalance['indicator'] = "false";
				echo (json_encode($pBalance));
			}
			
			
		}
		function getTData(){
			$tid = $this->input->post("name");
		//	print_r($tid);exit();
			$this->load->model("enterStockModel");
			$var = $this->enterStockModel->getItemName($tid);
			
			if($var->num_rows() > 0){
				foreach ($var->result() as $row){
					$itemData = array(
							"itemName" =>$row->item_name,
							"itemCat" =>$row->item_cat,
							"itemsize" =>$row->item_size,
							"price" =>$row->item_price,
							"qunatity" =>$row->item_quantity,
							);
						//	print_r($itemData);exit();
				}		
				}
				echo (json_encode($itemData));
		}
		
		function saleStock(){
		    $school_code = $this->session->userdata("school_code");

			$this->db->where("school_code",$school_code);
			$billno = $this->db->count_all("invoice_serial");

		//print_r($billno);exit();

			$this->load->model("daybookModel");
			$this->load->model("enterStockModel");
			$this->db->where("school_code",$school_code);
		$invoice = $this->db->get("invoice_serial");
		$invoice1=6000+$invoice->num_rows();
		$invoice_number = $school_code."I19".$invoice1;
	     	$billno = $invoice_number;
	     		$invoiceDetail = array(
				"invoice_no" => $invoice_number,
				"reason" => "Stock Sale",
				"invoice_date" => date('Y-m-d'),
				"school_code"=>$school_code
		);
		$this->db->insert("invoice_serial",$invoiceDetail);
		
				$validID = "";
				if(strlen($this->input->post("studID"))>0){
					$stid = $this->input->post("studID");
					$this->db->where('username',$stid);
					$validID= $this->db->get('student_info')->row()->id;
					$data2 = array(
							"bill_no"=>$billno,
							"valid_id"=>$validID
					);
				//	$this->enterStockModel->updatebill($data2);
				}
				else if(strlen($this->input->post("empID"))>0){
					$emid = $this->input->post("empID");
					
						$this->db->where('username',$emid);
						$this->db->where('school_code',$school_code);
					$validID= $this->db->get('employee_info')->row()->id;
					
					$data2 = array(
							"bill_no"=>$billno,
							"valid_id"=>$validID
					);
				
					//$this->enterStockModel->updatebill($data2);
				}else {
					$validID=$this->input->post("empFirstName");
					$emp_phone=$this->input->post("empphone");
					$data2 = array(
							"bill_no"=>$billno,
							"valid_id"=>$validID,
							"phone_no"=>$emp_phone
					);
				}
				
				//$this->db->select("closing_balance as cb");
				$this->db->where("school_code",$this->session->userdata("school_code"));
				$this->db->where("opening_date",date("Y-m-d"));
				$cb = $this->db->get("opening_closing_balance");
    //     	$this->db->where("school_code",$this->session->userdata("school_code"));
				// $this->db->where("pay_date",date("Y-m-d"));
				// $cb = $this->db->get("day_book");
             $dt= $cb->row()->closing_balance;
				$cl_balance = $dt + $this->input->post("paid");
				$cbData = array(
					"closing_balance" => $cl_balance
				);
				$this->db->where("school_code",$this->session->userdata("school_code"));
				$this->db->where("opening_date",date("Y-m-d"));
				$this->db->update("opening_closing_balance",$cbData);
				$daybook=array(
						"amount" => $this->input->post("paid"),
						"pay_date"=> date("Y-m-d"),
						"reason" =>"From sale Stock",
						"pay_mode"=>1,
						"invoice_no"=>$billno,
						"closing_balance" => $cl_balance,
						"paid_to" => $this->session->userdata("username"),
						"dabit_cradit"=> 1,
						"paid_by"=> $validID,
						"school_code"=>$this->session->userdata("school_code")
				);
				$daybook1 = $this->daybookModel->fromStock($daybook);

			for($i=1; $i<=15;$i++)
			{
			if($this->input->post("item_no$i")>0)
			{
				$data = array(
						"item_no" => $this->input->post("item_no$i"),
						"pries_per_item" => $this->input->post("item_price$i"),
						"item_quant" => $this->input->post("item_quantity$i"),
						"dis" => $this->input->post("item_discount$i"),
						"dis_rs" => $this->input->post("discount$i"),
						"total_price" => $this->input->post("total_price$i"),
						"sub_total" => $this->input->post("sub_total$i"),
					    	//"previous_balance" => $this->input->post("p_balance"),
					     	"category" => $this->input->post("category"),
					             	"valid_id" => $validID,
						//"name" => $this->input->post("empFirstName"),
						"phone_no"=> $this->input->post("empphone"),
						"date"=> date("Y-m-d"),
						"bill_no" =>$billno,
						"school_code"=>$this->session->userdata("school_code")
					);
		
				
				// $this->db->where("bill_no",$billno);
				// $var1 =$this->db->update("sale_info",$data);

			//	print_r($data);exit();
				$var1 = $this->enterStockModel->saleEntry($data);
			
			   }
			}
				 $bal = array(
               	"paid" => $this->input->post("paid"),
               	"total"=> $this->input->post("tt"),
                "balance" =>$this->input->post("balance"),      
                 "date"=> date("Y-m-d"),
				 "billno" =>$billno,
				 "valid_id" => $validID
               );

					$this->db->insert("sale_balance",$bal);
					
				if($this->input->post("category") =='Student Id'){

				    $this->db->where('username',$this->input->post("studID"));
				    $student=$this->db->get('student_info')->row();

				     $this->db->where('student_id',$student->id);
				     $this->db->where('school_code',$this->session->userdata('school_code'));
                      $studentfee=$this->db->get('feedue');
                      if($studentfee->num_rows()>0)
                      { 
                      	$fee=$studentfee->row();
                        $up=array(
                        	'mbalance'=>$fee->mbalance+$this->input->post("balance"),
                             'updatedate'=> date("Y-m-d"),
                             'description'=>'Form Sale Balance',
                        );
                         $this->db->where('student_id',$student->id);
                        $upadte=$this->db->update('feedue',$up);
                      }
                      
                      else
                      {
                        $ines=array(
                        	'student_id'=>$student->id,
                        	'mbalance'=>$this->input->post("balance"),
                             'updatedate'=> date("Y-m-d"),
                             'depositedate'=>date("Y-m-d"),
                             'description'=>'Form Sale Balance',
                             'school_code'=>$this->session->userdata('school_code'),
                          );
                          $inserttt=$this->db->insert('feedue',$ines);
                      }

										}


					if($var1):
					//	$var = $this->enterStockModel->getItemName1($data);
					$this->db->where("school_code",$this->session->userdata("school_code"));
	      	$this->db->where("bill_no",$billno);
	      	$var = $this->db->get("sale_info");
						if($var->num_rows() > 0):

							foreach ($var->result() as $row):

								$this->db->where("school_code",$this->session->userdata("school_code"));
								$this->db->where("item_no",$row->item_no);
								$row1 = $this->db->get("enter_stock")->row();
								$q = $row1->item_quantity;
								$itemno = $row1->item_no;
								$data1 = array(
									"item_quantity" => ($q - $row->item_quant),
									// "item_no" =>  $data["item_no"]
								);

								$this->enterStockModel->updateStock1($data1,$itemno);
							endforeach;
						endif;
					endif;
			
	 
		
					if($var1||$var)
					{
					$invoiceData = array(
						"invoice_no" => $billno,
						"reason" => "Sale Invoice",
						"invoice_date" => date("Y-m-d"),
							"school_code"=>$this->session->userdata("school_code")
					);
						$this->db->insert("invoice_serial",$invoiceData);
						
						//---------------------------------------------- CHECK SMS SETTINGS -----------------------------------------
						$paid1 = $this->input->post("paid");
						$total= $this->input->post("tt");
						$balance =  $this->input->post("balance");
						
						$val=$this->db->get("sms_setting")->row();
						$senderiD=$val->sender_id;
						$authkey=$val->auth_key;
						
						$isSMS = $this->db->get("sms")->row()->purchase;
						
						if($isSMS=="yes")
						{
							$this->load->helper("sms");
							if(strlen($this->input->post("studID"))>0){
								$validID = $this->input->post("studID");
								$this->db->where("school_code",$this->session->userdata("school_code"));
								$this->db->where("student_id",$validID);
								$var=$this->db->get("guardian_info")->row();
								
								$this->db->where("school_code",$this->session->userdata("school_code"));
								$this->db->where("student_id",$validID);
								$this->db->where("status","Active");
								$stu=$this->db->get("student_info")->row();
								
								$fname=$var->father_full_name;
								$fmobile=$var->f_mobile;
								$msg="Hi ".$stu->first_name.". Thank you for purchasing. Your total bill is Rs.".$total."/- and paid Rs.".$paid1." with balance Rs.".$balance."/-. For more information. Please logon to Your Account : ".$val->web_url;
								mysms($authkey, $msg,$senderiD,$fmobile);
								
							}
							else if(strlen($this->input->post("empID"))>0){
								$validID = $this->input->post("empID");
								$this->db->where("school_code",$this->session->userdata("school_code"));
								$this->db->where("username",$validID);
								$stu =$this->db->get("employee_info")->row();
								$fmobile=$stu->mobile;
								$msg="Hi ".$stu->first_name.". Thank you for purchasing. Your total bill is Rs.".$total."/- and paid Rs.".$paid1." with balance Rs.".$balance."/-. For more information. Please logon to Your Account : ".$val->web_url;
								mysms($authkey, $msg,$senderiD,$fmobile);
							
							
							}else {
								$empname1=$this->input->post("empFirstName");
								$emp_phone=$this->input->post("empphone");
								$msg="Hi ".$empname1.". Thank you for purchasing. Your total bill is Rs.".$total."/- and paid Rs.".$paid1." with balance Rs.".$balance."/-. For more information. Please logon to Your Account : ".$val->web_url;
								mysms($authkey, $msg,$senderiD,$emp_phone);
							}
							
						//---------------------------------------------- END CHECK SMS SETTINGS -----------------------------------------
						}
						
							redirect("index.php/invoiceController/printSaleReciept/$billno");
						
					}
	}
	
    function editSaleStock(){

    $billno = $this->input->post("billNo");
    $this->db->where("bill_no",$billno);
   $dt= $this->db->get("sale_info")->row();
  	for($i=1; $i<=15;$i++){
    $data = array(
				//"item_no" => $this->input->post("item_no$i"),

				//"pries_per_item" => $this->input->post("item_price.$i"),
				"item_quant" => $this->input->post("item_quantity$i"),
				"dis" => $this->input->post("item_discount$i"),
				"dis_rs" => $this->input->post("discount$i"),
				"total_price" => $this->input->post("total_price$i"),
				"sub_total" => $this->input->post("sub_total$i"),
				"phone_no"=> $this->input->post("empphone"),
				"date"=> date("Y-m-d"),
				);
  	       $sale =array(
             "total"=> $this->input->post("tt"),
				"paid" => $this->input->post("paid"),
				"date"=> date("Y-m-d"),
				"balance" =>  $this->input->post("balance")  
  	    );
  	    echo $this->input->post("total_price$i");
  	   exit();
        //  $saleentry= $this->enterstockmodel->updatesaleEntry($data,$billno);
         $this->db->where("bill_no",$billno);
	      $query2 = $this->db->update("sale_info", $data);
	       $this->db->where("billno",$billno);
	      $query2 = $this->db->update("sale_balance", $sale);
//print_r($dt->valid_id);
//print_r($billno);exit();
	                $this->db->where('username',$dt->valid_id);

				    $student=$this->db->get('student_info');

							if($student->num_rows()>0){
								$student= $student->row();
                        $this->db->where('student_id',$student->id);
				         $this->db->where('school_code',$this->session->userdata('school_code'));
                        $studentfee=$this->db->get('feedue');
                      if($studentfee->num_rows()>0)
                      { 
                      	$fee=$studentfee->row();
                        $up=array(
                        	'mbalance'=>$fee->mbalance+$this->input->post("balance"),
                             'updatedate'=> date("Y-m-d"),
                             'description'=>'Form Sale Balance',
                        );
                        $this->db->where('student_id',$student->id);
                        $upadte=$this->db->update('feedue',$up);
                      }
                      else
                      {
                        $ines=array(
                        	'student_id'=>$student->id,
                        	'mbalance'=>$this->input->post("balance"),
                             'updatedate'=> date("Y-m-d"),
                             'depositedate'=>date("Y-m-d"),
                             'description'=>'Form Sale Balance',
                             'school_code'=>$this->session->userdata('school_code'),
                          );
                          $inserttt=$this->db->insert('feedue',$ines);
                      }

              
                        	}


  	}
  	$this->db->where("school_code",$this->session->userdata("school_code"));
				//$this->db->where("opening_date",date("Y-m-d"));
				$cb = $this->db->get("opening_closing_balance")->row()->closing_balance;
                
				$cl_balance = $cb + $this->input->post("paid");
				$cbData = array(
					"closing_balance" => $cl_balance
				);
				$this->db->where("school_code",$this->session->userdata("school_code"));
				$this->db->where("opening_date",date("Y-m-d"));
				$this->db->update("opening_closing_balance",$cbData);
				
    	$daybook=array(
						"amount" => $this->input->post("paid"),
						"pay_date"=> date("Y-m-d"),
						"reason" =>"From sale Stock",
					//	"pay_mode"=>"Cash, ".$billno,
						"closing_balance" => $cl_balance,
					//	"paid_to" => $validid,
						"paid_by"=> $this->session->userdata("username"),
					//	"school_code"=>$this->session->userdata("school_code")
				);
			//	$daybook1 = $this->daybookModel->fromStock1($daybook,$billno);
             $this->db->where('invoice_no',$billno);
	         $this->db->where('reason',"From sale Stock");
	    	$query = $this->db->update("day_book", $daybook);
		 // print_r($query2);
			redirect("index.php/invoiceController/printSaleReciept/$billno");
		
}
}
?>