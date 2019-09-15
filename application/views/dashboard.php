<!-- start: PAGE CONTENT -->
<?php
$school_code = $this->session->userdata("school_code");

?>


<?php if($this->uri->segment("3") == "noteTrue"){?>
<div class="row">
  <div class="col-md-6 col-lg-12 col-sm-6">
    <div class="panel panel-default panel-white core-box">
      <div class="alert alert-success">
        <button data-dismiss="alert" class="close">
          &times;
        </button>
        <strong>Done!</strong> Your new Note successfully added <a class="alert-link" href="#">
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
        Something going wrong contect to <strong>NIKTECH SOFTWARE SOLUTIONS</strong> for this.... :(
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
        Something going wrong contect to <strong>NIKTECH SOFTWARE SOLUTIONS</strong> for this.... :(
      </div>
    </div>
  </div>
</div>
<?php }?>

<!-- ------------------------------------------ All alert codeing end -------------------------------------------- -->

<div class="row">
  <div class="col-md-6 col-lg-3 col-sm-6">
    <div class="panel panel-default panel-white core-box">
      <div class="panel-body no-padding">
        <div class="partition-green text-center core-icon">
          <i class="fa fa-inr fa-2x icon-big"></i><br>


        </div>
        <a href="<?php echo base_url(); ?>index.php/login/feeReport">
          <div class="padding-20 core-content">
            <!--	<h3 class="title block no-margin">Fee Reports</h3>-->
            <h3 class="title block no-margin">Today Collection</h3>
            <br />
            <div class="row">
              <div class="col-sm-6">
                <h6 class="block no-margin">Today Fees Collection</h6>
                </br>
                <mark><?php 
					
					 echo $totalIncome;
					?>
                </mark>
              </div>
              <div class="col-sm-6">
                <h6 class="block no-margin">Today Stock</h6>
                </br>
                <mark><?php 
					$camount=0;
					 $school_code=   $this->session->userdata("school_code");
					 $this->db->select_sum("sub_total");
					 $this->db->where('school_code',$school_code);
					 $this->db->where('date(date)',date('Y-m-d'));
				//	 $this->db->where('dabit_cradit',1);
					$stocktotal=$this->db->get('sale_info')->row();
					if($stocktotal->sub_total){
           echo $stocktotal->sub_total;
          } 
          else{
            echo "0";
          }
                    ?>
                </mark>
              </div>
            </div>

          </div>
        </a>
      </div>
    </div>
  </div>
  <div class="col-md-6 col-lg-3 col-sm-6">
    <div class="panel panel-default panel-white core-box">
      <div class="panel-body no-padding">
        <div class="partition-azure text-center core-icon">
          <i class="fa fa-book fa-2x icon-big"></i>

        </div>
        <a href="<?php echo base_url(); ?>index.php/login/daybook">
          <div class="padding-20 core-content">
            <!-- <h4 class="title block no-margin">DayBook</h4>-->
            <h4 class="title block no-margin">Today DayBook</h4>
            <br />
            <div class="row">
              <div class="col-sm-6">
                <h6 class="block no-margin">Debit Amount</h6>
                <mark><?php 
					$damount=0;
					 $school_code=   $this->session->userdata("school_code");
					 $this->db->where('school_code',$school_code);
					 $this->db->where('date(pay_date)',date('Y-m-d'));
					 $this->db->where('dabit_cradit',0);
					 $debit_amount=$this->db->get('day_book');
					 foreach($debit_amount->result() as $dm){
						 $damount=$damount + $dm->amount;
					 }
					 echo $damount;
					?>
                </mark>
              </div>
              <div class="col-sm-6">
                <h6 class="block no-margin">Credit Amount</h6>
                <mark><?php 
					$camount=0;
					 $school_code=   $this->session->userdata("school_code");
					 $this->db->where('school_code',$school_code);
					 $this->db->where('date(pay_date)',date('Y-m-d'));
					 $this->db->where('dabit_cradit',1);
					 $credit_amount=$this->db->get('day_book');
					 foreach($credit_amount->result() as $cm){
						 $camount=$camount + $cm->amount;
					 }
					 echo $camount;
                    ?>
                </mark>
              </div>
            </div>


          </div>
        </a>
      </div>
    </div>
  </div>

  <div class="col-md-6 col-lg-3 col-sm-6">
    <div class="panel panel-default panel-white core-box">
      <div class="panel-body no-padding">
        <div class="partition-pink text-center core-icon">
          <i class="fa fa-users fa-2x icon-big"></i>
          <br>
          <span class="subtitle"> <?php 
											$date=Date("Y-m-d");
											$this->db->select_sum("amount");
											//$x= $this->db->from("cash_payment");
                    	$this->db->where("school_code",$this->session->userdata("school_code"));
			                 $this->db->where("date",$date); 
		                   $info = $this->db->get('cash_payment')->row();
									
                    	?> </span>
        </div>
        <a href="<?php echo base_url(); ?>index.php/login/daybook">
          <div class="padding-20 core-content">
            <h4 class="title block no-margin">Today Expenditure</h4>
            <br />
            <span class="subtitle"> <mark><?php if($info->amount){ echo $info->amount; } else{ echo "0"; }?> </mark></span>
          </div>
        </a>
      </div>
    </div>
  </div>

  <div class="col-md-6 col-lg-3 col-sm-6">
    <div class="panel panel-default panel-white core-box">
      <div class="panel-body no-padding">
        <div class="partition-blue text-center core-icon">
          <i class="fa fa-users fa-2x icon-big"></i>

          </span>
        </div>
        <a href="<?php echo base_url(); ?>index.php/login/daybook">
          <div class="padding-20 core-content">
            <!-- <h4 class="title block no-margin">Student Admission</h4>-->
            <h4 class="title block no-margin">Today Business</h4><br>
            <div class="row">
              <div class="col-sm-6">
                <h6 class="block no-margin">Today Opening</h6>
                </br>
                <mark><?php 
                $date=Date("Y-m-d");
						$this->db->select('opening_balance');
						$this->db->where("school_code",$school_code);
						$this->db->where("Date(closing_date)",$date);
							$data=$this->db->get('opening_closing_balance')->row();
						//	$this->db->join('class_info','class_info.id=student_info.class_id');
						
							
						
							echo $data->opening_balance ;?></mark>
              </div>
              <div class="col-sm-6">
                <h6 class="block no-margin">Today Closing</h6>
                </br>
                <mark> <?php  $date=Date("Y-m-d");
						$this->db->select('closing_balance');
						$this->db->where("school_code",$school_code);
						$this->db->where("Date(closing_date)",$date);
							$data1=$this->db->get('opening_closing_balance')->row();
							echo $data1->closing_balance ; ;?></mark>
              </div>
            </div>

          </div>
        </a>
      </div>
    </div>
  </div>

  <!--<div class="col-md-6 col-lg-3 col-sm-6">-->
  <!--        <div class="panel panel-default panel-white core-box">-->
  <!--            <div class="panel-body no-padding">-->
  <!--                <div class="partition-red padding-20 text-center core-icon">-->
  <!--                    <i class="fa fa-tasks fa-2x icon-big"></i>-->
  <!--                </div>-->
  <!--                <a href="<?php echo base_url(); ?>index.php/login/schedulingReport">-->
  <!--                <div class="padding-20 core-content">-->
  <!--                    <h4 class="title block no-margin">Time Table</h4>-->
  <!--                    <br/>-->
  <!--                    <span class="subtitle"> Access the time table. </span>-->
  <!--                </div>-->
  <!--                </a>-->
  <!--            </div>-->
  <!--        </div>-->
  <!--    </div>-->
</div>
<!--1st row end-->
<!--2nd row start-->
<div class="row">
<div class="col-md-6 col-lg-3 col-sm-6">
        <div class="panel panel-default panel-white core-box">
            <div class="panel-body no-padding">
                <div class="partition-pink text-center core-icon">
                    <i class="fa fa-users fa-2x icon-big"></i>
                     <br>
                    	<span class="subtitle"> <?php 
                    	$this->db->where("school_code",$this->session->userdata("school_code"));
			            $this->db->where("status",1); 
			             $this->db->where("job_category",3);
		                 $info = $this->db->get("employee_info")->num_rows();
		                 echo $info ;
                    	?>  </span>
                </div>
                <a href="<?php echo base_url(); ?>index.php/login/classteacher">
                <div class="padding-20 core-content">
                    <h4 class="title block no-margin">Total Teachers</h4>
                    <br/>
                    <span class="subtitle"> Access To Class Teachers. </span>
                </div>
                </a>
            </div>
        </div>
    </div>
	<div class="col-md-6 col-lg-3 col-sm-6">
        <div class="panel panel-default panel-white core-box">
            <div class="panel-body no-padding">
                <div class="partition-blue text-center core-icon">
                    <i class="fa fa-users fa-2x icon-big"></i>
                   </div>
                <a href="<?php echo base_url(); ?>index.php/login/newAdmission">
				<div class="padding-20 core-content">
				   <!-- <h4 class="title block no-margin">Student Admission</h4>-->
				   <h4 class="title block no-margin"> New Registration</h4><br>
				   <div class="row">
					   <div class="col-sm-6">
					   <h6 class="block no-margin">Total Students</h6>
						<?php //$fsd = $this->session->userdata("fsd");
						$this->db->select('*');
							$this->db->from('student_info');
							$this->db->join('class_info','class_info.id=student_info.class_id');
							$this->db->where("class_info.school_code",$school_code);
							$query=$this->db->get();
							echo $query->num_rows() ;?>
					   </div>
					   <div class="col-sm-6">
					   <h6 class="block no-margin">Current Year Students</h6>
					   <?php $fsd = $this->session->userdata("fsd");
						$this->db->select('*');
							$this->db->from('student_info');
							$this->db->join('class_info','class_info.id=student_info.class_id');
							$this->db->where("class_info.school_code",$school_code);
							$this->db->where("student_info.status",1);
							$this->db->where("student_info.fsd",$fsd);
							$query=$this->db->get();
							echo $query->num_rows() ;?>
					   </div>
				   </div>
				  
                </div>
                </a>
            </div>
        </div>
    </div>
    </div>
    <!--2nd row end-->
<div class="row">

<div class="col-md-4 col-lg-4">
      <div class="panel panel-dark">
        <div class="panel-heading">
          <h4 class="panel-title">Today Attendance Report</h4>
          <div class="panel-tools">
            <div class="dropdown">
              <a data-toggle="dropdown" class="btn btn-xs dropdown-toggle btn-transparent-white">
                <i class="fa fa-cog"></i>
              </a>
              <ul class="dropdown-menu dropdown-light pull-right" role="menu">
                <li>
                  <a class="panel-collapse collapses" href="#"><i class="fa fa-angle-up"></i> <span>Collapse</span> </a>
                </li>
                <li>
                  <a class="panel-refresh" href="#">
                    <i class="fa fa-refresh"></i> <span>Refresh</span>
                  </a>
                </li>
                <li>
                  <a class="panel-config" href="#panel-config" data-toggle="modal">
                    <i class="fa fa-wrench"></i> <span>Configurations</span>
                  </a>
                </li>
                <li>
                  <a class="panel-expand" href="#">
                    <i class="fa fa-expand"></i> <span>Fullscreen</span>
                  </a>
                </li>
              </ul>
            </div>
            <a class="btn btn-xs btn-link panel-close" href="#">
              <i class="fa fa-times"></i>
            </a>
          </div>
        </div>
        <div class="panel-body no-padding">
          <div class="partition-green padding-15 text-center">
            <h4 class="no-margin">Attendance Report</h4>
          </div>
          <div id="accordion" class="panel-group accordion accordion-white no-margin">
            <div class="panel no-radius">
              <div class="panel-heading">
                <h4 class="panel-title">
                  <a href="#collapseOne1" data-parent="#accordion" data-toggle="collapse"
                    class="accordion-toggle padding-15">
                    <i class="icon-arrow"></i>

                    <?php $new = $this->db->query("SELECT * FROM cash_payment WHERE date='".date("Y-m-d")."' AND school_code='$school_code'")->num_rows();?>
                    Today Student Attendance <?php if($new > 0):?> <span
                      class="label label-danger pull-right"><?php echo $new;?></span><?php endif;?>

                  </a></h4>
              </div>
              <div class="panel-collapse collapse in" id="collapseOne1">
                <div class="panel-body no-padding partition-light-grey">
                  <a href="<?php echo base_url()?>index.php/login/dayBook">
                    <table class="table">
                    <thead>
                    <th>Sno.</th>
                    <th>Section Name</th>
                    <th>Class Name</th>
                    <th>Total Student</th>
                    <th>Present Student</th>
                    <th>Absent Student</th>
                    </thead>
                      <tbody>
                        <?php $i=1;?>
                        <?php $count=0;
                        $totstu=0;
                     

                      
                      
                         $this->db->where("school_code",$school_code);
                       // $this->db->where("section",$sectiondt->id);
                       $classdt= $this->db->get("class_info");
                     if($classdt->num_rows()>0){
                        
                         foreach($classdt->result() as $sectiondt):
                            //  print_r($sectiondt);
                            // exit();
                          $this->db->where("id",$sectiondt->section);
                          $data= $this->db->get("class_section");
                         if($data->num_rows()>0){
                              
                         $this->db->where("class_id",$sectiondt->id);
                         $studata=$this->db->get("student_info");
                         $totstudent= $studata->num_rows();
                        // echo "<pre>";
                      //  print_r($studata->row());
                         $totstu=$totstu+$totstudent;
                      if($studata->num_rows()>0){
                             $date=Date("Y-m-d");
                          $this->db->where("stu_id",$studata->row()->id);
                          $this->db->where("a_date",$date);
                           $absent=  $this->db->get("attendance")->num_rows();
                           if($absent>0){

                          $count=$count+$absent;

                          $presentstu=$totstu-$count;
                          // print_r($count);
                         
                        ?>
                    
                        <tr>
                          <td class="center"><?php echo $i;?></td>
                          <td> <?php echo $data->row()->section ;?>  </td>

                          <td class="center"><?php echo $sectiondt->class_name;?></td>
                          <td class="center"><?php echo $totstu;?></td>
                          <td class="center"><?php echo $presentstu;?></td>
                          <td class="center"><?php echo $count;?></td>
                        
                        </tr>
                        <?php $i++; }  } }    endforeach; } ?>
                       
                       
                     
                      </tbody>
                    </table>
                  </a>
                </div>
              </div>
            </div>
            <div class="panel no-radius">
              <div class="panel-heading">
                <h4 class="panel-title">
                  <a href="#collapseTwo2" data-parent="#accordion" data-toggle="collapse"
                    class="accordion-toggle padding-15 collapsed">
                    <i class="icon-arrow"></i>
                    <?php $new = $this->db->query("SELECT * FROM bank_transaction WHERE school_code='$school_code' AND date='".date("Y-m-d")."'")->num_rows();?>
                  Today  Teacher Attendance <?php if($new > 0):?> <span
                      class="label label-danger pull-right"><?php echo $new;?></span><?php endif;?>
                  </a></h4>
              </div>
              <div class="panel-collapse collapse" id="collapseTwo2">
                <div class="panel-body no-padding partition-light-grey">
                  <a href="<?php echo base_url()?>index.php/login/dayBook">
                  <table class="table">
                    <thead style="text-align:center;">

                    <th>Sno.</th>
                    <th>Teacher Name</th>
                
                    <th>Present / Absent </th>
                    </thead>
                      <tbody>
                      <?php $i=1;
                         $count=0;
                         
                        $totpresent=0;
                        $date=Date("Y-m-d");
                        $this->db->where("school_code",$school_code);
                      //  $this->db->where("job_category",3);
                       $data= $this->db->get("employee_info");

                       foreach($data->result() as $totteacher):
                       
                        $this->db->where("emp_id",$totteacher->id);
                        $this->db->where("a_date",$date);
                       $classdt= $this->db->get("teacher_attendance");
                 //      print_r($classdt);
                      
                          // print_r($count);
                         
                        ?>
                    
                        <tr>
                          <td class="center"><?php echo $i;?></td>
                          <td> <?php echo $totteacher->name ;?>  </td>  
                       <td class="center"><?php    if($classdt->num_rows()>0){?> <span style="color:green;"><?php echo "Present" ;?></span><?php } else{  ?><span style="color:red;"><?php  echo "Absent" ; ?></span><?php } ?></td>
                         
                        </tr>
               <?php     $i++;  endforeach;?>
                       
                       
                     
                      </tbody>
                    </table>
                  </a>
                </div>
              </div>
            </div>
            <div class="panel no-radius">
              <div class="panel-heading">
                <h4 class="panel-title">
                  <a href="#collapseThree3" data-parent="#accordion" data-toggle="collapse"
                    class="accordion-toggle padding-15 collapsed">
                    <i class="icon-arrow"></i>
                    <?php $new = $this->db->query("SELECT * FROM director_transaction WHERE school_code='$school_code' AND date='".date("Y-m-d")."'")->num_rows();?>
                    Director Transaction <?php if($new > 0):?> <span
                      class="label label-danger pull-right"><?php echo $new;?></span><?php endif;?>
                  </a></h4>
              </div>
              <div class="panel-collapse collapse" id="collapseThree3">
                <div class="panel-body no-padding partition-light-grey">
                  <a href="<?php echo base_url()?>index.php/login/dayBook">
                    <table class="table">
                      <tbody>
                        <?php $i=1;?>
                        <?php $cash = $this->db->query("SELECT * FROM director_transaction WHERE school_code='$school_code' ORDER BY receipt_no DESC LIMIT 4");?>
                        <?php if($cash->num_rows() >= 1):?>
                        <?php foreach($cash->result() as $row):?>
                        <tr>
                          <td class="center"><?php echo $i;?></td>
                          <td>
                            <?php echo $row->applicant_name; ?>
                          </td>
                          <td class="center"><?php echo $row->amount;?></td>
                          <td><?php echo date("d-M-Y", strtotime("$row->date"));?></td>
                        </tr>
                        <?php $i++; endforeach;?>
                        <?php else: ?>
                        <tr>
                          <td class="center">
                            <h2>No Trasaction done yet...</h2>
                          </td>
                        </tr>
                        <?php endif;?>
                      </tbody>
                    </table>
                  </a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>



    <div class="col-md-4 col-lg-4">
      <div class="panel panel-dark">
        <div class="panel-heading">
          <h4 class="panel-title">Total Due Report</h4>
          <div class="panel-tools">
            <div class="dropdown">
              <a data-toggle="dropdown" class="btn btn-xs dropdown-toggle btn-transparent-white">
                <i class="fa fa-cog"></i>
              </a>
              <ul class="dropdown-menu dropdown-light pull-right" role="menu">
                <li>
                  <a class="panel-collapse collapses" href="#"><i class="fa fa-angle-up"></i> <span>Collapse</span> </a>
                </li>
                <li>
                  <a class="panel-refresh" href="#">
                    <i class="fa fa-refresh"></i> <span>Refresh</span>
                  </a>
                </li>
                <li>
                  <a class="panel-config" href="#panel-config" data-toggle="modal">
                    <i class="fa fa-wrench"></i> <span>Configurations</span>
                  </a>
                </li>
                <li>
                  <a class="panel-expand" href="#">
                    <i class="fa fa-expand"></i> <span>Fullscreen</span>
                  </a>
                </li>
              </ul>
            </div>
            <a class="btn btn-xs btn-link panel-close" href="#">
              <i class="fa fa-times"></i>
            </a>
          </div>
        </div>
        <div class="panel-body no-padding">
          <div class="partition-green padding-15 text-center">
            <h4 class="no-margin">Due Report</h4>
          </div>
          <div id="accordion" class="panel-group accordion accordion-white no-margin">
            <div class="panel no-radius">
              <div class="panel-heading">
                <h4 class="panel-title">
                  <a href="#collapseOne4" data-parent="#accordion" data-toggle="collapse"
                    class="accordion-toggle padding-15">
                    <i class="icon-arrow"></i>
                    <?php $new = $this->db->query("SELECT * FROM cash_payment WHERE date='".date("Y-m-d")."' AND school_code='$school_code'")->num_rows();?>
                  This Month Due Report <?php if($new > 0):?> <span
                      class="label label-danger pull-right"><?php echo $new;?></span><?php endif;?>
                  </a></h4>
              </div>
              <div class="panel-collapse collapse in" id="collapseOne4">
                <div class="panel-body no-padding partition-light-grey">
                  <a href="<?php echo base_url()?>index.php/login/dayBook">
                    <table class="table">
                    <thead>
                    <th>Sno.</th>
                    <th>Class Name</th>
                    <th>Total Fee Due</th>
                    </thead>
                      


                      <tbody>
                        <?php $i=1;
                        $feecount=0;
                        $date=Date("Y-m-d");
                        $month = date("m", strtotime($date));
                        $yearmonth= date("m-y",strtotime($date));
                       // print_r($rmo);
                       $this->db->distinct();
                       $this->db->select('class_name,id');
                        $this->db->where("school_code",$school_code);
                        $classdt= $this->db->get("class_info");
                        //  print_r($this->session->userdata("fsd"));
                        //  //print_r($classdt->result());
                        //  exit();
                        foreach($classdt->result() as $data):
                          $this->db->where("class_id",$data->id);
                          $studt=$this->db->get("student_info");
                          // echo "<pre>";
                          // print_r($studt->result());
                           
                          // exit();
                          if($studt->num_rows()>0){
                           $sum=$studt->num_rows();

                          // print_r($nummo);
                          // echo "<pre>";
                          //  exit();

                          $this->db->where("student_id",$studt->row()->id);
                          $this->db->where("deposite_month",$month);
                          $feedt=$this->db->get("fee_deposit");
                          if($feedt->num_rows()>0){

                          }
                          else{ 
                            $this->db->select("*");
                            $this->db->from("deposite_months");

                            $this->db->where("student_id",$studt->row()->id);
                            $this->db->order_by("deposite_month","Desc");
                            $this->db->limit("1");
                           $dmonth= $this->db->get();
                           if($dmonth->num_rows()>0){
                          $feemonth= $dmonth->row()->deposite_month;
                          
                           $rmo= date("m-y",strtotime($feemonth));
                          //  print_r($dmonth->row()->deposite_month);
                          //$nummo=$yearmonth-$rmo;
                          //  print_r($nummo);

                            $this->db->where("class_id",$data->id);
                            $this->db->where("fsd",$this->session->userdata("fsd"));
                           $classiddt= $this->db->get("class_fees");
                           if($classiddt->num_rows()>0){

                          // $this->db->where("school_code",$school_code);
                        //   $this->db->where("id",$classiddt->row()->class_id);
                        //   $classnm= $this->db->get("class_info")->row();
                         $this->db->select_sum("fee_head_amount");
                            if($school_code ==1){$this->db->where("cat_id",3);}
                            	$this->db->where_in("taken_month",13);
                            $this->db->where("class_id",$data->id);
                            $this->db->where("fsd",$this->session->userdata("fsd"));
                           $classfee= $this->db->get("class_fees")->row();
                           $cfee=$classfee->fee_head_amount;


                            
                            $this->db->select_sum("fee_head_amount");
                            if($school_code ==1){$this->db->where("cat_id",3);}
                            	$this->db->where_in("taken_month",$month);
                            $this->db->where("class_id",$data->id);
                            $this->db->where("fsd",$this->session->userdata("fsd"));
                           $classfee= $this->db->get("class_fees");
                           if($classfee->num_rows()>0){
                           $fees=$classfee->row()->fee_head_amount;
                           $fee=$cfee+$fees;
                           $totfee =$fee*$sum;
                           }
                           else{
                           $totfee= $cfee*$sum; 
                           
                         
                           }
                        //      print_r($sum);
                        //     print_r($fees);
                        //   print_r($cfee);

                           //$feecount=$feecount-$classfee;
                          ?>
                        <tr>
                          <td class="center"><?php echo $i;?></td>
                          <td><?php echo $data->class_name;?></td>
                          <td><?php echo $totfee; ?></td>
                          </tr>

                     <?php $i++; } }  }   }  endforeach; ?>
                    </table>
                  </a>
                </div>
              </div>
            </div>
            <div class="panel no-radius">
              <div class="panel-heading">
                <h4 class="panel-title">
                  <a href="#collapseTwo5" data-parent="#accordion" data-toggle="collapse"
                    class="accordion-toggle padding-15 collapsed">
                    <i class="icon-arrow"></i>
                    <?php $new = $this->db->query("SELECT * FROM bank_transaction WHERE school_code='$school_code' AND date='".date("Y-m-d")."'")->num_rows();?>
                  This Year Due Report<?php if($new > 0):?> <span
                      class="label label-danger pull-right"><?php echo $new;?></span><?php endif;?>
                  </a></h4>
              </div>
              <div class="panel-collapse collapse" id="collapseTwo5">
                <div class="panel-body no-padding partition-light-grey">
                  <a href="<?php echo base_url()?>index.php/login/dayBook">
                  <table class="table">
                    <thead>
                    <th>Sno.</th>
                    <th>Class Name</th>
                    <th>Total Fee Due</th>
                    </thead>
                    <tbody>
                        <?php $i=1;
                        $feecount=0;
                        $date=Date("Y-m-d");
                        $month = date("m", strtotime($date));

                        $this->db->where("school_code",$school_code);
                        $classdt= $this->db->get("class_info");
                        //  print_r($this->session->userdata("fsd"));
                        //  //print_r($classdt->result());
                        //  exit();
                        foreach($classdt->result() as $data):
                          $this->db->where("class_id",$data->id);
                          $studt=$this->db->get("student_info");
                          // echo "<pre>";
                          // print_r($studt->result());
                           
                          // exit();
                          if($studt->num_rows()>0){

                          $this->db->where("student_id",$studt->row()->id);
                          $this->db->where("deposite_month",$month);
                          $feedt=$this->db->get("fee_deposit");
                          if($feedt->num_rows()>0){

                          }
                          else{ 
                            $this->db->where("class_id",$data->id);
                            $this->db->where("fsd",$this->session->userdata("fsd"));
                           $classiddt= $this->db->get("class_fees");
                           if($classiddt->num_rows()>0){

                          // $this->db->where("school_code",$school_code);
                           $this->db->where("id",$classiddt->row()->class_id);
                           $classnm= $this->db->get("class_info")->row();


                            
                            $this->db->select_sum("fee_head_amount");
                            $this->db->where("class_id",$data->id);
                            $this->db->where("fsd",$this->session->userdata("fsd"));
                           $classfee= $this->db->get("class_fees")->row();
                           //$feecount=$feecount-$classfee;
                          ?>
                        <tr>
                          <td class="center"><?php echo $i;?></td>
                          <td><?php echo $classnm->class_name;?></td>
                          <td><?php echo $classfee->fee_head_amount; ?></td>
                          </tr>

                     <?php $i++; }  }   }  endforeach; ?>
                        
                      </tbody>
                    </table>
                  </a>
                </div>
              </div>
            </div>
            <div class="panel no-radius">
              <div class="panel-heading">
                <h4 class="panel-title">
                  <a href="#collapseThree6" data-parent="#accordion" data-toggle="collapse"
                    class="accordion-toggle padding-15 collapsed">
                    <i class="icon-arrow"></i>
                    <?php $new = $this->db->query("SELECT * FROM director_transaction WHERE school_code='$school_code' AND date='".date("Y-m-d")."'")->num_rows();?>
                   Fsd Wise Due <?php if($new > 0):?> <span
                      class="label label-danger pull-right"><?php echo $new;?></span><?php endif;?>
                  </a></h4>
              </div>
              <div class="panel-collapse collapse" id="collapseThree6">
                <div class="panel-body no-padding partition-light-grey">
                  <a href="<?php echo base_url()?>index.php/login/dayBook">
                    <table class="table">
                      <tbody>
                        <?php $i=1;?>
                        <?php $cash = $this->db->query("SELECT * FROM director_transaction WHERE school_code='$school_code' ORDER BY receipt_no DESC LIMIT 4");?>
                        <?php if($cash->num_rows() >= 1):?>
                        <?php foreach($cash->result() as $row):?>
                        <tr>
                          <td class="center"><?php echo $i;?></td>
                          <td>
                            <?php echo $row->applicant_name; ?>
                          </td>
                          <td class="center"><?php echo $row->amount;?></td>
                          <td><?php echo date("d-M-Y", strtotime("$row->date"));?></td>
                        </tr>
                        <?php $i++; endforeach;?>
                        <?php else: ?>
                        <tr>
                          <td class="center">
                            <h2>No Trasaction done yet...</h2>
                          </td>
                        </tr>
                        <?php endif;?>
                      </tbody>
                    </table>
                  </a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>



<div class="col-md-4 col-lg-4">
      <div class="panel panel-dark">
        <div class="panel-heading">
          <h4 class="panel-title">Cash Transaction</h4>
          <div class="panel-tools">
            <div class="dropdown">
              <a data-toggle="dropdown" class="btn btn-xs dropdown-toggle btn-transparent-white">
                <i class="fa fa-cog"></i>
              </a>
              <ul class="dropdown-menu dropdown-light pull-right" role="menu">
                <li>
                  <a class="panel-collapse collapses" href="#"><i class="fa fa-angle-up"></i> <span>Collapse</span> </a>
                </li>
                <li>
                  <a class="panel-refresh" href="#">
                    <i class="fa fa-refresh"></i> <span>Refresh</span>
                  </a>
                </li>
                <li>
                  <a class="panel-config" href="#panel-config" data-toggle="modal">
                    <i class="fa fa-wrench"></i> <span>Configurations</span>
                  </a>
                </li>
                <li>
                  <a class="panel-expand" href="#">
                    <i class="fa fa-expand"></i> <span>Fullscreen</span>
                  </a>
                </li>
              </ul>
            </div>
            <a class="btn btn-xs btn-link panel-close" href="#">
              <i class="fa fa-times"></i>
            </a>
          </div>
        </div>
        <div class="panel-body no-padding">
          <div class="partition-green padding-15 text-center">
            <h4 class="no-margin">Last 4 Transaction</h4>
          </div>
          <div id="accordion" class="panel-group accordion accordion-white no-margin">
            <div class="panel no-radius">
              <div class="panel-heading">
                <h4 class="panel-title">
                  <a href="#collapseOne" data-parent="#accordion" data-toggle="collapse"
                    class="accordion-toggle padding-15">
                    <i class="icon-arrow"></i>
                    <?php $new = $this->db->query("SELECT * FROM cash_payment WHERE date='".date("Y-m-d")."' AND school_code='$school_code'")->num_rows();?>
                    Cash Payment <?php if($new > 0):?> <span
                      class="label label-danger pull-right"><?php echo $new;?></span><?php endif;?>
                  </a></h4>
              </div>
              <div class="panel-collapse collapse in" id="collapseOne">
                <div class="panel-body no-padding partition-light-grey">
                  <a href="<?php echo base_url()?>index.php/login/dayBook">
                    <table class="table">
                      <tbody>
                        <?php $i=1;?>
                        <?php $cash = $this->db->query("SELECT * FROM cash_payment where school_code='$school_code' ORDER BY receipt_no DESC LIMIT 4");?>
                        <?php if($cash->num_rows() >= 1):?>
                        <?php foreach($cash->result() as $row):?>
                        <tr>
                          <td class="center"><?php echo $i;?></td>
                          <td>
                            <?php
                                    		if(strlen($row->valid_id)>1):
                                    			echo $row->valid_id;
                                    		else:
                                    			echo $row->name;
                                    		endif;
                                    	?>
                          </td>
                          <td class="center"><?php echo $row->amount;?></td>
                          <td><?php echo date("d-M-Y", strtotime("$row->date"));?></td>
                        </tr>
                        <?php $i++; endforeach;?>
                        <?php else: ?>
                        <tr>
                          <td class="center">
                            <h2>No Trasaction done yet...</h2>
                          </td>
                        </tr>
                        <?php endif;?>
                      </tbody>
                    </table>
                  </a>
                </div>
              </div>
            </div>
            <div class="panel no-radius">
              <div class="panel-heading">
                <h4 class="panel-title">
                  <a href="#collapseTwo" data-parent="#accordion" data-toggle="collapse"
                    class="accordion-toggle padding-15 collapsed">
                    <i class="icon-arrow"></i>
                    <?php $new = $this->db->query("SELECT * FROM bank_transaction WHERE school_code='$school_code' AND date='".date("Y-m-d")."'")->num_rows();?>
                    Bank Transaction <?php if($new > 0):?> <span
                      class="label label-danger pull-right"><?php echo $new;?></span><?php endif;?>
                  </a></h4>
              </div>
              <div class="panel-collapse collapse" id="collapseTwo">
                <div class="panel-body no-padding partition-light-grey">
                  <a href="<?php echo base_url()?>index.php/login/dayBook">
                    <table class="table">
                      <tbody>
                        <?php $i=1;?>
                        <?php $cash = $this->db->query("SELECT * FROM bank_transaction WHERE school_code='$school_code' ORDER BY receipt_no DESC LIMIT 4");?>
                        <?php if($cash->num_rows() >= 1):?>
                        <?php foreach($cash->result() as $row):?>
                        <tr>
                          <td class="center">1</td>
                          <td><?php echo $row->id_name; ?></td>
                          <td class="center"><?php echo $row->amount;?></td>
                          <td><?php echo date("d-M-Y", strtotime("$row->date"));?></td>
                        </tr>
                        <?php $i++; endforeach;?>
                      </tbody>
                      <?php else: ?>
                      <tr>
                        <td class="center">
                          <h2>No Trasaction done yet...</h2>
                        </td>
                      </tr>
                      <?php endif;?>
                    </table>
                  </a>
                </div>
              </div>
            </div>
            <div class="panel no-radius">
              <div class="panel-heading">
                <h4 class="panel-title">
                  <a href="#collapseThree" data-parent="#accordion" data-toggle="collapse"
                    class="accordion-toggle padding-15 collapsed">
                    <i class="icon-arrow"></i>
                    <?php $new = $this->db->query("SELECT * FROM director_transaction WHERE school_code='$school_code' AND date='".date("Y-m-d")."'")->num_rows();?>
                    Director Transaction <?php if($new > 0):?> <span
                      class="label label-danger pull-right"><?php echo $new;?></span><?php endif;?>
                  </a></h4>
              </div>
              <div class="panel-collapse collapse" id="collapseThree">
                <div class="panel-body no-padding partition-light-grey">
                  <a href="<?php echo base_url()?>index.php/login/dayBook">
                    <table class="table">
                      <tbody>
                        <?php $i=1;?>
                        <?php $cash = $this->db->query("SELECT * FROM director_transaction WHERE school_code='$school_code' ORDER BY receipt_no DESC LIMIT 4");?>
                        <?php if($cash->num_rows() >= 1):?>
                        <?php foreach($cash->result() as $row):?>
                        <tr>
                          <td class="center"><?php echo $i;?></td>
                          <td>
                            <?php echo $row->applicant_name; ?>
                          </td>
                          <td class="center"><?php echo $row->amount;?></td>
                          <td><?php echo date("d-M-Y", strtotime("$row->date"));?></td>
                        </tr>
                        <?php $i++; endforeach;?>
                        <?php else: ?>
                        <tr>
                          <td class="center">
                            <h2>No Trasaction done yet...</h2>
                          </td>
                        </tr>
                        <?php endif;?>
                      </tbody>
                    </table>
                  </a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

</div>
</div>

<div class="row" style="margin-left:2px;">
  <!--<div class="col-lg-4 col-md-5">-->
  <!--	<div class="panel panel-red panel-calendar">-->
  <!--		<div class="panel-heading border-light">-->
  <!--			<h4 class="panel-title">Appointments</h4>-->
  <!--			<div class="panel-tools">-->
  <!--				<div class="dropdown">-->
  <!--					<a data-toggle="dropdown" class="btn btn-xs dropdown-toggle btn-transparent-white">-->
  <!--						<i class="fa fa-cog"></i>-->
  <!--					</a>-->
  <!--					<ul class="dropdown-menu dropdown-light pull-right" role="menu">-->
  <!--						<li>-->
  <!--							<a class="panel-collapse collapses" href="#"><i class="fa fa-angle-up"></i> <span>Collapse</span> </a>-->
  <!--						</li>-->
  <!--						<li>-->
  <!--							<a class="panel-refresh" href="#">-->
  <!--								<i class="fa fa-refresh"></i> <span>Refresh</span>-->
  <!--							</a>-->
  <!--						</li>-->
  <!--						<li>-->
  <!--							<a class="panel-config" href="#panel-config" data-toggle="modal">-->
  <!--								<i class="fa fa-wrench"></i> <span>Configurations</span>-->
  <!--							</a>-->
  <!--						</li>-->
  <!--						<li>-->
  <!--							<a class="panel-expand" href="#">-->
  <!--								<i class="fa fa-expand"></i> <span>Fullscreen</span>-->
  <!--							</a>-->
  <!--						</li>-->
  <!--					</ul>-->
  <!--				</div>-->
  <!--				<a class="btn btn-xs btn-link panel-close" href="#">-->
  <!--					<i class="fa fa-times"></i>-->
  <!--				</a>-->
  <!--			</div>-->
  <!--		</div>-->
  <!--		<div class="panel-body">-->
  <!--			<div class="height-300">-->
  <!--				<div class="row">-->
  <!--					<div class="col-xs-6">-->
  <!--						<div class="actual-date">-->
  <!--							<span class="actual-day"><?php $cdate = date("d-m-Y H:i:s"); echo date('d',strtotime($cdate));?></span>-->
  <!--							<span class="actual-month"><?php echo date('M',strtotime($cdate));?></span>-->
  <!--						</div>-->
  <!--					</div>-->
  <!--					<div class="col-xs-6">-->
  <!--						<div class="row">-->
  <!--							<div class="col-xs-12">-->
  <!--								<div class="clock-wrapper">-->
  <!--									<div class="clock">-->
  <!--										<div class="circle">-->
  <!--											<div class="face"><?php $ctimeh =  date('H',strtotime($cdate)); ?>-->
  <!--												<div id="hour" style="transform: rotate(258.55deg);"><?php echo $ctimeh." hour";?></div>-->
  <!--												<div id="minute" style="transform: rotate(222.6deg);"><?php echo date('i',strtotime($cdate));?></div>-->
  <!--												<div id="second" style="transform: rotate(36deg);"><?php echo date('s',strtotime($cdate)); ?></div>-->
  <!--											</div>-->
  <!--										</div>-->
  <!--									</div>-->
  <!--								</div>-->
  <!--							</div>-->
  <!--						</div>-->
  <!--						<div class="row">-->
  <!--							<div class="col-xs-12">-->
  <!--								<div class="weather text-light">-->
  <!--									<i class="wi-day-sunny"></i>-->
  <!--								25�-->
  <!--								</div>-->
  <!--							</div>-->
  <!--						</div>-->
  <!--					</div>-->
  <!--				</div>-->

  <!--				<div class="row">-->
  <!--					<div class="col-xs-12">-->
  <!--						<div class="row">-->
  <!--							<div class="appointments border-top border-bottom border-light space15">-->
  <!--								<a class="btn btn-sm owl-prev text-light">-->
  <!--									<i class="fa fa-chevron-left"></i>-->
  <!--								</a>-->
  <!--								<div class="e-slider owl-carousel owl-theme" data-plugin-options="{&quot;transitionStyle&quot;: &quot;goDown&quot;, &quot;pagination&quot;: false}" style="opacity: 1; display: block;">-->
  <!--									<div class="owl-wrapper-outer"><div class="owl-wrapper" style="width: 2208px; left: 0px; display: block; transition: all 0ms ease 0s; transform: translate3d(-368px, 0px, 0px); transform-origin: 552px center; perspective-origin: 552px center;"><div class="owl-item" style="width: 368px;"><div class="item">-->
  <!--										<div class="inline-block padding-10 border-right border-light">-->
  <!--											<span class="bold-text text-small"><i class="fa fa-clock-o"></i> 17:00</span>-->
  <!--											<span class="text-light text-extra-small">1 hour</span>-->
  <!--										</div>-->
  <!--										<div class="inline-block padding-10">-->
  <!--											<span class="bold-text text-small">NETWORKING</span>-->
  <!--											<span class="text-light text-small">Out to design conference</span>-->
  <!--										</div>-->
  <!--									</div></div><div class="owl-item" style="width: 368px;"><div class="item">-->
  <!--										<div class="inline-block padding-10 border-right border-light">-->
  <!--											<span class="bold-text text-small"><i class="fa fa-clock-o"></i> 18:30</span>-->
  <!--											<span class="text-light text-extra-small">30 mins</span>-->
  <!--										</div>-->
  <!--										<div class="inline-block padding-10">-->
  <!--											<span class="bold-text text-small">BOOTSTRAP SEMINAR</span>-->
  <!--											<span class="text-light text-small">Problem Solving</span>-->
  <!--										</div>-->
  <!--									</div></div><div class="owl-item" style="width: 368px;"><div class="item">-->
  <!--										<div class="inline-block padding-10 border-right border-light">-->
  <!--											<span class="bold-text text-small"><i class="fa fa-clock-o"></i> 20:00</span>-->
  <!--											<span class="text-light text-extra-small">2 hour</span>-->
  <!--										</div>-->
  <!--										<div class="inline-block padding-10">-->
  <!--											<span class="bold-text text-small">Lunch with Nicole</span>-->
  <!--											<span class="text-light text-small">Next on Tuesday</span>-->
  <!--										</div>-->
  <!--									</div></div></div></div>-->


  <!--								</div>-->
  <!--								<a class="btn btn-sm owl-next text-light"><i class="fa fa-chevron-right"></i> </a>-->
  <!--							</div>-->
  <!--						</div>-->
  <!--					</div>-->
  <!--				</div>-->
  <!--				<div class="row">-->
  <!--					<div class="col-xs-12">-->
  <!--						<div class="pull-right">-->
  <!--							<a href="#newEvent" class="btn btn-sm btn-transparent-white new-event"><i class="fa fa-plus"></i> New Event </a>-->
  <!--							<a href="#showCalendar" class="btn btn-sm btn-transparent-white show-calendar"><i class="fa fa-calendar-o"></i> Calendar </a>-->
  <!--						</div>-->
  <!--					</div>-->
  <!--				</div>-->
  <!--			</div>-->
  <!--		</div>-->
  <!--	</div>-->
  <!--</div>-->


  <!--  <div class="panel panel-dark">
        <div class="panel-heading text-center">
            <h4 class="panel-title">Class Homework</h4>
            <div class="panel-tools">
                <div class="dropdown">
                    <a data-toggle="dropdown" class="btn btn-xs dropdown-toggle btn-transparent-white">
                        <i class="fa fa-cog"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-light pull-right" role="menu">
                        <li>
                            <a class="panel-collapse collapses" href="#"><i class="fa fa-angle-up"></i> <span>Collapse</span> </a>
                        </li>
                        <li>
                            <a class="panel-refresh" href="#">
                                <i class="fa fa-refresh"></i> <span>Refresh</span>
                            </a>
                        </li>
                        <li>
                            <a class="panel-config" href="#panel-config" data-toggle="modal">
                                <i class="fa fa-wrench"></i> <span>Configurations</span>
                            </a>
                        </li>
                        <li>
                            <a class="panel-expand" href="#">
                                <i class="fa fa-expand"></i> <span>Fullscreen</span>
                            </a>
                        </li>
                    </ul>
                </div>
                <a class="btn btn-xs btn-link panel-close" href="#">
                    <i class="fa fa-times"></i>
                </a>
            </div>
        </div>
        
      <!--   <div class="panel-body no-padding">
          
             <?php
                                $school_code=$this->session->userdata('school_code');
                                  $this->db->where('school_code',$school_code);
                                  $class_name=$this->db->get('class_info');
                                  foreach($class_name->result() as $cname){
                                      
                                      $this->db->where('id',$cname->section);
                                      $this->db->where('school_code',$school_code);
                                      $sectionname=$this->db->get('class_section')->row();
                                      
                                       $this->db->where('id',$cname->stream);
                                      $this->db->where('school_code',$school_code);
                                      $streamname=$this->db->get('stream')->row();
                                      $this->db->where('class_id',$cname->id);
                                      $this->db->where('school_code',$school_code);
                                      $homework_name=$this->db->get('homework_name');
                                      if($homework_name->num_rows() >0){
                                ?>
            <div id="accordion" class="panel-group accordion accordion-white no-margin">
                <div class="panel no-radius">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <a href="#collapseOne<?php echo $cname->id; ?>" data-parent="#accordion" data-toggle="collapse" class="accordion-toggle padding-15">
                                <i class="icon-arrow"></i>
                               <?php echo $cname->class_name."-".$sectionname->section."-".$streamname->stream;?><span class="label label-danger pull-right"></span>
                            </a></h4>
                    </div>
                   <div class="panel-collapse collapse" id="collapseOne<?php echo $cname->id;?>">
                        <div class="panel-body no-padding partition-light-grey">
                            <table class="table">
                                <tbody>
                                <?php 
                                     
                                ?>
                                <?php ?>
                                <?php $i=1; foreach($homework_name->result() as $row):?>
                                <tr>
                                    <td class="center"><?php echo $i;?></td>
                                    <td>
                                    	<?php
                                    	  echo $row->workDiscription." in ".$row->work_name;
                                    	?>
                                    </td>
                                   
                                </tr>
                                <?php $i++; endforeach;?>
                                <?php }else{ ?>
                                <tr>
                                    <td class="center"><h2>Home Work not define ...</h2></td>
                                </tr>
                                <?php }?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <?php  }?>
        </div> 
    </div>
    </div>-->
  







  <div class="row" Style="margin-left:2px;">
    <div class="col-md-4 col-lg-4">
      <div class="panel panel-default panel-white ">
        <div class="panel-body no-padding">
          <div class="partition-green padding-20 text-center text-bold">
            <a href="<?php echo base_url(); ?>index.php/smsAjax/smsPanel" class="text-white">
              Click for SMS Panel
            </a>
          </div>

          <div class="padding-20 core-content">
            <h2 class="title block no-margin"></h2>
            <br />
            <span class="subtitle"></span>
          </div>
        </div>
      </div>
    </div>
    <!--   <div class="col-lg-4 col-md-12"> 
      <div class="panel panel-white">

        <div class="panel-body no-padding">
          <div class="padding-10">

            <h4 class="no-margin inline-block padding-5">Attendance Report <span
                class="block text-small text-left">Total Absent</span></h4>

          </div>

          <div class="tabbable no-margin no-padding partition-dark">

            <div class="tab-content partition-white">
              <div id="users_tab_example1" class="tab-pane padding-bottom-5 active">
                <div class="panel-scroll height-230">
                  <table class="table table-striped table-hover">
                    <thead>
                      <tr>

                        <th><span class="">Class Name</span><a href="#" class="btn"></i></a></th>
                        <th>Total
                        </th>
                        <th class="Present">Present
                        </th>
                        <th class="Absent">Absent
                        </th>
                        <th class="Leave">Leave
                        </th>


                      </tr>


                    </thead>
                    <tbody>

                      <?php $dat=date("Y-m-d") ;
															
															$this->db->distinct();
															//$this->db->select('id');
															$this->db->where("school_code",$this->session->userdata("school_code"));
															$dfg = $this->db->get('class_info');
															if($dfg->num_rows()>0){
															$vyt=	$dfg->result();
															  
															foreach($vyt as $t):
															
															$this->db->where("school_code",$this->session->userdata("school_code"));
															$this->db->where("DATE(a_date)",$dat);
															$this->db->where("class_id",$t->id);
															$grt = $this->db->get("attendance");
															if($grt->num_rows()>0){
																$ft = $grt->result();
																$p=0;$l=0;$a=0;
																	foreach($ft as $f):
																
																	if($f->attendance==0){
																	
																	$a=$a+1;
																	}
																	else{
																		$p=$p+1;	
																	}
																	
																	endforeach;
															?>
                      <tr>

                        <td><span>&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $t->class_name;?></span><a href="#"
                            class="btn"></a></td>
                        <td class="center"><?php echo $grt->num_rows();?>
                        </td>
                        <td class="center"><?php echo $p;?>
                        </td>
                        <td class="center"><?php echo $a;?>
                        </td>
                        <td class="center"><?php echo $l;?>
                        </td>
                      </tr>

                      <?php }else{
																
															}
															endforeach;
														}
															?>




                    </tbody>
                  </table>
                </div>
              </div>
              <div id="users_tab_example2" class="tab-pane padding-bottom-5">
                <div class="panel-scroll height-230">
                  <table class="table table-striped table-hover">
                    <tbody>
                      <tr>
                        <td class="center"><img src="assets/images/avatar-3.jpg" class="img-circle" alt="image" /></td>
                        <td><span class="text-small block text-light">Visual Designer</span><span
                            class="text-large">Steven Thompson</span><a href="#" class="btn"><i
                              class="fa fa-pencil"></i></a></td>
                        <td class="center">
                          <div>
                            <div class="btn-group">
                              <a class="btn btn-transparent-grey dropdown-toggle btn-sm" data-toggle="dropdown"
                                href="#">
                                <i class="fa fa-cog"></i> <span class="caret"></span>
                              </a>
                              <ul role="menu" class="dropdown-menu dropdown-dark pull-right">
                                <li role="presentation">
                                  <a role="menuitem" tabindex="-1" href="#">
                                    <i class="fa fa-edit"></i> Edit
                                  </a>
                                </li>
                                <li role="presentation">
                                  <a role="menuitem" tabindex="-1" href="#">
                                    <i class="fa fa-share"></i> Share
                                  </a>
                                </li>
                                <li role="presentation">
                                  <a role="menuitem" tabindex="-1" href="#">
                                    <i class="fa fa-times"></i> Remove
                                  </a>
                                </li>
                              </ul>
                            </div>
                          </div>
                        </td>
                      </tr>
                      <tr>
                        <td class="center"><img src="assets/images/avatar-5.jpg" class="img-circle" alt="image" /></td>
                        <td><span class="text-small block text-light">Senior Designer</span><span
                            class="text-large">Kenneth Ross</span><a href="#" class="btn"><i
                              class="fa fa-pencil"></i></a></td>
                        <td class="center">
                          <div>
                            <div class="btn-group">
                              <a class="btn btn-transparent-grey dropdown-toggle btn-sm" data-toggle="dropdown"
                                href="#">
                                <i class="fa fa-cog"></i> <span class="caret"></span>
                              </a>
                              <ul role="menu" class="dropdown-menu dropdown-dark pull-right">
                                <li role="presentation">
                                  <a role="menuitem" tabindex="-1" href="#">
                                    <i class="fa fa-edit"></i> Edit
                                  </a>
                                </li>
                                <li role="presentation">
                                  <a role="menuitem" tabindex="-1" href="#">
                                    <i class="fa fa-share"></i> Share
                                  </a>
                                </li>
                                <li role="presentation">
                                  <a role="menuitem" tabindex="-1" href="#">
                                    <i class="fa fa-times"></i> Remove
                                  </a>
                                </li>
                              </ul>
                            </div>
                          </div>
                        </td>
                      </tr>
                      <tr>
                        <td class="center"><img src="assets/images/avatar-4.jpg" class="img-circle" alt="image" /></td>
                        <td><span class="text-small block text-light">Web Editor</span><span class="text-large">Ella
                            Patterson</span><a href="#" class="btn"><i class="fa fa-pencil"></i></a></td>
                        <td class="center">
                          <div>
                            <div class="btn-group">
                              <a class="btn btn-transparent-grey dropdown-toggle btn-sm" data-toggle="dropdown"
                                href="#">
                                <i class="fa fa-cog"></i> <span class="caret"></span>
                              </a>
                              <ul role="menu" class="dropdown-menu dropdown-dark pull-right">
                                <li role="presentation">
                                  <a role="menuitem" tabindex="-1" href="#">
                                    <i class="fa fa-edit"></i> Edit
                                  </a>
                                </li>
                                <li role="presentation">
                                  <a role="menuitem" tabindex="-1" href="#">
                                    <i class="fa fa-share"></i> Share
                                  </a>
                                </li>
                                <li role="presentation">
                                  <a role="menuitem" tabindex="-1" href="#">
                                    <i class="fa fa-times"></i> Remove
                                  </a>
                                </li>
                              </ul>
                            </div>
                          </div>
                        </td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
              <div id="users_tab_example3" class="tab-pane padding-bottom-5">
                <div class="panel-scroll height-230">
                  <table class="table table-striped table-hover">
                    <tbody>
                      <tr>
                        <td class="center"><img src="assets/images/avatar-2.jpg" class="img-circle" alt="image" /></td>
                        <td><span class="text-small block text-light">Content Designer</span><span
                            class="text-large">Nicole Bell</span><a href="#" class="btn"><i
                              class="fa fa-pencil"></i></a></td>
                        <td class="center">
                          <div>
                            <div class="btn-group">
                              <a class="btn btn-transparent-grey dropdown-toggle btn-sm" data-toggle="dropdown"
                                href="#">
                                <i class="fa fa-cog"></i> <span class="caret"></span>
                              </a>
                              <ul role="menu" class="dropdown-menu dropdown-dark pull-right">
                                <li role="presentation">
                                  <a role="menuitem" tabindex="-1" href="#">
                                    <i class="fa fa-edit"></i> Edit
                                  </a>
                                </li>
                                <li role="presentation">
                                  <a role="menuitem" tabindex="-1" href="#">
                                    <i class="fa fa-share"></i> Share
                                  </a>
                                </li>
                                <li role="presentation">
                                  <a role="menuitem" tabindex="-1" href="#">
                                    <i class="fa fa-times"></i> Remove
                                  </a>
                                </li>
                              </ul>
                            </div>
                          </div>
                        </td>
                      </tr>
                      <tr>
                        <td class="center"><img src="assets/images/avatar-3.jpg" class="img-circle" alt="image" /></td>
                        <td><span class="text-small block text-light">Visual Designer</span><span
                            class="text-large">Steven Thompson</span><a href="#" class="btn"><i
                              class="fa fa-pencil"></i></a></td>
                        <td class="center">
                          <div>
                            <div class="btn-group">
                              <a class="btn btn-transparent-grey dropdown-toggle btn-sm" data-toggle="dropdown"
                                href="#">
                                <i class="fa fa-cog"></i> <span class="caret"></span>
                              </a>
                              <ul role="menu" class="dropdown-menu dropdown-dark pull-right">
                                <li role="presentation">
                                  <a role="menuitem" tabindex="-1" href="#">
                                    <i class="fa fa-edit"></i> Edit
                                  </a>
                                </li>
                                <li role="presentation">
                                  <a role="menuitem" tabindex="-1" href="#">
                                    <i class="fa fa-share"></i> Share
                                  </a>
                                </li>
                                <li role="presentation">
                                  <a role="menuitem" tabindex="-1" href="#">
                                    <i class="fa fa-times"></i> Remove
                                  </a>
                                </li>
                              </ul>
                            </div>
                          </div>
                        </td>
                      </tr>
                      <tr>
                        <td class="center"><img src="assets/images/avatar-5.jpg" class="img-circle" alt="image" /></td>
                        <td><span class="text-small block text-light">Senior Designer</span><span
                            class="text-large">Kenneth Ross</span><a href="#" class="btn"><i
                              class="fa fa-pencil"></i></a></td>
                        <td class="center">
                          <div>
                            <div class="btn-group">
                              <a class="btn btn-transparent-grey dropdown-toggle btn-sm" data-toggle="dropdown"
                                href="#">
                                <i class="fa fa-cog"></i> <span class="caret"></span>
                              </a>
                              <ul role="menu" class="dropdown-menu dropdown-dark pull-right">
                                <li role="presentation">
                                  <a role="menuitem" tabindex="-1" href="#">
                                    <i class="fa fa-edit"></i> Edit
                                  </a>
                                </li>
                                <li role="presentation">
                                  <a role="menuitem" tabindex="-1" href="#">
                                    <i class="fa fa-share"></i> Share
                                  </a>
                                </li>
                                <li role="presentation">
                                  <a role="menuitem" tabindex="-1" href="#">
                                    <i class="fa fa-times"></i> Remove
                                  </a>
                                </li>
                              </ul>
                            </div>
                          </div>
                        </td>
                      </tr>
                      <tr>
                        <td class="center"><img src="assets/images/avatar-4.jpg" class="img-circle" alt="image" /></td>
                        <td><span class="text-small block text-light">Web Editor</span><span class="text-large">Ella
                            Patterson</span><a href="#" class="btn"><i class="fa fa-pencil"></i></a></td>
                        <td class="center">
                          <div>
                            <div class="btn-group">
                              <a class="btn btn-transparent-grey dropdown-toggle btn-sm" data-toggle="dropdown"
                                href="#">
                                <i class="fa fa-cog"></i> <span class="caret"></span>
                              </a>
                              <ul role="menu" class="dropdown-menu dropdown-dark pull-right">
                                <li role="presentation">
                                  <a role="menuitem" tabindex="-1" href="#">
                                    <i class="fa fa-edit"></i> Edit
                                  </a>
                                </li>
                                <li role="presentation">
                                  <a role="menuitem" tabindex="-1" href="#">
                                    <i class="fa fa-share"></i> Share
                                  </a>
                                </li>
                                <li role="presentation">
                                  <a role="menuitem" tabindex="-1" href="#">
                                    <i class="fa fa-times"></i> Remove
                                  </a>
                                </li>
                              </ul>
                            </div>
                          </div>
                        </td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    -->
    <div class="col-lg-4 col-md-12">
      <div class="panel panel-white">
        <div class="panel-body no-padding">
          <div class="padding-10">
            <h4 class="no-margin inline-block padding-5">Absent Teachers 
            <!-- <span class="block text-small text-left">Total Absent</span> -->
            </h4>
          </div>
          <div class="tabbable no-margin no-padding partition-dark">
            <div class="tab-content partition-white">
              <div id="users_tab_example1" class="tab-pane padding-bottom-5 active">
                <div class="panel-scroll height-230">
                  <table class="table table-striped table-hover">
                    <thead>
                      <tr>
                        <th>#</th>
                        <th>Teacher Name</th>
                        <th>Status</th>
                        <th>Date</th>
                        <th>Action</th>
                        <!-- <th class="Leave">Leave</th> -->
                      </tr>
                    </thead>
                    <tbody>

                      <?php 
                          if($emp_lev->num_rows()>0){ $i=1;                
                          foreach($emp_lev->result() as $lv_data)
                          {                           															
                          ?>
                      <tr>
                        <td><?php echo $i;?></td>
                        <td><?php echo $lv_data->emp_id; ?></td>
                        <td>Absent</td>
                        <td><?php echo $lv_data->a_date; ?></td>
                        <td>
                            <input type="hidden" id="abc<?php echo $i;?>"  value="<?php echo $lv_data->emp_id; ?>"/>
                            <input type="button" id="assgin<?php echo $i;?>"  value="Assgin" class="btn btn-danger" />
                            <input type="button" id="assgined<?php echo $i;?>"  value="Assgined" class="btn btn-success" />
                        </td>
                      </tr>
                      <script>
                      $("#assgin<?php echo $i;?>").show();
                      alert("3"); 
                      $("#assgined<?php echo $i;?>").hide();
                      </script>
                      
                     
                            <?php 
														$i++;	}
														}
															?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    
  </div>

  <div class="row" style="margin-left:2px;">
    
    <div class="col-md-4 col-lg-4 col-sm-6">
      <div class="panel panel-blue core-box">

        <?php              $dt=date('Y-m-d'); ?>
        <?php $leve = $this->db->query("SELECT * FROM emp_leave WHERE school_code='$school_code' AND  end_date>='$dt' ORDER BY id");?>
        <?php $is_row=$leve->num_rows();?>
        <?php if($is_row > 0):?>
        <div class="e-slider owl-carousel owl-theme">
          <?php foreach($leve->result() as $row):?>
          <?php $id = $row->emp_id;?>
          <?php
			$this->db->where("school_code",$this->session->userdata("school_code"));
			$this->db->where("id",$id); 
		    $info = $this->db->get("employee_info")->row(); ?>

          <div class="item">
            <div class="panel-body">
              <div class="core-box">
                <div class="text-light text-bold">
                  Employee Leave Request
                </div>
                <br />
                <table style="width: 100%;">
                  <tr>
                    <td rowspan="4" width="30%">

                      <?php if(strlen($info->photo > 0)):?>
                      <img
                        src="<?php echo base_url();?>assets/<?= $this->session->userdata('school_code') ?>/images/empImage/<?php echo $info->photo; ?>"
                        alt="" width="90" height="105" />
                      <?php else:?>
                      <?php if($info->gender == 'Male'):?>
                      <img alt="<?php echo $info->name;?>" width="80%"
                        src="<?php echo $this->config->item('asset_url'); ?><?php echo $this->session->userdata("school_code");?>/images/empImage/empMale.png" />
                      <?php endif;?>
                      <?php if($info->gender == 'Female'):?>
                      <img alt="<?php echo $info->name;?>" width="80%"
                        src="<?php echo $this->config->item('asset_url'); ?><?php echo $this->session->userdata("school_code");?>/images/empImage/empFemale.png" />
                      <?php endif;?>
                      <?php endif;?>
                    </td>
                    <td>Name :
                      <?php echo $info->name;?>
                    </td>
                  </tr>
                  <tr>
                    <td>Start Date : <?php echo date("d-M-Y", strtotime($row->start_date)); ?></td>
                  </tr>
                  <tr>
                    <td>Days : <?php echo $row->total_leave; ?></td>
                  </tr>
                  <tr>
                    <td>End Date : <?php echo date("d-M-Y", strtotime($row->end_date)); ?></td>
                  </tr>
                  <tr>
                    <td colspan="2"><br />Reason :
                      <?php echo implode(' ', array_slice(explode(' ', $row->reason), 0, 7)); ?>...</td>
                  </tr>
                </table>
              </div>
            </div>
            <div class="padding-10">
              <?php if($row->status==0){?>
              <a href="<?php echo base_url();?>index.php/adminController/appleaveemp/<?php echo $row->id;?>"
                class="btn btn-sm btn-light-green"><i class="fa fa-check"></i> Approve</a>
              <a href="<?php echo base_url();?>index.php/adminController/deleleaveemp/<?php echo $row->id;?>"
                class="btn btn-sm btn-light-red"><strong>x</strong> Reject</a>
              <?php } else{?>
              <a href="#" class="btn btn-sm btn-light-yellow">
                Approved<i class="fa fa-check"></i>
              </a>
              <?php }?>
            </div>
          </div>

          <?php endforeach; ?>
        </div>
        <?php else: ?>
        <div class="item">
          <div class="panel-body">
            <div class="core-box">
              <div class="text-light text-bold">
                Employee Leave Request
              </div>
              <br />
              <h2>There is no request for the day.....</h2>
            </div>
          </div>
        </div>
        <?php endif;?>

      </div>
    </div>
    <div class="col-md-4 col-lg-4 col-sm-6" style="height:auto;">
      <div class="panel panel-blue core-box">
        <div class="e-slider owl-carousel owl-theme">
          <?php $dt=date('Y-m-d');?>
          <?php $leve = $this->db->query("SELECT * FROM stu_leave WHERE school_code='$school_code' AND end_date>='$dt'  ORDER BY id");?>
          <?php $is_row=$leve->num_rows();?>
          <?php if($is_row > 0):?>

          <?php foreach($leve->result() as $row):?>
          <?php $id = $row->stu_id;?>
          <?php
			//$this->db->where("school_code",$this->session->userdata("school_code"));
			$this->db->where("id",$id); ?>
          <?php $info = $this->db->get("student_info")->row(); ?>
          <div class="item">
            <div class="panel-body">
              <div class="core-box">
                <div class="text-light text-bold">
                  Student Leave Request
                </div>
                <br />
                <table style="width: 100%;">
                  <tr>
                    <td rowspan="4" width="30%">

                      <?php if(strlen($info->photo > 0)):?>
                      <img alt="<?php echo $info->name;?>" width="80%"
                        src="<?php echo $this->config->item('asset_url'); ?><?php echo $this->session->userdata("school_code");?>/images/stuImage/<?php echo $info->photo;?>" />
                      <?php else:?>
                      <?php if($info->gender == 'Male'):?>
                      <img alt="<?php echo $info->name;?>" width="80%"
                        src="<?php echo $this->config->item('asset_url'); ?><?php echo $this->session->userdata("school_code");?>/images/stuImage/empMale.png" />
                      <?php endif;?>
                      <?php if($info->gender == 'Female'):?>
                      <img alt="<?php echo $info->name;?>" width="80%"
                        src="<?php echo $this->config->item('asset_url'); ?><?php echo $this->session->userdata("school_code");?>/images/stuImage/empFemale.png" />
                      <?php endif;?>
                      <?php endif;?>
                    </td>
                    <td>Name :
                      <?php echo $info->name;?>
                    </td>
                  </tr>
                  <tr>
                    <td>Start Date : <?php echo date("d-M-Y", strtotime($row->start_date)); ?></td>
                  </tr>
                  <tr>
                    <td>Days : <?php echo $row->total_leave; ?></td>
                  </tr>
                  <tr>
                    <td>End Date : <?php echo date("d-M-Y", strtotime($row->end_date)); ?></td>
                  </tr>
                  <tr>
                    <td colspan="2"><br />Reason :
                      <?php echo implode(' ', array_slice(explode(' ', $row->reason), 0, 7)); ?>...</td>
                  </tr>
                </table>
              </div>
            </div>
            <div class="padding-10">
              <?php if($row->approve=='NO'){?>
              <a href="<?php echo base_url();?>index.php/adminController/appleave/<?php echo $row->id;?>"
                class="btn btn-sm btn-light-green"><i class="fa fa-check"></i> Approve</a>
              <a href="<?php echo base_url();?>index.php/adminController/deleleave/<?php echo $row->id;?>"
                class="btn btn-sm btn-light-red"><strong>x</strong> Reject</a>
              <?php } else{?>
              <a href="#" class="btn btn-sm btn-light-yellow">
                Approved<i class="fa fa-check"></i>
              </a>
              <?php }?>
            </div>
          </div>

          <?php endforeach; ?>
        </div>
        <?php else: ?>
        <div class="item">
          <div class="panel-body">
            <div class="core-box">
              <div class="text-light text-bold">
                Student Leave Request
              </div>
              <br />
              <h2>There is no request for the day.....</h2>
            </div>
          </div>
        </div>
        <?php endif;?>
      </div>
    </div>
  </div>


  <!-- end: PAGE CONTENT-->