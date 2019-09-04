<!-- start: PAGE CONTENT -->
<?php 
$school_code = $this->session->userdata("school_code");
$is_login = $this->session->userdata('is_login');
$is_lock = $this->session->userdata('is_lock');
$logtype = $this->session->userdata('login_type');
?>	

<div style="background-color:green; color:white;" class="form-control"><marquee behavior="alternate" onmouseover="this.stop();" onmouseout="this.start();">

<?php	
echo "Dear Student your remaning fee of month is ";
$tot=0.00;
$this->db->where("school_code",$this->session->userdata("school_code"));
$fsdate = $this->db->get("general_settings");
$fsd=$fsdate->row()->fsd_id;

$this->db->where("id",$fsd);
$fdate =$this->db->get("fsd")->row()->finance_start_date;
$this->db->where("username",$this->session->userdata("username"));
$rows = $this->db->get("student_info")->row();
$stu_id=$rows->id;
$total = $this->db->query("SELECT SUM(paid) as totalpaid, SUM(total) as totaldeposite,invoice_no from fee_deposit WHERE student_id = '$stu_id' AND finance_start_date='$fsd' AND school_code='$school_code'")->row(); 

?>
<?php 
$depmonth=array();
$mbk=0;
	 	$this->db->where('invoice_no',$total->invoice_no); 
	 	$this->db->where('student_id',$stu_id);
     	$mbalance=$this->db->get('feedue');
	 	if($mbalance->num_rows()>0){
	 	if(strlen($mbalance->row()->mbalance)>0){
			$mbk= $mbalance->row()->mbalance;
			
		}}
		$cdate = date("Y-m-d");
		$cmonth = date("Y-m",strtotime($cdate));
		//print_r($stu_id);
		$this->db->where("student_id",$stu_id);
		$dipom = $this->db->get("deposite_months");
		if($dipom->num_rows()>0){
			$g=0;	
				foreach($dipom->result() as $dip):
					$depmonth[$g]=$dip->deposite_month;
					//echo $depmonth[$g];
					$g++;	
				
				endforeach;
					//print_r($depmonth);
			$this->db->where_not_in("month_number",$depmonth);
			$this->db->where("school_code",$school_code);
			$fcd = 	$this->db->get("fee_card_detail");
			if($fcd->num_rows()>0){

				$rt=0;$month="";	
				foreach($fcd->result() as $fcg):
				if($fcg->month_number<4){
					$roldm=$fcg->month_number-4+12;
				}
				else{
					$roldm=$fcg->month_number-4;
				}
		$oldm =  date('Y-m', strtotime("$roldm months", strtotime($fdate)));
		if($oldm<=$cmonth){
			$searchM[$rt]=$fcg->month_number;
	        echo "<b>". date("M-Y",strtotime($oldm)) ."</b>" ;
			$rt++;
        }

		endforeach;
		
	if($rt>0){
	$searchM[$rt]=13;
		//$this->db->distinct();
	
		$this->db->select_sum("fee_head_amount");
		if($school_code ==1){
			$this->db->where("cat_id",3);}
		$this->db->where("fsd",$fsd);
		$this->db->where("class_id",$rows->class_id);
	    $this->db->where_in("taken_month",$searchM);
	    $fee_head = $this->db->get("class_fees");
	 if($fee_head->num_rows()>0){
		 $fee_head =$fee_head->row()->fee_head_amount;
	 echo " and total payble amount is Rs.<b>".$fee_head."</b>";
		
	 }else{
		 echo "fee Not found";								}
 }
}else{
	echo "Define Deposite Date in Configuration Fee section";
}

}else{
	$this->db->where("school_code",$school_code);
	$fcd = 	$this->db->get("fee_card_detail");
	$rt=0;
		$month="";
	foreach($fcd->result() as $fcg):
		if($fcg->month_number<4){
			$roldm=$fcg->month_number-4+12;
		}else{
		$roldm=$fcg->month_number-4;
		}	$oldm =  date('Y-m', strtotime("$roldm months", strtotime($fdate)));
		if($oldm<=$cmonth){
			$searchM[$rt]=$fcg->month_number;
			echo "<b>". date("M-Y",strtotime($oldm)) ."</b>";
			$rt++;
		
      }
	endforeach;

	$adable_amount=0;
  $searchM[$rt]=13;
	//$this->db->distinct();
	$this->db->select_sum("fee_head_amount");
	$this->db->where("fsd",$fsd);
	$this->db->where("class_id",$rows->class_id);
//	print_r($stuDetail->class_id);
if($school_code ==1){$this->db->where("cat_id",3);}
    $this->db->where_in("taken_month",$searchM);
	$fee_head = $this->db->get("class_fees");
	if($fee_head->num_rows()>0){

		$this->db->where("class_id",$rows->class_id);
		//	print_r($stuDetail->class_id);
	
				$this->db->where_in("taken_month",13);
			$one_all_amount = $this->db->get("class_fees");
			$one_all_amount=$one_all_amount->row()->fee_head_amount;
		
			for($ui=0;$ui<$rt;$ui++){
				if($ui>0){
					$adable_amount =$one_all_amount+$adable_amount;
				}
			}
		$fee_head =$fee_head->row()->fee_head_amount+$adable_amount;
	echo " and total payble amount is Rs.<b>".$fee_head."</b>";
//print_r($searchM);
   
	}else{
		echo "fee Not found";}
}

?>

</marquee></div>
<br>
<?php if($this->uri->segment("3") == "noteTrue"){?>
<div class="row">
    <div class="col-md-6 col-lg-12 col-sm-6">
        <div class="panel panel-default panel-white core-box">
			<div class="alert alert-success">
				<button data-dismiss="alert" class="close">
					&times;
				</button>
				<strong>Done!</strong>Your new Note successfully added <a class="alert-link" href="#">
					into database.</a>
			</div>
		</div>
	</div>
</div>
<?php } elseif($this->uri->segment("3") == "noteFalse"){?>
<div class="row">
    <div class="col-md-6 col-lg-12 col-sm-6">
        <div class="panel panel-default panel-white core-box">
			<div class="alert alert-danger">
				<button data-dismiss="alert" class="close">
					&times;
				</button>
				<strong>Oh my god! sorry....</strong>
					Something going wrong contect to <strong>Niktech Software Solutions</strong> for this.... :(
			</div>
		</div>
	</div>
</div>
<?php }?>

<?php if($this->uri->segment("3") == "noteDelTrue"){?>
<div class="row">
    <div class="col-md-6 col-lg-12 col-sm-6">
        <div class="panel panel-default panel-white core-box">
			<div class="alert alert-success">
				<button data-dismiss="alert" class="close">
					&times;
				</button>
				<strong>Done!</strong> Your Note successfully Deleted from database.
			</div>
		</div>
	</div>
</div>
<?php } elseif($this->uri->segment("3") == "noteDelFalse"){?>
<div class="row">
    <div class="col-md-6 col-lg-12 col-sm-6">
        <div class="panel panel-default panel-white core-box">
			<div class="alert alert-danger">
				<button data-dismiss="alert" class="close">
					&times;
				</button>
				<strong>Oh my god! sorry....</strong>
					Something going wrong contect to <strong>Niktech Software Solutions</strong> for this.... :(
			</div>
		</div>
	</div>
</div>
<?php }?>

<!-- ------------------------------------------ All alert codeing end -------------------------------------------- -->

<div class="row">
    <div class="col-md-6 col-lg-4 col-sm-6">
        <div class="panel panel-default panel-white core-box">
            <div class="panel-body no-padding">
                <div class="partition-green padding-20 text-center core-icon">
                    <i class="fa fa-inr fa-2x icon-big"></i>
                </div>
                <a href="<?php echo base_url()?>index.php/feeControllers/stuattendence/<?php echo $stu_id;?>">
	                <div class="padding-20 core-content">
	                	<h3 class="title block no-margin">Attendence Report</h3>
	                	 <br/>
	                	<span class="subtitle"> Find Out Detailed Attendence Reports  </span>
	                </div>
                </a>
            </div>
        </div>
    </div>
   
   <?php $unm=$this->session->userdata("username");
  $this->db->where('username',$unm);
 $dt= $this->db->get('student_info')->row();
 $stud_id=$dt->id;?>
    <div class="col-md-6 col-lg-4 col-sm-6">
        <div class="panel panel-default panel-white core-box">
            <div class="panel-body no-padding">
                <div class="partition-azure padding-20 text-center core-icon">
                    <i class="fa fa-book fa-2x icon-big"></i>
                </div>
                <a href="<?php echo base_url(); ?>index.php/feeControllers/feesDetail/<?php echo $stud_id?>">
                <div class="padding-20 core-content">
                    <h4 class="title block no-margin">Fee Details</h4>
                    <br/>
                    <span class="subtitle">Your Fee Month Wise. </span>
                </div>
                </a>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-lg-4 col-sm-6">
        <div class="panel panel-default panel-white core-box">
            <div class="panel-body no-padding">
                <div class="partition-azure padding-20 text-center core-icon">
                    <i class="fa fa-book fa-2x icon-big"></i>
                </div>
                <a href="<?php echo base_url(); ?>index.php/studentHWControllers/studentShowHomeWork">
                <div class="padding-20 core-content">
                    <h4 class="title block no-margin">Home Work </h4>
                    <br/>
                    <span class="subtitle">Home Work And Project Details. </span>
                </div>
                </a>
            </div>
        </div>
    </div>
    </div>
    <div class="row">
    
 <div class="col-md-6 col-lg-4 col-sm-6">
        <div class="panel panel-default panel-white core-box">
            <div class="panel-body no-padding">
                <div class="partition-red padding-20 text-center core-icon">
                    <i class="fa fa-tasks fa-2x icon-big"></i>
                </div>
               
                <a href="<?php echo base_url(); ?>index.php/singleStudentControllers/leave">
                <div class="padding-20 core-content">
                    <h4 class="title block no-margin">Leave</h4>
                    <br/>
                    <span class="subtitle"> Application. </span>
                </div>
                </a>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-lg-4 col-sm-6">
        <div class="panel panel-default panel-white core-box">
            <div class="panel-body no-padding">
                <div class="partition-red padding-20 text-center core-icon">
                    <i class="fa fa-tasks fa-2x icon-big"></i>
                </div>
               
                <a href="<?php echo base_url(); ?>index.php/singleStudentControllers/examResult/<?php echo $stu_id;?>">
                <div class="padding-20 core-content">
                    <h4 class="title block no-margin">Marks</h4>
                    <br/>
                    <span class="subtitle"> Current Exam Marks </span>
                </div>
                </a>
            </div>
        </div>
    </div>
    
    
</div>



						</div>


<!-- end: PAGE CONTENT-->